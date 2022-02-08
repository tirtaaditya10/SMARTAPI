<div class="form-group">
	<label class="control-label col-md-3">Audiences <span class="required">*</span></label>
	<div class="col-md-9">
		<select class="form-control select2me" multiple id="audience_aaa_acm_rbac_ixd" name="audience_aaa_acm_rbac_ixd[]" data-placeholder="Audiences by User-Role" title="Audiences by User-Role" style="width:100%">
			<option value=""></option>
			{html_options options=$sys.rsp.ref.audience_aaa_acm_rbac.option selected=$sys.rsp.ref.audience_aaa_acm_rbac.sp_def}
		</select>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3"></label>
	<div class="col-md-9">
		<select class="form-control select2me" multiple id="audience_org_ixd" name="audience_org_ixd[]" data-placeholder="Audiences by Directorat " title="Audiences by Directorat" style="width:100%">
			<option value=""></option>
			{html_options options=$sys.rsp.ref.audience_org.option selected=$sys.rsp.ref.audience_org.sp_def}
		</select>
	</div>
</div>
<div class="form-group">
	<label class="control-label col-md-3"></label>
	<div class="col-md-3">
		<select class="form-control select2me" multiple id="audience_aaa_account_ixd" name="audience_aaa_account_ixd[]" data-placeholder="Audiences by User-Account" title="Audiences by User-Account" style="width:100%">
			<option value=""></option>
			{html_options options=$sys.rsp.ref.audience_aaa_account.option selected=$sys.rsp.ref.audience_aaa_account.sp_def}
		</select>
	</div>
</div>
