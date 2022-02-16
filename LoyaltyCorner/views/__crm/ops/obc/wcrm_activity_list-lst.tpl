{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="widget_toolbar_11"}
    <div class="widget-toolbar smart-form pull-left" role="menu" style="min-width:15%; width:30%;">
        <label class="input">
            <i class="icon-append"><a class="btn btn-sm btn-circle" style="margin-top: -4px;margin-left: -4px;"><i class="icon fa fa-search-plus"></i></a></i>
            <input id="obc_search" placeholder="Search by Customer, Contact or Phone Number" type="text">
            <b class="tooltip tooltip-top-right">
                <i class="fa fa-warning txt-color-teal"></i>Search by Customer Name, Contact Name or Phone Number
            </b>
        </label>
    </div>
{/block}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Status"            field="wcrm_activity_status"}
    {if $sys.req.rid eq 520004100}{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Agent" field="aaa_agent"}{/if}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Area"              field="city"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Campaign"          field="wcrm_campaign_type"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Sub-Campaign"      field="call_name"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Phone"             field="phone_number_1"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Customer"          field="wcrm_account"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Child"             field="wcrm_contact"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Schedule"          field="activity_schedule_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="First Call"        field="call_first_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Last Call"         field="call_last_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="#Attempt"          field="attempt"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Next Call"         field="call_next_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Closed On"         field="activity_closed_on" break="lg"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Call Result"       field="wcrm_call_result"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Campaign-Result"   field="wcrm_campaign_result"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Member-No"         field="member_no" break="lg"}
{/block}
{block name="td_ext"}
    <td>{$i.wcrm_activity_status}</td>
    {if $sys.req.rid eq 520004100}<td>{$i.aaa_agent}</td>{/if}
    <td>{$i.city}</td>
    <td>{$i.wcrm_campaign_type}</td>
    <td>{$i.call_name}</td>
    <td>{$i.phone_number_1|phone_format}<br>{$i.phone_number_2|phone_format}<br>{$i.phone_number_3|phone_format}</td>
    <td>{$i.wcrm_account}</td>
    <td>{$i.wcrm_contact}</td>
    <td>{$i.call_schedule_on}</td>
    <td>{$i.call_first_on}</td>
    <td>{$i.call_last_on}</td>
    <td>{$i.call_attempt}</td>
    <td>{$i.call_next_on}</td>
    <td>{$i.activity_closed_on}</td>
    <td>{$i.wcrm_call_result}{if $i.wcrm_campaign_fail}<br><em>{$i.wcrm_campaign_fail}</em>{/if}</td>
    <td>{$i.wcrm_campaign_result}</td>
    <td>{$i.member_no}</td>
{/block}
{if $sys.req.rid eq 520004100}
{block name="td_act"}
    {include file="{$sys.uix.elm}/tbl/td_upd.tpl" url="520004200/{$i.id}/520004100"}
{/block}
{/if}
{block name="jquery_page_ready"}
    $('#obc_search').keypress(function (e) {
        var key = e.which,
            frm = $('#sForm_{$sys.req.rid}');

        if(key == 13) { // the enter key code
            frm.find('input[name="q"]').val($(this).val())
            frm.submit();
            return false;
        }
    });
{/block}