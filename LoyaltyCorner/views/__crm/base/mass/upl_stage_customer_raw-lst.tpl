<table class="auxtable table toggle-arrow-circle table-hover table-striped">
	<thead>
	<tr class="blue">
		<th data-class="expand" data-sort-ignore="true" style="width:50px">No</th>
		<th data-sort-ignore="true">Customer</th>
		<th data-sort-ignore="true">Acq-Data</th>
		<th data-sort-ignore="true">Child Name</th>
		<th data-sort-ignore="true">Birthday</th>
		<th data-sort-ignore="true">Phone</th>
		<th data-sort-ignore="true">Adress</th>
		<th data-sort-ignore="true">Email </th>
		<th data-sort-ignore="true">Data Type </th>
		<th data-sort-ignore="true">Product Category </th>
		<th data-sort-ignore="true">Area </th>
		<th data-sort-ignore="true">Sub Area </th>
		<th data-sort-ignore="true">DM </th>
		<th data-sort-ignore="true">TL </th>
		<th data-sort-ignore="true">BP </th>
		<th data-sort-ignore="true">Channel </th>
		<th data-sort-ignore="true">Source </th>
		<th data-sort-ignore="true">Sub-Source </th>
		<th data-sort-ignore="true">Promo Activity </th>
		<th data-sort-ignore="true">Sub Promo </th>
		<th data-sort-ignore="true">Gimmick </th>
		<th data-sort-ignore="true">Prev Product </th>
		<th data-sort-ignore="true">Actual Product </th>
		<th data-sort-ignore="true">Grammage </th>
		<th data-sort-ignore="true">Qty </th>
		<th data-sort-ignore="true">Receipt </th>
		<th data-sort-ignore="true">Batch No </th>
        <th data-sort-ignore="true">Remark Error</th>
		<th data-sort-ignore="true">Created By </th>
		<th data-sort-ignore="true">Created On </th>
	</tr>
	</thead>
	<tbody>
		{foreach from=$sys.rsp.aux item=i}
			<tr id="{$sys.req.rid}/{$i.id}">
				<td class="text-center">{$i.no}</td>
				<td>{$i.customer_name}</td>
				<td>{$i.acq_date}</td>
				<td>{$i.children_name}</td>
				<td>{$i.children_birthday}</td>
				<td>{$i.phone_number_1}<br>{$i.phone_number_2}</td>
				<td>{$i.address}</td>
				<td>{$i.email}</td>
				<td>{$i.upl_data_type}</td>
				<td>{$i.wcrm_product_category}</td>
				<td>{$i.wcrm_region}</td>
				<td>{$i.wcrm_region_sub}</td>
				<td>{$i.wcrm_district_manager}</td>
				<td>{$i.wcrm_team_leader}</td>
				<td>{$i.wcrm_brand_presenter}</td>
				<td>{$i.wcrm_channel_trade}</td>
				<td>{$i.wcrm_outlet_group}</td>
				<td>{$i.wcrm_outlet}</td>
				<td>{$i.wcrm_promo_activity}</td>
				<td>{$i.wcrm_promo_activity_sub}</td>
				<td>{$i.wcrm_gimmick}</td>
				<td>{$i.wcrm_product_list_prev}</td>
				<td>{$i.wcrm_product_list_actual}</td>
                <td>{$i.wcrm_grammage}</td>
				<td>{$i.qty}</td>
				<td>{$i.wcrm_receipt}</td>
				<td>{$i.batch_no}</td>
                <td>{$i.processed_check}</td>
				<td>{$i.aaa_account}</td>
				<td>{$i.created_on}</td>
			</tr>
		{/foreach}
	</tbody>
</table>