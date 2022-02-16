<div class="form-group">
	<label class="col-md-{$WLbl|default:3} control-label" for="{$name}">{$label}{if isset($required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$WElm|default:9}">
		<div class="input-group">
			<input type="text" class="form-control align-{$align|default:'left'}" name="{$name}" value="{$sys.rsp.dat.$name|default:''}" {if isset($required)}required{/if} readonly />
			<span class="input-group-addon"><i class="icon-lock"></i></span>
		</div>
	</div>
</div>
