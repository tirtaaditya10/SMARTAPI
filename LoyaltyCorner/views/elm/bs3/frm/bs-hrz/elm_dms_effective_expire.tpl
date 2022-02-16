{if !isset($class)}
	{assign 'class' ''}
{elseif $class eq 'unique'}
	{assign 'remote' {$sys.bpm.tbl}
{/if}
<div class="form-group">
	<label class="col-md-{$WLbl|default:3} control-label" for="doc_effective">Effective {if isset($effective_required)}<span class="required">*</span>{/if} / Expired {if isset($expired_required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-5">
		<div class="input-group date date_picker {$dpClass|default:''}" data-date-format="yyyy-mm-dd">
			<input type="text" class="form-control" readonly id="doc_effective" name="doc_effective" value="{$sys.rsp.dat.doc_effective|default:''}" data-value="{$sys.rsp.dat.doc_effective|default:''}"
				   title="Effective Date" placeholder="Effective Date"
					{if isset($date_required)}data-required="true" required data-msg-required="{$msg_required|default:'This Column is Mandatory !'}"{/if}
			/>
			<span class="input-group-btn"><button class="btn default" style="margin-bottom: 0;" type="button"><i class="fa fa-calendar"></i></button></span>
		</div>
		<span class="help-block help-block-error"></span>
	</div>
	<div class="col-md-4">
		<div class="input-group date date_picker {$dpClass|default:''}" data-date-format="yyyy-mm-dd">
			<input type="text" class="form-control" readonly id="doc_expire" name="doc_expire" value="{$sys.rsp.dat.doc_expire|default:''}" data-value="{$sys.rsp.dat.doc_expire|default:''}"
				   title="Expire Date" placeholder="Expire Date"
				   {if isset($expired_required)}data-required="true" required data-msg-required="{$msg_required|default:'This Column is Mandatory !'}"{/if}
			/>
			<span class="input-group-btn"><button class="btn default" style="margin-bottom: 0;" type="button"><i class="fa fa-calendar"></i></button></span>
		</div>
		<span class="help-block help-block-error"></span>
	</div>
</div>
