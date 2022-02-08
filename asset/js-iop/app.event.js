var bs3ui = function () {
	var handle_datepicker = function() {
		if (jQuery().date_picker) {
			$('div.date_picker').each(function() {
				var E = $(this),
					V = E.find('input').val(),
					N = E.find('input').attr('name'),
					F = E.parents('form:first'),
					O = $.extend({ }, DPV.BD),
					C = $.extend({ }, DPV.GD),
					R = new RegExp("(_a$|_z$|_start$|_end$)", "ig");
				
				if(N) {
					if(E.hasClass('GD'))
						E.datepicker(C);
					else if(R.test(N) || E.hasClass('BD'))
						E.datepicker(O);
					else
						E.datepicker(C);
				}
			});
		}
	};
	var handle_datetimepicker = function () {
		if (jQuery().datetimepicker) {
			$(".input-group.date").datetimepicker({
				format: 'YYYY-MM-DD',
				ignoreReadonly: true,
				allowInputToggle: true
			});
			
			/*
			$(".picker_datetime_bs3").datetimepicker({
				autoclose: true,
				format: "yyyy-mm-dd hh:ii",
				pickerPosition: "bottom-left"
			});
			
			$(".picker_datetime_15_bs3").datetimepicker({
				format: "yyyy-dd-MM hh:ii",
				autoclose: true,
				todayBtn: true,
				minuteStep: 15
			});
			
			$(".form_meridian_datetime").datetimepicker({
				format: "yyyy-dd-MM hh:ii P",
				showMeridian: true,
				autoclose: true,
				todayBtn: true
			});
			*/
			
			// $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
			
			// Workaround to fix datetimepicker position on window scroll
			/*
			$( document ).scroll(function(){
				$('#form_modal1 .form_datetime, #form_modal1 .form_advance_datetime, #form_modal1 .form_meridian_datetime').datetimepicker('place'); //#modal is the id of the modal
			});
			*/
		}
	}
	var handle_datetimepicker_smalot = function () {
		if (jQuery().datetimepicker) {
			$(".picker_date_bs3").datetimepicker({
				minView: 2,
				showTimepicker: false,
				format: "yyyy-mm-dd",
				pickerPosition: "bottom-left",
				autoclose: true
			});
			
			/*
			$(".picker_datetime_bs3").datetimepicker({
				autoclose: true,
				format: "yyyy-mm-dd hh:ii",
				pickerPosition: "bottom-left"
			});
			
			$(".picker_datetime_15_bs3").datetimepicker({
				format: "yyyy-dd-MM hh:ii",
				autoclose: true,
				todayBtn: true,
				minuteStep: 15
			});
			
			$(".form_meridian_datetime").datetimepicker({
				format: "yyyy-dd-MM hh:ii P",
				showMeridian: true,
				autoclose: true,
				todayBtn: true
			});
			*/
			
			$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
			
			// Workaround to fix datetimepicker position on window scroll
			$( document ).scroll(function(){
				$('#form_modal1 .form_datetime, #form_modal1 .form_advance_datetime, #form_modal1 .form_meridian_datetime').datetimepicker('place'); //#modal is the id of the modal
			});
		}
	}
	
	var handle_timepicker = function () {
		if (jQuery().timepicker) {
			$('div.time_picker').timepicker({
				autoclose: true,
				minuteStep: 5,
				showSeconds: false,
				showMeridian: false
			});
			
			// handle input group button click
			$('.time_picker').parent('.input-group').on('click', '.input-group-btn', function(e){
				e.preventDefault();
				$(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
			});
		}
	}
	var handle_colorpicker = function () {
		if (jQuery().colorpicker) {
			$('.colorpicker-default').colorpicker({
				format: 'hex'
			});
			$('.colorpicker-rgba').colorpicker();
		}
	}
	var handle_clockface = function() {
		if (jQuery().clockface) {
			$('.clockface_1').clockface({
				format: 'HH:mm'
			});
			
			$('#clockface_2').clockface({
				format: 'HH:mm',
				trigger: 'manual'
			});
			
			$('#clockface_2_toggle').click(function (e) {
				e.stopPropagation();
				$('#clockface_2').clockface('toggle');
			});
			
			$('#clockface_2_modal').clockface({
				format: 'HH:mm',
				trigger: 'manual'
			});
			
			$('#clockface_2_modal_toggle').click(function (e) {
				e.stopPropagation();
				$('#clockface_2_modal').clockface('toggle');
			});
			
			$('.clockface_3').clockface({
				format: 'H:mm'
			}).clockface('show', '14:30');
			
			// Workaround to fix clockface position on window scroll
			$( document ).scroll(function(){
				$('form.cForm .clockface_1').clockface('place'); //#modal is the id of the modal
			});
		}
	}
	
	var handle_selectpicker = function () {
		if ($('select.bs-select').length) {
			if ($().selectpicker)
				$('select.bs-select').selectpicker({
					iconBase: 'fas',
					tickIcon: 'fa-check'
				});
			else {
				load_asset('/asset/jquery-plugin/_form/bootstrap-select-snapappointments/css/bootstrap-select.min.css', function () {
					load_asset('/asset/jquery-plugin/_form/bootstrap-select-snapappointments/js/bootstrap-select.min.js', handle_selectpicker);
				});
			}
		}
	};
	var handle_multiSelect = function () {
		if ($().multiSelect) {
			$('.multiselect').multiSelect();
			$('.multiSelect_grp').multiSelect({
				selectableOptgroup: true
			});
		}
	}
	var handle_select2 = function() {
		if($('.select2').length || $('.select2-multiple').length || $('.select2tags').length) {
			if ($().select2) {
				$('.select2, .select2-multiple').select2({
					width: null,
					allowClear: true
				});
				
				$(".select2tags").each(function () {
					var elm = $(this),
						tag = elm.data('tags').split(', ');
					elm.select2({
						tags: tag
					});
				});
			}
			else {
				load_asset('/asset/jquery-plugin/select2/select2.min.js', handle_select2);
			}
		}
		/*
			if ($().select2) {
				//	$(".select2, .select2-multiple").on("select2:open", function() {
				//		if ($(this).parents("[class*='has-']").length) {
				//			var classNames = $(this).parents("[class*='has-']")[0].className.split(/\s+/);
				//
				//			for (var i = 0; i < classNames.length; ++i) {
				//				if (classNames[i].match("has-")) {
				//					$("body > .select2-container").addClass(classNames[i]);
				//				}
				//			}
				//		}
				//	});
			}
		*/
	};
	
	var handle_tags = function() {
		if($().tagsinput)
			$("input[data-role=bs-tagsinput], select[multiple][data-role=bs-tagsinput]").tagsinput({
				confirmKeys: [13]
			});
	};
	
	var handle_editor = function () {
		if (jQuery().wysihtml5)
			$('.wysihtml5').wysihtml5({
				"stylesheets": ['/asset/jquery-plugin/_form/bootstrap-wysihtml5/wysiwyg-color.css']
			});
		
		if ($().summernote) {
			$('.summerNote').each(function (i, o) {
				$(o).summernote({
					height: 400,
					toolbar: [
						['style', ['style']],
						['font', ['bold', 'italic', 'underline', 'clear']],
						['fontname', ['fontname']],
						['color', ['color']],
						['para', ['ul', 'ol', 'paragraph']],
						['height', ['height']],
						['table', ['table']],
						['insert', ['link', 'hr']],
						['view', ['fullscreen', 'codeview']],
						['help', ['help']]
					]
				});
			});
			$('.summerPict').each(function (i, o) {
				$(o).summernote({
					height: 400,
					onblur: function (e) {
						var editor = $(this).parents('.note-editor:first').siblings('textarea.summerPict');
						editor.html(editor.code());
					},
					onImageUpload: function (files, editor, welEditable) {
						summernote_upload_file(files[0], editor, welEditable);
					},
					onMediaDelete: function ($target, $editor, $editable) {
						// console.info($target, $editor, $editable)
					}
				})
			});
		}
		
		if ($().autosize)
			autosize($('textarea.autosize'));
	};
	
	var handle_footable_grid = function() {
		if ($('#PCL table.footable').length) {
			if ($().footable)
				$('#PCL table.footable').footable();
			else {
				load_asset('/asset/js-lib/moment/moment.min.js', function () {
					load_asset('/asset/jquery-plugin/_table/footable/v3/css/footable.bootstrap.min.css');
					load_asset('/asset/jquery-plugin/_table/footable/v3/js/footable.min.js', handle_footable_grid);
				});
			}
		}
	};
	var handle_footable_form = function() {
		if ($('#PCD table.footable').length) {
			if ($().footable)
				$('#PCD table.footable').footable();
			else {
				load_asset('/asset/js-lib/moment/moment.min.js', function () {
					load_asset('/asset/jquery-plugin/_table/footable/v3/css/footable.bootstrap.min.css');
					load_asset('/asset/jquery-plugin/_table/footable/v3/js/footable.min.js', handle_footable_form);
				});
			}
		}
	};
	
	var handle_treeGrid_grid = function() {
		if($('#PCL table.treeGrid').length) {
			if ($().treegrid) {
				var tbl = $('#PCL table.treeGrid');
				tbl.treegrid({
					initialState: 'collapsed',
					saveState: true
				});
				if (tbl.hasClass('expand'))
					tbl.treegrid('getRootNodes').treegrid('expand');
			}
			else {
				load_asset('/asset/jquery-plugin/_tree/jquery-treegrid/css/jquery.treegrid.css', function () {
					load_asset('/asset/jquery-plugin/_tree/jquery-treegrid/js/jquery.cookie.js', function () {
						load_asset('/asset/jquery-plugin/_tree/jquery-treegrid/js/jquery.treegrid.js', function () {
							load_asset('/asset/jquery-plugin/_tree/jquery-treegrid/js/jquery.treegrid.bootstrap3.js', handle_treeGrid_grid);
						});
					});
				});
			}
		}
	};
	var handle_treeGrid_form = function() {
		if($('#PCD table.treeGrid').length) {
			if ($().treegrid) {
				var tbl = $('#PCD table.treeGrid');
				tbl.treegrid({
					initialState: 'collapsed',
					saveState: true
				});
				if (tbl.hasClass('expand'))
					tbl.treegrid('getRootNodes').treegrid('expand');
			}
			else {
				load_asset('/asset/jquery-plugin/_tree/jquery-treegrid/css/jquery.treegrid.css', function () {
					load_asset('/asset/jquery-plugin/_tree/jquery-treegrid/js/jquery.cookie.js', function () {
						load_asset('/asset/jquery-plugin/_tree/jquery-treegrid/js/jquery.treegrid.js', function () {
							load_asset('/asset/jquery-plugin/_tree/jquery-treegrid/js/jquery.treegrid.bootstrap3.js', handle_treeGrid_form);
						});
					});
				});
			}
		}
	};
	
	var handle_mask = function() {
		if($().inputmask) {
			$("input.mask_phone").inputmask("mask", {
				"mask": "(+99) (9{2,3}) 9{3,4}-9{3,4}"
			});
			$("input.mask_mobile").inputmask("mask", {
				"mask": "(+99) 999 9{3,4}-9{3,4}",
				greedy: false
			});
			$("input.mask_currency_idr").inputmask('IDR 999.999.999,99', {
				numericInput: true
			});

			$("input.mask_currency").inputmask('999,999,999.99', {
				numericInput: true,
				rightAlignNumerics: false,
				greedy: false
			});
		}
	};
	
	var handle_bootstrapSwitch = function() {
		if ($('input.make-switch').length) {
			if ($().bootstrapSwitch) {
				$("input.make-switch").each(function() {
					var elm = $(this),
						val = elm.val();
					elm.bootstrapSwitch('setState', val);
				});
			}
			else {
				load_asset('/asset/jquery-plugin/_form/bootstrap-switch/css/bootstrap-switch.min.css', function () {
					load_asset('/asset/jquery-plugin/_form/bootstrap-switch/v4/js/bootstrap-switch.min.js', handle_bootstrapSwitch);
				});
			}
		}
	}
	var handle_audio = function () {
		if ($('audio').length) {
			if ($().maudio) {
				maudio({
					obj: 'audio',
					fastStep: 10
				})
			}
			else {
				load_asset('/asset/jquery-plugin/maudio/css/maudio.css', function () {
					load_asset('/asset/jquery-plugin/maudio/js/maudio.js', handle_audio);
				});
			}
		}
	}
	var handle_mixitup = function() {
		if ($().mixitup) {
			$('.mix-grid').mixitup();
			$('.form-md-floating-label .form-control').each(function () {
				if ($(this).val().length > 0) {
					$(this).addClass('edited');
				}
			});
		}
	};

	var handle_tabs = function () {
		$('.nav-tabs .active').each(function () {
			var that    = $(this).find('a'),
				hold    = $(that.attr('href'));
			
			if(hold.length && hold.is(':empty') && hold.is(':visible') && that.is('[data-url]')) {
				hold.loading();
				var url = that.data('url').replace('#', AGV.site);
				$.get(url, function(r) {
					hold.html(r);
					bs3ui.form();
				});
			}
		});
	}
	var handle_formValidate = function() {
		// for more info visit the official plugin documentation:
		// http://docs.jquery.com/Plugins/Validation
		$('form.bs3form').each(function() {
			$(this).bs3form_validate();
		});
	};

	return {
		//main function to initiate the module
		form: function () {
			AGV.reset();
			// handle_datepicker();
			handle_datetimepicker();
			// handle_datetimepicker_smalot();
			// handle_timepicker();
			// handle_clockface();
			// handle_colorpicker();
			// handle_tags();
			// handle_select();
			// handle_editor();
            handle_selectpicker();
			handle_bootstrapSwitch();
			handle_footable_form();
			handle_treeGrid_form();
			// handle_mask();
			// handle_mixitup();
			handle_tabs();
			handle_audio();
			handle_formValidate();
		},
		grid: function () {
			handle_datetimepicker();
            handle_selectpicker();
			handle_footable_grid();
			handle_treeGrid_grid();
			handle_tabs();
		}
	};
}();

$.fn.bs3form_validate = function(event) {
	AGV.form   = $(this);
	var dForm  = $(this);
	var error  = $('.alert-danger', dForm);
	var dOpts  = {
		// delegation: true,

		target: dForm.data('target') ? dForm.data('target') : '#content',
		url:    dForm.attr('action').replace('#', AGV.site),
		beforeSubmit: function(arr, $form, options) {
			AGV.form   = $form;
			AGV.target = $form.data('target') ? $form.data('target') : '#content';
			AGV.loading();
			$('button[type=submit]', $form).html("<i class='fa fa-file-cog fa-spin'></i> Submitting");
		},
		success: function(responseText, statusText, xhr, $form) {
			if(responseText == "error")
				return false;
			else {
				// $(this).html(xhr.responseText);
				// $(target).empty();

				// $('button[type=submit]', dForm).remove();
				// $('a.btn.frmDel', dForm).remove();
				bs3ui.form();
			}
		},
		error: function() {
			var msg = '<h4 class="ajax-loading-error"><i class="fa fa-warning txt-color-red"></i> Error Submiting Form <span class="txt-color-red">';
			AGV.errMsg(msg);
			AGV.reset();
			return false;
		}
	};
	dForm.validate({
		errorElement: 'span', //default input error message container
		errorClass: 'help-block help-block-error', // default input error message class
		focusInvalid: false, // do not focus the last invalid input
		ignore: "", // validate all fields including form hidden input

		errorPlacement: function (error, element) { // render error placement for each input type
			var icon = $(element).parent('.input-icon').children('i');
			icon.removeClass('fa-check').addClass("fa-warning");
			icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});

			if (element.parent(".input-group").length > 0) {
				error.insertAfter(element.parent(".input-group"));
			}
			else if (element.attr("data-error-container")) {
				error.appendTo(element.attr("data-error-container"));
			}
			else if (element.parents('.radio-list').length > 0) {
				error.appendTo(element.parents('.radio-list').attr("data-error-container"));
			}
			else if (element.parents('.radio-inline').length > 0) {
				error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
			}
			else if (element.parents('.checkbox-list').length > 0) {
				error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
			}
			else if (element.parents('.checkbox-inline').length > 0) {
				error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
			}
			else {
				console.info(error,  element);
				error.insertAfter(element); // for other inputs, just perform default behavior
			}
		},

		invalidHandler: function (event, validator) { //display error alert on form submit
			error.show();
			$("html").animate({
				scrollTop : 0
			}, "fast");
		},

		highlight: function (element) { // hightlight error inputs
			$(element).parents('.form-group:first').addClass('has-error'); // set error class to the control group
		},

		unhighlight: function (element) { // revert the change done by hightlight
			$(element).parents('.form-group:first').removeClass('has-error'); // set error class to the control group
		},

		success: function (label, element) {
			var icon = $(element).parent('.input-icon').children('i');
			$(element).parents('div.form-group:first').removeClass('has-error').addClass('has-success'); // set success class to the control group
			icon.removeClass("fa-warning").addClass("fa-check");
		},

		submitHandler: function (form) {
			if(AGV.error)
				error.show();
			else {
				error.hide();
				$(form).ajaxSubmit(dOpts);
			}
		}
	});

	//apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
	if ($().select2) {
		$(".select2", dForm).change(function () {
			dForm.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
		});
	}

	//initialize datepicker
	if ($().datetimepicker) {
		$('.input-group.date .form-control', dForm).change(function () {
			dForm.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
		})
	}
}
$.fn.set_required  = function(req) {
	var o = $(this);
	
	if(typeof req === 'undefined')
		req = true;
	
	if(req)
		o.prop('required', true).parents('div.form-group:first').find('label').eq(0).append('<span class="required">*</span>');
	else
		o.removeAttr('required').parents('div.form-group:first').find('label > span').remove();
	
	return o;
};
$.fn.loading = function () {
	$(this).html("<div class='circleX'></div><div class='circleY'></div>");
}

