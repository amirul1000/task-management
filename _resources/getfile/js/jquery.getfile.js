/*
 *	GetFile v2.2 - 2015-01-22
 *	jQuery Upload Plugin
 *	By Jose Carlos Rodriguez
 *	(c) 2014 Syscover S.L. - http://www.syscover.com/
 *	All rights reserved
 */

"use strict";

(function ( $ ) {
	var GetFile = {
		options: {
			urlPlugin:					'.',		                                // URL relative where is Get File plugin folder
			folder:						null,										// Path to the target folder (from the document root)
			tmpFolder:					null,										// Path to the temporary folder (from the document root)
			encryption:					false,										// File name encryption
			filename:					null,										// Desired final file name, without extension
			outputExtension:			null,										// Conversion to a image format (gif|jpg|png)
            multiple:                   false,                                      // set multiple files upload
            maxFileSize:                false,                                      // set maximun file size in bytes for each file uploaded
            maxFilesSizes:              false,                                      // set maximun file size in bytes for all uploads
            spinner:                    true,                                       // Use splinner while upload files
            mimesAccept:				[											// Accepted file types
				'image/*',
				'video/*',
				'audio/*',
                'text/plain',
				'application/pdf',
				'application/msword',
				'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
				'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
			],
			crop: {
				active:					false,										// Crop function is active
				width:					null,										// Final image width
				height:					null,										// Final image height
				aspectRatio:			null,										// Crop window aspect ratio, si instancia width y height el aspectRatio no se tiene en cuenta
				minSize:				null,										// Minimum crop size
				maxSize:				null,										// Maximum crop size
				setSelect:				null										// Default crop window coordinates
			},
			resize: {
				active:					false,										// Resize function is active
				width:					null,										// Final image width
				height:					null,										// Final image height
				constrainProportions:	true										// Mantiene las proporciones de la imagen
			},
            copies: [
			/*
			{
				width:					100,
				height:					100,
				constrainProportions:	true,
				prefix:					'@2',
				folder:					null,
				outputExtension:		null
			}
			*/
			],
            lang: {
                cropWindowTitle:		'Cop image',
                previewTitle:			'Preview',
                cropButtonText:			'Crop',
                cancelButtonText:		'Cancel'
            },
            selectorItems: {
                container:		        '#wrapGetFile',                             // Selector, crop frame and preview container
                cropButton:			    '#gfCropButton',                            // Selector, button that starts the crop process
                cancelButton:			'#gfCancelButton',                          // Selector, button that closes the crop window
                crop:		            '.imgs-crop-container',                     // Selector, frame that contains the crop
                preview:		        '.imgs-preview-container'                   // Selector, frame that contains the preview
            }
		},

		items: {
			container:				null,							                // Crop frame and preview container
			cropButton:				null,								            // Button that starts the crop process
			cancelButton:			null,							                // Button that closes the crop window
			crop:					null,						                    // Frame that contains the crop
			preview:				null					                        // Frame that contains the preview
		},

		properties: {
            files:                  null,                                           // Variable to set multiple files response
			coords:					null,											// Internal use variable
			tmpDelete:				345600,											// Minimum time that the temporary files are kept (by default, 345600 seconds = 4 days)
			tmpName:				'',											 	// Name of the file copied into the temporary folder from server
            oldName:                null,                                           // Original name of file
            extension:              null,                                           // Original extension of file
            mime:                   null,                                           // Original type mime of file
            size:                   null,                                           // Size from image uploaded
            isImage:                null,                                           // Check if is image file uploaded
            mow:					null,										    // Original frame width
            moh:					800,										    // Original frame height
            mpw:					null,										    // Preview frame width
            mph:					800,										    // Preview frame height
            row:					null,											// Real width of the image that's going to be cropped
			roh:					null,											// Real height of the image that's going to be cropped
			rpw:					null,											// Real preview width
			rph:					null,											// Real preview height
            width:                  null,                                           // Original image width
            height:                 null,                                           // Original image height
            pixelRatio:             null,                                           // Pixel ratio from screen
            phpIni:                 null,                                           // PHP ini values
            response:               null                                            // Variable where contain error response
		},

		callback: null,

		init: function(options, callback, elem)
		{
            // Options load
            this.options = $.extend({}, this.options, options||{});

            // Load popup if container haven't elements
            if(this.options.crop.active && $(this.options.selectorItems.container).length == 0)
            {
                var dataRequest = this.options.lang;
                dataRequest.urlPlugin = options.urlPlugin;

                $.ajax({
                    async:      false,
                    cache:      false,
                    dataType:   'html',
                    type:       'POST',
                    url:        this.options.urlPlugin + '/getfile/views/popup.php',
                    data:       dataRequest,
                    success:  function(data)
                    {
                        $('body').append(data);
                    },
                    error:function(data)
                    {
                        var data = {
                            success: false,
                            error:   12,
                            message: 'The path: ' + this.url + ' in the ajax request is not correct, please check the ajax function data'
                        };
                        callback(data);
                    }
                });
            }

            //Get PHP ini Values
            $.ajax({
                async:      false,
                url:        this.options.urlPlugin + '/getfile/php/Controllers/server.php',
                type:		'POST',
                dataType:	'json',
                context:	this,
                cache:		false,
                data: {
                    action: 'getvars'
                },
                success:  function(data)
                {
                    this.properties.phpIni = data;
                }
            });

            //load items from popup
            this.items = {
                container:				$(this.options.selectorItems.container),
                cropButton:				$(this.options.selectorItems.cropButton),
                cancelButton:			$(this.options.selectorItems.cancelButton),
                crop:					$(this.options.selectorItems.crop),
                preview:				$(this.options.selectorItems.preview)
            }

			if(options.mimesAccept)	                                                // The mimesAccept property is overwritten, since we don't want it to be combined
			{
				this.options.mimesAccept = options.mimesAccept;
			}

			this.callback = callback;												// Callback instantiation

			// Save the element reference, both as a jQuery reference and a normal reference
			this.elem = $(elem);													// Instance of the jQuery object to which the plugin is applied

            if(this.options.multiple)
            {
                var args = {
                    multiple: true,
                    logging: false
                };
            }
            else
            {
                var args = {
                    logging: false
                };
            }

			// Upload button and event
            if(this.options.mimesAccept == false)
            {
                window.fd.logging = false;
                fd.jQuery();

                $(this.elem).filedrop(args).filedrop().event('send', function(fileList) {
                        $.proxy(this.upload(fileList), this);
                }.bind(this));
            }
            else
            {
                if(Object.prototype.toString.call(this.options.mimesAccept) === '[object Array]')
                {
                    window.fd.logging = false;
                    fd.jQuery();

                    $(this.elem).filedrop(args).filedrop().event('send', function(fileList) {
                        $.proxy(this.upload(fileList), this);
                    }.bind(this));
                }
                else
                {
                    var data = {
                        success: false,
                        error:   11,
                        message: 'The mimesAccept setting must be an array or false. Setting it to false might be dangerous, since it means accepting all file types'
                    };

                    if(this.callback != null)
                    {
                        this.callback(data);
                    }
                }
            }

			return this;
		},

		upload: function(fileList)
		{
            if(this.options.spinner)
            {
                $.cssLoader.show({
                    urlPlugin: this.options.urlPlugin + '/getfile/libs',
                    useLayer: false,
                    theme: 'carousel'
                });
            }

            // Object which will contain the data that will be sent
			var data = new FormData();

			// Create the form to send by ajax
            if(this.options.multiple)
            {
                var filesSizes = 0;
                fileList.each(function(file)
                {
                    filesSizes += file.size;
                });

                if((this.options.maxFilesSizes != null && this.options.maxFilesSizes != false) && filesSizes > this.options.maxFilesSizes)
                {
                    if(this.options.spinner) $.cssLoader.hide();

                    //Error, file bigger than allowed
                    var realMb  = filesSizes / 1048576;
                    var limitMb = this.options.maxFilesSizes / 1048576;

                    var response = {
                        success: false,
                        error:   16,
                        message: 'The files whith weighing ' + realMb.toFixed(2) + ' Mb they does not been uploaded to the server, to exceed the maximum files sizes allowed of ' + limitMb.toFixed(2) + ' Mb'
                    };

                    this.callback(response);

                    return false;
                }

                var nFiles = 0;
                var response = new Array();
                fileList.each(function(file)
                {
                    if(((this.options.maxFileSize != null && this.options.maxFileSize != false) && file.size > this.options.maxFileSize))
                    {
                        var realMb  = file.size / 1048576;
                        var limitMb = this.options.maxFileSize / 1048576;

                        response.push({
                            success: false,
                            error:   15,
                            message: 'The file ' + file.name + ' weighing ' + realMb.toFixed(2) + ' Mb has not been uploaded to the server, to exceed the maximum file size allowed of ' + limitMb.toFixed(2) + ' Mb'
                        });
                    }
                    else
                    {
                        data.append('file' + nFiles, file.nativeFile);
                        nFiles++;
                    }
                }.bind(this));

                if(nFiles > 0)
                {
                    if (response.length > 0)
                    {
                        this.properties.response = response;
                    }
                    data.append('nFiles', nFiles);
                }
                else
                {
                    if(this.options.spinner) $.cssLoader.hide();

                    response = {
                        "success":  false,
                        "multiple": true,
                        "files":    response
                    }
                    this.callback(response);
                    return false;
                }
            }
            else
            {
                var file = fileList.first();

                if(((this.options.maxFileSize != null && this.options.maxFileSize != false) && file.size > this.options.maxFileSize) || ((this.options.maxFilesSizes != null && this.options.maxFilesSizes != false) && file.size > this.options.maxFilesSizes))
                {
                    if(this.options.spinner) $.cssLoader.hide();

                    //Error, file bigger than allowed
                    var realMb  = event.target.files[0].size / 1048576;
                    var limitMb = this.options.maxFileSize / 1048576;

                    var response = {
                        success: false,
                        error:   15,
                        message: 'The file ' + event.target.files[0].name + ' weighing ' + realMb.toFixed(2) + ' Mb has not been uploaded to the server, to exceed the maximum file size allowed of ' + limitMb.toFixed(2) + ' Mb'
                    };

                    this.callback(response);

                    return false;
                }
                else
                {
                    data.append('file',	file.nativeFile);
                }
            }

            data.append('multiple',			this.options.multiple);
            data.append('action',			'upload');
			data.append('folder',			this.options.folder);
			data.append('tmpFolder',		this.options.tmpFolder);
			data.append('cropActive',		this.options.crop.active);
            data.append('resizeActive',		this.options.resize.active);
            data.append('outputExtension',	this.options.outputExtension);
			data.append('encryption',		this.options.encryption);
			data.append('filename',			this.options.filename);
			data.append('mimesAccept',		this.options.mimesAccept);
			data.append('tmpDelete',		this.properties.tmpDelete);

			$.ajax({
				url:						this.options.urlPlugin + '/getfile/php/Controllers/server.php',
				data:						data,
				type:						'POST',
				dataType:					'json',
				context:					this,
				cache:						false,
				contentType:				false,
				processData:				false,
                xhr: function()
                {
                    var xhr = new window.XMLHttpRequest();

                    //Upload progress
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable)
                        {
                            //var percentComplete = evt.loaded / evt.total;
                            //Do something with upload progress
                            if(this.callback != null)
                            {
                                var percentage = (evt.loaded / evt.total * 100 | 0);

                                var data = {
                                    success:    true,
                                    action:     "loading",
                                    total:      evt.total,
                                    loaded:     evt.loaded,
                                    percentage: percentage
                                };

                                this.callback(data);
                            }
                        }
                    }.bind(this.context), false);

                    return xhr;
                },
                error:function(e)
                {
                    if(this.options.spinner) $.cssLoader.hide();

                    if(this.options.multiple)
                    {
                        var data = new Array();
                        var self = this;
                        $.each(fileList, function(index, file)
                        {
                            var realMb = file.size / 1048576;
                            var dataError = {
                                success: false,
                                error:   13,
                                message: 'The file ' + file.name + ' weighing ' + realMb.toFixed(2) + ' Mb has not been uploaded to the server, to exceed the maximum file size allowed to server: ' + self.properties.phpIni.postMaxSize
                            };
                            data.push(dataError);
                        });

                        this.callback(data);
                    }
                    else
                    {
                        var file    = fileList.first();
                        var realMb  = file.size / 1048576;

                        var data = {
                            success: false,
                            error:   13,
                            message: 'The file ' + file.name + ' weighing ' + realMb.toFixed(2) + ' Mb has not been uploaded to the server, to exceed the maximum file size allowed to server:' + this.properties.phpIni.postMaxSize
                        };
                        this.callback(data);
                    }
                },
				success: function(data)												// Actions done once the image is in the tmp directory
				{
                    if(this.options.multiple)
                    {
                        this.properties.files       = data.files;
                    }
                    else
                    {
                        this.properties.tmpName     = data.name;					    // Temporary name assigned to the file
                        this.properties.size        = data.size;                        // Size from image uploaded
                        this.properties.oldName     = data.oldName;                     // Original name from image uploaded
                        this.properties.extension   = data.extension;                   // Extension from file
                        this.properties.mime        = data.mime;                        // MIME type from file
                        this.properties.isImage     = data.isImage;                     // Check if is image
                    }

                    if(this.options.crop.active && data.isImage && this.options.multiple == false)
					{
                        this.properties.width       = data.width;                   // Original image width if is image crop
                        this.properties.height      = data.height;                  // Original image height if is image crop
                        this.properties.pixelRatio  = window.devicePixelRatio;

                        $.colorbox({
                            inline:     true,
                            href:       this.items.container,
                            width:      '100%',
                            height:     '100%',
                            scrolling:  false
                        });

                        var cblc            = $('#cboxLoadedContent'),              // Elements from crop
                            gfPreview       = $('#gfPreview'),
                            gfFooter        = $('#gfFooter'),
                            contentWidth    = cblc.width(),
                            contentHeight   = cblc.height(),
                            landScape       = false;

                        if($(window).width() * this.properties.pixelRatio > 990)
                        {
                            var freeSpace       = contentWidth - 70;
                            this.properties.mow = Math.round(freeSpace * 0.7);                                          // Calculating the width of each frame
                            this.properties.mpw = Math.round(freeSpace * 0.3);
                            landScape           = true;

                        }
                        else
                        {
                            var freeSpace       = contentWidth;
                            this.properties.mow = Math.round(freeSpace * 0.9);                                          // Calculating the width of each frame
                            this.properties.mpw = Math.round(freeSpace * 0.6);
                            landScape           = false;
                        }

                        if(!MobileEsp.DetectTierTablet() && !MobileEsp.DetectTierIphone())                              // In the desktop case, we match the highest maximum screen size
                        {
                            this.properties.moh = contentHeight-110;
                        }

                        this.crop(this.options.tmpFolder + '/' + data.name);		                                    // Crop is initialized

                        gfPreview.removeClass();
						gfFooter.removeClass();

                        if (landScape)							                    // Landscape display
						{
							gfPreview.addClass('gf-horizontal');
						}
						else														// Portrait display
						{
							gfPreview.addClass('gf-vertical');
							gfFooter.addClass('gf-vertical');

                            var cblHeight = Math.round(this.properties.mph + this.properties.moh + 175);

                            $.colorbox.resize({
                                width:      '100%',
                                height:     cblHeight
                            });
						}
					}
					else if(this.options.resize.active && data.isImage || this.options.resize.active && this.options.multiple == true)
					{
                        if(this.options.multiple)
                        {
                            var hasImage = false;
                            for(var i=0; i < this.properties.files.length; i++)
                            {
                                if(this.properties.files[i].isImage == true)
                                {
                                    i = this.properties.files.length;
                                    hasImage = true;
                                    this.executeResize();
                                }
                            }
                            // Execution is finished and callback is called if hasn't image
                            if(!hasImage && this.callback != null) this.callback(data);
                        }
                        else
                        {
                            // Resize module is executed if active
                            this.executeResize();
                        }
					}
					else if(this.options.outputExtension != null && data.isImage || this.options.outputExtension != null && this.options.multiple == true)	// Image file extension change
					{
                        if(this.options.multiple)
                        {
                            var hasImage = false;
                            for(var i=0; i < this.properties.files.length; i++)
                            {
                                if(this.properties.files[i].isImage == true)
                                {
                                    i = this.properties.files.length;
                                    hasImage = true;
                                    this.executeChangeExtension();
                                }
                            }
                            // Execution is finished and callback is called if hasn't image
                            if(!hasImage && this.callback != null) this.callback(data);
                        }
                        else
                        {
                            // Resize module is executed if active
                            this.executeChangeExtension();
                        }
					}
                    else if(this.options.copies.length > 0 && data.isImage || this.options.copies.length > 0 && this.options.multiple == true)
                    {
                        if(this.options.multiple)
                        {
                            var hasImage = false;
                            for(var i=0; i < this.properties.files.length; i++)
                            {
                                if(this.properties.files[i].isImage == true)
                                {
                                    i = this.properties.files.length;
                                    hasImage = true;
                                    this.executeCopies(data);
                                }
                            }
                            // Execution is finished and callback is called if hasn't image
                            if(!hasImage && this.callback != null) this.callback(data);
                        }
                        else
                        {
                            // Resize module is executed if active
                            this.executeCopies(data);
                        }
                    }
					else
					{
                        if(this.callback != null)
                        {
                            if(this.options.multiple)
                            {
                                $.merge(data.files, response);
                            }
                            this.callback(data);										// Execution is finished and callback is called
                        }
					}
                    if(this.options.spinner) $.cssLoader.hide();										            // Hide loader
				}
			});
		},

		crop: function(imageUrl)
		{

            if (!$.Jcrop)
            {
				var data = {
					success: false,
					error:   3,
					message: 'JCrop library not loaded'
				};

                if(this.callback != null)
                {
                    this.callback(data);
                }
			}

			this.removeCrop();													    // Work canvas is initialized

            // Check if values is correct
            if(this.options.crop.height && this.options.crop.width)				    // Checking if width and height are defined; in case of being defined, they're used for aspect ratio
            {
                this.options.crop.aspectRatio = this.options.crop.width / this.options.crop.height;
            }
            else
            {
                if(isNaN(this.options.crop.aspectRatio))						    // If there is no width or height and there is no aspect ratio, an error is thrown
                {
                    var data = {
                        success: false,
                        error:   4,
                        message: 'Width and Height or Ratio must be defined'
                    };

                    if(this.callback != null)
                    {
                        this.callback(data);
                    }
                }
            }

            // Calculating the sizes of the preview image, depending on its orientation
            // Check if preview is horizontal or vertical
            if(this.options.crop.aspectRatio >= 1)								                                        // If ratio is greater than 1, width is set and preview height is calculated, preview is horizontal
            {
                this.properties.rpw = this.properties.mpw;
                this.properties.rph = Math.round(this.properties.rpw / this.options.crop.aspectRatio);
            }
            else
            {																	                                        // If ratio os less than 1, height is set and preview width is calculated, preview is vertical
                this.properties.rph = this.properties.mph;
                this.properties.rpw = Math.round(this.properties.rph * this.options.crop.aspectRatio);

                if(this.properties.rpw > this.properties.mpw)                                                           // If width is greater than the frame's width, the width is set and the height is proportionately calculated
                {
                    this.properties.rpw = this.properties.mpw;
                    this.properties.rph = Math.round(this.properties.rpw / this.options.crop.aspectRatio);
                }
            }

            this.properties.mph = this.properties.rph;


            // Calculating the sizes of the original image to crop
            var ratImg = this.properties.width / this.properties.height;

            if(this.properties.width > this.properties.mow)                                                             // Reduce the width in the case of non-mobile or tablet and height scrolling do if necessary
            {
                this.properties.row = this.properties.mow;
                this.properties.roh = Math.round(this.properties.mow / ratImg);
            }
            else
            {
                this.properties.row = this.properties.width;
                this.properties.roh = this.properties.height;
            }

            if(this.properties.roh > this.properties.moh)                                                               // We ensure the highest does not exceed the maximum height of the frame
            {
                this.properties.roh = this.properties.moh;
                this.properties.row = Math.round(this.properties.moh * ratImg);
            }

            this.properties.moh = this.properties.roh;

            this.items.preview.css({											                                        // Preview configuration
                "width"  : this.properties.rpw + "px",
                "height" : this.properties.rph + "px"
            });

            this.items.crop.css({												                                        // Crop configuration
                "width"  : this.properties.mow + 4 + "px",								                                // 4px are added to avoid the horizontal scroll (done with overflow: scroll) from overlapping part of the picture
                "height" : this.properties.moh + "px"
            });

            // Images are loaded in each frame
            $('<img id="imgOrig" width="'+this.properties.row+'" height="'+this.properties.roh+'" src="'+imageUrl+'">').appendTo(this.items.crop);
            $('<img id="imgPreview" src="'+imageUrl+'">').appendTo(this.items.preview);

            $('#imgOrig').Jcrop({
                onChange:       $.proxy(this.showPreview, this),
                onSelect:       $.proxy(this.showPreview, this),
                bgColor:        'black',
                bOpacity:       .65,
                aspectRatio:    this.options.crop.aspectRatio,
                minSize:        this.options.crop.minSize,
                maxSize:        this.options.crop.maxSize,
                setSelect:      this.options.crop.setSelect
            });


            var isIE11 = !!navigator.userAgent.match(/Trident.*rv[ :]*11\./)
            if(isIE11)
            {
                this.properties.tmpNameIE11     = this.properties.tmpName;
                this.properties.sizeIE11        = this.properties.size;
                this.properties.oldNameIE11     = this.properties.oldName;
                this.properties.extensionIE11   = this.properties.extension;
                this.properties.mimeIE11        = this.properties.mime;
                this.properties.isImageIE11     = this.properties.isImage;
            }

            this.items.cropButton.on('click', $.proxy(this.executeCrop, this));
            this.items.cancelButton.on('click', function() {$.colorbox.close();});
		},

		removeCrop: function()
		{
			$(this.items.crop).html('');
			$(this.items.preview).html('');
			this.items.cropButton.off('click');
			this.items.cancelButton.off('click');
		},

		showPreview: function(coords)												// Show the thumbnail on resize
		{
			var rx = this.properties.rpw / coords.w;
			var ry = this.properties.rph / coords.h;

			$('#imgPreview').css({
				width: Math.round(rx * $('#imgOrig').width()) + 'px',
				height: Math.round(ry * $('#imgOrig').height()) + 'px',
				marginLeft: '-' + Math.round(rx * coords.x) + 'px',
				marginTop: '-' + Math.round(ry * coords.y) + 'px'
			});

			this.properties.coords = coords;										// Coordinates are updated
		},

		executeCrop: function()
		{
			$.ajax({
				url:					this.options.urlPlugin+'/getfile/php/Controllers/server.php',
				type:		   			'POST',
				dataType:	   			'json',
				context:				this,
				cache:					false,
                data: {
					action:				'crop',
                    tmpName:			this.properties.tmpName == undefined? this.properties.tmpNameIE11 : this.properties.tmpName,
                    size:			    this.properties.size == undefined? this.properties.sizeIE11 : this.properties.size,
                    oldName:            this.properties.oldName == undefined? this.properties.oldNameIE11 : this.properties.oldName,
                    extension:          this.properties.extension == undefined? this.properties.extensionIE11 : this.properties.extension,
                    mime:               this.properties.mime == undefined? this.properties.mimeIE11 : this.properties.mime,
                    isImage:            this.properties.isImage == undefined? this.properties.isImageIE11 : this.properties.isImage,
					coords:				this.properties.coords,
                    cropWidth:			this.options.crop.width,
                    cropHeight:			this.options.crop.height,
                    aspectRatio:		this.options.crop.aspectRatio,
					tmpFolder:			this.options.tmpFolder,
					folder:				this.options.folder,
					row:				this.properties.row,
					roh:				this.properties.roh,
					outputExtension:	this.options.outputExtension,
					copies:				this.options.copies
				},
				success: function(data)
                {
                    $.colorbox.close();

                    if(this.callback != null)
                    {
                        this.callback(data);
                    }
				},
                error: function(data)
                {
                    if(this.callback != null)
                    {
                        this.callback(data.responseJSON);
                    }
                }
			});
		},

		executeResize: function()
		{
            if(this.options.multiple)
            {
                var data = {
                    action:					'resize',
                    multiple:               true,
                    files:				    this.properties.files,
                    tmpFolder:				this.options.tmpFolder,
                    folder:					this.options.folder,
                    width:					this.options.resize.width,
                    height:					this.options.resize.height,
                    constrainProportions:	this.options.resize.constrainProportions,
                    outputExtension:		this.options.outputExtension,
                    copies:					this.options.copies
                };
            }
            else
            {
                var data = {
                    action:					'resize',
                    multiple:               false,
                    tmpName:				this.properties.tmpName,
                    size:			        this.properties.size,
                    oldName:                this.properties.oldName,
                    extension:              this.properties.extension,
                    mime:                   this.properties.mime,
                    isImage:                this.properties.isImage,
                    tmpFolder:				this.options.tmpFolder,
                    folder:					this.options.folder,
                    width:					this.options.resize.width,
                    height:					this.options.resize.height,
                    constrainProportions:	this.options.resize.constrainProportions,
                    outputExtension:		this.options.outputExtension,
                    copies:					this.options.copies
                };
            }

			$.ajax({
				url:					this.options.urlPlugin+'/getfile/php/Controllers/server.php',
				type:		   			'POST',
				dataType:	   			'json',
				context:				this,
				cache:					false,
				data:                   data,
				success: function(data)
                {
                    if(this.callback != null)
                    {
                        if(this.options.multiple && this.properties.response != null)
                        {
                            $.merge(data.files, this.properties.response);
                        }
                        this.callback(data);
                    }
				},
                error: function(data)
                {
                    if(this.callback != null)
                    {
                        this.callback(data.responseJSON);
                    }
                }
			});
		},

		executeChangeExtension: function()
		{
            if(this.options.multiple)
            {
                var data = {
                    action:					'change',
                    multiple:               true,
                    files:				    this.properties.files,
                    tmpFolder:				this.options.tmpFolder,
                    folder:					this.options.folder,
                    outputExtension:		this.options.outputExtension,
                    copies:					this.options.copies
                };
            }
            else
            {
                var data = {
                    action:					'change',
                    multiple:               false,
                    tmpName:				this.properties.tmpName,
                    size:			        this.properties.size,
                    oldName:                this.properties.oldName,
                    extension:              this.properties.extension,
                    mime:                   this.properties.mime,
                    isImage:                this.properties.isImage,
                    tmpFolder:				this.options.tmpFolder,
                    folder:					this.options.folder,
                    outputExtension:		this.options.outputExtension,
                    copies:					this.options.copies
                };
            }

			$.ajax({
				url:					this.options.urlPlugin+'/getfile/php/Controllers/server.php',
				type:					'POST',
				dataType:				'json',
				context:				this,
				cache:		  			false,
				data:                   data,
				success: function(data)
                {
                    if(this.callback != null)
                    {
                        if(this.options.multiple && this.properties.response != null)
                        {
                            $.merge(data.files, this.properties.response);
                        }
                        this.callback(data);
                    }
				},
                error: function(data)
                {
                    if(this.callback != null)
                    {
                        this.callback(data.responseJSON);
                    }
                }
			});
		},

        executeCopies: function(data)
        {
            if(this.options.multiple)
            {
                data.action     = 'copies';
                data.multiple   = true;
                data.files      = this.properties.files,
                data.folder     = this.options.folder;
                data.copies     = this.options.copies;
            }
            else
            {
                data.action     = 'copies';
                data.multiple   = false;
                data.folder     = this.options.folder;
                data.copies     = this.options.copies;
            }

            $.ajax({
                url:					this.options.urlPlugin+'/getfile/php/Controllers/server.php',
                type:					'POST',
                dataType:				'json',
                context:				this,
                cache:		  			false,
                data:                   data,
                success: function(data)
                {
                    if(this.callback != null)
                    {
                        if(this.options.multiple && this.properties.response != null)
                        {
                            $.merge(data.files, this.properties.response);
                        }
                        this.callback(data);
                    }
                },
                error: function(data)
                {
                    if(this.callback != null)
                    {
                        this.callback(data.responseJSON);
                    }
                }
            });
        },

        delete: function($filenames, callback)
        {
            $.ajax({
                url:					this.options.urlPlugin+'/getfile/php/Controllers/server.php',
                type:		   			'POST',
                dataType:	   			'json',
                context:				this,
                cache:					false,
                data: {
                    action:				'delete',
                    filenames:          $filenames
                },
                success: function(data)
                {
                    if(callback != null)
                    {
                        callback(data);
                    }
                }
            });
        }
	};

	/*
	 * Make sure Object.create is available in the browser (for our prototypal inheritance)
	 * Note this is not entirely equal to native Object.create, but compatible with our use-case
	 */
	if (typeof Object.create !== 'function') {
		Object.create = function (o) {
			function F() {}
			F.prototype = o;
			return new F();
		};
	}

	/*
	 * Start the plugin
	 */
	$.fn.getFile = function(options, callback) {
		return this.each(function() {
			if (!$.data(this, 'getFile')) {
				$.data(this, 'getFile', Object.create(GetFile).init(options, callback, this));
			}
		});
	};
}( jQuery ));