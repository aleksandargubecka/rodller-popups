!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):"object"==typeof exports?module.exports=e(require("jquery")):e(jQuery)}(function(l){var n=/\+/g;function c(e){return w.raw?e:encodeURIComponent(e)}function f(e,o){e=w.raw?e:function(e){0===e.indexOf('"')&&(e=e.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return e=decodeURIComponent(e.replace(n," ")),w.json?JSON.parse(e):e}catch(e){}}(e);return l.isFunction(o)?o(e):e}var w=l.cookie=function(e,o,n){var t,i;if(1<arguments.length&&!l.isFunction(o))return"number"==typeof(n=l.extend({},w.defaults,n)).expires&&(i=n.expires,(t=n.expires=new Date).setMilliseconds(t.getMilliseconds()+864e5*i)),document.cookie=[c(e),"=",(i=o,c(w.json?JSON.stringify(i):String(i))),n.expires?"; expires="+n.expires.toUTCString():"",n.path?"; path="+n.path:"",n.domain?"; domain="+n.domain:"",n.secure?"; secure":""].join("");for(var s=e?void 0:{},r=document.cookie?document.cookie.split("; "):[],p=0,u=r.length;p<u;p++){var d=r[p].split("="),a=(a=d.shift(),w.raw?a:decodeURIComponent(a)),d=d.join("=");if(e===a){s=f(d,o);break}e||void 0===(d=f(d))||(s[a]=d)}return s};w.defaults={},l.removeCookie=function(e,o){return l.cookie(e,"",l.extend({},o,{expires:-1})),!l.cookie(e)}}),function(n){function t(e){0<e.clientY||(o&&clearTimeout(o),n.exitIntent.settings.sensitivity<=0?n.event.trigger("exitintent"):o=setTimeout(function(){o=null,n.event.trigger("exitintent")},n.exitIntent.settings.sensitivity))}function i(){o&&(clearTimeout(o),o=null)}var o;n.exitIntent=function(e,o){if(n.exitIntent.settings=n.extend(n.exitIntent.settings,o),"enable"==e)n(window).mouseleave(t),n(window).mouseenter(i);else{if("disable"!=e)throw"Invalid parameter to jQuery.exitIntent -- should be 'enable'/'disable'";i(),n(window).unbind("mouseleave",t),n(window).unbind("mouseenter",i)}},n.exitIntent.settings={sensitivity:300}}(jQuery),function(n){"use strict";function t(e){return void 0===e||(0===e||"0"===e||(null===e||(0===e.length||(""===e||(!1===e||!("object"!=typeof e||!n.isEmptyObject(e)))))))}n(document).ready(function(){window.rodllerPopups.init()}),window.rodllerPopups={popups:n(".rodller-popup"),init:function(){t(window.rodllerPopups.popups)||(n("body").on("click",".rodller-popup-close",this.hidePopUp),n("body").on("click","a[href*=\\#]",this.openPopupClick),window.rodllerPopups.popups.each(function(){var e=n(this),o=e.data("id").toString();return!!e.hasClass("showed")||(!e.hasClass("dont-show-again")||"showed"!==n.cookie(o))&&(n.exitIntent("enable"),void(e.hasClass("exif")?window.rodllerPopups.exifPopup(e):window.rodllerPopups.standardPopup(e)))}))},hidePopUp:function(e){e.preventDefault();var o=n(this).closest(".rodller-popup"),e=o.data("id");o.removeClass("rodller-popup-active"),o.hasClass("dont-show-again")&&n.cookie(e,"showed",{expires:7,path:"/"})},openPopupClick:function(e){var o=n(this).attr("href").split("#").slice(-1),o=n("#rodller-popup-"+o);if(t(o))return!0;e.preventDefault(),window.rodllerPopups.showPopup(o)},exifPopup:function(e){n(document).bind("exitintent",function(){e.hasClass("showed")||window.rodllerPopups.showPopup(e)})},standardPopup:function(e){var o=parseInt(e.data("show-after"));setTimeout(function(){window.rodllerPopups.showPopup(e)},1e3*o)},showPopup:function(e){e.addClass("rodller-popup-active"),e.hasClass("dont-show-again")&&e.addClass("showed")}}}(jQuery);