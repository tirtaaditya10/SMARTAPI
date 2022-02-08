<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
    <fieldset>
        <legend><i class="fa fa-2x fa-phone"></i> <span class="font-lg txt-camo-earth">Customer</span>
            <small></small>
        </legend>
        <div class="row">
            <section class="col-md-3">
                {include file="{$sys.uix.elm}/frm/bs-hrz/elm_display.tpl" label="Customer" 		name="wcrm_account" required=true}
                {include file="{$sys.uix.elm}/frm/bs-hrz/elm_display.tpl" label="Children" 		name="wcrm_contact" required=true}
            </section>
            <section class="col-md-3">
                {include file="{$sys.uix.elm}/frm/bs-hrz/elm_display.tpl" label="Category" 		name="wcrm_campaign_type" required=true}
                {include file="{$sys.uix.elm}/frm/bs-hrz/elm_display.tpl" label="#CALL" 	    name="call_name"          required=true}
            </section>
            <section class="col-md-3">
                {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Result" 		    name="wcrm_call_result" required=true}
                {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Fail Reason"      name="wcrm_campaign_fail"}
                {include file="{$sys.uix.elm}/frm/bs-hrz/elm_textarea.tpl" label="Notes" 		name="wcrm_contact" required=true}
            </section>
            <section class="col-md-3">
                {include file="{$sys.uix.elm}/frm/bs-hrz/elm_display.tpl" label="Follow-Up" 	name="call_next_on"}
            </section>
        </div>
    </fieldset>
</form>
<ul id="myPoint" class="nav nav-tabs bordered">
    <li class="active"><a href="#point-1" data-toggle="tab">Point Balance</a></li>
    <li><a href="#point-2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gear"></i> Point Trans</a></li>
    <li><a href="#point-3" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gear"></i> Point Redeem</a></li>
    <li><a href="#point-4" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gear"></i> Point Requirement</a></li>
    <li><a href="#point-5" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gear"></i> Delivery Address</a></li>
    <li><a href="#point-6" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gear"></i> Redeem Request</a></li>
    <li><a href="#point-7" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gear"></i> Pending Request</a></li>
</ul>

<div id="myPointContent" class="tab-content padding-10">
    <div class="tab-pane fade in active" id="point-1">
        {include file="{$sys.uix.tpl}/obc-call/list_misc-membership-point_balance.tpl"}
    </div>
    <div class="tab-pane fade" id="point-2">
        {include file="{$sys.uix.tpl}/obc-call/list_misc-membership-point_trans.tpl"}
    </div>
    <div class="tab-pane fade" id="point-3">
        {include file="{$sys.uix.tpl}/obc-call/list_misc-membership-point_redeem.tpl"}
    </div>
    <div class="tab-pane fade" id="point-4">
        {include file="{$sys.uix.tpl}/obc-call/list_misc-membership-point_requirement.tpl"}
    </div>
    <div class="tab-pane fade" id="point-5">
        {include file="{$sys.uix.tpl}/obc-call/list_misc-membership-point_address.tpl"}
    </div>
    <div class="tab-pane fade" id="point-6">
        {include file="{$sys.uix.tpl}/obc-call/list_misc-membership-point_request.tpl"}
    </div>
    <div class="tab-pane fade" id="point-7">
        {include file="{$sys.uix.tpl}/obc-call/list_misc-membership-point_pending.tpl"}
    </div>
</div>