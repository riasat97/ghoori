



	function Slider(container, nav) {
		this.container = container;
		this.nav = nav;

		this.imgs = this.container.find('img');
		this.imgWidth = this.imgs[0].width;
		this.imgsLen = this.imgs.length;

		this.current = 0;
	}

	Slider.prototype.transition = function( coords ) {

		this.container.animate({
			'margin-left': coords || -( this.current * this.imgWidth ),
		}, {duration: 200, queue:false}, function() {
			this.animate({
				autoPlay : true,
			navigation : true,
                slideSpeed : 600,
                paginationSpeed : 200,
                singleItem : true,

                stopOnHover : true,
                navigation : true,
                responsive : true
			})
		});

	};

	Slider.prototype.setCurrent = function( dir ) {

		// console.log(this.imgsLen);

		var pos = this.current;

		pos += (~~( dir === 'next' ) || -1);

		this.current = ( pos < 0 ) ?  this.imgsLen -1 : pos % this.imgsLen;

		console.log(this.current);

		return pos;

	};









	function Slider2(container, nav) {
		this.container = container;
		this.nav = nav;

		this.imgs = this.container.find('img');
		this.imgWidth = this.imgs[0].width;
		this.imgsLen = this.imgs.length;

		this.current = 0;
	}

	Slider2.prototype.transition = function( coords ) {

		this.container.animate({
			'margin-left': coords || -( this.current * this.imgWidth ),
		}, {duration: 200, queue:false}, function() {
			this.animate({
				autoPlay : true,
			navigation : true,
                slideSpeed : 600,
                paginationSpeed : 200,
                singleItem : true,
                autoPlay : true,

                stopOnHover : true,
                navigation : true,
                responsive : true
			})
		});

	};

	Slider2.prototype.setCurrent = function( dir ) {

		// console.log(this.imgsLen);

		var pos = this.current;

		pos += (~~( dir === 'next' ) || -1);

		this.current = ( pos < 0 ) ?  this.imgsLen -1 : pos % this.imgsLen;

		console.log(this.current);

		return pos;

	};














// (function() {
// 	var sliderUL = $('div.sidebar-slider').css('overflow', 'hidden').children('ul'),
// 		imgs = sliderUL.find('img'),
// 		imgWidth = imgs[0].width,
// 		imgLen = imgs.length,
// 		totalImgWidth = imgWidth * imgLen,
// 		current = 1;

// 	console.log(imgs[0]);
// 	console.log('All images: '+ imgs);
// 	console.log('First image width: '+ imgWidth);
// 	console.log('Total number of images: '+ imgLen);
// 	console.log('Total images width: '+ totalImgWidth);

// 	$('.slider-nav').show().find('.slide-icon').on('click', function() {
// 		var direction = $(this).data('dir');
// 		console.log('Go: '+ direction);

// 		( direction === 'next' ) ? ++current : --current;

// 		var w = totalImgWidth - imgWidth;

// 		var loc;

// 		if( current === 0 ) {
// 			current = imgLen;
// 			loc = totalImgWidth - imgWidth;
// 			// console.log(loc);
// 			direction = 'next;'
// 			sliderUL.animate({
// 				'margin-left': '-='+w
// 			});
			
// 		}

// 		else if( current === imgLen+1 ) {
// 			current = 1;
// 			loc = 0;
// 			sliderUL.animate({
// 				'margin-left': '+='+w
// 			});
// 		}

// 		else {

// 			var unit;

// 			if ( direction && loc !== 0 ) {
// 				unit = (direction === 'next') ? '-=' : '+=';
// 			}

// 			sliderUL.animate({
// 				'margin-left': unit+imgWidth
// 			},  {duration: 400, queue:false});

// 		}

// 		console.log(current);
// 	});
// })();














// (function() {
// 	var sliderUL = $('div.sidebar-slider').css('overflow', 'hidden').children('ul'),
// 		imgs = sliderUL.find('img'),
// 		imgWidth = imgs[0].width,
// 		imgLen = imgs.length,
// 		totalImgWidth = imgWidth * imgLen,
// 		current = 1;

// 	console.log(imgs[0]);
// 	console.log('All images: '+ imgs);
// 	console.log('First image width: '+ imgWidth);
// 	console.log('Total number of images: '+ imgLen);
// 	console.log('Total images width: '+ totalImgWidth);

// 	$('.slider-nav').show().find('.slide-icon').on('click', function() {
// 		var direction = $(this).data('dir');
// 		console.log('Go: '+ direction);

// 		( direction === 'next' ) ? ++current : --current;

// 		var w = totalImgWidth - imgWidth;

// 		var loc;

// 		if( current === 0 ) {
// 			current = imgLen;
// 			loc = totalImgWidth - imgWidth;
// 			// console.log(loc);
// 			direction = 'next;'
// 			sliderUL.animate({
// 				'margin-left': '-='+w
// 			});
			
// 		}

// 		else if( current === imgLen+1 ) {
// 			current = 1;
// 			loc = 0;
// 			sliderUL.animate({
// 				'margin-left': '+='+w
// 			});
// 		}

// 		else {

// 			var unit;

// 			if ( direction && loc !== 0 ) {
// 				unit = (direction === 'next') ? '-=' : '+=';
// 			}

// 			sliderUL.animate({
// 				'margin-left': unit+imgWidth
// 			},  {duration: 400, queue:false});

// 		}

// 		console.log(current);
// 	});
// })();