{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="widget_toolbar_21"}
    <div class="widget-toolbar" id="widget_toolbar_21" style="display:none;">
        <button class="button-icon btn btn-danger" title="Upload to Stage II"><i class="fa fa-gear"></i> Upload to Stage II</button>
    </div>
{/block}
{block name="th_ext"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Start Date" name="period_started" field="period_started"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="End Date" name="period_ended" field="period_ended"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="NOTES" name="period_notes" field="period_notes"}
{/block}
{block name="td_ext"}
	<td>{$i.period_started}</td>
	<td>{$i.period_ended}</td>
	<td>{$i.period_notes}</td>
{/block}