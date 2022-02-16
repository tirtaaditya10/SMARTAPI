{if !isset($label)}
	{assign 'label' $dtx.title}
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
	<label class="col-md-{$WLbl|default:3} control-label">{$label} {if $dtx.required}<span class="required">*</span>{else}&nbsp;{/if}</label>
	<div class="col-md-{$WElm|default:9}">
		<div class="checkbox-list" {if isset($msg_err)}data-error-container="#{$dtx.col_fid}_error"{/if}>
			{foreach $dtx.option as $k=>$v}
				<label><input type="checkbox" value="{$v.id}_{$sys.req.rid}" name="{$dtx.col_fid}" {if $v.id eq $selected}checked{/if}/> {$v.nm}</label>
			{/foreach}
		</div>
		<span class="help-block">{$dtx.msg_helper|default:''}</span>
	</div>
</div>
