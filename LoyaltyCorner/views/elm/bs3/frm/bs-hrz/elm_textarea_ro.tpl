<div class="form-group">
	<label class="col-md-{$WLbl|default:3} control-label">{$label}</label>
	<div class="col-md-{$WElm|default:9}">
		<div class="input-icon right">
			<i class="fa"></i>
			<textarea class="form-control autosize" rows="{$row|default:3}" readonly disabled>{$sys.rsp.dat.$name}</textarea>
		</div>
	</div>
</div>
