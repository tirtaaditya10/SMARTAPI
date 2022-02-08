{if !isset($selected)}
	{assign 'selected' $dtx.sp_def}
{/if}
{capture name="el_select"}
	<select class="form-control bs-select show-tick show-menu-arrow" data-size="{$max_row|default:5}" data-style="{$style|default:'btn-inverse'}" data-live-search="true" {if isset($disabled)}disabled{/if}
			id="{$dtx.col_fid}_{$sys.req.rid}" name="{$dtx.col_fid}[]" multiple
			{if $dtx.is_require}required data-rule-required="true" data-msg-required="{$dtx.msg_required|default:'This column is mandatory !'}"{/if}
			data-placeholder="Choose for {$dtx.elm_label}" title="Choose for {$dtx.elm_label}" style="width:100%" >
		<option value="">Choose for {$dtx.elm_label}</option>
		{if $dtx.option}
			{foreach from=$dtx.option item=i}
				<option {if isset($i.icon)}data-icon="{$i.icon}"{/if} value="{$i.id}" {if is_array($selected) && in_array($i.id, $selected)}selected{/if}>{$i.nm}</option>
			{/foreach}
		{/if}
	</select>
	<span class="help-block">{$dtx.msg_helper|default:''}</span>
	<div id="{$dtx.col_fid}_error"></div>
{/capture}
{if isset($el_only) && $el_only eq 1}
	{$smarty.capture.el_select}
{else}
	<div class="form-group {$display|default:''}">
		<label for="{$dtx.col_fid}_{$sys.req.rid}" class="col-md-{$WLbl|default:3} control-label">{$dtx.elm_label} {if $dtx.is_require}<span class="required">*</span>{else}&nbsp;{/if}</label>
		<div class="col-md-{$WElm|default:9}">
			{$smarty.capture.el_select}
		</div>
	</div>
{/if}
