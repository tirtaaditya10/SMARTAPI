<article class="col-sm-12">
    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget jarviswidget-color-wyeth"
         data-widget-colorbutton="false"
         data-widget-editbutton="false"
         data-widget-togglebutton="false"
         data-widget-deletebutton="false"
         data-widget-collapsed="false"
         data-widget-sortable="false"
         style="display:grid">
        <header>
            {block name="portlet-mini_title"}
                <span class="widget-icon"><i class="{$sys.prc.sys_prc.icon}"></i></span>
                <h2>{$sys.prc.sys_prc.header}</h2>
            {/block}
            {block name="portlet-mini_toolbar_11"}{/block}
            {block name="portlet-mini_toolbar_12"}{/block}
            {block name="portlet-mini_toolbar_13"}{/block}
            {block name="portlet-mini_toolbar_21"}{/block}
            {block name="portlet-mini_toolbar_22"}{/block}
            {block name="portlet-mini_toolbar_23"}{/block}
            {block name="portlet-mini_tab"}{/block}
        </header>

        <!-- widget div-->
        <div role="content">
            <!-- widget content -->
            <div class="widget-body">
                {block name="portlet-mini_body"}{/block}
            </div>
            <!-- end widget content -->
        </div>
        <!-- end widget div -->
    </div>
    <!-- end widget -->
</article>