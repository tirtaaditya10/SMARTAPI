{assign var=value       value=$sys.rsp.dat.$name|default:''}
{if !isset($grid_0)}    {assign var=grid_0      value=3}{/if}
{if !isset($grid_1)}    {assign var=grid_1      value=9}{/if}

{if !isset($cfg)}       {assign var=cfg         value=[]}{/if}
{if !isset($cfg.plain)} {$cfg.plain = 0}{/if}

{capture name="elm_datepicker"}
	<div class="input-group date date_picker {$cfg.dp_class|default:''}" data-date-format="{$cfg.format|default:'dd-mm-yyyy'}">
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_input.tpl"     cfg=$cfg}
		<span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span>
	</div>
	<span class="help-block">{$cfg.msg_helper|default:''}</span>
{/capture}

{if $cfg.plain}
	{$smarty.capture.elm_datepicker}
{else}
	<div class="form-group {$display|default:''}" {if isset($cfg.msg_helper)}style="margin-bottom:0"{/if}>
        {if isset($label)}
		<label class="col-md-{$grid_0} control-label" for="{$name}">{$label} {if isset($cfg.required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
        {/if}
        <div class="col-md-{$grid_1}">
			{$smarty.capture.elm_datepicker}
		</div>
	</div>
{/if}

