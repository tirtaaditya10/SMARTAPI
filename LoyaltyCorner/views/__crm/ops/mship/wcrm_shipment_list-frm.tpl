<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
	<fieldset>
		<legend><i class="fa fa-2x fa-database"></i> <span class="font-lg txt-camo-earth">Batch Upload</span>
			
		</legend>
        {include file="{$sys.uix.elm}/frm/dlg_error_form_validation.tpl"}
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_pkey.tpl"}
		&ensp;
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label=" ACCOUNT"  name="wcrm_account" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="	REF NO 1"  name="ref_no_1" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="	REF NO 2"  name="ref_no_2" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="	REF NO 3"  name="ref_no_3" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="	REF NO 4"  name="ref_no_4" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="	REF NO 5"  name="ref_no_5" required=true}

        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="  SHIPMENT HEADER"  name="wcrm_shipment_h" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="	ITEM NAME"  name="item_name" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="	QUANTITY"  name="qty" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="	NAME"  name="name_" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="	ADDRESs 1"  name="address_1" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="	ADDRESs 2"  name="address_2" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="	ADDRESS 3"  name="address_3" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="	ADDRESS 4"  name="address_4" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="	CITY"  name="city" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="ZIP CODE"  name="zip_code" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="PHONE LANDED"  name="phone_landed" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="PHONE MOBILE"  name="phone_mobile" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="PHONE OFFICE"  name="phone_office" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="SENT OD"  name="sent_od" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl" rff=$sys.rsp.ref.wcrm_shipment_delivery}
       <!--  {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="SHIPMENT DELIVERY"  name="wcrm_shipment_delivery" required=true} -->
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="POD NUMBER"  name="pod_no" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="RECEIVED ON"  name="received_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="SHIPMENT RECEIVER"  name="received_name" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl" rff=$sys.rsp.ref.wcrm_shipment_receiver}
        <!-- {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="RECEIVED NAME"  name="wcrm_shipment_receiver" required=true} -->
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="RETUR ON"  name="retur_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="RETUR REASON"  name="retur_reason" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="KU 1 DATE"  name="ku_1_date" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="KU 1 ADDRESs"  name="ku_1_address" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="KU 2 DATE"  name="ku_2_date" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="KU 2 ADDRESS"  name="ku_2_address" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="KU RECEIVER NAME"  name="ku_receiver_name" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="KU RECEIVER STATUS"  name="ku_receiver_status" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="KU POD NUMBER"  name="ku_pod_no" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="RETENTION WH ON"  name="ret_wh_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl" rff=$sys.rsp.ref.wcrm_shipment_courier}
        <!-- {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="SHIPMENT COURIER"  name="wcrm_shipment_courier" required=true} -->
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="NOTES"  name="notes" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="CREATED ON"  name="created_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="ACCOUNT UPD "  name="aaa_account_upd" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="UPDATED ON"  name="updated_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="EVENT"  name="event_id" required=true}


        {include file="{$sys.uix.elm}/frm/bs-hrz/is_active.tpl"}
	</fieldset>
	{include file="{$sys.uix.elm}/frm/btn_close.tpl"}
</form>