<div class="form-group {$display|default:''}">
	<label class="col-md-{$WLbl|default:3} control-label" for="{$name}">{$label} {if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$WElm|default:9}">
		<input type="text" id="{$name}_{$sys.req.rid}" name="{$name}" class="form-control" placeholder="{$label}" data-role="bs-tagsinput" value="{$sys.rsp.dat.$name}" />
		<span class="help-block">Comma, is tags delimiter</span>
	</div>
</div>