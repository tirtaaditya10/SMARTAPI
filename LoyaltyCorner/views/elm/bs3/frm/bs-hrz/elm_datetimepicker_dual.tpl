<div class="form-group" {if isset($msg_helper)}style="margin-bottom:0"{/if}>
	<label for="{$name1}_{$sys.req.rid}" class="col-md-{$WLbl|default:3} control-label">{$label} {if isset($required1)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-4">
		<div class="input-group date datetime_picker" data-date-format="yyyy-mm-dd hh:ii">
			<input type="text" class="form-control" readonly {if isset($disabled)}disabled{/if}
				id="{$name1}_{$sys.req.rid}" name="{$name1}" value="{$sys.rsp.dat.$name1|default:''}"
				{if isset($title1)}title="{$title1}" placeholder="{$title1}"{/if}
				{if isset($required1)}data-required="true" required{/if}     {if isset($msg_required)}data-msg-required="{$msg_required}"{/if}
				{if isset($msg_err)}data-error-container="#{$name1}_error"{/if}
			/>
			<span class="input-group-btn"><button class="btn default date-set" type="button" style="margin-bottom: 0;"><i class="fa fa-calendar"></i></button></span>
		</div>
	</div>
	<div class="col-md-1">
		<span class="form-control-static"> ~ </span>
	</div>
	<div class="col-md-4">
		<div class="input-group date datetime_picker" data-date-format="yyyy-mm-dd hh:ii">
			<input type="text" class="form-control" readonly {if isset($disabled)}disabled{/if}
				   id="{$name2}_{$sys.req.rid}" name="{$name2}" value="{$sys.rsp.dat.$name2|default:''}"
				{if isset($title2)}title="{$title2}" placeholder="{$title2}"{/if}
				{if isset($required2)}data-required="true" required{/if}     {if isset($msg_required)}data-msg-required="{$msg_required}"{/if}
				{if isset($msg_err)}data-error-container="#{$name2}_error"{/if}
				/>
			<span class="input-group-btn"><button class="btn default date-set" type="button" style="margin-bottom: 0;"><i class="fa fa-calendar"></i></button></span>
		</div>
	</div>
</div>
