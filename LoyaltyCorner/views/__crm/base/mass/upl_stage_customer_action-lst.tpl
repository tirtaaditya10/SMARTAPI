<table class="footable table table-hover table-striped" data-cascade="true" data-sorting="false" data-use-parent-width="true">
	<thead>
	<tr><th></th>
		<th style="width:50px">No</th>
		<th>Acq-Data</th>
		<th>Customer</th>
		<th>Children</th>
		<th>Age</th>
		<th data-breakpoints="all">Adress</th>
		<th data-breakpoints="all">Email </th>
		<th>Type & Category </th>
		<th>Region </th>
		<th>PIC </th>
		<th>Channel & Source </th>
		<th>Activity </th>
		<th>Product</th>
		<th>Qty </th>
		<th>Receipt </th>
		<th data-breakpoints="all">Batch Sampling </th>
		<th data-breakpoints="all">Is Redundant </th>
		<th data-breakpoints="all">Is Double </th>
		<th data-breakpoints="all">Created By </th>
		<th data-breakpoints="all">Created On </th>
	</tr>
	</thead>
	<tbody>
		{foreach from=$sys.rsp.aux.upl_stage_customer item=i}
			<tr id="{$sys.req.rid}/{$i.id}">
				<td></td>
				<td class="text-center">{$i.id}</td>
				<td>{$i.acq_date|date_format:"%Y-%m-%d"}</td>
				<td>{$i.customer_name}<br>{$i.phone_number_1}<br>{$i.phone_number_2}</td>
				<td>{$i.children_name}<br>{$i.children_birthday}</td>
				<td>{$i.age}</td>
				<td>{$i.address}</td>
				<td>{$i.email}</td>
				<td><dl class="dl-horizontal">
						<dt style="width:15px;">T</dt><dd title="Data Type"> {$i.upl_data_type}</dd>
						<dt style="width:15px;">C</dt><dd title="Product Category"> {$i.wcrm_product_category}</dd>
					</dl>
				</td>
				<td><dl class="dl-horizontal">
						<dt style="width:25px;">R</dt><dd title="Region"> {$i.wcrm_region}</dd>
						<dt style="width:25px;">S</dt><dd title="Sub-Region"> {$i.wcrm_region_sub}</dd>
					</dl>
				</td>
				<td><dl class="dl-horizontal">
						<dt style="width:25px;">DM</dt><dd title="Distrik Manager"> {$i.wcrm_district_manager}</dd>
						<dt style="width:25px;">TL</dt><dd title="Team Leader"> {$i.wcrm_team_leader}</dd>
						<dt style="width:25px;">BP</dt><dd title="Brand Presenter"> {$i.wcrm_brand_presenter}</dd>
					</dl>
				</td>
				<td><dl class="dl-horizontal">
						<dt style="width:15px;">C</dt><dd title="Channel"> {$i.wcrm_channel_trade}</dd>
						<dt style="width:15px;">G</dt><dd title="Group Outlet"> {$i.wcrm_outlet_group}</dd>
						<dt style="width:15px;">O</dt><dd title="Outlet"> {$i.wcrm_outlet}</dd>
					</dl>
				</td>
				<td><dl class="dl-horizontal">
						<dt style="width:15px;">P</dt><dd title="Promo Activity"> {$i.wcrm_promo_activity}</dd>
						<dt style="width:15px;">S</dt><dd title="Sub-Promo Activity"> {$i.wcrm_promo_activity_sub}</dd>
						<dt style="width:15px;">G</dt><dd title="Gimmick"> {$i.wcrm_gimmick}</dd>
					</dl>
				</td>
				<td><dl class="dl-horizontal">
						<dt style="width:15px;">P</dt><dd title="Product Previous"> {$i.wcrm_product_list_prev}</dd>
						<dt style="width:15px;">A</dt><dd title="Product Actual"> {$i.wcrm_product_list_actual}</dd>
						<dt style="width:15px;">G</dt><dd title="Product Grammage"> {$i.wcrm_grammage}</dd>
					</dl>
				</td>
				<td>{$i.qty}</td>
				<td>{$i.wcrm_receipt}</td>
				<td>{$i.batch_no}</td>
				<td>{$i.upl_logs_id}</td>
				<td>{$i.red_status}</td>
				<td>{$i.double_status}</td>
				<td>{$i.aaa_account}</td>
				<td>{$i.created_on}</td>
			</tr>
		{foreachelse}
		{/foreach}
	</tbody>
</table>