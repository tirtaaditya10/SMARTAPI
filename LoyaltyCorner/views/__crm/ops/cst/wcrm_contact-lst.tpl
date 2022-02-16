{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Children" field="wcrm_contact"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Birthday" }
    {** include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Acquition" field="acq_date" **}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Usage Duration" field="member_no"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Body Height"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Body Weight"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="First Time Mom"  break_point="all"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Lap. User"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Loyal User"}
    {** include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Reason Switch Back" **}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Type & Category"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Product"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Region" break_point="all"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Outlet" break_point="all"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CREATED BY" field="aaa_account" break_point="all"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CREATED TIME" field="created_on" break_point="all"}
{/block}
{block name="td_ext"}
    <td><!--<i class="fa fa-child">--> {$i.wcrm_contact}<!--<br><i class="fa fa-female">{$i.wcrm_account}</i>--></td>
    <td>{$i.children_birthday}
        <br>Age Acq @{$i.age_acq}<br>Age Now @{$i.age_now}
    </td>
    {** <td><dl class="dl-horizontal">
            <dt style="width:50px;"><i class="fa fa-calendar"></i></dt><dd style="margin-left:60px;" title="Acq. Date"> {$i.acq_date}</dd>
            <dt style="width:60px;">Age @Acq</dt><dd style="margin-left:75px;" title="Age @Acq">{$i.age_acq}</dd>
            <dt style="width:60px;">Age @Now</dt><dd style="margin-left:75px;" title="Age @Now">{$i.age_now}</dd>
        </dl>
     </td>
    **}
    <td>{$i.wcrm_duration_of_use}</td>
    <td>{$i.body_height}</td>
    <td>{$i.body_weight}</td>
    <td>{if $i.is_first_time_mom}<i class="fa fa-check"></i>{/if}</td>
    <td>{if $i.is_laps_user}<i class="fa fa-check"></i>{/if}</td>
    <td>{if $i.is_loyal_user}<i class="fa fa-check"></i>{/if}</td>
    
    <td><dl class="dl-horizontal">
            <dt style="width:15px;">T</dt><dd style="margin-left:25px;" title="Product Type"> {$i.upl_data_type}</dd>
            <dt style="width:15px;">C</dt><dd style="margin-left:25px;" title="Product Category"> {$i.wcrm_product_category}</dd>
        </dl>
    </td>
    <td><dl class="dl-horizontal">
            <dt style="width:15px;">P</dt><dd style="margin-left:25px;" title="Product Previous"> {$i.wcrm_product_list_prev}</dd>
            <dt style="width:15px;">A</dt><dd style="margin-left:25px;" title="Product Actual"> {$i.wcrm_product_list_actual}</dd>
            <dt style="width:15px;">G</dt><dd style="margin-left:25px;" title="Product Grammage"> {$i.wcrm_grammage}</dd>
        </dl>
    </td>
    <td><dl class="dl-horizontal">
            <dt style="width:25px;">R</dt><dd style="margin-left:35px;" title="Region"> {$i.wcrm_region}</dd>
            <dt style="width:25px;">S</dt><dd style="margin-left:35px;" title="Sub-Region"> {$i.wcrm_region_sub}</dd>
        </dl>
    </td>
    <td><dl class="dl-horizontal">
            <dt style="width:15px;">C</dt><dd style="margin-left:25px;" title="Channel"> {$i.wcrm_channel_trade}</dd>
            <dt style="width:15px;">G</dt><dd style="margin-left:25px;" title="Group Outlet"> {$i.wcrm_outlet_group}</dd>
            <dt style="width:15px;">O</dt><dd style="margin-left:25px;" title="Outlet"> {$i.wcrm_outlet}</dd>
        </dl>
    </td>
    <td>{$i.aaa_account}</td>
    <td>{$i.created_on}</td>
{/block}
