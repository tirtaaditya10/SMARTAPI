{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Reward Name"      field="wcrm_reward"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Point"            field="reward_point"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="ATTRIB1"          field="attrib_1"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="ATTRIB2"          field="attrib_2"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="ATTRIB3"          field="attrib_3"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Active"           field="is_active"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Created by"       field="aaa_account"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CREATED"          field="created_on"}
{/block}
{block name="td_ext"}
    <td>{$i.wcrm_reward}</td>
    <td>{$i.reward_point}</td>
    <td>{$i.attrib_1}</td>
    <td>{$i.attrib_2}</td>
    <td>{$i.attrib_3}</td>
    <td>{$i.is_active}</td>
    <td>{$i.aaa_account}</td>
    <td>{$i.created_on}</td>
{/block}