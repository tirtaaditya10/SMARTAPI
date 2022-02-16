{if !isset($display) || $display eq 1 || $display eq true}
	{assign 'display' ''}
{else}
	{assign 'display' ' display-hide'}
{/if}
<div class="form-group{$display}">
	<label for="{$xname}" class="col-md-{$WLbl|default:3} control-label">Coordinate {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$WElm|default:3}">
		<div class="input-group input-icon right">
			<span class="input-group-addon">Lat.</span>
			<i class="fa"></i>
			<input type="number" id="{$xname}" name="{$xname}" class="form-control numeric text-right" value="{$sys.rsp.dat.$xname|default:''}"
				{if isset($title)}title="{$title}" placeholder="{$title}"{/if}
				{if isset($required)}data-required="true" required{/if}     {if isset($msg_required)}data-msg-required="{$msg_required}"{/if}
				{if isset($min)}min="{$min}"    data-min="{$min}"{/if}      {if isset($msg_min)}data-msg-min="{$msg_min}"{/if}
				{if isset($max)}max="{$max}"    data-max="{$max}"{/if}      {if isset($msg_max)}data-msg-max="{$msg_max}"{/if}
				{if isset($step)}step="{$step}" data-step="{$step}"{/if}    {if isset($msg_step)}data-msg-step="{$msg_step}"{/if}
				{if isset($range)}data-range="{$range}"{/if}                {if isset($msg_range)}data-msg-range="{$msg_range}"{/if}
				{if isset($msg_err)}data-error-container="#{$name}_error"{/if}
			/>
			{if isset($msg_helper)}<span class="help-block">{$msg_helper}</span>{/if}
			{if isset($msg_err)}<div id="{$xname}_error"></div>{/if}
		</div>
	</div>
	<div class="col-md-{$WElm|default:3}">
		<div class="input-group input-icon right">
			<span class="input-group-addon">Long.</span>
			<i class="fa"></i>
			<input type="number" id="{$yname}" name="{$yname}" class="form-control numeric text-right" value="{$sys.rsp.dat.$yname|default:''}"
			       {if isset($title)}title="{$title}" placeholder="{$title}"{/if}
				{if isset($required)}data-required="true" required{/if}     {if isset($msg_required)}data-msg-required="{$msg_required}"{/if}
				{if isset($min)}min="{$min}"    data-min="{$min}"{/if}      {if isset($msg_min)}data-msg-min="{$msg_min}"{/if}
				{if isset($max)}max="{$max}"    data-max="{$max}"{/if}      {if isset($msg_max)}data-msg-max="{$msg_max}"{/if}
				{if isset($step)}step="{$step}" data-step="{$step}"{/if}    {if isset($msg_step)}data-msg-step="{$msg_step}"{/if}
				{if isset($range)}data-range="{$range}"{/if}                {if isset($msg_range)}data-msg-range="{$msg_range}"{/if}
				{if isset($msg_err)}data-error-container="#{$name}_error"{/if}
				/>
			{if isset($msg_helper)}<span class="help-block">{$msg_helper}</span>{/if}
			{if isset($msg_err)}<div id="{$yname}_error"></div>{/if}
		</div>
	</div>
</div>
