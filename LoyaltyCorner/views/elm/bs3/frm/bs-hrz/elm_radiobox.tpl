{if !isset($label)}
	{assign 'label' $dtx.elm_label}
{/if}
{if !isset($selected)}
	{assign 'selected' $dtx.sp_def}
{/if}
{if !isset($display) || $display eq 1 || $display eq true}
	{assign 'display' ''}
{else}
	{assign 'display' ' display-hide'}
{/if}
<div class="form-group{$display}">
	<label for="{$dtx.col_fid}" class="col-md-{$WLbl|default:3} control-label">{$label} {if $dtx.is_require}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$WElm|default:9}">
		<div class="radio-list" {if isset($msg_err)}data-error-container="#{$dtx.col_fid}_error"{/if}>
			{foreach $dtx.option as $v}
				<label><input type="radio" name="{$dtx.col_fid}" value="{$v.id}" {if $v.id eq $selected}checked{/if}/ {if isset($disabled)}disabled{/if}> {$v.nm}</label>
			{/foreach}
		</div>
		<div id="{$dtx.col_fid}_error"></div>
	</div>
</div>
