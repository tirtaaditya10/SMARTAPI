{if !isset($preview)}
	{assign 'preview' 1}
{/if}
{if !isset($accept)}
	{assign 'accept' 'all'}
{/if}
{if !isset($sys.rsp.ref.dms_catalog)}
    {if isset($sys.rsp.dat.dms_catalog_id)}
        {assign 'cat' $sys.rsp.dat.dms_catalog_id}
    {elseif isset($sys.bpm.svc.dms_catalog_id)}
        {assign 'cat' $sys.svc.dms_catalog_id}
    {else}
        {assign 'cat' '0'}
    {/if}
{/if}
<div id="elm_upload" class="form-group display-hide">
	<label class="col-md-3 control-label" for="uf_simple"></label>
	<div class="col-md-9">
        {foreach from=$sys.rsp.map key=k item=m}
			<input type="hidden" class="map_var" id="{$k}" name="{$k}" value="{$m}" />
		{foreachelse}
        {/foreach}
		<input type="hidden" name="media_old" value="{$sys.rsp.dat.media_avatar}" />
		<input type="hidden" id="media_avatar" name="media_avatar" value="" />
		<span class="btn yellow-lemon fileinput-button">
			<i class="fa fa-plus"></i>
			<span> {$label|default:'Re-Upload'}</span>
			<input type="file" name="file" id="uf_simple"
				   data-url="{$sys.req.rid}/{$obj|default:'img'}/{$sys.req.pid}"
				   data-loc="{$loc|default:'tmp'}"
				   data-cat="{$cat}"
				   data-tbl="{$tbl|default:''}"
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
		{*if $sys.rsp.dat.path}<a class="btn red trash" data-url="" href="javascript:"><i class="icon-trash"></i>Delete</a>{/if**}
		<progress></progress>
		<p id="file_upl"></p>
	</div>
</div>
{if $preview && (isset($sys.rsp.dat.dms_media_viewer_id) && $sys.rsp.dat.dms_media_viewer_id eq 3)}
<div id="preview">
	<div class="col-md-3 col-sm-3" style="display: block; position:absolute; top:{$top|default:90}px; right:20px; opacity:0.8;">
		<a href="{$sys.cfg.host}{$sys.rsp.dat.media_avatar}?ts={$smarty.now}" class="fancybox-button" data-rel="fancybox-button">
			<img class="img-responsive" {if $sys.rsp.dat.media_avatar}src="{$sys.cfg.host}{$sys.rsp.dat.media_avatar}?ts={$smarty.now}{/if}" alt="">
		</a>
	</div>
</div>
{/if}
