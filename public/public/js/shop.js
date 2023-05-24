/* Modernizr 2.5.3 (Custom Build) | MIT & BSD
 * Build: http://www.modernizr.com/download/#-fontface-backgroundsize-borderimage-borderradius-boxshadow-flexbox-hsla-multiplebgs-opacity-rgba-textshadow-cssanimations-csscolumns-generatedcontent-cssgradients-cssreflections-csstransforms-csstransforms3d-csstransitions-applicationcache-canvas-canvastext-draganddrop-hashchange-history-audio-video-indexeddb-input-inputtypes-localstorage-postmessage-sessionstorage-websockets-websqldatabase-webworkers-geolocation-inlinesvg-smil-svg-svgclippaths-touch-webgl-shiv-mq-cssclasses-addtest-prefixed-teststyles-testprop-testallprops-hasevent-prefixes-domprefixes-load
 */
;window.Modernizr=function(a,b,c){function D(a){j.cssText=a}function E(a,b){return D(n.join(a+";")+(b||""))}function F(a,b){return typeof a===b}function G(a,b){return!!~(""+a).indexOf(b)}function H(a,b){for(var d in a)if(j[a[d]]!==c)return b=="pfx"?a[d]:!0;return!1}function I(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:F(f,"function")?f.bind(d||b):f}return!1}function J(a,b,c){var d=a.charAt(0).toUpperCase()+a.substr(1),e=(a+" "+p.join(d+" ")+d).split(" ");return F(b,"string")||F(b,"undefined")?H(e,b):(e=(a+" "+q.join(d+" ")+d).split(" "),I(e,b,c))}function L(){e.input=function(c){for(var d=0,e=c.length;d<e;d++)u[c[d]]=c[d]in k;return u.list&&(u.list=!!b.createElement("datalist")&&!!a.HTMLDataListElement),u}("autocomplete autofocus list placeholder max min multiple pattern required step".split(" ")),e.inputtypes=function(a){for(var d=0,e,f,h,i=a.length;d<i;d++)k.setAttribute("type",f=a[d]),e=k.type!=="text",e&&(k.value=l,k.style.cssText="position:absolute;visibility:hidden;",/^range$/.test(f)&&k.style.WebkitAppearance!==c?(g.appendChild(k),h=b.defaultView,e=h.getComputedStyle&&h.getComputedStyle(k,null).WebkitAppearance!=="textfield"&&k.offsetHeight!==0,g.removeChild(k)):/^(search|tel)$/.test(f)||(/^(url|email)$/.test(f)?e=k.checkValidity&&k.checkValidity()===!1:/^color$/.test(f)?(g.appendChild(k),g.offsetWidth,e=k.value!=l,g.removeChild(k)):e=k.value!=l)),t[a[d]]=!!e;return t}("search tel url email datetime date month week time datetime-local number range color".split(" "))}var d="2.5.3",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k=b.createElement("input"),l=":)",m={}.toString,n=" -webkit- -moz- -o- -ms- ".split(" "),o="Webkit Moz O ms",p=o.split(" "),q=o.toLowerCase().split(" "),r={svg:"http://www.w3.org/2000/svg"},s={},t={},u={},v=[],w=v.slice,x,y=function(a,c,d,e){var f,i,j,k=b.createElement("div"),l=b.body,m=l?l:b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),k.appendChild(j);return f=["&#173;","<style>",a,"</style>"].join(""),k.id=h,m.innerHTML+=f,m.appendChild(k),l||(m.style.background="",g.appendChild(m)),i=c(k,a),l?k.parentNode.removeChild(k):m.parentNode.removeChild(m),!!i},z=function(b){var c=a.matchMedia||a.msMatchMedia;if(c)return c(b).matches;var d;return y("@media "+b+" { #"+h+" { position: absolute; } }",function(b){d=(a.getComputedStyle?getComputedStyle(b,null):b.currentStyle)["position"]=="absolute"}),d},A=function(){function d(d,e){e=e||b.createElement(a[d]||"div"),d="on"+d;var f=d in e;return f||(e.setAttribute||(e=b.createElement("div")),e.setAttribute&&e.removeAttribute&&(e.setAttribute(d,""),f=F(e[d],"function"),F(e[d],"undefined")||(e[d]=c),e.removeAttribute(d))),e=null,f}var a={select:"input",change:"input",submit:"form",reset:"form",error:"img",load:"img",abort:"img"};return d}(),B={}.hasOwnProperty,C;!F(B,"undefined")&&!F(B.call,"undefined")?C=function(a,b){return B.call(a,b)}:C=function(a,b){return b in a&&F(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=w.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(w.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(w.call(arguments)))};return e});var K=function(c,d){var f=c.join(""),g=d.length;y(f,function(c,d){var f=b.styleSheets[b.styleSheets.length-1],h=f?f.cssRules&&f.cssRules[0]?f.cssRules[0].cssText:f.cssText||"":"",i=c.childNodes,j={};while(g--)j[i[g].id]=i[g];e.touch="ontouchstart"in a||a.DocumentTouch&&b instanceof DocumentTouch||(j.touch&&j.touch.offsetTop)===9,e.csstransforms3d=(j.csstransforms3d&&j.csstransforms3d.offsetLeft)===9&&j.csstransforms3d.offsetHeight===3,e.generatedcontent=(j.generatedcontent&&j.generatedcontent.offsetHeight)>=1,e.fontface=/src/i.test(h)&&h.indexOf(d.split(" ")[0])===0},g,d)}(['@font-face {font-family:"font";src:url("https://")}',["@media (",n.join("touch-enabled),("),h,")","{#touch{top:9px;position:absolute}}"].join(""),["@media (",n.join("transform-3d),("),h,")","{#csstransforms3d{left:9px;position:absolute;height:3px;}}"].join(""),['#generatedcontent:after{content:"',l,'";visibility:hidden}'].join("")],["fontface","touch","csstransforms3d","generatedcontent"]);s.flexbox=function(){return J("flexOrder")},s.canvas=function(){var a=b.createElement("canvas");return!!a.getContext&&!!a.getContext("2d")},s.canvastext=function(){return!!e.canvas&&!!F(b.createElement("canvas").getContext("2d").fillText,"function")},s.webgl=function(){try{var d=b.createElement("canvas"),e;e=!(!a.WebGLRenderingContext||!d.getContext("experimental-webgl")&&!d.getContext("webgl")),d=c}catch(f){e=!1}return e},s.touch=function(){return e.touch},s.geolocation=function(){return!!navigator.geolocation},s.postmessage=function(){return!!a.postMessage},s.websqldatabase=function(){return!!a.openDatabase},s.indexedDB=function(){return!!J("indexedDB",a)},s.hashchange=function(){return A("hashchange",a)&&(b.documentMode===c||b.documentMode>7)},s.history=function(){return!!a.history&&!!history.pushState},s.draganddrop=function(){var a=b.createElement("div");return"draggable"in a||"ondragstart"in a&&"ondrop"in a},s.websockets=function(){for(var b=-1,c=p.length;++b<c;)if(a[p[b]+"WebSocket"])return!0;return"WebSocket"in a},s.rgba=function(){return D("background-color:rgba(150,255,150,.5)"),G(j.backgroundColor,"rgba")},s.hsla=function(){return D("background-color:hsla(120,40%,100%,.5)"),G(j.backgroundColor,"rgba")||G(j.backgroundColor,"hsla")},s.multiplebgs=function(){return D("background:url(https://),url(https://),red url(https://)"),/(url\s*\(.*?){3}/.test(j.background)},s.backgroundsize=function(){return J("backgroundSize")},s.borderimage=function(){return J("borderImage")},s.borderradius=function(){return J("borderRadius")},s.boxshadow=function(){return J("boxShadow")},s.textshadow=function(){return b.createElement("div").style.textShadow===""},s.opacity=function(){return E("opacity:.55"),/^0.55$/.test(j.opacity)},s.cssanimations=function(){return J("animationName")},s.csscolumns=function(){return J("columnCount")},s.cssgradients=function(){var a="background-image:",b="gradient(linear,left top,right bottom,from(#9f9),to(white));",c="linear-gradient(left top,#9f9, white);";return D((a+"-webkit- ".split(" ").join(b+a)+n.join(c+a)).slice(0,-a.length)),G(j.backgroundImage,"gradient")},s.cssreflections=function(){return J("boxReflect")},s.csstransforms=function(){return!!J("transform")},s.csstransforms3d=function(){var a=!!J("perspective");return a&&"webkitPerspective"in g.style&&(a=e.csstransforms3d),a},s.csstransitions=function(){return J("transition")},s.fontface=function(){return e.fontface},s.generatedcontent=function(){return e.generatedcontent},s.video=function(){var a=b.createElement("video"),c=!1;try{if(c=!!a.canPlayType)c=new Boolean(c),c.ogg=a.canPlayType('video/ogg; codecs="theora"').replace(/^no$/,""),c.h264=a.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/,""),c.webm=a.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/,"")}catch(d){}return c},s.audio=function(){var a=b.createElement("audio"),c=!1;try{if(c=!!a.canPlayType)c=new Boolean(c),c.ogg=a.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/,""),c.mp3=a.canPlayType("audio/mpeg;").replace(/^no$/,""),c.wav=a.canPlayType('audio/wav; codecs="1"').replace(/^no$/,""),c.m4a=(a.canPlayType("audio/x-m4a;")||a.canPlayType("audio/aac;")).replace(/^no$/,"")}catch(d){}return c},s.localstorage=function(){try{return localStorage.setItem(h,h),localStorage.removeItem(h),!0}catch(a){return!1}},s.sessionstorage=function(){try{return sessionStorage.setItem(h,h),sessionStorage.removeItem(h),!0}catch(a){return!1}},s.webworkers=function(){return!!a.Worker},s.applicationcache=function(){return!!a.applicationCache},s.svg=function(){return!!b.createElementNS&&!!b.createElementNS(r.svg,"svg").createSVGRect},s.inlinesvg=function(){var a=b.createElement("div");return a.innerHTML="<svg/>",(a.firstChild&&a.firstChild.namespaceURI)==r.svg},s.smil=function(){return!!b.createElementNS&&/SVGAnimate/.test(m.call(b.createElementNS(r.svg,"animate")))},s.svgclippaths=function(){return!!b.createElementNS&&/SVGClipPath/.test(m.call(b.createElementNS(r.svg,"clipPath")))};for(var M in s)C(s,M)&&(x=M.toLowerCase(),e[x]=s[M](),v.push((e[x]?"":"no-")+x));return e.input||L(),e.addTest=function(a,b){if(typeof a=="object")for(var d in a)C(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,g.className+=" "+(b?"":"no-")+a,e[a]=b}return e},D(""),i=k=null,function(a,b){function g(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function h(){var a=k.elements;return typeof a=="string"?a.split(" "):a}function i(a){var b={},c=a.createElement,e=a.createDocumentFragment,f=e();a.createElement=function(a){var e=(b[a]||(b[a]=c(a))).cloneNode();return k.shivMethods&&e.canHaveChildren&&!d.test(a)?f.appendChild(e):e},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+h().join().replace(/\w+/g,function(a){return b[a]=c(a),f.createElement(a),'c("'+a+'")'})+");return n}")(k,f)}function j(a){var b;return a.documentShived?a:(k.shivCSS&&!e&&(b=!!g(a,"article,aside,details,figcaption,figure,footer,header,hgroup,nav,section{display:block}audio{display:none}canvas,video{display:inline-block;*display:inline;*zoom:1}[hidden]{display:none}audio[controls]{display:inline-block;*display:inline;*zoom:1}mark{background:#FF0;color:#000}")),f||(b=!i(a)),b&&(a.documentShived=b),a)}var c=a.html5||{},d=/^<|^(?:button|form|map|select|textarea)$/i,e,f;(function(){var a=b.createElement("a");a.innerHTML="<xyz></xyz>",e="hidden"in a,f=a.childNodes.length==1||function(){try{b.createElement("a")}catch(a){return!0}var c=b.createDocumentFragment();return typeof c.cloneNode=="undefined"||typeof c.createDocumentFragment=="undefined"||typeof c.createElement=="undefined"}()})();var k={elements:c.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:c.shivCSS!==!1,shivMethods:c.shivMethods!==!1,type:"default",shivDocument:j};a.html5=k,j(b)}(this,b),e._version=d,e._prefixes=n,e._domPrefixes=q,e._cssomPrefixes=p,e.mq=z,e.hasEvent=A,e.testProp=function(a){return H([a])},e.testAllProps=J,e.testStyles=y,e.prefixed=function(a,b,c){return b?J(a,b,c):J(a,"pfx")},g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+v.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return o.call(a)=="[object Function]"}function e(a){return typeof a=="string"}function f(){}function g(a){return!a||a=="loaded"||a=="complete"||a=="uninitialized"}function h(){var a=p.shift();q=1,a?a.t?m(function(){(a.t=="c"?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){a!="img"&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l={},o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};y[c]===1&&(r=1,y[c]=[],l=b.createElement(a)),a=="object"?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),a!="img"&&(r||y[c]===2?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i(b=="c"?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),p.length==1&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&o.call(a.opera)=="[object Opera]",l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return o.call(a)=="[object Array]"},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,i){var j=b(a),l=j.autoCallback;j.url.split(".").pop().split("?").shift(),j.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]||h),j.instead?j.instead(a,e,f,g,i):(y[j.url]?j.noexec=!0:y[j.url]=1,f.load(j.url,j.forceCSS||!j.forceJS&&"css"==j.url.split(".").pop().split("?").shift()?"c":c,j.noexec,j.attrs,j.timeout),(d(e)||d(l))&&f.load(function(){k(),e&&e(j.origUrl,i,g),l&&l(j.origUrl,i,g),y[j.url]=2})))}function i(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var j,l,m=this.yepnope.loader;if(e(a))g(a,0,m,0);else if(w(a))for(j=0;j<a.length;j++)l=a[j],e(l)?g(l,0,m,0):w(l)?B(l):Object(l)===l&&i(l,m);else Object(a)===a&&i(a,m)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,b.readyState==null&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};


