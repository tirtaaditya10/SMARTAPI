{if isset($value)}
{elseif !isset($sys.rsp.dat.$name)}
	{assign 'value' ''}
{else}
	{assign 'value' $sys.rsp.dat.$name}
{/if}

<div class="input-icon {$ipos|default:'right'}">
	<i class="fa{if $class eq 'unique'} fa-underline{/if}"></i>
	<input type="text" class="form-control {$class} align-{$align|default:'left'}"
		   id="{$name}_{$sys.req.rid}" {if $ctrl}name="{$name}"{/if} value='{$value}' data-value='{$value}'
			{if isset($disabled)}disabled{/if}
			{if isset($title)}title="{$title}" placeholder="{$title}"{/if}
			{if $class eq 'unique'}
				data-rule-unique="{if $value}true{else}false{/if}"
			{/if}
			{if isset($required)}required data-rule-required="true" data-msg-required="{$msg_required|default:'This Column is Mandatory !'}"{/if}
			{if isset($minlength)}minlength="{$minlength}" data-rule-minlength="{$minlength}" data-msg-minlength='{$msg_minlength|default:"Min. Length: {$minlength} chars"}'{/if}
			{if isset($maxlength)}maxlength="{$maxlength}" data-rule-maxlength="{$maxlength}" data-msg-maxlength='{$msg_maxlength|default:"Max. Length: {$maxlength} chars"}'{/if}
			{if isset($rule_remote)}data-rule-remote="{$rule_remote}"{/if}                 {if isset($msg_remote)}data-msg-remote="{$msg_rule_remote}"{/if}
			{if isset($remote)}data-remote="{$remote}"{/if}
			{if isset($msg_err)}data-error-container="#{$name}_error"{/if}
	/>
	{if isset($msg_helper)}<span class="help-block">{$msg_helper}</span>{/if}
</div>
