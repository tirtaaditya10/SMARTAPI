{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="ACCOUNT" field="wcrm_account"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="REF NO 1" field="ref_no_1"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="REF NO 2" field="ref_no_2"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="REF NO 3" field="ref_no_3"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="REF NO 4" field="ref_no_4"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="REF NO 5" field="ref_no_5"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="SHIPMENT HEADER" field="wcrm_shipment_h_id"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="ITEM NAME" field="item_name"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="QUANTITY" field="qty"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="NAME" field="name_"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="ADDRESS 1" field="address_1"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="ADDRESS 2" field="address_2"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="ADDRESS 3" field="address_3"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="ADDRESS 4" field="address_4"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CITY" field="city"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="ZIP CODE" field="zip_code"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="PHONE LANDED" field="phone_landed"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="PHONE MOBILE" field="phone_mobile"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="PHONE OFFICE" field="phone_office"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="SENT OD" field="sent_od"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="SHIPMENT DELIVERY" field="wcrm_shipment_delivery"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="POD NUMBER" field="pod_no"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="RECEIVED ON" field="received_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="RECEIVED NAME" field="received_name"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="SHIPMENT RECEIVER" field="wcrm_shipment_receiver"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="RETUR ON" field="retur_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="RETUR REASON" field="retur_reason"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="KU 1 DATE" field="ku_1_date"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="KU 1 ADDRESS" field="ku_1_address"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="KU 2 DATE" field="ku_2_date"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="KU 2 ADDRESS" field="ku_2_address"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="KU RECEIVER NAME" field="ku_receiver_name"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="KU RECEIVER STATUS" field="ku_receiver_status"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="KU POD NUMBER" field="ku_pod_no"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="RETENTION WH ON" field="ret_wh_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="SHIPMENT COURIER" field="wcrm_shipment_courier"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="NOTES" field="notes"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="EVENT" field="event_id"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CREATED ON" field="created_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="ACCOUNT UPD" field="aaa_account_upd"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="UPDATED ON" field="updated_on"}
{/block}
{block name="td_ext"}
    <td>{$i.wcrm_account}</td>
    <td>{$i.ref_no_1}</td>
    <td>{$i.ref_no_2}</td>
    <td>{$i.ref_no_3}</td>
    <td>{$i.ref_no_4}</td>
    <td>{$i.ref_no_5}</td>
    <td>{$i.wcrm_shipment_h_id}</td>
    <td>{$i.item_name}</td>
    <td>{$i.qty}</td>
    <td>{$i.name_}</td>
    <td>{$i.address_1}</td>
    <td>{$i.address_2}</td>
    <td>{$i.address_3}</td>
    <td>{$i.address_4}</td>
    <td>{$i.city}</td>
    <td>{$i.zip_code}</td>
    <td>{$i.phone_landed}</td>
    <td>{$i.phone_mobile}</td>
    <td>{$i.phone_office}</td>
    <td>{$i.sent_od}</td>
    <td>{$i.wcrm_shipment_delivery}</td>
    <td>{$i.pod_no}</td>
    <td>{$i.received_on}</td>
    <td>{$i.receiver_name}</td>
    <td>{$i.wcrm_shipment_receiver}</td>
    <td>{$i.retur_on}</td>
    <td>{$i.retur_reason}</td>
    <td>{$i.ku_1_date}</td>
    <td>{$i.ku_1_address}</td>
    <td>{$i.ku_2_date}</td>
    <td>{$i.ku_2_address}</td>
    <td>{$i.ku_receiver_name}</td>
    <td>{$i.ku_receiver_status}</td>
    <td>{$i.ku_pod_no}</td>
    <td>{$i.ret_wh_on}</td>
    <td>{$i.wcrm_shipment_courier}</td>
    <td>{$i.notes}</td>
    <td>{$i.event_id}</td>
    <td>{$i.created_on}</td>
    <td>{$i.aaa_account_upd}</td>
    <td>{$i.updated_on}</td>
{/block}