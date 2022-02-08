<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}/{$sys.req.fid}" data-target="#{$sys.uix.pcm}" class="cForm form-horizontal form-compact" role="form">
	{block name="form_body"}
		<div class="form-body">
			{include file="{$sys.uix.elm}/frm/dlg_error_form_validation.tpl"}
			{include file="{$sys.uix.elm}/frm/bs-hrz/elm_pkey.tpl"}
			{block name="form_main"}
				{if $sys.prc.sys_tbl.has.col_self}
					{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"     label="{$label|default:'Name'}" name="{$sys.prc.sys_tbl.has.col_self}" cfg=[required=>true]}
				{/if}
				{if $sys.prc.sys_tbl.has.col_pid}
					{include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"   name=$sys.prc.sys_tbl.has.col_self|cat:"_pid"}
				{/if}
			{/block}
			{block name="form_ext"}{/block}
			{block name="form_def"}
				{assign var='desc' value=$sys.bpm.tbl|cat:'_desc' nocache}
				{if isset($sys.rsp.dat[$desc]) || (isset($sys.rsp.dat[$desc]) && is_null($sys.rsp.dat[$desc]))}
					{include file="{$sys.uix.elm}/frm/bs-hrz/elm_textarea.tpl"  label="Desc"   name="{$desc}"}
				{/if}
				{if isset($sys.rsp.dat.font_icon) || (isset($sys.rsp.dat.font_icon) && is_null($sys.rsp.dat.font_icon))}
					{include file="{$sys.uix.elm}/frm/bs-hrz/elm_fontpicker.tpl"}
				{/if}
				{if $sys.prc.sys_tbl.has.col_active}
					{include file="{$sys.uix.elm}/frm/bs-hrz/elm_is_active.tpl"}
				{/if}
			{/block}
		</div>
		{block name="form_btn"}
			{include file="{$sys.uix.elm}/frm/btn_crud.tpl"}
		{/block}
	{/block}
</form>
{block name="style"}{/block}
{block name="script"}{/block}
{if $sys.rsp.dat.id}
	{if $sys.prc.sys_tbl.has.col_self}
		{include file="{$sys.uix.elm}/frm/dlg_crud_del_conf.tpl" cForm="F{$sys.req.rid}{$sys.req.pid}" dlgHead="{$sys.prc.sys_process}" dlgBody="<dt>{$sys.prc.sys_process}</dt><dd>{$sys.rsp.dat[$sys.prc.sys_tbl.has.col_self]}</dd>{block name=dlg_ext}{/block}"}
	{else}
		{include file="{$sys.uix.elm}/frm/dlg_crud_del_conf.tpl" cForm="F{$sys.req.rid}{$sys.req.pid}" dlgHead="{$sys.prc.sys_process}" dlgBody="<dt>{$sys.prc.sys_process}</dt><dd>{$sys.rsp.dat[$sys.prc.sys_tbl.has.col_self]}</dd>{block name=dlg_ext}{/block}"}
	{/if}
{/if}
