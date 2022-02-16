{extends file="{$sys.uix.elm}/tpl/tbl_foo.tpl"}
{block name="data"}
    {assign var="data"      value=$data}
{/block}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Age"               field="age"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Cleverness-1"      field="wcrm_sf_intelligen_1"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Cleverness-2"      field="wcrm_sf_intelligen_2"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Cleverness-3"      field="wcrm_sf_intelligen_3"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Cleverness Stimulated"      field="wcrm_sf_intelligen_stimulate"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Intelligence Base"      field="wcrm_sf_intelligen_base"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Commitment"        field="wcrm_sf_commitment"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Realization"       field="wcrm_sf_realization"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Result"            field="wcrm_sf_stimulation_result"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Age Stages"        field="wcrm_sf_age"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CREATED BY"        field="aaa_account" break="all"}
    {include file="{$sys.uix.elm}/tbl/th_date.tpl" label="CREATED TIME"     field="created_on"  break="all"}
{/block}
{block name="td_ext"}
    <td>{$i.age}</td>
    <td>{$i.wcrm_sf_intelligen_1}</td>
    <td>{$i.wcrm_sf_intelligen_2}</td>
    <td>{$i.wcrm_sf_intelligen_3}</td>
    <td>{$i.wcrm_sf_intelligen_stimulate}</td>
    <td>{$i.wcrm_sf_intelligen_base}</td>
    <td>{$i.wcrm_sf_commitment}</td>
    <td>{$i.wcrm_sf_realization}</td>
    <td>{$i.wcrm_sf_stimulation_result}</td>
    <td>{$i.wcrm_sf_age}</td>
    <td>{$i.aaa_account}</td>
    <td>{$i.created_on}</td>
{/block}