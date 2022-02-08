{if isset($name)}       {assign var=rff         value=$sys.rsp.ref.$name}{/if}
{if !isset($selected)}  {assign 'selected'      $rff.sp_def}{/if}

{if !isset($grid_0)}    {assign var=grid_0      value=3}{/if}
{if !isset($grid_1)}    {assign var=grid_1      value=9}{/if}

{if !isset($cfg)}       {assign var=cfg         value=[]}{/if}
{if !isset($cfg.plain)} {$cfg.plain = 0}{/if}

{capture name="elm_select"}
	<select id="{$rff.col_fid}_{$sys.req.rid}" {if $rff.is_control}name="{$rff.col_fid}"{/if} class="form-control bs-select show-tick show-menu-arrow{if $rff.elm_chain} chaining{/if}"
			data-size="{$max_row|default:5}"
			data-style="{$style|default:'btn-inverse'}"
			data-live-search="true"
			title="{$rff.elm_title}" placeholder="{$rff.elm_placeholder}"
			{if $rff.elm_chain}
				data-model="{$sys.req.rid}"
				data-source="{$rff.elm_chain.src}"
				data-target="#{$rff.elm_chain.trg}_{$sys.req.rid}"
			{/if}
			{if $rff.is_require}required data-rule-required="true" data-msg-required="{$rff.msg_required|default:'This column is mandatory !'}"{/if}
            {if $cfg.disabled|default:0}disabled{/if}
            {if $cfg.readonly|default:0}readonly{/if}
	>
		<option value="">Choose for {$rff.elm_placeholder}</option>
		{if $rff.init_flg && $rff.option}
			{foreach from=$rff.option item=i}
				<option value="{$i.id}" {if $i.id eq $selected}selected{/if}
						{if isset($i.disabled)} disabled{/if}
						{if isset($i.title)} title="{$i.title}"{/if}
						{if isset($i.icon)} data-icon="{$i.icon}"{/if}
						{if isset($i.subtext)} data-subtext="{$i.subtext}"{/if}
						{if isset($i.content)} data-content="{$i.content}"{/if}
				>{$i.nm}</option>
			{/foreach}
		{/if}
	</select>
	<span id="{$rff.col_fid}_error" class="help-block">{$rff.msg_helper|default:''}</span>
{/capture}
{if $cfg.plain}
	{$smarty.capture.elm_select}
{else}
	<div class="form-group">
		<label for="{$sys.req.rid}_{$rff.col_fid}" class="col-md-{$grid_0} control-label">{$rff.elm_label} {if $rff.is_require}<span class="required">*</span>{else}&nbsp;{/if}</label>
		<div class="col-md-{$grid_1}">
			{$smarty.capture.elm_select}
		</div>
	</div>
{/if}
