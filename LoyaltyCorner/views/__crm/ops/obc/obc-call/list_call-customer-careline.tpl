{extends file="{$sys.uix.elm}/tpl/tbl_foo.tpl"}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Status"            field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Priority"          field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Customer"          field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Child"             field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Channel"           field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Sub channel"       field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Contact type"      field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Category"          field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Sub category"      field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Comp.RefNo"        field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Comp.RefNo1"       field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Root Cause"        field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Need FU"           field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Assigned to"       field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Closed date"       field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Real call"         field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Created by"        field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Created on"        field=""}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Elapsed day"       field=""}
{/block}
{block name="td_ext"}
    <td>{$i.wcrm_activity_status}</td>
    <td>{$i.wcrm_contact}</td>
    <td>{$i.wcrm_call_result}</td>
    <td>{$i.wcrm_camp_retention}<br><em>{$i.call_name}</em></td>
    <td>{$i.activity_on}</td>
    <td>{$i.attempt}</td>
    <td>{$i.wcrm_campaign_result}</td>
    <td>{$i.wcrm_campaign_fail}</td>
    <td>{$i.aaa_account}</td>
    <td>{$i.created_on}</td>
{/block}