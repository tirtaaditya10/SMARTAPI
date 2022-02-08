{block name="config"}
    {block name="grid"}
        {assign pl 0}
        {assign pr 0}
    {/block}
{/block}
{assign pc 12}
{if $sys.uix.asd.pos eq 'left'  || $sys.uix.asd.pos eq 'both'}  {assign var=pc value=$pc-$pl}{/if}
{if $sys.uix.asd.pos eq 'right' || $sys.uix.asd.pos eq 'both'}  {assign var=pc value=$pc-$pr}{/if}

{capture name=portlet_center}
<div class="row">
    <article class="col-sm-12 {if $sys.uix.asd.pos eq 'both'}no-padding{/if}">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-wyeth" id="PCL_{$sys.req.rid}"
             data-widget-colorbutton="false"
             data-widget-togglebutton="false"
             data-widget-deletebutton="false"
             data-widget-collapsed="false"
             data-widget-sortable="false"
             data-widget-editbutton="false"
             style="display:grid">

            <header>
                <div class="widget-toolbar">
                    <a href="javascript:void(0);" class="button-icon btn-danger btn-jarvis btn-lst-refresh fa fa-refresh" title="Refresh Page" rel="tooltip"></a>
                </div>
                {include file="{$sys.uix.elm}/hst/portlet-lst-search.tpl"}
                {block name="widget_toolbar_11"}{/block}
                {block name="widget_toolbar_12"}{/block}
                {block name="widget_toolbar_13"}{/block}
                {if $sys.prc.sys_aaa.right.bat}{include file="{$sys.uix.elm}/hst/portlet-lst-upl_xls.tpl"}{/if}
                {if $sys.prc.sys_aaa.right.exp}{include file="{$sys.uix.elm}/hst/portlet-lst-exp.tpl"}{/if}
                {block name="widget_toolbar_21"}{/block}
                {block name="widget_toolbar_22"}{/block}
                {block name="widget_toolbar_23"}{/block}
                {block name="widget_tab"}{/block}
            </header>

            <!-- widget div-->
            <div class="no-padding">
                <!-- widget content -->
                <div class="widget-body">
                    {if $sys.prc.sys_aaa.right.bat && isset($sys.rsp.upl)}
                        {include file="{$sys.uix.elm}/hst/portlet_warning_validation.tpl"}
                    {/if}
                    <div class="clearfix">
                        <div id="PCT" class="root-PCT">
                            {include file="{$sys.uix.elm}/tpl/tbl_uxt.tpl"}
                        </div>
                    </div>
                </div>
                <!-- end widget content -->
            </div>
            <!-- end widget div -->
        </div>
        <!-- end widget -->
    </article>
</div>
{/capture}

<section id="widget-grid">
{if $sys.uix.hst && !$sys.req.n}
    <div id="PCL" class="root-PCL">
        {include file="{$sys.uix.elm}/hst/portlet-header.tpl"}
        {if $sys.uix.asd}
            {if $sys.uix.asd.pos eq 'left' || $sys.uix.asd.pos eq 'both'}
                <div class="col col-md-{$pl}">
                    {include file="{$sys.uix.elm}/hst/portlet-aside.tpl"}
                </div>
            {/if}
                <div class="col col-md-{$pc}">
                    {$smarty.capture.portlet_center}
                </div>
            {if $sys.uix.asd.pos eq 'right' || $sys.uix.asd.pos eq 'both'}
                <div class="col col-md-{$pr}">
                    {include file="{$sys.uix.elm}/hst/portlet-aside.tpl"}
                </div>
            {/if}
        {else}
            {$smarty.capture.portlet_center}
        {/if}
        {** include file="{$sys.uix.elm}/hst/portlet-lst_js.tpl" **}
    </div>
    {include file="{$sys.uix.elm}/misc/div_pcd.tpl"}
{else}
    {include file="{$sys.uix.elm}/tpl/tbl_uxt.tpl"}
{/if}
</section>