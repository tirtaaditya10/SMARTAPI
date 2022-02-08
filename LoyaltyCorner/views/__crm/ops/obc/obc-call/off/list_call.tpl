<section id="widget-grid" class="full-screen">
    <div class="row">
        <article class="col-sm-12 col-md-12 col-lg-12">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-wyeth"
                 data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false"
                 data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false"
                 data-widget-sortable="false" role="widget">
                <!-- widget options:
                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
                data-widget-colorbutton="false"
                data-widget-editbutton="false"
                data-widget-togglebutton="false"
                data-widget-deletebutton="false"
                data-widget-fullscreenbutton="false"
                data-widget-custombutton="false"
                data-widget-collapsed="true"
                data-widget-sortable="false"
                -->
                <header role="heading">
                    <span class="widget-icon"> <i class="fa fa-comments txt-color-white"></i> </span>
                    <h2> SMART CRM </h2>
                    <div class="widget-toolbar" role="menu">
                        <div class="badge bg-color-blue">99</div>
                    </div>
                    <ul id="myCall" class="nav nav-tabs bordered pull-right">
                        <li class="active"><a href="#activity_1" data-toggle="tab"><i class="fa fa-user"></i> Call Activity Base</a></li>
                        <li><a href="#activity_2" data-toggle="tab" data-url="#520004230/0/{$sys.rsp.dat.wcrm_activity_h_id}/{$sys.rsp.dat.wcrm_campaign_type_id}"><i class="fa fa-gift"></i> {$sys.rsp.dat.wcrm_campaign_type}</a></li>
                        <li><a href="#activity_3" data-toggle="tab" data-url="#520004250/0/{$sys.rsp.dat.wcrm_activity_h_id}"><i class="fa fa-headphones"></i> Voice Recording</a></li>
                        <li><a href="#activity_4" data-toggle="tab" data-url="#520004250/0/{$sys.rsp.dat.wcrm_activity_h_id}"><i class="fa fa-female"></i> Customer</a></li>
                        <li><a href="#activity_5" data-toggle="tab" data-url="#520004250/0/{$sys.rsp.dat.wcrm_activity_h_id}"><i class="fa fa-child"></i> Children</a></li>
                        <li><a href="#activity_6" data-toggle="tab" data-url="#520004250/0/{$sys.rsp.dat.wcrm_activity_h_id}"><i class="fa fa-id-card"></i> Membership</a></li>
                    </ul>

                    <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                </header>
                <!-- widget div-->
                <div role="content">
                    <!-- widget content -->
                    <div class="widget-body">
                        <form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
                            <div id="myCallContent" class="tab-content padding-10">
                                <div class="tab-pane fade in active" id="activity_1">{include file="{$sys.uix.tpl}/obc-call/list_call-base.tpl"}</div>
                                <div class="tab-pane fade" id="activity_2"></div>
                                <div class="tab-pane fade" id="activity_3"></div>
                                <div class="tab-pane fade" id="activity_4">{include file="{$sys.uix.tpl}/obc-call/list_call-customer.tpl"}</div>
                                <div class="tab-pane fade" id="activity_5"></div>
                                <div class="tab-pane fade" id="activity_6">{include file="{$sys.uix.tpl}/obc-call/list_misc-membership.tpl"}</div>
                            </div>
                            {include file="{$sys.uix.elm}/frm/btn_crud.tpl"}
                        </form>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </article>
    </div>
</section>