if($().select2) {
	$.fn.select2.defaults.set("theme", "bootstrap");
}
if($().toastr) {
	toastr.options = {
		closeButton: false,
		debug: false,
		newestOnTop: false,
		progressBar: true,
		positionClass: "toast-top-right",
		preventDuplicates: true,
		onclick: null,
		showDuration: 300,
		hideDuration: 1000,
		timeOut: 5000,
		extendedTimeOut: 1000,
		showEasing: "swing",
		hideEasing: "linear",
		showMethod: "fadeIn",
		hideMethod: "fadeOut"
	}
}
if($().modalmanager) {
	$.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner =
		'<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
		'<div class="progress progress-striped active">' +
		'<div class="progress-bar" style="width: 100%;"></div>' +
		'</div>' +
		'</div>';
	$.fn.modalmanager.defaults.resize = true;
}

function toggle_fullscreen() {
	var el = document;
	var fs = el.fullscreenElement || el.mozFullScreenElement || el.webkitFullscreenElement || el.msFullscreenElement ? true : false;
	if(fs){
		$('#set_fullscreen').attr('title', 'Full-Screen').find('i').removeClass('fa-compress').addClass('fa-extend');
		var cancelMethod = el.exitFullscreen || el.msExitFullscreen ||
			el.mozCancelFullScreen || el.webkitExitFullscreen;
		if(cancelMethod)
			cancelMethod.call(el);
		else if(typeof window.ActiveXObject !== "undefined"){
			// Older IE.
			var wscript = new ActiveXObject("WScript.Shell");
			if(wscript !== null)
				wscript.SendKeys("{F11}");
		}
	}
	else {
		$('#set_fullscreen').attr('title', 'Cancel Full-Screen').find('i').removeClass('fa-extend').addClass('fa-compress');
		var requestMethod = el.requestFullScreen || el.mozRequestFullScreen ||
			el.webkitRequestFullscreen || el.msRequestFullscreen;

		if(requestMethod)
			requestMethod.call(el);
		else if(typeof window.ActiveXObject !== "undefined"){
			var wscript = new ActiveXObject("WScript.Shell");
			if(wscript !== null)
				wscript.SendKeys("{F11}");
		}
	}
}
// Upload
function upload_file_summernote(file, editor, welEditable) {
	var data = new FormData();
	data.append("file", file);
	
	if(AGV.cPRM.upl.length)
		for(k in AGV.cPRM.upl) {
			var o = AGV.cPRM.upl[k];
			data.append(o.name, o.value);
		}
	
	$.ajax({
		data: data,
		type: 'post',
		xhr: function() {
			var myXhr = $.ajaxSettings.xhr();
			if (myXhr.upload)
				myXhr.upload.addEventListener('progress', upload_progress_handler, false);
			return myXhr;
		},
		url: AGV.cURL.upl,
		cache: false,
		contentType: false,
		processData: false,
		success: function(url) {
			editor.insertImage(welEditable, url);
		},
		error: function() {
		
		}
	});
}
function upload_progress_handler(e){
	if(e.lengthComputable){
		$('progress').show().attr({value:e.loaded, max:e.total});
		// reset progress on complete
		if (e.loaded == e.total) {
			$('progress').hide().attr('value','0.0');
		}
	}
}
function upload_file_util(path) {
	var out  = {name:'', ext:'', icon:''};
	out.name = path.split('\\').pop().split('/').pop();
	out.ext  = out.name.substr(out.name.lastIndexOf('.') + 1).toLowerCase();
	out.name = out.name.replace('.'+out.ext, '');
	out.name = out.name.replace(/([.|_|-])/g, ' ').capitalize();
	switch(out.ext) {
		case 'pdf':
			out.icon = "fa fa-file-pdf-o";
			break;
		
		case 'doc': case 'docx': case 'odt':
		out.icon = "fa fa-file-word-o";
		break;
		
		case 'xls': case 'xlsx': case 'ods':
		out.icon = "fa fa-file-excel-o";
		break;
		
		case 'ppt': case 'pptx': case 'pps': case 'odp':
		out.icon = "fa fa-file-powerpoint-o";
		break;
		
		case 'zip': case 'rar': case 'tar': case 'gz': case 'b':
		out.icon = "fa fa-file-archive-o";
		break;
		
		case 'jpg': case 'jpeg': case 'gif': case 'png': case 'bmp': case 'tif': case 'tiff':
		out.icon = "fa fa-file-image-o";
		break;
		
		case 'mp4': case 'ogg': case 'webm':
		out.icon = "fa fa-file-video-o";
		break;
		
		case 'ogg': case 'mp3':
		out.icon = "fa fa-file-audio-o";
		break;
	}
	return out;
}
function upload_file_size(fileid, max) {
	try {
		var fileSize = 0;
		max = max=='undefined' ? 32 : max;
		//for IE
		if (navigator.userAgent.match(/msie/i)) {
			//before making an object of ActiveXObject,
			//please make sure ActiveX is enabled in your IE browser
			var objFSO = new ActiveXObject("Scripting.FileSystemObject"); var filePath = $("#" + fileid)[0].value;
			var objFile = objFSO.getFile(filePath);
			var fileSize = objFile.size; //size in kb
			fileSize = fileSize / 1048576; //size in mb
		}
		//for FF, Safari, Opeara and Others
		else {
			fileSize = $("#" + fileid)[0].files[0].size //size in kb
			fileSize = fileSize / 1048576; //size in mb
		}
		return (fileSize < max);
	}
	catch (e) {
		alert("Error is :" + e);
	}
}
function upload_file_allowed(fname) {
	if(!fname) return true;
	else
		return (jQuery.inArray(fname.substr(fname.lastIndexOf('.') + 1).toLowerCase(), AGV.aDoc.split(',')) == -1) ? false : true;
}

