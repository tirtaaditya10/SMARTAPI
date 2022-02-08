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
			<input name="{$name}" type="text" class="form-control"
			    {if isset($title)}title="{$title}" placeholder="{$title}"{/if}
				{if isset($required)}data-required="true" required{/if}     {if isset($msg_required)}data-msg-required="{$msg_required}"{/if}
				{if isset($msg_err)}data-error-container="#{$name}_error"{/if}
				/>
			<span class="help-block">e.g: 5500 0000 0000 0004</span>
			{if isset($msg_err)}<div id="{$name}_error"></div>{/if}
		</div>
	</div>
</div>
