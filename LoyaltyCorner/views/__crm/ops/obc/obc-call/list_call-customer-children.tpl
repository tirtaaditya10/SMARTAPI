{extends file="{$sys.uix.elm}/tpl/tbl_foo.tpl"}
{block name="crud"}
    {assign var="crud"      value=0}
{/block}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Child Name"        field="wcrm_contact"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Birthday"          field="children_birthday"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Acq Date"          field="acq_date"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Age Usage"         field="age_usage"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Loyal user"        field="is_loyal_user"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Data type"         field="upl_data_type"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Product Category"  field="wcrm_product_category"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Area"              field="wcrm_region"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Sub area"          field="wcrm_region_sub"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Source"            field="wcrm_outlet_group"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Sub source"        field="wcrm_outlet"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Previous product"  field="wcrm_product_list_prev"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Actual product"    field="wcrm_product_list_actual"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="#Batch-ID"         field="upl_action_id" break="lg"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Created on"        field="created_on"}
{/block}
{block name="td_ext"}
    <td>{$i.wcrm_contact}</td>
    {include file="{$sys.uix.elm}/tbl/td/td_acq_date.tpl" xtd="age_acq"}
    {include file="{$sys.uix.elm}/tbl/td/td_birthday.tpl" xtd="age_now"}
    <td class="nowrap">{$i.age_usage}</td>
    {include file="{$sys.uix.elm}/tbl/td/td_boolean.tpl" name="is_loyal_user"}
    <td>{$i.upl_data_type}</td>
    <td>{$i.wcrm_product_category}</td>
    <td>{$i.wcrm_region}</td>
    <td>{$i.wcrm_region_sub}</td>
    <td>{$i.wcrm_outlet_group}</td>
    <td>{$i.wcrm_outlet}</td>
    <td>{$i.wcrm_product_list_prev}</td>
    <td>{$i.wcrm_product_list_actual}</td>
    <td>{$i.upl_action_id}</td>
    {include file="{$sys.uix.elm}/tbl/td/td_created_on.tpl"}
{/block}