{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}

{block name="th_ext"}
      {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="COURIER" field="wcrm_shipment_courier"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="SHIPMENT NO" field="shipment_no"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="SHIPMENT DESC" field="shipment_desc"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="SHIPMENT TYPE" field="wcrm_shipment_type"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="LABELED ON" field="labeled_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="PRINTED ON" field="printed_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="PICKED ON" field="picked_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="ACCOUNT" field="aaa_account"}

    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CREATED ON" field="created_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="UPDATE ON" field="updated_on"}
    
{/block}
{block name="td_ext"}
     <td>{$i.wcrm_shipment_courier}</td>
    <td>{$i.shipment_no}</td>
    <td>{$i.shipment_desc}</td>
    <td>{$i.wcrm_shipment_type}</td>
    <td>{$i.labeled_on}</td>
    <td>{$i.printed_on}</td>
    <td>{$i.picked_on}</td>
    <td>{$i.aaa_account}</td>

    <!-- <td>{$i.wcrm_shipment_header}</td> -->
    <td>{$i.created_on}</td>
    <td>{$i.updated_on}</td>
    
{/block}


