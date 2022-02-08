{if !isset($class)}
	{assign 'class' ''}
{/if}
<div class="form-group">
	<label class="col-md-{$WLbl|default:3} control-label" for="{$name}">{$label} {if isset($is_require)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$WElm|default:9}">
		<select id="{$name}_{$sys.req.rid}" name="{$name}" class="form-control {$class}" {if isset($disabled)}disabled{/if} title="{$label}"
			{if isset($is_require)}required data-rule-required="true" data-msg-required="{$msg_required|default:'This column is mandatory !'}"{/if}>
			<option value="">Choose {$label}</option>
			{if $sys.rsp.dat.$name}<option value="{$sys.rsp.dat.$name}" selected>{$sys.rsp.dat.$name}</option>{/if}
		</select>
		<span class="help-block">{$msg_helper|default:''}</span>
		<div id="{$name}_error"></div>
	</div>
</div>
