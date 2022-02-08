{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="widget_toolbar_21"}
    <div class="widget-toolbar" id="widget_toolbar_21" style="display:none;">
        <button class="button-icon btn btn-danger" title="Upload to Stage II"><i class="fa fa-gear"></i> Upload to Stage II</button>
    </div>
{/block}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DISPLAY VALUE" field="wcrm_address_id"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DISPLAY VALUE" field="redeemed_on"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DISPLAY VALUE" field="wcrm_loyalty_reward"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DISPLAY VALUE" field="total_point"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DISPLAY VALUE" field="redeem_status"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DISPLAY VALUE" field="wcrm_shipment_id"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DISPLAY VALUE" field="_oldStatus"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DISPLAY VALUE" field="_oldRedeemId"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DISPLAY VALUE" field="wcrm_loyalty_period"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DISPLAY VALUE" field="qty"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DISPLAY VALUE" field="wcrm_loyalty_channel_id"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DISPLAY VALUE" field="wcrm_loyalty_channel_sub"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DISPLAY VALUE" field="aaa_account"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DISPLAY VALUE" field="created_on"}
{/block}
{block name="td_ext"}
    <td>{$i.wcrm_campaign_type}</td>
    <td class="text-center">{if $i.is_active}<i class="fa fa-check"></i>{else}<i class="fa fa-times">{/if} </td>
{/block}
