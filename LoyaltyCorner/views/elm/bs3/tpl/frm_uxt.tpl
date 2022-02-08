{block name="toolbar_upper"}{/block}
    {if isset($sys.uix.nav)}
        {include file="{$sys.uix.tpl}/{$sys.uix.nav}"}
    {else}
        {include file="{$sys.uix.elm}/tpl/frm_hrz.tpl"}
        <div class="clearfix">
            {include file="{$sys.uix.elm}/misc/div_performance.tpl"}
        </div>
    {/if}
{block name="toolbar_lower"}{/block}
{include file="{$sys.uix.elm}/tpl/tbl_js.tpl"}