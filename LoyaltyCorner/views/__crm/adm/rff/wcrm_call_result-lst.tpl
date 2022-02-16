{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="widget_toolbar_21"}
    <div class="widget-toolbar" id="widget_toolbar_21" style="display:none;">
        <button class="button-icon btn btn-danger" title="Upload to Stage II"><i class="fa fa-gear"></i> Upload to Stage II</button>
    </div>
{/block}
{block name="th_ext"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DISPLAY VALUE" field="wcrm_call_result"}
    {include file="{$sys.uix.elm}/tbl/th_col.tpl" label="ACTIVE" field="is_active" width="50px"}
{/block}
{block name="td_ext"}
    <td>{$i.wcrm_call_result}</td>
    <td class="text-center">{if $i.is_active}<i class="fa fa-check"></i>{else}<i class="fa fa-times">{/if} </td>
{/block}