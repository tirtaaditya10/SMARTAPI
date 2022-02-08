{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="th_ext"}
	<th>Phone</th>
	<th>Customer</th>
	<th>Description</th>
	<th>Sent On</th>
    <th>Sent Status</th>
	<th>#Stage-ID</th>
	<th data-breakpoints="all">Created By</th>
	<th data-breakpoints="all">Created On</th>
{/block}
{block name="td_ext"}
	<td>{$i.phone_number|phone_format}</td>
	<td>{$i.wcrm_account}</td>
	<td>{$i.upl_stage_sms}</td>
	<td>{$i.sent_on}</td>
    <td>{$i.sent_status}</td>
    <td>{$i.upl_action_sms_id}</td>
	<td>{$i.aaa_account}</td>
	<td>{$i.created_on}</td>
{/block}