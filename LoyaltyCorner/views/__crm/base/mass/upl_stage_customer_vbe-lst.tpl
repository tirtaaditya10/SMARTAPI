{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="th_ext"}
    <th colspan="2">Action</th>
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Validate"          field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="View"              field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Procom Date"       field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Created"           field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Mom's"             field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Phone 1"           field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Phone 2"           field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Child Name"        field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Birth Date"        field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Address"           field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Email"             field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Screening"         field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Validate-Status"   field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Upload By"         field=""}
{/block}
{block name="td_ext"}
    <td><a href="/crm/#dp/mbl/vbe_detail/{$i.id}"> <span class="glyphicon glyphicon-check @2x"> [validate]</span> </a></td>
    <td><a href="/crm/{$i.receipt_path}" target="_blank"> <span class="glyphicon glyphicon-eye-open @2x"> [view]</span> </a></td>
    <td>{$i.$acq_date}</td>
    <td>{$i.$created_on}</td>
    <td>{$i.$custumer_name}</td>
    <td>{$i.phone_number_1}</td>
    <td>{$i.phone_number_2}</td>
    <td>{$i.$children_name}</td>
    <td>{$i.children_birthday}</td>
    <td>{$i.$address}</td>
    <td>{$i.$email}</td>
    <td>{$i.$wcrm_screening}</td>
    <td>{$i.$upl_receipt_check}</td>
    <td>{$i.$wcrm_brand_presenter}</td>
{/block}