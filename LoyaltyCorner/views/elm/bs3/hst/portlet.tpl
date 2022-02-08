{if $sys.uix.hst}
    {include file="{$sys.uix.elm}/hst/portlet-{$sys.uix.hst}.tpl"}
{else}
    {block name="content-main"}{/block}
{/if}