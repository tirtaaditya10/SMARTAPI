{if !isset($display) || $display eq 1 || $display eq true}
	{assign 'display' ''}
{else}
	{assign 'display' ' display-hide'}
{/if}
<div class="form-group{$display}">
	<label class="col-md-{$WLbl|default:3} control-label" for="{$name}">{$label} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$WElm|default:3}">
		<div class="input-group input-icon right">
			<span class="input-group-addon">123</span>
			<i class="fa"></i>
			<input type="number" id="{$name}_{$sys.req.rid}" name="{$name}" class="form-control" value="{$sys.rsp.dat.$name|default:''}"
			       {if isset($title)}title="{$title}" placeholder="{$title}"{/if}
				{if isset($required)}data-required="true" required{/if}     {if isset($msg_required)}data-msg-required="{$msg_required}"{/if}
				{if isset($min)}min="{$min}"    data-min="{$min}"{/if}      {if isset($msg_min)}data-msg-min="{$msg_min}"{/if}
				{if isset($max)}max="{$max}"    data-max="{$max}"{/if}      {if isset($msg_max)}data-msg-max="{$msg_max}"{/if}
				{if isset($step)}step="{$step}" data-step="{$step}"{/if}    {if isset($msg_step)}data-msg-step="{$msg_step}"{/if}
				{if isset($range)}data-range="{$range}"{/if}                {if isset($msg_range)}data-msg-range="{$msg_range}"{/if}
				{if isset($msg_err)}data-error-container="#{$name}_error"{/if}
				/>
			<span></span>
		</div>
		{if isset($msg_helper)}<span class="help-block">{$msg_helper}</span>{/if}
		{if isset($msg_err)}<div id="{$name}_error"></div>{/if}
	</div>
</div>

<div class="form-group">
	<label class="control-label col-md-3">Spinner 3</label>
	<div class="col-md-9">
		<div id="spinner3">
			<div style="width:150px;" class="input-group">
				<input type="text" readonly="" maxlength="2" class="spinner-input form-control">
				<div class="spinner-buttons input-group-btn">
					<button class="btn spinner-up default" type="button"><i class="fa fa-angle-up"></i></button>
					<button class="btn spinner-down default" type="button"><i class="fa fa-angle-down"></i></button>
				</div>
			</div>
		</div>
		<span class="help-block">with max value: 10 </span>
	</div>
</div>
