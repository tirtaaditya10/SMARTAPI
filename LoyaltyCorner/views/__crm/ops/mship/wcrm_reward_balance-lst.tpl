{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Reward"        field="wcrm_reward"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="QTY Available" field="qty_available"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="QTY On Hand"   field="qty_onhand"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Alert Level"   field="alert_level"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Warehouse"     field="wcrm_warehouse"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CREATOR"       field="aaa_account"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CREATED"       field="created_on"}
{/block}
{block name="td_ext"}
    <td>{$i.wcrm_reward}</td>
    <td>{$i.qty_available}</td>
    <td>{$i.qty_onhand}</td>
    <td>{$i.alert_level}</td>
    <td>{$i.wcrm_warehouse}</td>
    <td>{$i.aaa_account}</td>
    <td>{$i.created_on}</td>
{/block}
