{if !isset($WEml)}
	{if $pky_type eq 'char' || $pky_type eq 'serial'}
		{assign "WEml" 3}
	{else}
		{assign "WEml" 2}
	{/if}
{/if}
<div class="form-group">
	<label for="id" class="col-md-3 control-label">ID <span class="required">*</span> | Code <span class="required">*</span></label>
	<div class="col-md-3">
		<input id="act" name="act" value="{if $sys.rsp.dat.id}upd{else}add{/if}" type="hidden" />
		{if $sys.rsp.dat.id}
			<div class="input-group">
				<input type="text" id="id_{$sys.req.rid}" name="id" class="form-control" value="{$sys.rsp.dat.id}" readonly required />
				<span class="input-group-addon"><i class="icon-lock"></i></span>
			</div>
		{else}
			{if $pky_type eq 'num'}
				<div class="input-group">
					<input type="number" id="id_{$sys.req.rid}" name="id" class="form-control numeric unique" data-source="{$sys.req.rid}" step="{$step|default:1}" maxlength="{$maxlength|default:3}"
						required data-required="true"   data-msg-required="{$msg_required|default:'This Column is Mandatory'}"
						data-remote="{$sys.bpm.tbl}"    data-msg-remote="{$msg_remote|default:'This value is already used'}"
						data-rule-unique="{if $sys.rsp.dat.id}true{else}false{/if}"
					/>
					<span class="input-group-addon">U</span>
				</div>
			{elseif $pky_type eq 'char'}
				<div class="input-group">
					<input type="text" id="id_{$sys.req.rid}" name="id" class="form-control unique" data-source="{$sys.req.rid}" step="{$step|default:1}" maxlength="{$maxlength|default:3}"
						required data-required="true"   data-msg-required="{$msg_required|default:'This Column is Mandatory'}"
						data-remote="{$sys.bpm.tbl}"    data-msg-remote="{$msg_remote|default:'This value is already used'}"
						data-rule-unique="{if $sys.rsp.dat.id}true{else}false{/if}"
					/>
					<span class="input-group-addon">U</span>
				</div>
			{elseif $pky_type eq 'serial'}
				<div class="input-group">
					<input type="text" id="id_{$sys.req.rid}" name="id" class="form-control" readonly />
					<span class="input-group-addon"><i class="icon-lock"></i></span>
				</div>
				<span class="help-block">Auto-Number</span>
			{/if}
		{/if}
	</div>
	<div class="col-md-6">
		<div class="input-group">
			<input type="text" id="id_code_{$sys.req.rid}" name="id_code" class="form-control unique" data-source="{$sys.req.rid}" value="{$sys.rsp.dat.id_code}"
				{if $sys.rsp.dat.id_code}
					required data-required="true" data-msg-required="This Column is Mandatory'"
			   {/if}
			   data-rule-unique="{if $sys.rsp.dat.id_code}true{else}false{/if}"
			   data-remote="{$sys.bpm.tbl}" data-msg-remote="This value is already used"
			/>
			<span class="input-group-addon">U</span>
		</div>
	</div>
</div>
