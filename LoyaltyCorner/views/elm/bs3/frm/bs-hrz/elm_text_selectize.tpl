<div class="form-group">
	<label class="col-md-{$WLbl|default:3} control-label" for="{$name}">{$label} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$WElm|default:9}">
			<input id="{$name}_{$sys.req.rid}" name="{$name}" class="{$class|default:'contacts'}" value="{$sys.rsp.dat.$name|default:''}" />
	</div>
</div>
