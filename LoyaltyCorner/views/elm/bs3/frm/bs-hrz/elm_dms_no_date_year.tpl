{if !isset($class)}
	{assign 'class' ''}
{elseif $class eq 'unique'}
	{assign 'remote' {$sys.bpm.tbl}
{/if}
<div class="form-group">
	<label class="col-md-{$WLbl|default:3} control-label" for="doc_no">{$label} {if isset($no_required)}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-3">
		<div class="input-icon left">
			<i class="fa{if $class eq 'unique'} fa-underline{/if}"></i>
			<input type="text" class="form-control {$class} text-left" id="doc_no_{$sys.req.rid}" name="doc_no" value="{$sys.rsp.dat.doc_no|default:''}" data-value="{$sys.rsp.dat.doc_no|default:''}"
				{if isset($disabled)}disabled{/if}
				{if isset($no_title)}title="{$no_title}" placeholder="{$no_title}"{/if}
				{if $class eq 'unique'}data-rule-unique="{if $sys.rsp.dat.doc_no}true{else}false{/if}"{/if}
				{if isset($no_required)}required data-rule-required="true" data-msg-required="{$msg_required|default:'This Column is Mandatory !'}"{/if}
				{if isset($minlength)}minlength="{$minlength}" data-rule-minlength="{$minlength}" data-msg-minlength='{$msg_minlength|default:"Min. Length: {$minlength} chars"}'{/if}
				{if isset($maxlength)}maxlength="{$maxlength}" data-rule-maxlength="{$maxlength}" data-msg-maxlength='{$msg_maxlength|default:"Max. Length: {$maxlength} chars"}'{/if}
			/>
			{if isset($no_msg_helper)}<span class="help-block">{$no_msg_helper}</span>{/if}
		</div>
	</div>
	<div class="col-md-3">
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
	<div class="col-md-3">
		<div class="input-group">
			<input type="number" id="doc_year_{$sys.req.rid}" name="doc_year" class="form-control" value="{$sys.rsp.dat.doc_year|default:''}"
				   {if isset($year_title)}title="{$year_title}" placeholder="{$year_title}"{/if}
					{if isset($year_required)}data-required="true" required data-msg-required="{$msg_required|default:'This Column is Mandatory !'}"{/if}
					{if isset($year_min)}min="{$year_min}"    data-min="{$year_min}" data-msg-min="Earliest Year is {$year_min}"{/if}
					{if isset($year_max)}max="{$year_max}"    data-max="{$year_max}" data-msg-max="Max. Year is {$year_max}"{/if}
					step="{$year_step|default:1}"
					{if isset($year_range)}data-range="{$year_range}" data-msg-range="Year Range: {$year_range}"{/if}
			/>
			<span class="input-group-addon">123</span>
		</div>
	</div>
</div>
