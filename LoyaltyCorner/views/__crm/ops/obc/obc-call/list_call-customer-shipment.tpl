{extends file="{$sys.uix.elm}/tpl/tbl_foo.tpl"}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="NAME" field="item_name"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="REF NO 1" field="ref_no_1"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="REF NO 2"          field="ref_no_2"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="REF NO 3"          field="ref_no_3" break="all"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="REF NO 4"          field="ref_no_4" break="all"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="REF NO 5"          field="ref_no_5" break="all"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="SHIPMENT HEADER"   field="wcrm_shipment_h_id"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="QUANTITY"          field="qty"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Village"           field="address_2"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="ADDRESS 4"         field="address_4" break="all"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CITY"              field="city"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="PHONE LANDED"      field="phone_landed"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="PHONE MOBILE"      field="phone_mobile"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="PHONE OFFICE"      field="phone_office" break="all"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="SHIPMENT DELIVERY" field="wcrm_shipment_delivery"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="POD NUMBER"        field="pod_no"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="RECEIVED"       field="received_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="SHIPMENT RECEIVER" field="wcrm_shipment_receiver"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="RETUR ON"          field="retur_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="SHIPMENT COURIER"  field="wcrm_shipment_courier"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="NOTES"             field="notes" break="all"}
{/block}
{block name="td_ext"}
    <td>{$i.item_name}</td>
    <td>{$i.ref_no_1}</td>
    <td>{$i.ref_no_2}</td>
    <td>{$i.ref_no_3}</td>
    <td>{$i.ref_no_4}</td>
    <td>{$i.ref_no_5}</td>
    <td>{$i.wcrm_shipment_h_id}</td>
    <td>{$i.qty}</td>
    {include file="{$sys.uix.elm}/tbl/td/td_text__text.tpl" first="address_2" second="address_3"}
    <td>{$i.address_4}</td>
    {include file="{$sys.uix.elm}/tbl/td/td_text__text.tpl" first="city" second="zip_code"}
    {include file="{$sys.uix.elm}/tbl/td/td_phone.tpl"  name="phone_landed"}
    {include file="{$sys.uix.elm}/tbl/td/td_phone.tpl"  name="phone_mobile"}
    {include file="{$sys.uix.elm}/tbl/td/td_phone.tpl"  name="phone_office"}
    <td>{$i.wcrm_shipment_delivery}</td>
    <td>{$i.pod_no}</td>
    {include file="{$sys.uix.elm}/tbl/td/td_when__who.tpl" when="received_on" who="receiver_name"}
    <td>{$i.wcrm_shipment_receiver}</td>
    {include file="{$sys.uix.elm}/tbl/td/td_datetime__text.tpl" when="retur_on" info="retur_reason"}
    <td>{$i.wcrm_shipment_courier}</td>
    <td>{$i.notes}</td>
{/block}