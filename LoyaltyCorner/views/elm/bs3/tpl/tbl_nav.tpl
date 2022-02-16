{extends file="{$sys.uix.elm}/hst/portlet-lst_tab.tpl"}
{block name="uix_pct"}
	{if $tbl eq 'treegrid'}
		{include file="{$sys.uix.elm}/tpl/tbl_treegrid.tpl"}
	{else}
		{include file="{$sys.uix.elm}/tpl/tbl_foo.tpl"}
	{/if}
{/block}