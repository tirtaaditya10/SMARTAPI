{if isset($arr_idx)}
    {assign 'value' $sys.rsp.dat.$name.$arr_idx}
{elseif !isset($sys.rsp.dat.$name)}
    {assign 'arr_idx' 0}
	{assign 'value'   0}
{else}
    {assign 'arr_idx' 0}
	{assign 'value' $sys.rsp.dat.$name}
{/if}
{if !isset($ctrl)}
	{assign 'ctrl' 1}
{/if}
<div class="form-group {if isset($hideme) && $hideme}display-hide{/if}">
	<label class="col-md-{$WLbl|default:3} control-label">{$label} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$WElm|default:9}">
		<input type="checkbox" class="make-switch" id="{$name}_{$sys.req.rid}" {if $ctrl}{if $arr_idx}name="{$name}[{$arr_idx}]"{else}name="{$name}"{/if}{/if}
			{if $value}checked value="1"{/if}
			data-on-text ="&nbsp;{$lbl_on|default:'Yes'}&nbsp;"
			data-off-text="&nbsp;{$lbl_off|default:'No'}&nbsp;"
		/>
	</div>
</div>