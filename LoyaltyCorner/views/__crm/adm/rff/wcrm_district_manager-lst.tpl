{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="widget_toolbar_21"}
    <div class="widget-toolbar" id="widget_toolbar_21" style="display:none;">
        <button class="button-icon btn btn-danger" title="Upload to Stage II"><i class="fa fa-gear"></i> Upload to Stage II</button>
    </div>
{/block}
{block name="th_ext"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="DMCODE" field="id_code"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="OUTLET GROUP" field="wcrm_outlet_group"}
 
{/block}
{block name="td_ext"}
	<td>{$i.id_code}</td>
	<td>{$i.wcrm_outlet_group}</td>
	
	

{/block}