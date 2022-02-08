<link rel="stylesheet" href="{$sys.cfg.asset}plugin/_form/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="{$sys.cfg.asset}plugin/_form/jquery-file-upload/css/jquery.fileupload.css">
<link rel="stylesheet" href="{$sys.cfg.asset}plugin/_form/jquery-file-upload/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="{$sys.cfg.asset}plugin/_form/jquery-file-upload/css/jquery.fileupload-noscript.css"></noscript>
<noscript><link rel="stylesheet" href="{$sys.cfg.asset}plugin/_form/jquery-file-upload/css/jquery.fileupload-ui-noscript.css"></noscript>
<script src="{$sys.cfg.asset}plugin/_form/jquery-file-upload/js/jquery.fileupload.js"></script>

{if !isset($preview)}
	{assign 'preview' 1}
{/if}
{if !isset($accept)}
	{assign 'accept' 'all'}
{/if}
{if !isset($sys.rsp.ref.dms_catalog)}
	{if isset($sys.rsp.dat.dms_catalog_id)}
		{assign 'dms_catalog_id' $sys.rsp.dat.dms_catalog_id}
	{elseif isset($sys.bpm.ext.dms_catalog_id)}
		{assign 'dms_catalog_id' $sys.bpm.ext.dms_catalog_id}
	{else}
		{assign 'dms_catalog_id' '0'}
	{/if}
{/if}
{if !isset($sys.rsp.ref.dms_catalog)}
	<input type="hidden" name="dms_catalog_id" value="{$dms_catalog_id}" />
{/if}
<input type="hidden" name="path_old[]" value="" />
<input type="hidden" id="path" name="path[]" value="" />
<span class="btn yellow-lemon fileinput-button">
	<i class="fa fa-plus"></i>
	<span> Select</span>
	<input type="file" name="file[]" id="uf_multi" multiple data-url="{$obj|default:'img'}/{$dms_catalog_id}/{$sys.req.pid}/{$loc|default:'tmp'}"
			{if $accept eq 'img'}
				accept="image/*"
			{elseif $accept eq 'mmedia'}
				accept="audio/*, video/*, image/*"
			{elseif $accept eq 'doc'}
				accept="application/pdf, application/msword, application/excel, application/vnd.ms-excel, application/x-excel, application/x-msexcel,
				application/x-compressed, application/x-gzip, application/x-gzip, multipart/x-gzip"
			{else}
				accept="audio/*, video/*, image/*, application/pdf, application/msword,
				application/excel, application/vnd.ms-excel, application/x-excel, application/x-msexcel,
				application/x-compressed, application/x-gzip, application/x-gzip, multipart/x-gzip"
			{/if}
	/>
</span>
<script>
$(function () {
	$('#uf_multi').fileupload({
		dataType: 'json',
		done: function (e, data) {
			$.each(data.result.files, function (index, file) {
				$('<p/>').text(file.name).appendTo(document.body);
			});
		}
	});
});
</script>
