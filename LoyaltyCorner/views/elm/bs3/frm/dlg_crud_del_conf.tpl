{if !isset($cascade)}
    {assign "cascade" 0}
{/if}
{if isset($url_del)}
    {assign "url_del" "{$sys.req.rid}/{$sys.req.pid}/{$sys.req.fid}"}
{else}
    {assign "url_del" ""}
{/if}

<div id="{$sys.uix.pcm}_xxx" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-attention-animation="false">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 class="modal-title">Delete Confirmation<br /><span class="txt-color-red bold italic">{$dlgHead}</span></h3>
	</div>
	<div class="modal-body">
		<dl class="dl-horizontal">
			{$dlgBody}
			{if $cascade}<dt>Warning !!</dt><dd><span style="color:red;">Delete this data also delete other {$dlgHead} related info</span></dd>{/if}
		</dl>
		<p class="text-danger">This is un-rollback operation!</p>
	</div>
	<div class="modal-footer">
		<a href="#{$url_del}" class="btn red" data-dismiss="modal" aria-hidden="true" onclick="form_del(this);"><i class="icon-trash"></i> Delete</a>
		<a href="#" class="btn blue" data-dismiss="modal" aria-hidden="true"><i class="icon-close"></i> Cancel</a>
	</div>
</div>
