

$(document).ready(function() {

    /********************************Content Animation Left to Right AND Right to Left***************************/
    var $animation_elements = $('.animation-element');
    var $window = $(window);

    function check_if_in_view() {
        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = (window_top_position + window_height);
     
        $.each($animation_elements, function() {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);
     
            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) && (element_top_position <= window_bottom_position)) {
                $element.addClass('in-view');
            }
            else {
                $element.removeClass('in-view');
            }
        });
    }

    $window.on('scroll resize', check_if_in_view);
    $window.trigger('scroll');





    /********************************Image Popup Zoom Effect using Magnific Popup***************************/
    $('.img-link-1').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below

        zoom: {
        enabled: true, // By default it's false, so don't forget to enable it
        duration: 300, // duration of the effect, in milliseconds
        easing: 'ease-in-out', // CSS transition easing function 
            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function(openerElement) {
                // openerElement is the element on which popup was initialized, in this case its <a> tag
                // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });


    $('.img-link-2').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below

        zoom: {
        enabled: true, // By default it's false, so don't forget to enable it
        duration: 300, // duration of the effect, in milliseconds
        easing: 'ease-in-out', // CSS transition easing function 
            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function(openerElement) {
                // openerElement is the element on which popup was initialized, in this case its <a> tag
                // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });


    $('.img-link-3').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below

        zoom: {
        enabled: true, // By default it's false, so don't forget to enable it
        duration: 300, // duration of the effect, in milliseconds
        easing: 'ease-in-out', // CSS transition easing function 
            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function(openerElement) {
                // openerElement is the element on which popup was initialized, in this case its <a> tag
                // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });


    $('.img-link-4').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below

        zoom: {
        enabled: true, // By default it's false, so don't forget to enable it
        duration: 300, // duration of the effect, in milliseconds
        easing: 'ease-in-out', // CSS transition easing function 
            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function(openerElement) {
                // openerElement is the element on which popup was initialized, in this case its <a> tag
                // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });


    $('.img-link-5').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below

        zoom: {
        enabled: true, // By default it's false, so don't forget to enable it
        duration: 300, // duration of the effect, in milliseconds
        easing: 'ease-in-out', // CSS transition easing function 
            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function(openerElement) {
                // openerElement is the element on which popup was initialized, in this case its <a> tag
                // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });


    $('.img-link-6').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below

        zoom: {
        enabled: true, // By default it's false, so don't forget to enable it
        duration: 300, // duration of the effect, in milliseconds
        easing: 'ease-in-out', // CSS transition easing function 
            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function(openerElement) {
                // openerElement is the element on which popup was initialized, in this case its <a> tag
                // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });


    $('.img-link-7').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below

        zoom: {
        enabled: true, // By default it's false, so don't forget to enable it
        duration: 300, // duration of the effect, in milliseconds
        easing: 'ease-in-out', // CSS transition easing function 
            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function(openerElement) {
                // openerElement is the element on which popup was initialized, in this case its <a> tag
                // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });

    $('.img-link-8').magnificPopup({
        type: 'image',
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below

        zoom: {
        enabled: true, // By default it's false, so don't forget to enable it
        duration: 300, // duration of the effect, in milliseconds
        easing: 'ease-in-out', // CSS transition easing function 
            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function(openerElement) {
                // openerElement is the element on which popup was initialized, in this case its <a> tag
                // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });
});


/********************************Not in use Here Image Popup***************************/
// $('#open-popup-1').magnificPopup({
//     items: [
//       {
//         src: 'images/Untitled-1.png',
//         title: 'Go to https://ghoori.com.bd/ and Click "Login" from upper right cornerof the website'
//       }
//     ],
//     gallery: {
//       enabled: true
//     },
//     type: 'image', // this is a default type
//     removalDelay: 300,
//     mainClass: 'mfp-fade'
// });

// $('#open-popup-2').magnificPopup({
//     items: [
//       {
//         src: 'images/Untitled-2.png',
//         title: 'Click on "f Login" button'
//       }
//     ],
//     gallery: {
//       enabled: true
//     },
//     type: 'image', // this is a default type
//     removalDelay: 300,
//     mainClass: 'mfp-fade'
// });

// $('#open-popup-3').magnificPopup({
//     items: [
//       {
//         src: 'images/Untitled-3.png',
//         title: 'Then click "My Shop" button'
//       }
//     ],
//     gallery: {
//       enabled: true
//     },
//     type: 'image', // this is a default type
//     removalDelay: 300,
//     mainClass: 'mfp-fade'
// });

// $('#open-popup-4').magnificPopup({
//     items: [
//       {
//         src: 'images/Untitled-4.png',
//         title: 'Click "Facebook Shop" button floating above the banner image'
//       }
//     ],
//     gallery: {
//       enabled: true
//     },
//     type: 'image', // this is a default type
//     removalDelay: 300,
//     mainClass: 'mfp-fade'
// });

// $('#open-popup-5').magnificPopup({
//     items: [
//       {
//         src: 'images/Untitled-5.png',
//         title: 'Select the desired page (e.g. Pinjuice) where you want to install the tab app, from the drop down list and Click "Install"'
//       }
//     ],
//     gallery: {
//       enabled: true
//     },
//     type: 'image', // this is a default type
//     removalDelay: 300,
//     mainClass: 'mfp-fade'
// });

// $('#open-popup-6').magnificPopup({
//     items: [
//       {
//         src: 'images/Untitled-6.png',
//         title: 'Give a name of your page tab and Click "Save"'
//       }
//     ],
//     gallery: {
//       enabled: true
//     },
//     type: 'image', // this is a default type
//     removalDelay: 300,
//     mainClass: 'mfp-fade'
// });

// $('#open-popup-7').magnificPopup({
//     items: [
//       {
//         src: 'images/Untitled-7.png',
//         title: 'Click on "Go to your Facebook Shop" button'
//       }
//     ],
//     gallery: {
//       enabled: true
//     },
//     type: 'image', // this is a default type
//     removalDelay: 300,
//     mainClass: 'mfp-fade'
// });

// $('#open-popup-8').magnificPopup({
//     items: [
//       {
//         src: 'images/Untitled-8.png',
//         title: 'View your facebook tab app'
//       }
//     ],
//     gallery: {
//       enabled: true
//     },
//     type: 'image',
//     removalDelay: 300,
//     mainClass: 'mfp-fade',
//     tLoading: 'Please wait...'
// });

// var $window = $(window);
// $window.trigger('scroll');

