{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="th_ext"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Batch Description" field="upl_action_sms"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Batch Type"    field="action_type"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Batch Status"  field="action_status"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="#SMS"          field="total"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="#BatchID"      field="id"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CREATED BY" 	field="aaa_account"}
	{include file="{$sys.uix.elm}/tbl/th_date.tpl" label="CREATED TIME" field="created_on"}
{/block}
{block name="td_ext"}
	<td>{$i.upl_action_sms}</td>
	<td>{$i.action_type}</td>
	<td>{$i.action_status}</td>
	<td>{$i.total}</td>
	<td>{$i.id}</td>
	<td>{$i.aaa_account}</td>
	<td>{$i.created_on}</td>
{/block}