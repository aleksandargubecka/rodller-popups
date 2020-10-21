(function ($) {

	"use strict";

	$( document ).ready( function() {
		window.rodllerPopupsAdmin.init();
	} );

	window.rodllerPopupsAdmin = {
		init:function() {
			this.initColorPicker()
		},

		initColorPicker: function() {
			$('.rodller-popup-color-picker').each(function(){
				$(this).wpColorPicker();
			});
		}
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