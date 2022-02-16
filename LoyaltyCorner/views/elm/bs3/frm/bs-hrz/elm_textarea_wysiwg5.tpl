{if !isset($display) || $display eq 1 || $display eq true}
	{assign 'display' ''}
{else}
	{assign 'display' ' display-hide'}
{/if}
<div class="form-group{$display}">
	<label class="col-md-{$WLbl|default:3} control-label" for="{$name}">{$label} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$WElm|default:9}">
		<div class="input-icon right">
			<i class="fa"></i>
			<textarea name="{$name}" class="form-control wysihtml5" rows="6" {if isset($disabled)}disabled{/if}
		       {if isset($title)}title="{$title}" placeholder="{$title}"{/if}
				{if isset($required)}data-required="true" required{/if}     {if isset($msg_required)}data-msg-required="{$msg_required}"{/if}
				{if isset($minlength)}data-minlength="{$minlength}"{/if}    {if isset($msg_minlength)}data-msg-minlength="{$msg_minlength}"{/if}
				{if isset($maxlength)}data-maxlength="{$maxlength}"{/if}    {if isset($msg_maxlength)}data-msg-maxlength="{$msg_maxlength}"{/if}
				{if isset($msg_err)}data-error-container="#{$name}_error"{/if}
			>{$sys.rsp.dat.$name|default:''}</textarea>
			{if isset($msg_helper)}<span class="help-block">{$msg_helper}</span>{/if}
			{if isset($msg_err)}<div id="{$name}_error"></div>{/if}
		</div>
	</div>
</div>
