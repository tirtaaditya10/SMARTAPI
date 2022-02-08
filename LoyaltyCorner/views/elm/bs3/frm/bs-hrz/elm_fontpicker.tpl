{if !isset($ctrl)}
	{assign 'ctrl' 1}
{/if}
{if !isset($display) || $display eq 1 || $display eq true}
	{assign 'display' ''}
{else}
	{assign 'display' ' display-hide'}
{/if}
<div class="form-group{$display}">
	<label class="col-md-{$WLbl|default:3} control-label" for="{$name|default:'font_icon'}">{$label|default:'Font'} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$WElm|default:9}">
		<div class="input-group">
			<input  type="text" class="form-control" data-placement="bottomRight"
			        id="font_icon_{$sys.req.rid}" {if $ctrl}name="font_icon"{/if} value="{$sys.rsp.dat.font_icon|default:''}"
					{if isset($disabled)}disabled{/if}
					{if isset($required)}required data-required="true"{/if}     {if isset($msg_required)}data-msg-required="{$msg_required}"{/if}
					{if isset($title)}title="{$title}" placeholder="{$title}"{/if}
					{if isset($readonly)}readonly{/if}
			/>
			<span class="input-group-addon"></span>
		</div>
	</div>
</div>
<script>
	$('input[name="font_icon"]').iconpicker();
</script>
