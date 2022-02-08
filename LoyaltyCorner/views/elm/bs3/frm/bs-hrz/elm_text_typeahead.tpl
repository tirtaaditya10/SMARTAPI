{if !isset($ctrl)}
	{assign 'ctrl' 1}
{/if}
<div id="div_{$name}" class="form-group">
	<label class="col-md-{$WLbl|default:3} control-label" for="{$name}">{$label} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$WElm|default:9}">
		<div class="input-group input-icon">
			<span class="input-group-addon"><i class="icon-magnifier"></i></span>
			<input type="text" class="form-control typeahead align-{$align|default:'left'}"
				id="{$name}_{$sys.req.rid}" {if $ctrl}name="{$name}"{/if} value="{$sys.rsp.dat.$name}" data-value="{$sys.rsp.dat.$name}" autocomplete="off"
				{if isset($source)}data-source="{$source}"{/if}
				{if isset($target)}data-target="#{$target}"{/if}
				{if isset($disabled)}disabled{/if}
				{if isset($title)}title="{$title}" placeholder="{$title}"{/if}
				{if isset($required)}required data-rule-required="true" data-msg-required="{$msg_required|default:'Kolom ini wajib diisi !'}"{/if}
				{if isset($minlength)}minlength="{$minlength}" data-rule-minlength="{$minlength}" data-msg-minlength='{$msg_minlength|default:"Min. Length: {$minlength} chars"}'{/if}
				{if isset($maxlength)}maxlength="{$maxlength}" data-rule-maxlength="{$maxlength}" data-msg-maxlength='{$msg_maxlength|default:"Max. Length: {$maxlength} chars"}'{/if}
				{if isset($remote)}data-rule-remote="{$remote}"{/if}                 {if isset($msg_remote)}data-msg-remote="{$msg_remote}"{/if}
				{if isset($msg_err)}data-error-container="#{$name}_error"{/if}
				onkeyup="$(this).validate();"
			/>

			{if isset($msg_helper)}<span class="help-block">{$msg_helper}</span>{/if}
		</div>
	</div>
</div>
