{if !isset($accept)}
	{assign 'accept' 'doc'}
{/if}
{if !isset($sys.rsp.ref.dms_catalog)}
	{if isset($sys.rsp.dat.dms_catalog_id)}
		{assign 'cat' $sys.rsp.dat.dms_catalog_id}
	{elseif isset($sys.bpm.ext.dms_catalog_id)}
		{assign 'cat' $sys.bpm.ext.dms_catalog_id}
	{else}
		{assign 'cat' '0'}
	{/if}
{/if}
{foreach from=$sys.rsp.map key=k item=m}
	<input type="hidden" class="map_var" id="{$k}" name="{$k}" value="{$m}" />
    {foreachelse}
{/foreach}
<span class="fileinput-button">
	<i class="fa fa-upload do-hvr-spin"></i>
	<input type="file" name="file" id="uf_doc"
		   data-url="{$sys.req.rid}/{$obj|default:'doc'}/{$sys.req.pid}"
		   data-loc="{$loc|default:'fix'}"
		   data-cat="{$cat}"
		   data-tbl="{$tbl|default:'dms_doc_path'}"
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
	$('#uf_doc').change(function(e) {
		var that = $(this),
			dirx = that.data('url'),
			data = new FormData();

		var	file = upload_file_util($('#uf_doc').val()),
			dFrm = $('form.cForm'),
			dBdy = $('#uplBody'),
			dBar = '',
			dTR  = '';

		data.append('loc', that.data('loc'));
		data.append('cat', that.data('cat'));
		data.append('tbl', that.data('tbl'));

		$("#uplBody tr:first-child").clone(true, true).appendTo($('#uplBody'));
		dTR  = $('tr:last-child', dBdy);
		dBar = dTR.find('td.progress').html('<i class="'+file.icon+'"></i> ' + file.name +
				'<div class="progress-bar progress-bar-info" style="float:none; height:4px; width:0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar"></div>');
		$('tr:last-child', dBdy).removeAttr('class').children().eq(0).removeAttr('class');

		if(e && e.target && e.target.files && e.target.files[0]) {
			data.append('file', e.target.files[0]);
			if($('#doc_no_{$sys.req.rid}', dFrm).length)
				data.append('doc_no', $('#doc_no_{$sys.req.rid}', dFrm).val());
			if($('#doc_date_{$sys.req.rid}', dFrm).length)
				data.append('doc_date', $('#doc_date_{$sys.req.rid}', dFrm).val());

			$('.map_var').each(function() {
				var map = $(this);
				data.append(map.attr('id'), map.val());
			});

			$.ajax({
				url: AGV.site + 'upl/'+dirx,
				type: 'post',
				xhr: function() {
					var xhr = $.ajaxSettings.xhr();
					xhr.upload.addEventListener('progress', function(e) {
						if(e.lengthComputable) {
							var prg = e.loaded / e.total * 100;
							dBar.find('div').css({ width:prg+'%' }).attr('aria-valuenow', prg);
						}
					}, false);
					return xhr;
				},
				data: data,
				cache: false,
				processData: false, // Don't process the files
				contentType: false, // Set content type to false as jQuery will tell the server its a query string request
				beforeSend: function(xhr, setting) {
					dBar.show();
				},
				success: function(data, textStatus, jqXHR) {
					// clear input file
					that.replaceWith(that.val('').clone(true));

					var rst = jQuery.parseJSON(JSON.stringify(data));
					if(rst.ack) {
						var obj = $('a.pcdOpen', dTR);
						obj.data('url', obj.data('url').replace('##new_id', rst.id));
						obj.attr('data-url', obj.data('url').replace('##new_id', rst.id));

						obj = $('a.uplDel', dTR);
						obj.data('url', obj.data('url').replace('##new_id', rst.id));
						obj.attr('data-url', obj.data('url').replace('##new_id', rst.id));

						obj.data('toggle', 'modal');
						obj.attr('data-toggle', 'modal');
						dBar.find('div').remove();
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
});
</script>