/**
 * jQuery Mobile Google maps
 * @Author: Jochen Vandendriessche <jochen@builtbyrobot.com>
 * @Author URI: http://builtbyrobot.com
 *
 * @TODO:
 * - fix https image requests
**/

(function($){
	"use strict";

	var methods = {
		init : function(config) {
			var options = $.extend({
				deviceWidth: 480,
				showMarker: true,
			}, config),
			settings = {},
			markers = [];
			// we'll use the width of the device, because we stopped browsersniffing
			// a long time ago. Anyway, we want to target _every_ small display
			var _o = $(this); // store the jqyuery object once
			// iframe?
			//<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.be/maps?f=q&amp;source=s_q&amp;hl=nl&amp;geocode=&amp;q=Brugse+Heirweg+37,+aartrijke&amp;aq=&amp;sll=51.122175,3.086483&amp;sspn=0.009253,0.021651&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Brugse+Heirweg+37,+8211+Zedelgem,+West-Vlaanderen,+Vlaams+Gewest&amp;t=m&amp;z=14&amp;ll=51.122175,3.086483&amp;output=embed"></iframe>
			options.imgURI = 'http://maps.googleapis.com/maps/api/staticmap?';
			settings.center = 'Brussels Belgium';
			settings.zoom = '5';
			settings.size = screen.width + 'x' +  480;
			settings.scale = window.devicePixelRatio ? window.devicePixelRatio : 1;
			settings.maptype = 'roadmap';
			settings.sensor = false;
			options.settings = settings;

			if ($(this).attr('data-center')){
				options.settings.center = $(this).attr('data-center').replace(/ /gi, '+');
			}
			if ($(this).attr('data-zoom')){
				options.settings.zoom = parseInt($(this).attr('data-zoom'));
			}
			if ($(this).attr('data-maptype')){
				options.settings.zoom = $(this).attr('data-maptype');
			}
			
			// if there should be more markers _with_ text an ul.markers element should be used so
			// we can store all markers :-) (marker specific settings will be added later)
			if (options.showMarker){
				markers.push({
					label: 'A',
					position: settings.center
				});
			}
			options.markers = markers;
			$(this).data('options', options);
			
			if (screen.width < options.deviceWidth){
				$(this).mobileGmap('showImage');
			}else{
				$(this).mobileGmap('showMap');
			}
			
		},
		
		showMap : function(){
			var options = $(this).data('options'),
					geocoder = new google.maps.Geocoder(),
					latlng = new google.maps.LatLng(-34.397, 150.644),
					mapOptions = {},
					htmlObj = $(this).get(0);
					geocoder.geocode( { 'address': options.settings.center.replace(/\+/gi, ' ')}, function(results, status) {
					      if (status == google.maps.GeocoderStatus.OK) {
					        // map.setCenter(results[0].geometry.location);
					        mapOptions = {
										zoom: parseInt(options.settings.zoom, 10),
										center: results[0].geometry.location,
										mapTypeId: options.settings.maptype
									}
									var map = new google.maps.Map(htmlObj, mapOptions);
									var marker = new google.maps.Marker({
									            map: map,
									            position: results[0].geometry.location
									        });
					      }
					    });
		},
		
		showImage : function(){
			var par = [],
					r = new Image(),
					l = document.createElement('a'),
					options = $(this).data('options'),
					i = 0,
					m = [];
			for (var o in options.settings){
				par.push(o + '=' + options.settings[o]);
			}
			if (options.markers.length){
				var t=[];
				for (;i < options.markers.length;i++){
					t = [];
					for (var j in options.markers[i]){
						if (j == 'position'){
							t.push(options.markers[i][j]);
						}else{
							t.push(j + ':' + options.markers[i][j]);
						}
					}
					m.push('&markers=' + t.join('%7C'));
				}
			}
			r.src =  options.imgURI + par.join('&') + m.join('');
			l.href = 'http://maps.google.com/maps?q=' + options.settings.center;
			l.appendChild(r);
			$(this).empty().append(l);
		}
		
	};

	$.fn.mobileGmap = function(method){
		if ( methods[method] ) {
					return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
				} else if ( typeof method === 'object' || ! method ) {
					return methods.init.apply( this, arguments );
				} else {
					$.error( 'Method ' + method + ' does not exist on jQuery.mobileGmap' );
		}
	};
})(this.jQuery);

