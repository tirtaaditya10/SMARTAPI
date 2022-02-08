{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="widget_toolbar_21"}
    <div class="widget-toolbar" id="widget_toolbar_21">
        <button id="btnSync" class="button-icon btn btn-jarvis btn-danger" title="Sync Data Mobile"><i class="fa fa-exchange"></i> Sync Data Mobile <b class="badge" style="top:-5px; font-size:0.8em">{$sys.rsp.aux.un_sync}</b> </button>
    </div>
{/block}
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
    <th>PIC</th>
    <th>Channel & Source</th>
    <th>Activity</th>
    <th>Product</th>
    <th data-breakpoints="all">Qty</th>
    <th data-breakpoints="all">Receipt</th>
    <th data-breakpoints="all">Batch No</th>
    <th data-breakpoints="all">#Log-ID</th>
    <th data-breakpoints="all">Created By</th>
    <th data-breakpoints="all">Created On</th>
{/block}
{block name="td"}
    {foreach from=$sys.rsp.dat item=i}
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
    {/foreach}
{/block}
{block name="jquery_page_ready"}
    $('#btnSync').click(function(e) {
        $.get(AGV.site + 'sync_mobile/{$sys.req.rid}', function (rsp) {
            location.reload();
        });
    });
{/block}