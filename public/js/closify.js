/*
* jQuery Form Plugin; v20141005
* http://www.itechflare.com/
* Version: v2.6
* Copyright (c) 2014 iTechFlare; Licensed: GPL
* Developer: Abdulrhman Mohamed Samir Elbuni
*/

jQuery.noConflict();
 
(function( $ ) {

    // The closify plugin
	$.fn.closify = function(options) {
 
		var mainNode = this;
		var outputChanged = false;
		var hOffset = 20;
		var ratio;
		
		// The module pattern
		var closify = {
			init: function( elm, width, height, settings ) {
				closify.config = $.extend({
					allowedFileSize: 1024 * 1024 * 100, // (10 MB)
					url: "processupload.php",
					loadingImageUrl: 'images/ajax-loader.gif',
					backgroundImageUrl: 'images/arrow-upload-icon.png',
					imgBaseUrl: 'uploads',
					dataType: "json",
					hardTrim: true,
					quality: 1,
					id: ""+$(elm).attr("id"),
					startWithThisImg:'',
					dynamicStorage:false,
					targetOutput: "#output-"+$(elm).attr("id"),
					type: "post",
					circularCanvas: false,
					progress: false,
					position: {top:'0',left:'0'},
					topLeftCorner: true,
					topRightCorner: true,
					bottomLeftCorner: true,
					bottomRightCorner: true,
					responsive:true,
					data: {w:width, h:height, id:$(elm).attr("id")},
					menuBackgroundColor:'black',
                    action:'itech_closify_submission',
					menuTextColor:'white',
					progressBarColor: 'red',
					element: elm,
					error: closify.closifyError,
					success: closify.closifySuccess,
					uploadProgress: closify.uploadProgress,
					beforeSubmit:  closify.beforeSubmit,
					finishUploading: closify.finishUploading,
					finishCropping: closify.finishCropping,
					deletingImage: closify.deletingImage,
					imageDeleted: closify.imageDeleted
				}, options );
				
				// Updating post data array
				closify.config.data.quality = closify.config.quality;
				ratio = closify.config.data.w/closify.config.data.h;
				
				var widgetWidth = parseInt(width);
				
				// Widget width calculation based on canvas shape
				if(closify.config.circularCanvas)
				{
					widgetWidth = parseInt(width)+65;
				}
				
				// check if outputTarget has changed
				if(closify.config.targetOutput != ("#output-"+$(elm).attr("id")))
				{
					outputChanged = true;
				}else{
					outputChanged = false;
				}
				
				// Initiate the html structure
				closify.setup();
				
				if(outputChanged == false){
					$(elm).find("ul.closify-output-bar").hide();
				}
				
				var aspectRatio = width/height;
				
				// Android browser check
				var nua = navigator.userAgent.toLowerCase();
				var is_android = (nua.indexOf("android") > -1);
		
				function aspectResize() {
					var w = $( window ).width();
					var h = $( window ).height();
					var progressWidth = $('#progress-'+mainNode.attr("id")).width();
					w = w - 40;
					mainNode.width(w);
					mainNode.height(w/ratio);
					if( progressWidth > w){
						$('#progress-'+mainNode.attr("id")).width(w-5);
					}
				}
					
				if(closify.config.responsive){					
					// Responsive style
					mainNode.css("max-width",width+"px");
					mainNode.css("max-height",height+"px");
					
					aspectResize();
					$(window).resize(aspectResize);
					
					mainNode.find("div.closify-container").css("width","100%");
					mainNode.find("div.closify-container").css("height","100%");
					mainNode.find("div.closify-container").css("max-width",width+"px");
					mainNode.find("div.closify-container").css("max-height",height+"px");
					
					// To shift the container and leave place in the right for the menu
					if(closify.config.circularCanvas)
						mainNode.find("div.closify-widget").css("width","130%");
				}else{
					mainNode.find("div.closify-container").css("width",width+"px");
					mainNode.find("div.closify-container").css("height",height+"px");
					
					mainNode.css("width",widgetWidth+"px");
					mainNode.css("height",parseInt(height)+hOffset+"px");
					
					mainNode.find("div.closify-widget").css("width",widgetWidth+"px");
				}
				
				mainNode.find('.closify-container').css("background-image","url("+closify.config.backgroundImageUrl+")");
				
				mainNode.find("ul.closify-side-bar").hide();
				$("#progress-"+mainNode.attr("id")).hide();
			},

			//function to format bites bit.ly/19yoIPO
			bytesToSize:function(bytes) {
			   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
			   if (bytes == 0) return '0 Bytes';
			   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
			   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
			},
			finishUploading:function(result) {
			   // Trigger event
			},
			finishCropping:function(result) {
			   // Trigger event
			},
			deletingImage:function(result) {
			   // Trigger event
			},
			imageDeleted: function(result) {
				// Trigger event
			},
			setup: function() {
				var circular = '';
				if(closify.config.circularCanvas){
					if( closify.config.topLeftCorner && closify.config.topRightCorner && closify.config.bottomLeftCorner && closify.config.bottomRigthCorner)
					{
						circular += 'border-radius: 50%;';
						circular += '-webkit-border-radius: 50%;';
						circular += '-moz-border-radius: 50%;';
						closify.config.topLeftCorner=closify.config.topRightCorner=closify.config.bottomLeftCorner=closify.config.bottomRigthCorner=false;
					}
					if(closify.config.topLeftCorner){ 
						circular += '-webkit-border-top-left-radius: 50%;';
						circular += '-moz-border-radius-topleft: 50%;';
						circular += 'border-top-left-radius: 50%;';
					}
					if(closify.config.topRightCorner){ 
						circular += '-webkit-border-top-right-radius: 50%;';
						circular += '-moz-border-radius-topright: 50%;';
						circular += 'border-top-right-radius: 50%;';
					}
					if(closify.config.bottomLeftCorner){ 
						circular += '-webkit-border-bottom-left-radius: 50%;';
						circular += '-moz-border-radius-bottomleft: 50%;';
						circular += 'border-bottom-left-radius: 50%;';
					}
					if(closify.config.bottomRightCorner){ 
						circular += '-webkit-border-bottom-right-radius: 50%;';
						circular += '-moz-border-radius-bottomright: 50%;';
						circular += 'border-bottom-right-radius: 50%;';
					}
				}

				// ========== Elements declaration starts ========== //
				var wpSecurity = '<input type="hidden" name="action" value="itech_closify_submission" />';
				var widgetStart = '<div class="closify-widget" style="height:100%">';
				var menu = '<ul class="closify-side-bar" style="background-color:'+closify.config.menuBackgroundColor+';color:'+closify.config.menuTextColor+'"><li><a class="upload" href="" onclick="return false;"><span title="Upload an image" class="icon icon-pictures2" style="color:'+closify.config.menuTextColor+' !important"></span></a></li><li><a class="delete" href="" onclick="return false;"><span title="Delete" class="icon icon-trashcan" style="color:'+closify.config.menuTextColor+' !important"></span></a></li><li><a class="position" href="" onclick="return false;"><span  title="Position photo" class="icon icon-move-alt1" style="color:'+closify.config.menuTextColor+' !important"></span></a></li><li><a class="save" href="" onclick="return false;"><span title="Save changes" class="icon icon-checkmark3" style="color:'+closify.config.menuTextColor+' !important"></span></a></li></ul>';
				
				var closifyContainerStart = '<div class="closify-container closify-cursor" style="'+circular+'">';
				var closifyLoading = '<img class="closify-loading" src="'+closify.config.loadingImageUrl+'" style="display:none;" width="80px" height="80px"/>';
				var inputFile = '<input type="file" accept="image/*" style="display:none" id="'+mainNode.attr("id")+'ImageFile" name="'+mainNode.attr("id")+'ImageFile"/>';
				var hiddenInput = '<input type="hidden" name="ImageName" value="'+mainNode.attr("id")+'ImageFile" />';
				var hiddenInput = '<input type="hidden" id="imageList-'+mainNode.attr("id")+'" name="imageList-'+mainNode.attr("id")+'" value="" />';
				var hiddenDynamicStorage = '<input type="hidden" name="dynamicStorage" value="'+closify.config.dynamicStorage+'" />';
				var outputMenu = '<ul class="closify-output-bar" style="background-color:'+closify.config.menuBackgroundColor+';"><li class="closify-output" id="output-'+mainNode.attr("id")+'" style="color:'+closify.config.menuTextColor+' !important"></li></ul>';
				var closifyContainerEnd = '</div>';
				
				var progressBar = '<div id="progress-'+mainNode.attr("id")+'" style="height: 25px;width:'+closify.config.data.w+'px" class="meter '+closify.config.progressBarColor+'"><span style="width: 0%" id="span-progress-'+mainNode.attr("id")+'"></span></div>';
				
				var widgetEnd = '</div>';
				
				// ========== Elements declaration ends ========== //
				if(outputChanged){
					outputMenu = '';
				}
				// if circular convas is not enabled
				if(!closify.config.circularCanvas)
				{
					mainNode.html(wpSecurity +  widgetStart + closifyContainerStart+ menu + closifyLoading+ inputFile+ hiddenInput + hiddenDynamicStorage + outputMenu+closifyContainerEnd+widgetEnd);
					mainNode.find("ul.closify-side-bar").css("position","absolute");
				}else{
					mainNode.html(wpSecurity + widgetStart + menu + closifyContainerStart + closifyLoading+ inputFile+ hiddenInput + hiddenDynamicStorage + outputMenu+closifyContainerEnd+widgetEnd);
					mainNode.find("ul.closify-side-bar li").css("display","block");
				}
				
				if(closify.config.progress)
				{
					mainNode.after(progressBar);
				}
				
				if(closify.config.startWithThisImg != '')
				{
					closify.config.element.find("div.closify-container").append("<img class='closify-image' src='"+closify.config.startWithThisImg+"' style='width:100%;position:absolute;top:"+closify.config.position.top+";left:"+closify.config.position.left+"'>").hide().fadeIn(500);
				}
				if(closify.config.dynamicStorage)
				{
					var elm = closify.config.element.find("div.closify-container");
					elm.append("<img class='closify-image' src='"+closify.config.imgBaseUrl+"/"+mainNode.attr("id")+".jpg' style='position:absolute;top:"+closify.config.position.top+";left:"+closify.config.position.left+";'>").hide().fadeIn(500);
					var imgLoad = imagesLoaded(elm);
					
					imgLoad.on( 'fail', function( instance ) {
					  elm.find(".closify-image").remove();
					  console.log("Failed to load image!");
					});
				}
			},
			
			uploadProgress: function(e) {
				
				var percentComplete = e.loaded/e.total * 100;
			
				if(closify.config.progress){
					// show update progress bar
					$("#progress-"+mainNode.attr("id")).show();
					$("#span-progress-"+mainNode.attr("id")).css("width",percentComplete+"%");
					
					if(percentComplete >= 100)
					{
						setTimeout( function(e){
							$("#progress-"+mainNode.attr("id")).hide();
						}, 2000 );
					}
				}
			},
			
			closifyError: function(error)
			{
				if(mainNode.find('img.closify-loading').is(":visible")){
					mainNode.find('img.closify-loading').toggle();
					mainNode.find('.closify-container').css("background-image","url("+closify.config.backgroundImageUrl+")");
				}
			
				closify.printOutput(error.responseText,6000);
			},
			
			printOutput: function(msg, d)
			{
				if(!d)
				{
					d = 2000;
				}
				
				if(!outputChanged){ mainNode.find("ul.closify-output-bar").slideDown(); }
				else { $(closify.config.targetOutput).delay(d).slideDown(); }
				$(closify.config.targetOutput).html( msg );
				if(!outputChanged){ mainNode.find("ul.closify-output-bar").delay(d).slideUp();}
				else { $(closify.config.targetOutput).delay(d).slideUp(); }
			},
			
			closifySuccess: function(result){
				var d = new Date();
				
				// Check if imagick exist, and if any error has been retrieved from process logic
				if(result.msg == "false"){
					closify.printOutput("Error:"+result.error);
					
					// Stop loading
					mainNode.find("img.closify-loading").toggle();
					mainNode.find('.closify-container').css("background-image","url("+closify.config.backgroundImageUrl+")");
					mainNode.find("img.closify-image").remove();
					return;
				}
				
				// Store information globally and trigger finish uploading event
				closify.config.finishUploading(result);
				
				closify.printOutput("Image submitted!");
				// Stop loading
				mainNode.find("img.closify-loading").toggle();
				mainNode.find("img.closify-image").remove();
				mainNode.find("div.closify-container").append("<img class='closify-image' src='"+result.imgSrc+"?"+d.getTime()+"' style='position:absolute;top:0;left:0;max-width:"+result.width+"px;max-height:"+result.height+"px;'>").hide().fadeIn(500);
				
				mainNode.find('img.closify-image').dragncrop({drag: function(event, position){
						closify.config.position = position.offset;
					  }, 
					  centered: true, 
					  overlay: true, 
					  overflow: true, 
					  instruction: true
				});
			},
		
			beforeSubmit: function(){
				var is_chrome = navigator.userAgent.indexOf('Chrome') > -1;
				var is_safari = navigator.userAgent.indexOf("Safari") > -1;
				if ((is_chrome)&&(is_safari)) {is_safari=false;}
				
				if(closify.config.progress){
					// show update progress bar
					$("#progress-"+mainNode.attr("id")).show();
					$("#span-progress-"+mainNode.attr("id")).css("width","0");
				}

				//check whether browser fully supports all File API
			   if (window.File && window.FileReader && window.FileList && window.Blob)
				{
					
					if( !$('#'+mainNode.attr('id')+'ImageFile').val()) //check empty input filed
					{
						closify.closifyError("There is no image input");
						return false
					}
					
					var fsize = $('#'+mainNode.attr('id')+'ImageFile')[0].files[0].size; //get file size
					var ftype = $('#'+mainNode.attr('id')+'ImageFile')[0].files[0].type; // get file type
					

					//allow only valid image file types 
					switch(ftype)
					{
						case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
							break;
						default:
							closify.closifyError("<b>"+ftype+"</b> Unsupported file type!");
							return false
					}
					
					//Allowed file size is less than 1 MB (1048576)
					if(fsize > closify.config.allowedFileSize ) 
					{
                        var err = [];
                        err.responseText = "<b>"+closify.bytesToSize(fsize) +"</b> The image size is too big! <br />Please try to reduce the size of your photo using an image editor.";
						closify.closifyError(err);
						return false
					}
							
					$(closify.config.targetOutput).html("");  
				}
				else
				{
					if(is_safari) return true;
					
					//Output error to older unsupported browsers that doesn't support HTML5 File API
					closify.closifyError("Please upgrade your browser, because your current browser lacks some new features we need!");
					return false;
				}
				
				return true;
			}
		};
			
		// Initilization
		// Initialize closify literal
		closify.init(this,this.attr("width"),this.attr("height"));
		
		// =------ Events ------=
		// click sidebar
		mainNode.find("a.upload").click(function(){
			$("input[id="+mainNode.attr("id")+"ImageFile]").click();
		});

		mainNode.find("a.delete").click(function(){
			closify.config.deletingImage();
			$.ajax({
				url:closify.config.url,
				type: "POST",
				data: 
				{'id':closify.config.id,
				 'command':'delete',
                 'closify-id':mainNode.attr('closify-id'),
                 'closify-idx':mainNode.attr('closify-idx')
                },
				success: function( data ) {
					mainNode.find('.closify-container').css("background-image","url("+closify.config.backgroundImageUrl+")");
					closify.printOutput("Deleted!");
					closify.config.imageDeleted();
					if(mainNode.find("img.closify-image").hasClass("ui-draggable")){
						mainNode.find("img.closify-image").dragncrop("destroy");
					}

					mainNode.find("img.closify-image").remove();
					
					// Remove drag-n-crop widget
					mainNode.find("div.closify-container").attr("class","closify-container closify-cursor");
				}
			});
		});
		
		mainNode.find("a.position").click(function(){
			// Remove drag-n-crop widget
			mainNode.find("img.closify-image").dragncrop({drag: function(event, position){
						closify.config.position = position.offset;
					  }, 
					  overlay: true, 
					  overflow: true, 
					  instruction: true
				});
		});
		
		mainNode.find("a.save").click(function(){
			
			var tempData = {
				'top':mainNode.find('img.closify-image').css('top'),
				'left':mainNode.find('img.closify-image').css('left'),
                'action':'itech_closify_submission',
                'closify-id':mainNode.attr('closify-id'),
                'closify-idx':mainNode.attr('closify-idx')
				};
			
			if(closify.config.hardTrim)
			{
				tempData.quality = closify.config.quality;
				tempData.hardTrim = closify.config.hardTrim;
				tempData.width = closify.config.data.w;
				tempData.height = closify.config.data.h;
				tempData.src = mainNode.find('img.closify-image').attr('src');
				tempData.dynamicStorage = closify.config.dynamicStorage;
			}
			
			$.ajax({
				url:closify.config.url,
				type: "POST",
				dataType: "json",
				data: tempData,
				success: function( data ) {
					if(data.msg == "true"){
						closify.printOutput("Image saved!");
						
						// Store information globally and trigger finish uploading event
						closify.config.finishCropping(data);
				
						mainNode.find("img.closify-image").dragncrop("destroy");
						mainNode.find("div.closify-container").removeClass("closify-cursor");
						mainNode.find('.closify-container').css("background-image","");
						
						// Pass attachment ID as an input with the parent form
						if(data.attachID != null)
							$("imageList-"+mainNode.attr("id")).value(data.attachID);
						
						if(closify.config.hardTrim){
							mainNode.find('img.closify-image').attr('src', '');
							mainNode.find('img.closify-image').attr('src', data.imgSrc);
							mainNode.find('img.closify-image').hide();
							mainNode.find('img.closify-image').css('top', 0);
							mainNode.find('img.closify-image').css('left', 0);
							mainNode.find('img.closify-image').css('width', '100%');
							mainNode.find('img.closify-image').css('height', '100%');
							// Image fade in
							mainNode.find('img.closify-image').delay(400).fadeIn();
							//mainNode.find('img.closify-image').css('height', data.height);
							//mainNode.find('img.closify-image').css('width', data.width);
						}
					}else{
						closify.printOutput("Error:"+data.error);
						ainNode.find("img.closify-image").dragncrop("destroy");
						mainNode.find("div.closify-container").removeClass("closify-cursor");
					}
				}
			});
		});
		
		// Add delay to fix the menu rapid closing issue
		mainNode.hover(function(mouseEnterElm){
			mainNode.find("ul.closify-side-bar").slideDown().delay(1000);
		},function(mouseLeaveElm){

			mainNode.find("ul.closify-side-bar").slideUp();
		});
		
		// File choosen - event
		$('#'+mainNode.attr('id')+'ImageFile').change(function (){
			// Remove previous image
			mainNode.find("img.closify-image").remove();
			
			if(!mainNode.find('img.closify-loading').is(":visible")){
				mainNode.find('img.closify-loading').toggle();
				mainNode.find('.closify-container').css("background-image","none");
			}

			// Trigger submit form event
			var file = document.getElementById(mainNode.attr("id")+'ImageFile');
			processFiles(file);		

		 });
		 
		function processFiles(inputFile)
		{
			if(inputFile.length == 0){
				return false;
			}
			
			var data = new FormData();
			data.append(mainNode.attr("id")+'ImageFile', inputFile.files[0]);
			data.append('w', closify.config.data.w);
			data.append('h', closify.config.data.h);
			data.append('quality', closify.config.quality);
			data.append('dynamicStorage', closify.config.dynamicStorage);
			data.append('id', closify.config.data.id);
			data.append('ImageName', mainNode.attr("id")+'ImageFile');
			
			var sanitizeFile = closify.beforeSubmit(inputFile.files[0]);
			
			if(!sanitizeFile)
			{
				return false;
			}
			
			var requestTemp = new XMLHttpRequest();
			request = requestTemp;
			request.onreadystatechange = function(){
				if(this.readyState == 4){
					var resp = JSON.parse(this.response);
					closify.closifySuccess(resp);
				}
			};
			
			// Progress event listener
			request.upload.addEventListener('progress', closify.uploadProgress, false);

			request.open(closify.config.type, closify.config.url);
			request.send(data);
			
			return true;
		}
		
		// ========== End Events ========== //
				
        return this;
 
    };

})( jQuery );

