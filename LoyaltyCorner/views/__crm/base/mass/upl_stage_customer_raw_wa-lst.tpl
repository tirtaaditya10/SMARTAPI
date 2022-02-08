{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="custom"}
	{assign var="custom" value=1}
{/block}
{block name="th"}
	<th>Acq-Data</th>
	<th>Customer</th>
	<th>Children</th>
	<th data-breakpoints="all">Adress</th>
	<th data-breakpoints="all">Email</th>
	<th>Type & Category</th>
	<th>Region</th>
	<th data-breakpoints="all">PIC</th>
	<th>Channel & Source</th>
	<th>Activity</th>
	<th>Product</th>
	<th data-breakpoints="all">Qty</th>
	<th data-breakpoints="all">Receipt</th>
	<th data-breakpoints="all">Batch No</th>
	<th data-breakpoints="all">#Log-ID</th>
	<th data-breakpoints="all">Created By</th>
	<th data-breakpoints="all">Created On</th>
	{include file="{$sys.uix.elm}/tbl/th_add.tpl"}
{/block}
{block name="td"}
    {foreach from=$sys.rsp.dat item=i}
        <tr>
            <td>{$i.acq_date|date_format:"%Y-%m-%d"}</td>
            <td>{$i.customer_name}
                {if $i.phone_number_1}<br><i class="fa fa-phone"></i> {$i.phone_number_1|phone_format}{/if}
                {if $i.phone_number_2}<br><i class="fa fa-phone"></i> {$i.phone_number_2|phone_format}{/if}
            </td>
            <td>{$i.children_name}<br><i class="fa fa-calendar"></i> {$i.children_birthday}<br>{$i.age}</td>
            <td>{$i.address}</td>
            <td>{$i.email}</td>
            <td><dl class="dl-horizontal">
                    <dt style="width:15px;">T</dt><dd style="margin-left:25px;" title="Product Type"> {$i.upl_data_type}</dd>
                    <dt style="width:15px;">C</dt><dd style="margin-left:25px;" title="Product Category"> {$i.wcrm_product_category}</dd>
                </dl>
            </td>
            <td><dl class="dl-horizontal">
                    <dt style="width:25px;">R</dt><dd style="margin-left:35px;" title="Region"> {$i.wcrm_region}</dd>
                    <dt style="width:25px;">S</dt><dd style="margin-left:35px;" title="Sub-Region"> {$i.wcrm_region_sub}</dd>
                </dl>
            </td>
            <td><dl class="dl-horizontal">
                    <dt style="width:25px;">DM</dt><dd style="margin-left:35px;" title="Distrik Manager"> {$i.wcrm_district_manager}</dd>
                    <dt style="width:25px;">TL</dt><dd style="margin-left:35px;" title="Team Leader"> {$i.wcrm_team_leader}</dd>
                    <dt style="width:25px;">BP</dt><dd style="margin-left:35px;" title="Brand Presenter"> {$i.wcrm_brand_presenter}</dd>
                </dl>
            </td>
            <td><dl class="dl-horizontal">
                    <dt style="width:15px;">C</dt><dd style="margin-left:25px;" title="Channel"> {$i.wcrm_channel_trade}</dd>
                    <dt style="width:15px;">G</dt><dd style="margin-left:25px;" title="Group Outlet"> {$i.wcrm_outlet_group}</dd>
                    <dt style="width:15px;">O</dt><dd style="margin-left:25px;" title="Outlet"> {$i.wcrm_outlet}</dd>
                </dl>
            </td>
            <td><dl class="dl-horizontal">
                    <dt style="width:15px;">P</dt><dd style="margin-left:25px;" title="Promo Activity"> {$i.wcrm_promo_activity}</dd>
                    <dt style="width:15px;">S</dt><dd style="margin-left:25px;" title="Sub-Promo Activity"> {$i.wcrm_promo_activity_sub}</dd>
                    <dt style="width:15px;">G</dt><dd style="margin-left:25px;" title="Gimmick"> {$i.wcrm_gimmick}</dd>
                </dl>
            </td>
            <td><dl class="dl-horizontal">
                    <dt style="width:15px;">P</dt><dd style="margin-left:25px;" title="Product Previous"> {$i.wcrm_product_list_prev}</dd>
                    <dt style="width:15px;">A</dt><dd style="margin-left:25px;" title="Product Actual"> {$i.wcrm_product_list_actual}</dd>
                    <dt style="width:15px;">G</dt><dd style="margin-left:25px;" title="Product Grammage"> {$i.wcrm_grammage}</dd>
                </dl>
            </td>
            <td>{$i.qty}</td>
            <td>{$i.wcrm_receipt}</td>
            <td>{$i.batch_no}</td>
            <td>{$i.upl_logs_id}</td>
            <td>{$i.aaa_account}</td>
            <td>{$i.created_on}</td>
            {include file="{$sys.uix.elm}/tbl/td_upd.tpl"}
        </tr>
    {/foreach}
{/block}