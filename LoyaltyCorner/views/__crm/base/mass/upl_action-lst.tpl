{extends file="{$sys.uix.elm}/hst/portlet-lst.tpl"}
{block name="widget_toolbar_21"}
	<div class="widget-toolbar" id="widget_toolbar_21" style="display:none;">
		<button class="button-icon btn btn-danger" title="Batch Process"><i class="fa fa-gear"></i> Batch Process</button>
	</div>
{/block}
{block name="th_ext"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Batch Description" field="upl_action" break="all"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Batch Type" field="upl_action_type"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Batch Status" field="upl_action_step"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Data Uploaded" field="upl_rows"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Data Screened" field="upl_dirty"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="Data Clean"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CREATED BY" 	field="aaa_account"}
	{include file="{$sys.uix.elm}/tbl/th_col.tpl" label="CREATED TIME" field="created_on"}
{/block}
{block name="td_ext"}
	<td>{$i.upl_action}</td>
	<td>{$i.upl_action_type}</td>
	<td name="step" data-val="{$i.upl_action_step_id}">{$i.upl_action_step}</td>
	<td>{$i.upl_rows}</td>
	<td>{$i.upl_dirty}</td>
	<td>{$i.upl_rows - $i.upl_dirty}</td>
	<td>{$i.aaa_account}</td>
	<td>{$i.created_on}</td>
{/block}
{block name="jquery_page_ready"}
	$('table.footable tbody tr').click(function(e) {
		$('#widget_toolbar_21').hide();

		var row  = $(this),
			step = parseInt(row.find('td[name="step"]').data('val'));
		row.siblings().removeClass('bg-gray')
		if(step == 0) {
			row.addClass('bg-gray');
			$('#widget_toolbar_21').show();
		}
	})
{/block}