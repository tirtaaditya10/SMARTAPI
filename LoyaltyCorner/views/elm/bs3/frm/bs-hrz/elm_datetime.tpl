{if !isset($display) || $display eq 1 || $display eq true}
	{assign 'display' ''}
{else}
	{assign 'display' ' display-hide'}
{/if}
<div class="form-group{$display}" {if isset($msg_helper)}style="margin-bottom:0"{/if}>
	<label class="col-md-{$WLbl|default:3} control-label" for="{$name}">{$label} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-4">
		<div class="input-group date datetime_picker" data-date-format="yyyy-mm-dd hh:ii">
			<input type="text" class="form-control" readonly {if isset($disabled)}disabled{/if}
				   id="{$name}_{$sys.req.rid}" name="{$name}" value="{$sys.rsp.dat.$name|default:''}"
                    {if isset($title1)}title="{$title1}" placeholder="{$title1}"{/if}
                    {if isset($required1)}data-required="true" required{/if}     {if isset($msg_required)}data-msg-required="{$msg_required}"{/if}
                    {if isset($msg_err)}data-error-container="#{$name1}_error"{/if}
			/>
			<span class="input-group-btn"><button class="btn default date-set" type="button" style="margin-bottom: 0;"><i class="fa fa-calendar"></i></button></span>
		</div>
	</div>
</div>
{if isset($msg_helper)}
	<div class="form-group">
		<div class="col-md-2"></div>
		<div class="col-md-6"><span class="help-block">{$msg_helper}</span></div>
	</div>
{/if}
