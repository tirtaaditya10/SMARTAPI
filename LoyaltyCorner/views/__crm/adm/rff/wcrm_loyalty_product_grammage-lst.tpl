{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="widget_toolbar_21"}
    <div class="widget-toolbar" id="widget_toolbar_21" style="display:none;">
        <button class="button-icon btn btn-danger" title="Upload to Stage II"><i class="fa fa-gear"></i> Upload to Stage II</button>
    </div>
{/block}
{block name="th_ext"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="POINT" name="point" field="point"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="NOTES" name="notes" field="notes"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="PRICE" name="price" field="price"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="_OldGramID" name="_oldGramID" field="_oldGramID"}

{/block}
{block name="td_ext"}
	<td>{$i.point}</td>
	<td>{$i.notes}</td>
	<td>{$i.price}</td>
	<td>{$i._oldGramID}</td>
{/block}