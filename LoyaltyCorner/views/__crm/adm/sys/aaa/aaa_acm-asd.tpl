{extends file="{$sys.uix.elm}/hst/portlet-mini.tpl"}
{block name="portlet-mini_title"}
    <span class="widget-icon"><i class="fa fa-lock"></i></span>
    <h2>ROLE: {$sys.rsp.dat.aaa_acm|upper}</h2>
{/block}
{block name="portlet-mini_tab"}
    <ul class="nav nav-tabs pull-right in bordered">
        <li class="active">
            <a data-toggle="tab" href="#acm_1" data-url="#{$sys.req.rid+1}/{$sys.req.pid}">
                <i class="fa fa-user txt-color-orange"></i> Members
            </a>
        </li>
        <li>
            <a data-toggle="tab" href="#acm_2" class="refresh" data-url="#{$sys.req.rid+2}/{$sys.req.pid}">
                <i class="fa fa-globe txt-color-blue"></i> Menus
            </a>
        </li>

    </ul>
{/block}
{block name="portlet-mini_body"}
    <div class="tab-content">
        <div id="acm_1" class="tab-pane active"></div>
        <div id="acm_2" class="tab-pane"></div>
    </div>
{/block}