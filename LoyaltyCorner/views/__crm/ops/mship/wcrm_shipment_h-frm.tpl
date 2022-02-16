<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
    <fieldset>
       <legend><i class="fa fa-2x fa-database"></i> <span class="font-lg txt-camo-earth">{$sys.prc.sys_prc.header}</span></legend>
        {include file="{$sys.uix.elm}/frm/dlg_error_form_validation.tpl"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_pkey.tpl"}
        &ensp;
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl" rff=$sys.rsp.ref.wcrm_shipment_courier}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Description"  name="shipment_desc" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Shipment Number"  name="shipment_no" required=true}
       
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl" rff=$sys.rsp.ref.wcrm_shipment_type}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Labeled On"  name="labeled_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Printed On"  name="printed_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Picked On"  name="picked_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="ACCOUNT"  name="aaa_account" required=true}
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Created On"  name="created_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Update On"  name="updated_on" required=true}
    </fieldset>
    {include file="{$sys.uix.elm}/frm/btn_close.tpl"}
</form>
{include file="{$sys.uix.tpl}/wcrm_shipment_list-view.tpl" custom=1 data=$sys.rsp.aux.shipment_list}
