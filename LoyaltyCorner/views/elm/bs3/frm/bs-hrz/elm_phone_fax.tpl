{if !isset($name1)}{assign name1 'phone'}{/if}
{if !isset($name2)}{assign name2 'fax'}{/if}
<div class="form-group {$display|default:''}" {if isset($msg_helper)}style="margin-bottom:0"{/if}>
	<label for="{$name1|default:'phone'}" class="col-md-{$WLbl|default:3} control-label">{$label|default:'Phone / Fax'} {if isset($required1) || isset($required2)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-4">
		<div class="input-group {$dpClass|default:''}">
			<input type="text" class="form-control" {if isset($disabled)}disabled{/if}
				id="{$name1}_{$sys.req.rid}" name="{$name1}" value="{$sys.rsp.dat.$name1|default:''}"
				{if isset($title1)}title="{$title1}" placeholder="{$title1}"{/if}
				{if isset($required1)}data-required="true" required{/if}     {if isset($msg_required)}data-msg-required="{$msg_required}"{/if}
				{if isset($msg_err)}data-error-container="#{$name1}_error"{/if}
			/>
			<span class="input-group-btn"><button class="btn default" type="button" style="margin-bottom: 0;"><i class="fa fa-phone"></i></button></span>
		</div>
		<span class="help-block">{$msg_helper|default:''}</span>
	</div>
	<div class="col-md-1 text-center"><p class="form-control-static"> ~ </p></div>
	<div class="col-md-4">
		<div class="input-group {$dpClass|default:''}">
			<input type="text" class="form-control" {if isset($disabled)}disabled{/if}
				   id="{$name2}_{$sys.req.rid}" name="{$name2}" value="{$sys.rsp.dat.$name2|default:''}"
				{if isset($title2)}title="{$title2}" placeholder="{$title2}"{/if}
				{if isset($required2)}data-required="true" required{/if}     {if isset($msg_required)}data-msg-required="{$msg_required}"{/if}
				{if isset($msg_err)}data-error-container="#{$name2}_error"{/if}
				/>
			<span class="input-group-btn"><button class="btn default" type="button" style="margin-bottom: 0;"><i class="fa fa-fax"></i></button></span>
		</div>
		<span class="help-block">{$msg_helper|default:''}</span>
	</div>
</div>
