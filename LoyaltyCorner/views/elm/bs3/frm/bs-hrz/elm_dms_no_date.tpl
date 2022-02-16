{assign 'value' $sys.rsp.dat.$name|default:''}
{if !isset($class)}
	{assign 'class' ''}
{elseif $class eq 'unique'}
	{assign 'remote' {$sys.bpm.tbl}
{/if}
<div class="form-group">
	<label for="doc_no" class="col-md-{$WLbl|default:3} control-label">{$label} {if isset($no_required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-5">
		<div class="input-icon left">
			<i class="fa{if $class eq 'unique'} fa-underline{/if}"></i>
			<input type="text" class="form-control {$class} text-left" id="doc_no_{$sys.req.rid}" name="doc_no" value="{$sys.rsp.dat.doc_no|default:''}" data-value="{$sys.rsp.dat.doc_no|default:''}"
				{if isset($disabled)}disabled{/if}
				{if isset($no_title)}title="{$no_title}" placeholder="{$no_title}"{/if}
				{if $class eq 'unique'}
					data-rule-unique="{if $sys.rsp.dat.doc_no}true{else}false{/if}"
					data-remote="{$remote}"
					data-msg-remote="{$msg_remote|default:'This value is already used'}"
				{/if}
				{if isset($no_required)}required data-rule-required="true" data-msg-required="{$msg_required|default:'This Column is Mandatory !'}"{/if}
				{if isset($minlength)}minlength="{$minlength}" data-rule-minlength="{$minlength}" data-msg-minlength='{$msg_minlength|default:"Min. Length: {$minlength} chars"}'{/if}
				{if isset($maxlength)}maxlength="{$maxlength}" data-rule-maxlength="{$maxlength}" data-msg-maxlength='{$msg_maxlength|default:"Max. Length: {$maxlength} chars"}'{/if}
			/>
			{if isset($no_msg_helper)}<span class="help-block">{$no_msg_helper}</span>{/if}
		</div>
	</div>
	<div class="col-md-4">
		<div class="input-group date date_picker {$dpClass|default:''}" data-date-format="yyyy-mm-dd">
			<input type="text" class="form-control" readonly id="doc_date_{$sys.req.rid}" name="doc_date" value="{$sys.rsp.dat.doc_date|default:''}" data-value="{$sys.rsp.dat.doc_date|default:''}"
				{if isset($date_title)}title="{$date_title}" placeholder="{$date_title}"{/if}
				{if isset($date_required)}data-required="true" required data-msg-required="{$msg_required|default:'This Column is Mandatory !'}"{/if}
			/>
			<span class="input-group-btn"><button class="btn default" style="margin-bottom: 0;" type="button"><i class="fa fa-calendar"></i></button></span>
		</div>
		<span id="datepicker-error" class="help-block help-block-error"></span>
		{if isset($date_msg_helper)}<span class="help-block">{$date_msg_helper}</span>{/if}
	</div>
</div>
