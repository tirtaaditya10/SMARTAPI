{extends file="{$sys.uix.elm}/tpl/tbl_foo.tpl"}
{block name="config"}
    {assign var=data    value=$data}
    {assign var=crud    value=0}
{/block}
{block name="caption"}<caption>VOICE RECORDING</caption>{/block}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Dialed Number"     field="destination"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Voice Recording"   field="filename"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Connection"        field="wcrm_call_result"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Failed Reason"     field="wcrm_campaign_fail"}
    {include file="{$sys.uix.elm}/tbl/th_number.tpl" label="Duration"       field="call_duration"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl"  label="CREATED BY"       field="aaa_account" break="all"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl"  label="CREATED TIME"     field="created_on"  break="all"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl"  label="PLAY ME"          break="all"}
{/block}
{block name="td_ext"}
    <td>{$i.destination|phone_format}</td>
    <td>{$i.filename}</td>
    <td>{$i.wcrm_call_result}</td>
    <td>{$i.wcrm_campaign_fail}</td>
    <td class="text-center">{$i.call_duration}</td>
    <td>{$i.aaa_account}</td>
    <td>{$i.created_on}</td>
    <td><div><audio controls src="{$i.filename}"></audio></div></td>
{/block}
{block name="th_act"}{/block}
{block name="td_act"}{/block}