/*
 SelectNav.js (v. 0.1)
 Converts your <ul>/<ol> navigation into a dropdown list for small screens
 https://github.com/lukaszfiszer/selectnav.js
*/
window.selectnav=function(){return function(p,q){var a,h=function(b){var c;b||(b=window.event);b.target?c=b.target:b.srcElement&&(c=b.srcElement);3===c.nodeType&&(c=c.parentNode);c.value&&(window.location.href=c.value)},k=function(b){b=b.nodeName.toLowerCase();return"ul"===b||"ol"===b},l=function(b){for(var c=1;document.getElementById("selectnav"+c);c++);return b?"selectnav"+c:"selectnav"+(c-1)},n=function(b){g++;var c=b.children.length,a="",d="",f=g-1;if(c){if(f){for(;f--;)d+=r;d+=" "}for(f=0;f<
c;f++){var e=b.children[f].children[0];if("undefined"!==typeof e){var h=e.innerText||e.textContent,i="";j&&(i=-1!==e.className.search(j)||-1!==e.parentElement.className.search(j)?m:"");s&&!i&&(i=e.href===document.URL?m:"");a+='<option value="'+e.href+'" '+i+">"+d+h+"</option>";t&&(e=b.children[f].children[1])&&k(e)&&(a+=n(e))}}1===g&&o&&(a='<option value="">'+o+"</option>"+a);1===g&&(a='<select class="selectnav" id="'+l(!0)+'">'+a+"</select>");g--;return a}};if((a=document.getElementById(p))&&k(a)){document.documentElement.className+=
" js";var d=q||{},j=d.activeclass||"active",s="boolean"===typeof d.autoselect?d.autoselect:!0,t="boolean"===typeof d.nested?d.nested:!0,r=d.indent||"\u2192",o=d.label||"- Navigation -",g=0,m=" selected ";a.insertAdjacentHTML("afterend",n(a));a=document.getElementById(l());a.addEventListener&&a.addEventListener("change",h);a.attachEvent&&a.attachEvent("onchange",h)}}}();

