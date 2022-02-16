{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Campaign Type"     field="wcrm_campaign_type"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Query"             field="wcrm_query"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="#Data"             field="total"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="#List"             field="upl_action_xid"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Param-1"           field="param_1"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Param-2"           field="param_2"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Param-3"           field="param_3"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Param-4"           field="param_4"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Distributed On"    field="exec_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Creator"           field="aaa_account_id"}
    {include file="{$sys.uix.elm}/tbl/th_date.tpl" label="Crated"            field="created_on"}
{/block}
{block name="td_ext"}
    <td>{$i.wcrm_campaign_type}</td>
    <td>{$i.wcrm_query}</td>
    <td>{$i.total}</td>
    <td>{$i.upl_action_xid}</td>
    <td>{$i.param_1}</td>
    <td>{$i.param_2}</td>
    <td>{$i.param_3}</td>
    <td>{$i.param_4}</td>
    <td>{$i.dist_on}</td>
    <td>{$i.aaa_account}</td>
    <td>{$i.created_on}</td>
{/block}
