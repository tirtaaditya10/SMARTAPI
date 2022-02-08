{if !isset($grid)}      {assign var=grid    value=3}{/if}
{if !isset($name)}      {assign var=name    value="email"}{/if}

<div class="form-group{$display|default:''}">
	<label class="col-md-{$grid} control-label" for="{$name}">{$label|default:'Email'} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{math equation=12-$grid}">
		<div class="input-group input-icon">
			<span class="input-group-addon"><i class="{if isset($readonly)}icon-lock{else}fa fa-envelope{/if}"></i></span>
			<i class="fa"></i>
			<input type="email" data-rule-email="true" class="form-control {$class|default:''} align-{$align|default:'left'}"
			       id="{$name}_{$sys.req.rid}" {if $ctrl|default:1}name="{$name}"{/if} value='{$sys.rsp.dat.$name|default:""}'
				{if isset($disabled)}disabled{/if}
				{if isset($required)}required data-required="true"{/if}     {if isset($msg_required)}data-msg-required="{$msg_required}"{/if}
				{if isset($title)}title="{$title}" placeholder="{$title}"{/if}
				{if isset($readonly)}readonly{/if}

				{if isset($remote)}data-remote="{$remote}"{/if}             {if isset($msg_remote)}data-msg-remote="{$msg_remote}"{/if}
				{if isset($msg_err)}data-error-container="#{$name}_error"{/if}
			/>
			{if isset($msg_helper)}<span class="help-block">{$msg_helper}</span>{/if}
			{if isset($msg_err)}<div id="{$name}_error"></div>{/if}
		</div>
	</div>
</div>