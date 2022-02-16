{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="th_ext"}
	<th data-sort-ignore="true">File Upload</th>
	<th data-sort-ignore="true">Existing Customer</th>
	<th data-sort-ignore="true">Staging Customer</th>
	<th data-sort-ignore="true">Data Created</th>
{/block}
{block name="td_ext"}
	<td>{$i.upl_filename}</td>
	<td>{$i.wcrm_account}<br>{$i.account_number_1|phone_format}</td>
	<td>{$i.customer_name}<br>{$i.staging_number_1|phone_format}</td>
	<td>{$i.created_on}</td>
{/block}