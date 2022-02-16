<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            {if $sys.prc.sys_prc.font eq 'md'}
                <i class="material-icons">{$sys.prc.sys_prc.icon}</i>
            {else}
                <i class="{$sys.prc.sys_prc.icon}"></i>
            {/if}
            {$sys.prc.sys_prc.header}
            {if $sys.prc.sys_prc.header_sub} <small>{$sys.prc.sys_prc.header_sub}</small>{/if}
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        {block name="widget_header_right"}{/block}
    </div>
</div>