{if !isset($ctrl)}
	{assign 'ctrl' 1}
{/if}
<div class="form-group">
	<label class="col-md-{$WLbl|default:3} control-label">{$label|default:"Sex"} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$WElm|default:9}">
		<input type="checkbox" class="make-switch"
			   id="sex_{$sys.req.rid}" {if $ctrl}name="sex"{/if}
			   data-off-text="<i class=' icon-symbol-female'></i>" data-on-text="<i class=' icon-symbol-male'></i>"
				{if $sys.rsp.dat.sex}checked value="1"{/if}
		/>
		<span class="help-block"></span>
	</div>
</div>