/*!
 * jquery.drag-n-crop
 * https://github.com/lukaszfiszer/drag-n-crop
 *
 * Copyright (c) 2013 Lukasz Fiszer
 * Licensed under the MIT license.
 */

(function ( $, window, document, undefined ) {

    $.widget( "lukaszfiszer.dragncrop" , {

        classes: {
          // Basic classes
          container: 'dragncrop',
          containerActive: 'dragncrop-dragging',
          containment: 'dragncrop-containment',
          horizontal: 'dragncrop-horizontal',
          vertical: 'dragncrop-vertical',

          // Options' classes
          overflow: 'dragncrop-overflow',
          overlay: 'dragncrop-overlay',
          instruction: 'dragncrop-instruction',
          instructionHide: 'dragncrop-instruction-autohide',
          instructionText: 'dragncrop-instruction-text'
        },

        options: {
          // Initial position
          position: {},
          centered: false,

          // Simple overflow:
          overflow: false,

          // Overflaid overflow
          overlay: false,

          // Drag instruction
          instruction: false,
          instructionText: 'Drag to crop',
          instructionHideOnHover: true,
        },

        move: function ( position ) {

          var left, top, x, y;

          if( !position ){
            throw new Error('position object must be provided');
          }

          if (position.offset === undefined && position.dimension === undefined ) {
            throw new Error('position object must contain "left" or "top" props');
          }

          if( this.axis === 'x' && position.offset ){
            left = -position.offset[0] * this.offsetX;
            this.element.css('left', left);
            this.element.css('top', 0);
          } else
          if( this.axis === 'x' && position.dimension ){
            left = -position.dimension[0] * this.width;
            this.element.css('left', left);
            this.element.css('top', 0);
          } else

          if( this.axis === 'y' && position.offset ){
            top = -position.offset[1] * this.offsetY;
            this.element.css('left', 0);
            this.element.css('top', top);
          } else
          if( this.axis === 'y' && position.dimension ){
            top = -position.dimension[1] * this.height;
            this.element.css('left', 0);
            this.element.css('top', top);
          }

          this._setPosition( { left: left, top: top });

        },

        _create: function () {

          this.container = $(this.element.parent());
          this.container.addClass(this.classes.container);

          if( this.options.overflow || this.options.overlay){
            $(this.container).addClass(this.classes.overflow);
          }

          var dfd = this.element.imagesLoaded();
          var self = this;

          dfd.done(function(){
            if(self._setAxis.call(self)){
              self._getDimensions.call(self);
              self._makeDraggable.call(self);
              if (self.options.loaded) {
                self.options.loaded();
              }
            }
          } );

        },

        _destroy: function() {
          this.draggable && this.draggable.draggable('destroy');
          this.container.find('.' + this.classes.containment + ',' +
                              '.' + this.classes.overlay  + ',' +
                              '.' + this.classes.instruction).remove();
          this.element.removeClass(this.classes.horizontal)
                      .removeClass(this.classes.vertical);
        },

        getPosition: function() {
          return {
            offset : [
              ( -this.position.left / this.offsetX) || 0,
              ( -this.position.top / this.offsetY) || 0
            ],
            dimension : [
              ( -this.position.left / this.width) || 0,
              ( -this.position.top / this.height) || 0
            ]
          };

        },

        _getDimensions: function() {

          this.width = this.element.width();
          this.height = this.element.height();

          this.containerWidth = this.container.width();
          this.containerHeight = this.container.height();

          this.offsetX = this.width - this.containerWidth;
          this.offsetY = this.height - this.containerHeight;

        },

        _setAxis: function() {

          this.photoRatio = this.element.width() / this.element.height();
          this.containerRatio = this.container.width() / this.container.height();

          if (this.photoRatio > this.containerRatio) {

            this.axis = 'x';
            $(this.element).addClass(this.classes.horizontal);
            return true;

          } else if (this.photoRatio < this.containerRatio) {

            this.axis = 'y';
            $(this.element).addClass(this.classes.vertical);
            return true;

          }else{

            return false;

          }

        },

        _setPosition: function( obj ) {
          this.position = obj;
        },

        _makeDraggable : function () {

          var axis         = this.axis;
          var position     = this.options.position;
          var containement = this._insertContainment();

          var draggable = this.draggable = this.element.draggable({
            axis: axis,
            containment: containement
          });

          this._on({
            dragstart: function (event, ui) {
              this._dragStart( event , ui );
              this.container.addClass( this.classes.containerActive );
            },
            drag: function( event, ui ){
              this._dragging( event , ui );
              if (this.options.overlay) {
                this._adaptOverlay( ui );
              }
            },
            dragstop: function( event, ui ){
              this._dragStop( event , ui );
              this.container.removeClass( this.classes.containerActive );
            }
          });

          if(this.options.overlay){
            this._insertOverlay();
          }

          if(this.options.instruction){
            this._insertInstruction();
          }

          if(this.options.centered){
            position = { offset : [0.5, 0.5] };
          }

          if( position && ( position.offset || position.coordinates)) {
            this.move(position);
          }else{
            this._setPosition({ left: 0, top: 0 });
          }

        },

        _dragStart: function( event, ui ) {
          this._setPosition(ui.position);
          this._trigger('start', event, this.getPosition() );
        },

        _dragging: function( event, ui ) {
          this._setPosition(ui.position);
          this._trigger('drag', event, this.getPosition() );
        },

        _dragStop: function( event, ui ) {
          this._setPosition(ui.position);
          this._trigger('stop', event, this.getPosition() );
        },


        _insertOverlay: function(){

          var overlay = $('<div>').addClass(this.classes.overlay);
          this.overlay = overlay.insertBefore(this.element);
          return this.overlay;

        },

        _adaptOverlay: function( ui ) {

          if ( this.axis === 'x' ) {

            this.overlay.css('left', ui.position.left)
                        .css('border-left-width', -ui.position.left)
                        .css('right', -ui.position.left - this.offsetX)
                        .css('border-right-width', ui.position.left + this.offsetX);

          } else if ( this.axis === 'y' ){

            this.overlay.css('top', ui.position.top)
                        .css('border-top-width', -ui.position.top)
                        .css('bottom', -ui.position.top - this.offsetY )
                        .css('border-bottom-width', ui.position.top + this.offsetY );
          }

        },

        _insertContainment: function() {

          var top    = - this.offsetY;
          var bottom = - this.offsetY;
          var left   = - this.offsetX;
          var right  = - this.offsetX;

          var containment = $('<div/>').addClass(this.classes.containment)
                            .css('top',top).css('bottom', bottom)
                            .css('left',left).css('right',right)
                            .css('position','absolute');

          this.containment = containment.insertBefore(this.element);
          return this.containment;

        },

        _insertInstruction: function() {
          this.instruction = $('<div>').addClass(this.classes.instruction);
          if(this.options.instructionHideOnHover){
            this.instruction.addClass(this.classes.instructionHide);
          }
          this.instruction.append(
            $('<span></span>').text(this.options.instructionText)
                              .addClass(this.classes.instructionText)
          );
          this.instruction.insertAfter(this.element);
          return this.instruction;
        },

    });

})( jQuery, window, document );