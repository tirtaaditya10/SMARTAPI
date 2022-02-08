<div class="form-group">
	<label class="col-md-{$WLbl|default:3} control-label" for="{$name}">{$label} {if isset($required)}<span class="required">*</span>{/if}</label>
	<div class="col-md-{$WElm|default:9}">
		<div style="padding:10px; border:1px dashed;">{$sys.rsp.dat.$name}</div>
	</div>
</div>
