{if $sys.uix.uxt eq 'treegrid'}
	{include file="{$sys.uix.elm}/tpl/tbl_treegrid.tpl"}
{else}
	{include file="{$sys.uix.elm}/tpl/tbl_foo.tpl"}
{/if}