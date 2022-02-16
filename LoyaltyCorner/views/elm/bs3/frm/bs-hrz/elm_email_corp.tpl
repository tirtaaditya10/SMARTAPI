{if !isset($ctrl)}
	{assign 'ctrl' 1}
{/if}
{if !isset($display) || $display eq 1 || $display eq true}
	{assign 'display' ''}
{else}
	{assign 'display' ' display-hide'}
{/if}
<div class="form-group{$display}">
	<label class="col-md-{$WLbl|default:3} control-label" for="{$name}">{$label} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$WElm|default:9}">
		<div class="input-group input-icon right">
			<span class="input-group-addon"><i class="{if isset($readonly)}icon-lock{else}fa fa-envelope{/if}"></i></span>
			<i class="fa"></i>
			<input type="email" data-rule-email="true" class="form-control {$class|default:''} align-{$align|default:'left'}"
			       id="{$name}_{$sys.req.rid}" {if $ctrl}name="{$name}"{/if} value='{$sys.rsp.dat.email|default:""}'
				{if isset($disabled)}disabled{/if}
				{if isset($required)}required data-required="true"{/if}     {if isset($msg_required)}data-msg-required="{$msg_required}"{/if}
				{if isset($title)}title="{$title}" placeholder="{$title}"{/if}
				{if isset($readonly)}readonly{/if}

				{if isset($remote)}data-remote="{$remote}"{/if}             {if isset($msg_remote)}data-msg-remote="{$msg_remote}"{/if}
				{if isset($msg_err)}data-error-container="#{$name}_error"{/if}
			/>
			<span class="input-group-addon">@{$sys.cfg.app.cfg.corp_domain}</span>
			{if isset($msg_helper)}<span class="help-block">{$msg_helper}</span>{/if}
			{if isset($msg_err)}<div id="{$name}_error"></div>{/if}
		</div>
	</div>
</div>
