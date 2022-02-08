{block name="toolbar_upper"}{/block}
{if $sys.uix.uxt eq 'treegrid'}
	{include file="{$sys.uix.elm}/tpl/tbl_treegrid.tpl"}
{else}
	{include file="{$sys.uix.elm}/tpl/tbl_foo.tpl"}
{/if}
{block name="toolbar_lower"}{/block}
{include file="{$sys.uix.elm}/tpl/tbl_js.tpl"}