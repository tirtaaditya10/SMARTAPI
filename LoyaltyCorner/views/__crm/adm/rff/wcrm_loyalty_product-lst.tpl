{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="widget_toolbar_21"}
    <div class="widget-toolbar" id="widget_toolbar_21" style="display:none;">
        <button class="button-icon btn btn-danger" title="Upload to Stage II"><i class="fa fa-gear"></i> Upload to Stage II</button>
    </div>
{/block}
{block name="th_ext"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CATEGORY" name="category" field="category"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="NOTES" name="period_notes" field="period_notes"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Order No" name="order_no" field="order_no"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="_OldProdID" name="_OldProdID" field="_OldProdID"}
{/block}
{block name="td_ext"}
	<td>{$i.category}</td>
	<td>{$i.notes}</td>
	<td>{$i.order_no}</td>
	<td>{$i._OldProdID}</td>
{/block}