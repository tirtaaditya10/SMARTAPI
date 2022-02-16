<style>
    .jarviswidget header .nav-tabs > li.active > a,
    .jarviswidget header .nav-tabs > li.active > a:focus,
    .jarviswidget header .nav-tabs > li.active > a:hover {
        color: azure;
        background-color: #444488;
        border: 1px solid #4444cc;
    }
</style>
{include file="{$sys.uix.elm}/hst/portlet-header.tpl"}
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
                    <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
                </header>
                <!-- widget div-->
                <div role="content">
                    <!-- widget content -->
                    <div class="widget-body">
                        {if !$sys.req.fid}
                        <button id="dialer_callme" class="btn btn-lg fa fa-phone txt-color-red"> Call Now</button>
                        <button type="button" class="btn btn-lg fa fa-pencil txt-camo-earth"> Edit Without Call</button>
                        {/if}
                        {include file="{$sys.uix.tpl}/obc-call/list_call-voice_recording.tpl" data=$sys.rsp.recording}

                        <form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal form-compact" role="form">
                            {include file="{$sys.uix.tpl}/obc-call/list_call-base.tpl"}

                            <h2 class="row-seperator-header"><i class="fa fa-comments"></i> {$sys.rsp.dat.wcrm_campaign_type} </h2>
                            {include file="{$sys.uix.tpl}/obc-call/list_call-campaign.tpl"}

                            <h2 class="row-seperator-header"><i class="fa fa-comments"></i> Customer </h2>
                            <ul id="myInfo" class="nav nav-tabs bordered">
                                <li class="active"><a href="#info_1" data-toggle="tab"><i class="fa fa-user"></i> Customer</a></li>
                                <li><a href="#info_2" data-toggle="tab" data-url="#520004220/{$sys.rsp.dat.wcrm_contact_id}/contact" class="refresh"><i class="fa fa-child"></i> Children</a></li>
                                <li><a href="#info_3" data-toggle="tab" data-url="#520004220/{$sys.rsp.dat.wcrm_account_id}/membership" class="refresh"><i class="fa fa-id-card"></i> Membership</a></li>
                            </ul>
                            <div id="myCallContent" class="tab-content padding-10">
                                <div class="tab-pane fade in active" id="info_1">
                                    {include file="{$sys.uix.tpl}/obc-call/list_call-customer.tpl"}
                                </div>
                                <div class="tab-pane fade" id="info_2"></div>
                                <div class="tab-pane fade" id="info_3"></div>
                            </div>
                            {include file="{$sys.uix.elm}/frm/btn_crud.tpl"}
                        </form>

                        <div id="dialer_dialog" title="Dialer">
                            <form class="form-horizontal form-compact">
                                <div class="form-group">
                                    <label class="col-md-3 control-label" for="dialer_number">Phone Number</label>
                                    <div class="col-md-4" style="padding-left:0">
                                        <select class="form-control" id="dialer_number">
                                            <option value="{$sys.rsp.dat.phone_number_1}">{$sys.rsp.dat.phone_number_1|phone_format}</option>
                                            {if $sys.rsp.dat.phone_number_2}<option value="{$sys.rsp.dat.phone_number_2}">{$sys.rsp.dat.phone_number_2|phone_format}</option>{/if}
                                            {if $sys.rsp.dat.phone_number_3}<option value="{$sys.rsp.dat.phone_number_3}">{$sys.rsp.dat.phone_number_3|phone_format}</option>{/if}
                                        </select>
                                    </div>
                                    <button class="btn btn-danger btn-xs" id="dialer_button">DIAL</button>
                                </div>
                                <div class="form-group display-none">
                                    <label class="col-md-3 control-label">Connection</label>
                                    <button class="btn btn-default" id="dialer_connect">Connected</button>
                                    <button class="btn btn-default" id="dialer_failed">Unconnected</button>
                                    <div class="col-md-4 display-none" style="padding-left:0;">
                                        <select class="form-control" id="dialer_number">
                                            <option value="N/A">N/A</option>
                                            <option value="MB/MV/PS">MB/MV/PS</option>
                                            <option value="TA/TDH/LJ/NS/JS">TA/TDH/LJ/NS/JS</option>
                                            <option value="TDA">TDA</option>
                                            <option value="TR/TDF/TTL/NK">TR/TDF/TTL/NK</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Voice Recording</label>
                                    <span id="dialer_file">asdas asdasda</span>
                                </div>
                            </form>
                        </div>
                        <script>
		                    $('#dialer_callme').click(function() {
			                    $('#dialer_dialog').dialog('open');
			                    return false;
		                    });
		                    $('#dialer_dialog').dialog({
			                    autoOpen : false,
			                    width : 600,
			                    resizable : false,
			                    modal : true,
			                    title : "Auto Dialer",
			                    buttons : [
				                    {   html : "<i class='fa fa-database'></i>&nbsp; Save Status",
					                    "class" : "btn btn-default btn-save display-none",
					                    click : function() {
						                    // post-something-to-server
						                    $(this).dialog('destroy').remove();
					                    }
				                    },
				                    {   html : "<i class='fa fa-times'></i>&nbsp; Cancel",
					                    "class" : "btn btn-default",
					                    click : function() {
						                    $(this).dialog('destroy').remove();
					                    }
				                    }
			                    ],
			                    close: function() {
				                    $(this).dialog('destroy').remove();
			                    }
		                    });
		                    $('#dialer_button').click(function() {
			                    $(this).parent().next().removeClass('display-none');
			                    $('.btn-save').removeClass('display-none');
			                    $.get('http://10.86.184.20:8085/crondialer.do?task=dial&extension={$sys.usr.phone_ext}&destination=' + $('#phone_number').val(), function (rsp) {
				                    console.info(rsp);
			                    })
		                    });
		                    $('#dialer_failed').click(function () {
			                    $(this).prev().hide().next().next().removeClass('display-none');
		                    })
		                    $('#dialer_connect').click(function () {
			                    $(this).html('<i class="fa fa-check"></i> Connected').next().hide();
		                    })
                        </script>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </div>
            <!-- end widget -->
        </article>
    </div>
</section>
