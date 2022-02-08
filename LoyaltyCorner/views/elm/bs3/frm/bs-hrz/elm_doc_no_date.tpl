{if !isset($class)}
	{assign 'class' ''}
{elseif $class eq 'unique'}
	{assign 'remote' {$sys.bpm.tbl}
{/if}
<div id="div_{$name_no}_{$sys.req.rid}" class="form-group">
	<label for="{$name_no}" class="control-label col-md-2">{$label} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-3">
		<div class="input-icon {$ipos|default:'right'}">
			<i class="fa{if $class eq 'unique'} fa-underline{/if}"></i>
			<input type="text" class="form-control unique"
				id="{$name_no}_{$sys.req.rid}" name="{$name_no}" value='{$sys.rsp.dat.$name_no}' data-value='{$sys.rsp.dat.$name_no}'
				{if isset($disabled)}disabled{/if}
				{if isset($title)}title="{$title}" placeholder="{$title}"{/if}
				data-rule-unique="{if $sys.rsp.dat.$name_no}true{else}false{/if}"
				{if isset($required)}required data-rule-required="true" data-msg-required="{$msg_required|default:'This Column is Mandatory !'}"{/if}
				{if isset($minlength)}minlength="{$minlength}" data-rule-minlength="{$minlength}" data-msg-minlength='{$msg_minlength|default:"Min. Length: {$minlength} chars"}'{/if}
				{if isset($maxlength)}maxlength="{$maxlength}" data-rule-maxlength="{$maxlength}" data-msg-maxlength='{$msg_maxlength|default:"Max. Length: {$maxlength} chars"}'{/if}
				{if isset($rule_remote)}data-rule-remote="{$rule_remote}"{/if}
				{if isset($msg_remote)}data-msg-remote="{$msg_rule_remote}"{/if}
				data-remote="{$sys.bpm.tbl}"
				{if isset($msg_err)}data-error-container="#{$name_no}_error"{/if}
			/>
			{if isset($msg_helper)}<span class="help-block">{$msg_helper}</span>{/if}
		</div>
	</div>
</div>
