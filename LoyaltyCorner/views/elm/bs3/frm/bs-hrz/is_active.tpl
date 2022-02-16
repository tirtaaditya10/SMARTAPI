<div class="form-group last">
	<label class="col-md-{$WLbl|default:3} control-label">Status <span class="required">*</span></label>
	<div class="col-md-{$WElm|default:9}">
		<input type="checkbox" class="make-switch" name="is_active"
			{if $sys.rsp.dat.is_active}checked value="1"{/if}
			data-on-text="&nbsp;{$lbl_on|default:'Active'}&nbsp;"
			data-off-text="&nbsp;{$lbl_off|default:'Disabled'}&nbsp;"
		/>
	</div>
</div>
