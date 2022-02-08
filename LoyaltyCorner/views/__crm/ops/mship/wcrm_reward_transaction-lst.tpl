{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Type"              field="wcrm_inv_trans_dir"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Item ID"           field="wcrm_reward"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Warehouse ID"      field="wcrm_warehouse"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Trans Category"    field="wcrm_inv_trans_category"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Quantity"          field="qty"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Reference"         field="reference"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Trans Date"        field="transacted_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Notes"             field="notes"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Created On"        field="created_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Created By"        field="aaa_account"}
{/block}
{block name="td_ext"}
    <td>{$i.wcrm_inv_trans_dir}</td>
    <td>{$i.wcrm_reward}</td>
    <td>{$i.wcrm_warehouse}</td>
    <td>{$i.wcrm_inv_trans_category}</td>
    <td>{$i.qty}</td>
    <td>{$i.reference}</td>
    <td>{$i.transacted_on}</td>
    <td>{$i.notes}</td>
    <td>{$i.created_on}</td>
    <td>{$i.aaa_account}</td>
{/block}