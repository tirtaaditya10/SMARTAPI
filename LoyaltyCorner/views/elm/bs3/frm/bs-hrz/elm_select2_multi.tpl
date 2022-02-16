{if !isset($selected)}
	{assign 'selected' $dtx.sp_def}
{/if}
{capture name="el_select"}
	<select class="form-control select2-multiple" {if isset($disabled)}disabled{/if} id="{$dtx.col_fid}" name="{$dtx.col_fid}[]" multiple
			{if $dtx.is_require}required data-rule-required="true" data-msg-required="{$dtx.msg_required|default:'This column is mandatory !'}"{/if}
			data-placeholder="{$dtx.elm_label}" title="{$dtx.elm_label}" style="width:100%" >
		<option value="">Choose {$dtx.elm_label}</option>
		{if $dtx.option}{html_options options=$dtx.option selected=$selected}{/if}
	</select>
	<span class="help-block">{$dtx.msg_helper|default:''}</span>
	<div id="{$dtx.col_fid}_error"></div>
{/capture}
{if isset($el_only) && $el_only eq 1}
	{$smarty.capture.el_select}
{else}
	<div class="form-group {$display|default:''}">
		<label for="{$dtx.col_fid}" class="col-md-{$WLbl|default:3} control-label">{$dtx.elm_label} {if $dtx.is_require}<span class="required">*</span>{else}&nbsp;{/if}</label>
		<div class="col-md-{$WElm|default:9} select2-bootstrap-append">
			{$smarty.capture.el_select}
		</div>
	</div>
{/if}