// var klik;

jQuery(function() {
	if($('#content').length)
		$content = $('#content');
	else
        $content = $('#PCM');

	$('body').on('click', '[data-url]', function(e) {
		e.preventDefault();

		$this       = $(this);
		AGV.target  = $this.data('target');
		AGV.url     = $this.data('url');
		
		// loadURL(AGV.url, AGV.target);
	});
	$('body').on('click', '.stop-propagation', function (e) {
		e.stopPropagation();
	});
	
	$('.toggle_fullscreen').click(function() {
		toggle_fullscreen();
	});

	// PCM: Page-Container-Main
	$content.on('click',  'form.sForm button[type=submit]', function() {
		$(this).parents('form.sForm').find('input.p').val(1);
	});
	$('body').on('submit', 'form.sForm', function(e) {
		e.preventDefault();
		e.stopPropagation();
		
		var $this   = $(this);
		AGV.target  = $($this.data('target'));
		AGV.url     = $this.attr('action').replace('#', AGV.site);

		if($this.hasClass('gSearch')) {
			$('nav li.active').removeClass('active');
            $('nav li.open').removeClass('open')
		}
		// spinner     = new Spinner().spin($content);
		if(AGV.xhr)
			AGV.xhr.abort();
		AGV.xhr = $.ajax({
			type:   'get',
			url:    AGV.url,
			data:   $this.serialize(),
			beforeSend: function(xhr) {
				AGV.loading();
			},
			success: function(data, status) {
				// spinner.stop();
				if($this.find('div.divSearch').is(':visible'))
					$this.find('a.btnSearch').click();
				
				// $content.html(data);
				AGV.target.html(data);
				// bs3ui.form();

				if (typeof sform_cb === 'function')
					sform_cb(F);
			}
		});
	});

	$content.on('click', 'a.nav_lst', function(e) {
		e.preventDefault();
		e.stopPropagation();
		
		var me = $(this),
			fs = me.parents('.jarviswidget:first').find('form.sForm');
		// console.info(me,  fs);
		fs.find('input[name="p"]').val(me.data('paging'));
		fs.submit();
	});
	$content.on('click', 'a.nav_tab', function(e) {
		e.preventDefault();
		e.stopPropagation();
		
		var o = $(this),
			t = o.data('target') ? $(o.data('target')) : $('#PCT');
		
		$.get(o.data('url').replace('#', AGV.site), function(r) {
			t.html(r);
			t = null;
			o = null;
		});
	});
	$content.on('click', '.nav-tabs a', function (e) {
		e.preventDefault(); //prevents re-size from happening before tab shown
		
		// $(this).tab('show'); //show tab panel
		// $('table.footable').trigger('footable_resize'); //fire re-size of footable
		
		var that    = $(this),
			hold    = $(that.attr('href'))
		AGV.target  = hold;
		
		// console.info(that, hold, AGV.target);
		if(hold.length && that.is('[data-url]') && (hold.is(':empty') || that.hasClass('refresh'))) {
			AGV.url = that.data('url').replace('#', AGV.site);
			if(AGV.xhr)
				AGV.xhr.abort();
			AGV.loading();
			AGV.xhr = $.get(AGV.url, function(r) {
				hold.html(r);
				bs3ui.form();
			});
		}
	});
	
	$content.on('click', 'a.frmDel',  function(e) {
		AGV.form = $(this).parents('form:first');
		// AGV.target = $(this).data('target') ? $(this).data('target') : '#dDelete';
		//$(AGV.target).modal('show');
	});
	$content.on('click', 'a.uplDel',  function(e) {
		
		AGV.form = $(this).parents('form:first');
		
		// AGV.target = $(this).data('target') ? $(this).data('target') : '#dDelete';
		//$(AGV.target).modal('show');
	});
	$content.on('click', 'a.uplDels', function(e) {
		e.preventDefault();
		var a = $(this),
		    r = a.parents('tr:first'),
		    t = r.children().eq(0).text(),
		    u = a.attr('data-url');
		Pace.stop();
		if(u.match(/##new_id/g))
			r.remove();
		else {
			$('span.sub-title').html(t);
			$('a.uplDelGo').attr('data-url', u);
		}
	});
	$content.on('click', 'a.uplDelGo', function(e) {
		e.preventDefault();
		var o = $(this),
		    u = o.attr('data-url'),
		    r = $('a[data-url="'+u+'"]').parents('tr:first');
		u = u.replace('#', AGV.site);
		
		Pace.stop();
		$.get(u, function(rsp) {
			toastr.options.escapeHtml = true;
			if(rsp == 'error'){
				toastr.options.positionClass = "toast-top-full-width";
				toastr.options.timeOut = 15000;
				var tFunc   = 'error',
				    tCrud   = 'Data was unsuccessfully/failed deleted !!!';
			}
			else {
				r.remove();
				toastr.options.positionClass = "toast-top-right";
				toastr.options.timeOut = 5000;
				var tFunc   = 'success',
				    tCrud   = 'Data was successfully deleted';
			}
			toastr[tFunc](tCrud, 'DATA MODIFICATION');
		});
	});
	
	$content.on('click', 'a.btn-toggle', function(e) {
		e.preventDefault();
		e.stopPropagation();
		var me = $(this),
			bs = me.parents('.jarviswidget:first');
		bs.find(me.data('target')).toggle();
	});
	$content.on('click', 'a.btn-lst-refresh', function(e) {
		e.preventDefault();
		e.stopPropagation();
		var me = $(this),
			bs = me.parents('.jarviswidget:first');
		bs.find('form.sForm').submit();
	});
	$content.on('click', 'a.btn-upl-simple', function(e) {
		e.preventDefault();
		e.stopPropagation();
		$($(this).data('target')).show('slow');
		$('#uf_simple').click();
	});
	$content.on('click', 'a.clear_q', function(e) {
		e.preventDefault();
		e.stopPropagation();

		$(this).parent().siblings('input').val('');
	});
	$content.on('click', 'a.reload',  function(e) {
		var obj = $(this);
		if(obj.hasClass('upl'))
			obj.parents('div.tab-content:first').prev().find('a.refresh.upl').click();
	});
	
	$content.on('click', '.pcdOpen', function(e) {
		e.preventDefault();
		
		var $this   = $(this),
			target  = $this.data('target');
		AGV.url     = $this.data('url').replace('#', AGV.site);
		AGV.target  = $(target);
		AGV.target.show().prev().hide();
		AGV.loading();
		
		if(AGV.xhr)
			AGV.xhr.abort();
		AGV.xhr = $.get(AGV.url, function(r) {
			$(target).html(r);
			bs3ui.form();
		})
	});
	$content.on('click', '.pcdClose',  function(e) {
		e.preventDefault();
		
		var $this   = $(this);
		if($this.hasClass('refresh')) {
			AGV.target  = $($this.data('target'));
			AGV.url     = $this.data('url').replace('#', AGV.site);
			
			if(AGV.xhr)
				AGV.xhr.abort();
			AGV.target.prev().hide();
			AGV.target.show();
			AGV.loading();
			AGV.xhr = $.get(AGV.url, function (r) {
				AGV.target.html(r);
				bs3ui.form();
			});
		}
		else {
			$this.parents('div.root-PCD:first').empty().prev().show();
			AGV.reset();
		}
	});

	$content.on('click', 'a.export', function(e) {
		e.preventDefault();
		e.stopPropagation();

		var p = $('#sForm').serialize(),
			u = $(this).data('url').replace('#', AGV.site);

		if(AGV.xhr)
			AGV.xhr.abort();
		AGV.xhr = $.post(u, p, function(r) {
			var rst = jQuery.parseJSON(JSON.stringify(r));
			if(rst.ack) {
				$('<a/>', {
					id: 'cos_axp',
					href: rst.url,
					download: rst.doc
				}).hide().appendTo("body")[0].click();
				$('#cos_axp').remove();
			}
			else {
				alert('Failed');
			}
		});
	});

	$content.on('focus',  'input', function() {
		// $(this).select();
	});
	$content.on('blur',   'input[type=number]', function() {
		var elm = $(this),
			nme = elm.attr('name'),
			val = $.trim(elm.val()),
			min = elm.attr('min'),
			max = elm.attr('max');
		elm.popover('destroy').parents('div.form-group:first').removeClass('error');
		if(val && !$.isNumeric(val)) {
			elm.parents('div.form-group:first').addClass('error');
			elm.popover({
				placement: 'top',
				content: 'This is a numeric field !!!'
			}).popover('show');
		}
		if(val && $.isNumeric(val)) {
			val = parseFloat(val);
			if(min && val < parseFloat(min)) {
				elm.parents('div.form-group:first').addClass('error');
				elm.prop('invalid', true).popover({
					placement: 'right',
					content: 'The minimum value is ' + min
				}).popover('show');
			}
			if(max && val > parseFloat(max)) {
				elm.parents('div.form-group:first').addClass('error');
				elm.prop('invalid', true).popover({
					placement: 'right',
					content: 'The maximum value is ' + max
				}).popover('show');
			}
		}
	});
	$content.on('change', 'input.rupiah', function() {
		$(this).next('span').html(Rp($(this).val()));
	});
	$content.on('change', 'input.unique', function (e) {
		var obj = $(this),
			rid = obj.data('remote'),
			old = obj.data('value'),
			val = obj.val();
		if(val && rid && old != val) {
			var data = [
				{name: 'act', value:'unique'},
				{name: obj.attr('name'), value:val}
				];
			$.post(AGV.site+rid, data, function(rsp) {
				if(rsp=='y') {
					AGV.cErr = false;
					obj.data('rule--unique', true);
					obj.parents('div.form-group:first').removeClass('has-error');
					obj.popover('hide');
					if(typeof unique_cb === 'function')
						unique_cb(obj, val);
				}
				else if(rsp=='n') {
					AGV.cErr = true;
					obj.data('rule--unique', false);
					obj.parents('div.form-group:first').removeClass('has-success').addClass('has-error');
					obj.popover({
						placement: 'top',
						html: 'true',
						content: 'this value already been used'
					}).popover('show');
				}
				else {
					AGV.cErr = true;
					obj.data('rule--unique', false);
					obj.parents('div.form-group:first').removeClass('has-success').addClass('has-error');
					obj.popover({
						placement: 'bottom',
						content: 'upps..something not right'
					}).popover('show');
				}
			});
		}
		else if(old == val) {
			AGV.cErr = false;
			obj.data('rule--unique', true);
			obj.parents('div.form-group:first').removeClass('has-error');
			obj.popover('hide');
		}
	});
	
	$content.on('change', 'input#upl_xls', function(e) {
		e.preventDefault();
		e.stopPropagation();
		
		var elm  = $(this),
			rid  = $('#upl_xls').data('rid'),
			svc  = $('#svc_code').val();
		
		if(svc === '') {
			toastr.options.positionClass = "toast-top-right";
			toastr.warning('Choose Entity Data First, and re-Choose the File', 'Warning');
			return false;
		}
		else {
			var data = new FormData();
			data.append('rid', rid);
			data.append('svc_code', svc);
			
			if (e && e.target && e.target.files && e.target.files[0]) {
				data.append('file', e.target.files[0]);
				
				$.ajax({
					url: AGV.host + 'svc/upl/xls/' + rid,
					type: 'post',
					xhr: function () {
						var myXhr = $.ajaxSettings.xhr();
						if (myXhr.upload)
							myXhr.upload.addEventListener('progress', upload_progress_handler, false);
						return myXhr;
					},
					data: data,
					cache: false,
					processData: false, // Don't process the files
					contentType: false, // Set content type to false as jQuery will tell the server its a query string request
					beforeSend: function (xhr, setting) {
						elm.prev().find('i').removeClass('fi excel-icon').addClass('fa fa-gear fa-spin');
						elm.prev().find('span').html(' .. in progress')
						elm.parents('form:first').next().show();
					},
					success: function (data, textStatus, jqXHR) {
						elm.prev().find('i').removeClass('fa fa-gear fa-spin').addClass('fi excel-icon');
						elm.prev().find('span').html('Select File')
						elm.parents('.btn-grp').find('button.btn-import').click();
						elm.parents('form:first').next().hide();
						if (data.err) {
							toastr.options.positionClass = "toast-top-right";
							toastr.error(data.msg, data.err);
							console.log('ERRORS: ' + data.msg);
						}
						else {
							elm.parents('form:first').next().hide();
							
							// var url = AGV.host + rid;
							// loadUrl(url);
							toastr.options.positionClass = "toast-top-right";
							toastr.success('File Success Uploaded', 'Success!');
							$('#M' + rid).click();
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						elm.parents('form:first').next().hide();
						toastr.options.positionClass = "toast-top-right";
						toastr.warning(textStatus, 'Error');
						
						console.log('ERRORS: ' + textStatus);
					}
				});
			}
		}
	});
    $content.on('change', 'input#uf_lite', function(e) {
        var that = $(this),
            urlx = that.data('url'),
            tarx = that.data('plc'),
            data = new FormData();

        data.append('loc', that.data('loc'));
        data.append('cat', that.data('cat'));
        data.append('tbl', that.data('tbl'));

        if(that.data('doc'))
            data.append('doc', that.data('doc'));
        if(that.data('nik'))
            data.append('nik', that.data('nik'));

        if(e && e.target && e.target.files && e.target.files[0]) {
            data.append('file', e.target.files[0]);

            $.ajax({
                url: AGV.site + 'upl/'+urlx,
                type: 'post',
                xhr: function() {
                    var myXhr = $.ajaxSettings.xhr();
                    if (myXhr.upload)
                        myXhr.upload.addEventListener('progress', upload_progress_handler, false);
                    return myXhr;
                },
                data: data,
                cache: false,
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                beforeSend: function(xhr, setting) {
                    $('progress').show();
                },
                success: function(data, textStatus, jqXHR) {
                    that.replaceWith(that.val('').clone(true));

                    var rst = jQuery.parseJSON(JSON.stringify(data));
                    if(rst.ack) {
                        $('#path').val(rst.path);
                        $('#file_upl').html(rst.path);
                        if($('#viewer').length) {
                            $.get(AGV.site+'viewer/'+rst.ext+'/'+rst.pid, function(html) {
                                $('#viewer').html(html);
                                $('a[href=#viewer]').click();
                            })
                        }
                        else if($('#preview').length) {
                            $('#preview').find('img').eq(0).attr('src', AGV.host + rst.path).show();
                        }
                        else
                            $(tarx).attr('src', AGV.host + rst.path);
                        $('progress').hide();
                    }
                    else {
                        console.log('ERRORS: ' + rst.msg);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('ERRORS: ' + textStatus);
                }
            });
        }
    });
    $content.on('change', 'input#uf_icon_x', function(e) {
        var that = $(this),
            dirx = that.data('url');
        if(that.attr('id') == 'uf_icon') {
            var data = new FormData();

            if(e && e.target && e.target.files && e.target.files[0]) {
                data.append('file', e.target.files[0]);
                $.ajax({
                    url: AGV.site + 'upl/upl/'+dirx,
                    type: 'post',
                    xhr: function() {
                        var myXhr = $.ajaxSettings.xhr();
                        if (myXhr.upload)
                            myXhr.upload.addEventListener('progress', upload_progress_handler, false);
                        return myXhr;
                    },
                    data: data,
                    cache: false,
                    processData: false, // Don't process the files
                    contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                    beforeSend: function(xhr, setting) {
                        $('progress').show();
                    },
                    success: function(data, textStatus, jqXHR) {
                        that.replaceWith(that.val('').clone(true));

                        var rst = jQuery.parseJSON(JSON.stringify(data));
                        if(rst.ack) {
                            $('#path').val(rst.path);
                            $('#file_upl').html(rst.path);
                            if($('#viewer').length) {
                                $.get(AGV.site+'viewer/'+rst.ext+'/'+rst.pid, function(html) {
                                    $('#viewer').html(html);
                                    $('a[href=#viewer]').click();
                                })
                            }
                            if($('#preview').length) {
                                $('#preview').find('img').eq(0).attr('src', AGV.host + rst.path).show();
                            }
                            $('progress').hide();
                        }
                        else {
                            console.log('ERRORS: ' + rst.msg);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('ERRORS: ' + textStatus);
                    }
                });
            }
        }
        else
            console.info('correct with no sending');
    });

    $content.on('change', '.chaining', function(e) {
        var o = $(this),
            t = o.data('target'),
            s = o.data('source'),
	        f = o.data('filter'),
            m = o.data('model'),
            v = o.val();
        
        if (f === 'undefined')
        	f = o.attr('name');
        
        if(t !== 'undefined' && $(t).length && s !== 'undefined' && m !== 'undefined' && v)
            $.get(AGV.site + m +'.opt/' + s + '/' + f + '/' + v, function(rsp) {
            	if ($().selectpicker)
	                $(t).html(rsp).selectpicker('refresh');
                $(t).html(rsp);
            });
    });

    $content.on('click', 'a.goto', function (e) {
		var elm = $(this).data('url')

		if($(elm).hasClass('tab-pane')){
			$('.nav-tabs a[href=\\'+elm+']').click();
			$('html, body').animate({ scrollTop: $(elm).offset().top }, 1500);
		}
		else
			$('html, body').animate({ scrollTop: $(elm).offset().top }, 1500);
	});
    
    $content.on('click', 'th.footable-sortable', function(e) {
    	var elm = $(this),
		    fld = elm.data('field'),
		    ord = elm.data('sort-order'),
		    par = elm.parents('.jarviswidget:first'),
		    frm = par.find('form.sForm');
	    
    	if(ord == '')
    		ord = 'asc';
    	else if(ord == 'asc')
	        ord = 'desc';
    	else if(ord == 'desc')
	        ord = 'asc';
    	
    	frm.find('[name="f"]').val(fld);
	    frm.find('[name="s"]').val(ord);
	    frm.find('[name="n"]').val(1);
	    frm.submit();
    });
});
