(function ($) {

	"use strict";

	$( document ).ready( function() {
		window.rodllerPopups.init();
	} );

	window.rodllerPopups = {

		popups: $('.rodller-popup'),

		init: function() {

			if (empty(window.rodllerPopups.popups)){
				return;
			}

			$( 'body' ).on( 'click', '.rodller-popup-close', this.hidePopUp );
			$( 'body' ).on( 'click', 'a[href*=\\#]', this.openPopupClick );

			window.rodllerPopups.popups.each(function() {

				var $popup = $(this),
					id = $popup.data('id').toString();

				if ($popup.hasClass('showed') ){
					return true;
				}

				if ( $popup.hasClass('dont-show-again') && $.cookie( id ) === 'showed' ) {
					return false;
				}

				$.exitIntent( 'enable' );

				if ($popup.hasClass('exif') ){
					window.rodllerPopups.exifPopup($popup);
				}else{
					window.rodllerPopups.standardPopup($popup);
				}
			})
		},

		hidePopUp: function(e){
			e.preventDefault();

			var $popup = $(this).closest('.rodller-popup'),
				id = $popup.data('id');

			$popup.removeClass('rodller-popup-active');

			if ( $popup.hasClass('dont-show-again') ){
				$.cookie( id, 'showed', { expires: 7, path: '/' } );
			}
		},

		openPopupClick: function(e){
			var $this = $( this ),
				href = $this.attr( 'href' ),
				hrefSplitted = href.split( '#' ),
				id = hrefSplitted.slice( -1 ),
				hash = '#rodller-popup-' + id,
				$id = $( hash );

			if ( empty($id) ){
				return true;
			}

			e.preventDefault();
			window.rodllerPopups.showPopup( $id );

		},

		exifPopup: function($popup) {
			$( document ).bind( 'exitintent', function() {
				if ( !$popup.hasClass( 'showed' ) ) {
					window.rodllerPopups.showPopup( $popup );
				}
			} );
		},

		standardPopup: function($popup) {
			var time = parseInt($popup.data('show-after'));

			setTimeout(function() {
				window.rodllerPopups.showPopup( $popup );
			},time * 1000 )
		},

		showPopup: function( $popup ) {
			$popup.addClass('rodller-popup-active');

			if ($popup.hasClass('dont-show-again') ){
				$popup.addClass('showed');
			}
		},
	};

	/**
	 * Checks if variable is empty or not
	 *
	 * @param variable
	 * @returns {boolean}
	 */
	function empty(variable) {

		if (typeof variable === 'undefined') {
			return true;
		}

		if (variable === 0 || variable === '0') {
			return true;
		}

		if (variable === null) {
			return true;
		}

		if (variable.length === 0) {
			return true;
		}

		if (variable === "") {
			return true;
		}

		if (variable === false) {
			return true;
		}

		if (typeof variable === 'object' && $.isEmptyObject(variable)) {
			return true;
		}

		return false;
	}
})(jQuery);