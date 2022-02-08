{extends file="{$sys.uix.elm}/tpl/tbl_foo.tpl"}
{block name="crud"}
	{assign var="crud" value=0}
{/block}
{block name="th"}
	<th>Phone</th>
	<th>Customer</th>
	<th>Description</th>
    <th>Sent Status</th>
    <th>Sent On</th>
	<th>#Stage-ID</th>
{/block}
{block name="td"}
	<td>{$i.phone_number|phone_format}</td>
	<td>{$i.wcrm_account}</td>
	<td>{$i.upl_stage_sms}</td>
	<td>{$i.sent_on}</td>
    <td>{$i.sent_status}</td>
    <td>{$i.upl_action_sms_id}</td>
{/block}