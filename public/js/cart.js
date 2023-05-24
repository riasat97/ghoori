(function() {
    [].slice.call( document.querySelectorAll( '.checkout' ) ).forEach( function( el ) {
        var openCtrl = el.querySelector( '.checkout__button' ),
            closeCtrls = el.querySelectorAll( '.checkout__cancel' );

        openCtrl.addEventListener( 'click', function(ev) {
            ev.preventDefault();
            $('.checkout-grid__item--product').show();
            setTimeout(function(){ classie.add( el, 'checkout--active' ); }, 200);
            
            setTimeout(function(){ $('.winteriscoming').fadeIn(1000); }, 200);
        } );

        [].slice.call( closeCtrls ).forEach( function( ctrl ) {
            ctrl.addEventListener( 'click', function() {
                classie.remove( el, 'checkout--active' );
                setTimeout(function(){ $('.checkout-grid__item--product').hide(); }, 100);
                
                $('.winteriscoming').fadeOut();
            } );
        } );
    } );
})();