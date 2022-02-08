{extends file="{$sys.uix.elm}/tpl/tbl_foo.tpl"}
{block name="crud"}
    {assign var="crud"      value=0}
{/block}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Status"            field="wcrm_activity_status"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Child"             field="wcrm_contact"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Call Result"       field="wcrm_call_result"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Campaign"          field="wcrm_camp_retention"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Call Date"         field="activity_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Call Attempt"      field="call_attempt"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Result"            field="wcrm_campaign_result"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Fail Reason"       field="wcrm_campaign_fail"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Call By"           field="aaa_account"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Call On"           field="created_on"}
{/block}
{block name="td_ext"}
    <td>{$i.wcrm_activity_status}</td>
    <td>{$i.wcrm_contact}</td>
    <td>{$i.wcrm_call_result}</td>
    {include file="{$sys.uix.elm}/tbl/td/td_text__text.tpl" first="wcrm_camp_retention" second="call_name"}
    {include file="{$sys.uix.elm}/tbl/td/td_datetime.tpl" name="activity_on"}
    <td>{$i.call_attempt}</td>
    <td>{$i.wcrm_campaign_result}</td>
    <td>{$i.wcrm_campaign_fail}</td>
    <td>{$i.aaa_account}</td>
    {include file="{$sys.uix.elm}/tbl/td/td_created_on.tpl"}
{/block}