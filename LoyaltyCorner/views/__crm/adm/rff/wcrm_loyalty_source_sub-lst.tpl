{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="widget_toolbar_21"}
    <div class="widget-toolbar" id="widget_toolbar_21" style="display:none;">
        <button class="button-icon btn btn-danger" title="Upload to Stage II"><i class="fa fa-gear"></i> Upload to Stage II</button>
    </div>
{/block}
{block name="th_ext"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="NOTES" name="notes" field="notes"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="_SubSourceID" name="_SubSourceID" field="_SubSourceID"}
{/block}
{block name="td_ext"}
	<td>{$i.notes}</td>
	<td>{$i._SubSourceID}</td>
{/block}