/*
 * jQuery FlexSlider v2.0
 * http://www.woothemes.com/flexslider/
 *
 * Copyright 2012 WooThemes
 * Free to use under the GPLv2 license.
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Contributing author: Tyler Smith (@mbmufffin)
 */

/*jshint bitwise:true, curly:true, eqeqeq:true, forin:true, immed:false, latedef:true, newcap:true, noarg:true, noempty:true, nonew:true, undef:true, strict:false, trailing:true, 
  browser:true, jquery:true */
/*!
 * jQuery flexslider extension
 * Original author: @markirby
 * Licensed under the MIT license
 */

;(function ( $, window, document, undefined ) {
  
  var flexsliderManualDirectionControls = 'flexsliderManualDirectionControls',
      defaults = {
        previousElementSelector: ".previous",
        nextElementSelector: ".next",
        disabledStateClassName: "disable"
      };

  function FlexsliderManualDirectionControls( element, options ) {
    this.element = element;
    this.options = $.extend( {}, defaults, options) ;

    this._flexslider = $(element).data('flexslider');
    this._originalFlexsliderWrapupFunction = this._flexslider.wrapup;
    this._defaults = defaults;
    this._name = flexsliderManualDirectionControls;

    this.init();
  }

  FlexsliderManualDirectionControls.prototype.init = function () {
      this.addEventListeners();
      var self = this;
      this._flexslider.wrapup = function(direction) {
        self.onAnimationEnd.call(self, direction);
      };
  };
  
  FlexsliderManualDirectionControls.prototype.addEventListeners = function() {
    
    $(this.element).find(this.options.previousElementSelector).bind('touchstart.flexsliderPromo click.flexsliderPromo', {self:this}, function(event) {
      event.stopPropagation();
      event.preventDefault();
      
      if (!event.handled) {
        event.data.self.goToTargetInDirection('prev');
        event.handled = true;
      }
      
    });

    $(this.element).find(this.options.nextElementSelector).bind('click.flexsliderPromo', {self:this}, function(event) {

      event.stopPropagation();
      event.preventDefault();

      if (!event.handled) {
        event.data.self.goToTargetInDirection('next');
        event.handled = true;
      }

    });
    
  };
  
  FlexsliderManualDirectionControls.prototype.goToTargetInDirection = function(direction) {
    
    var target = this._flexslider.getTarget(direction);
    
    if (this._flexslider.canAdvance(target)) {
      this._flexslider.flexAnimate(target);
    }
    
    return false;
  };
  
  FlexsliderManualDirectionControls.prototype.addOrRemoveDisabledStateForDirection = function(direction, $navElement) {
    var target = this._flexslider.getTarget(direction);
   
    if (!this._flexslider.canAdvance(target)) {
      $navElement.addClass(this.options.disabledStateClassName);
    } else {
      $navElement.removeClass(this.options.disabledStateClassName);
    }
  };
  
  FlexsliderManualDirectionControls.prototype.onAnimationEnd = function(direction) {
      var $nextElement = $(this.element).find(this.options.nextElementSelector),
      $previousElement = $(this.element).find(this.options.previousElementSelector);
      
      this.addOrRemoveDisabledStateForDirection('next', $nextElement);
      this.addOrRemoveDisabledStateForDirection('prev', $previousElement);
      
      this._originalFlexsliderWrapupFunction(direction);
  };
  
  $.fn[flexsliderManualDirectionControls] = function ( options ) {
    return this.each(function () {
      if (!$.data(this, 'plugin_' + flexsliderManualDirectionControls)) {
        $.data(this, 'plugin_' + flexsliderManualDirectionControls,
        new FlexsliderManualDirectionControls( this, options ));
      }
    });
  };
  
})( jQuery, window, document );

//eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(5($){5 L(a){a.3x.1F[a.3r]=3o(a.3n,10)+a.3l}6 j=5(a){3k({3i:"1E.1d.3d 3c 3b",38:a})};6 k=5(){7(/*@2S!@*/19&&(2Q 2N.1w.1F.2K==="2F"))};6 l={2C:[0,4,4],2B:[1u,4,4],2y:[1s,1s,2v],2u:[0,0,0],2t:[0,0,4],2s:[1q,1p,1p],2o:[0,4,4],2n:[0,0,B],2m:[0,B,B],2l:[1b,1b,1b],2j:[0,1c,0],2i:[2h,2g,1o],2e:[B,0,B],2d:[2c,1o,2b],2a:[4,1n,0],27:[24,21,20],1Z:[B,0,0],1Y:[1R,1P,1O],1N:[3s,0,Y],2f:[4,0,4],1Q:[4,2z,0],2E:[0,t,0],22:[26,0,28],29:[1u,1z,1n],2p:[2r,2w,1z],2x:[1h,4,4],2A:[1i,2G,1i],2L:[Y,Y,Y],2M:[4,2O,2W],33:[4,4,1h],34:[0,4,0],35:[4,0,4],36:[t,0,0],39:[0,0,t],3e:[t,t,0],3j:[4,1q,0],3m:[4,W,3t],1H:[t,0,t],1I:[t,0,t],1J:[4,0,0],1K:[W,W,W],1L:[4,4,4],1M:[4,4,0],9:[4,4,4]};6 m=5(a){U(a&&a.1j("#")==-1&&a.1j("(")==-1){7"1S("+l[a].1T()+")"}1U{7 a}};$.1V($.1W.1X,{w:L,x:L,u:L,v:L});$.1k.23=5(){7 V.1l(5(){6 a=$(V);a.1d(a.F(\'1m\'))})};$.1k.1d=5(i){7 V.1l(5(){6 c=$(V),3,$8,C,11,1f,1e=k();U(c.F(\'S\')){7 19}6 e={R:(5(a){2k(a){X"T":7"Z";X"Z":7"T";X"15":7"14";X"14":7"15";2q:7"Z"}})(i.R),y:m(i.A)||"#H",A:m(i.y)||c.z("12-A"),1r:c.N(),D:i.D||1t,Q:i.Q||5(){},K:i.K||5(){},P:i.P||5(){}};c.F(\'1m\',e).F(\'S\',1).F(\'2D\',e);3={s:c.s(),p:c.p(),y:m(i.y)||c.z("12-A"),1v:c.z("2H-2I")||"2J",R:i.R||"T",E:m(i.A)||"#H",D:i.D||1t,o:c.1x().o,n:c.1x().n,1y:i.1r||2P,9:"9",18:i.18||19,Q:i.Q||5(){},K:i.K||5(){},P:i.P||5(){}};1e&&(3.9="#2R");$8=c.z("16","2T").8(2U).F(\'S\',1).2V("1w").N("").z({16:"1g",2X:"2Y",n:3.n,o:3.o,2Z:0,30:31,"-32-1A-1B":"G G G #1C","-37-1A-1B":"G G G #1C"});6 f=5(){7{1D:3.9,1v:0,3a:0,w:0,u:0,v:0,x:0,M:3.9,O:3.9,I:3.9,J:3.9,12:"3f",3g:\'3h\',p:0,s:0}};6 g=5(){6 a=(3.p/1c)*25;6 b=f();b.s=3.s;7{"q":b,"1a":{w:0,u:a,v:a,x:0,M:\'#H\',O:\'#H\',o:(3.o+(3.p/2)),n:(3.n-a)},"r":{x:0,w:0,u:0,v:0,M:3.9,O:3.9,o:3.o,n:3.n}}};6 h=5(){6 a=(3.p/1c)*25;6 b=f();b.p=3.p;7{"q":b,"1a":{w:a,u:0,v:0,x:a,I:\'#H\',J:\'#H\',o:3.o-a,n:3.n+(3.s/2)},"r":{w:0,u:0,v:0,x:0,I:3.9,J:3.9,o:3.o,n:3.n}}};11={"T":5(){6 d=g();d.q.w=3.p;d.q.M=3.y;d.r.x=3.p;d.r.O=3.E;7 d},"Z":5(){6 d=g();d.q.x=3.p;d.q.O=3.y;d.r.w=3.p;d.r.M=3.E;7 d},"15":5(){6 d=h();d.q.u=3.s;d.q.I=3.y;d.r.v=3.s;d.r.J=3.E;7 d},"14":5(){6 d=h();d.q.v=3.s;d.q.J=3.y;d.r.u=3.s;d.r.I=3.E;7 d}};C=11[3.R]();1e&&(C.q.3p="3q(A="+3.9+")");1f=5(){6 a=3.1y;7 a&&a.1E?a.N():a};$8.17(5(){3.Q($8,c);$8.N(\'\').z(C.q);$8.13()});$8.1G(C.1a,3.D);$8.17(5(){3.P($8,c);$8.13()});$8.1G(C.r,3.D);$8.17(5(){U(!3.18){c.z({1D:3.E})}c.z({16:"1g"});6 a=1f();U(a){c.N(a)}$8.3u();3.K($8,c);c.3v(\'S\');$8.13()})})}})(3w);',62,220,'|||flipObj|255|function|var|return|clone|transparent||||||||||||||left|top|height|start|second|width|128|borderLeftWidth|borderRightWidth|borderTopWidth|borderBottomWidth|bgColor|css|color|139|dirOption|speed|toColor|data|0px|999|borderLeftColor|borderRightColor|onEnd|int_prop|borderTopColor|html|borderBottomColor|onAnimation|onBefore|direction|flipLock|tb|if|this|192|case|211|bt||dirOptions|background|dequeue|rl|lr|visibility|queue|dontChangeColor|false|first|169|100|flip|ie6|newContent|visible|224|144|indexOf|fn|each|flipRevertedSettings|140|107|42|165|content|245|500|240|fontSize|body|offset|target|230|box|shadow|000|backgroundColor|jquery|style|animate|purple|violet|red|silver|white|yellow|darkviolet|122|150|gold|233|rgb|toString|else|extend|fx|step|darksalmon|darkred|204|50|indigo|revertFlip|153||75|darkorchid|130|khaki|darkorange|47|85|darkolivegreen|darkmagenta|fuchsia|183|189|darkkhaki|darkgreen|switch|darkgrey|darkcyan|darkblue|cyan|lightblue|default|173|brown|blue|black|220|216|lightcyan|beige|215|lightgreen|azure|aqua|flipSettings|green|undefined|238|font|size|12px|maxHeight|lightgrey|lightpink|document|182|null|typeof|123456|cc_on|hidden|true|appendTo|193|position|absolute|margin|zIndex|9999|webkit|lightyellow|lime|magenta|maroon|moz|message|navy|lineHeight|error|plugin|js|olive|none|borderStyle|solid|name|orange|throw|unit|pink|now|parseInt|filter|chroma|prop|148|203|remove|removeData|jQuery|elem'.split('|'),0,{}))