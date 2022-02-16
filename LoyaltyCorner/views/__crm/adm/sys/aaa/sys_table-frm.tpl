{extends file="{$sys.uix.elm}/tpl/frm_hrz.tpl"}
{block name="form_ext"}
	{include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"      dtx=$sys.rsp.ref.schema_db}
	{include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"      dtx=$sys.rsp.ref.sys_table_type}
	{include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"      dtx=$sys.rsp.ref.sys_table_pk_type}
	{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"        label="Primary=Key" name="sys_table_pk" required=true}
	{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"        label="Model" name="has.mvc_model"}
	{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"        label="Search-Free" name="search_free"}
	{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"        label="Search-Full" name="search_full"}
	{include file="{$sys.uix.elm}/frm/bs-hrz/elm_number.tpl"      label="Max-Tree" name="max_tree"}
	{include file="{$sys.uix.elm}/frm/bs-hrz/elm_boolean.tpl"     label="Has PID"   name="has.pid"}
	{include file="{$sys.uix.elm}/frm/bs-hrz/elm_boolean.tpl"     label="Has Code"  name="has.id_code"}
	{include file="{$sys.uix.elm}/frm/bs-hrz/elm_boolean.tpl"     label="In-Memory ?" name="is_table_memory"}
{/block}