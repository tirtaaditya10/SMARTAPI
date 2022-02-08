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
    <article class="col-sm-12 {if $sys.uix.asd.pos eq  'both'}no-padding{/if}">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-wyeth" id="PCF_{$sys.req.rid}"
             data-widget-colorbutton="false"
             data-widget-editbutton="false"
             data-widget-togglebutton="false"
             data-widget-deletebutton="false"
             data-widget-collapsed="false"
             data-widget-sortable="false"
             style="display:grid">
            <header>
                <span class="widget-icon"> <i class="{$sys.prc.sys_prc.icon}"></i></span>
                <h2>Form {$sys.prc.sys_prc.header}</h2>
                {block name="widget_toolbar_11"}{/block}
                {block name="widget_toolbar_12"}{/block}
                {block name="widget_toolbar_13"}{/block}
                {block name="widget_toolbar_21"}{/block}
                {block name="widget_toolbar_22"}{/block}
                {block name="widget_toolbar_23"}{/block}
                {block name="widget_tab"}{/block}
            </header>

            <!-- widget div-->
            <div>
                <!-- widget content -->
                <div class="widget-body">
                    {if $sys.prc.sys_aaa.right.bat && isset($sys.rsp.upl)}
                        {include file="{$sys.uix.elm}/hst/portlet_warning_validation.tpl"}
                    {/if}
                    <div class="clearfix">
                        <div id="PCF" class="root-PCF">
                            {include file="{$sys.uix.elm}/tpl/frm_uxt.tpl"}
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

{include file="{$sys.uix.elm}/hst/portlet-header.tpl"}
{if $sys.uix.asd}
    <div class="row">
        {if $sys.uix.asd.pos eq 'left' || $sys.uix.asd.pos eq 'both'}
            <div class="col col-md-{$pl}">
                {include file="{$sys.uix.elm}/hst/portlet-aside.tpl" pos='left'}
            </div>
        {/if}
        <div class="col col-md-{$pc}">
            {$smarty.capture.portlet_center}
        </div>
        {if $sys.uix.asd.pos eq 'right' || $sys.uix.asd.pos eq 'both'}
            <div class="col col-md-{$pr}">
                {include file="{$sys.uix.elm}/hst/portlet-aside.tpl" pos='right'}
            </div>
        {/if}
    </div>
{else}
    {$smarty.capture.portlet_center}
{/if}
{include file="{$sys.uix.elm}/hst/portlet-frm_js.tpl"}
