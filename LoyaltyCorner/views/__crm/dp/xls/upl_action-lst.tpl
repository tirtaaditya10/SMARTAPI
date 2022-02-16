<div class="table-scrollable">
	<table class="table toggle-arrow-circle table-hover table-striped">
	    <thead>
	    <tr class="blue">
	        <th data-class="expand" data-sort-ignore="true" style="width:50px">ID</th>
		    <th data-sort-ignore="true">Batch Description</th>
		    <th data-sort-ignore="true">Batch Type</th>
		    <th data-sort-ignore="true">Batch Status</th>
		    <th data-sort-ignore="true">Data Count</th>
			<th data-sort-ignore="true">Screened</th>
			<th data-sort-ignore="true">Data Clean</th>
		    <th data-sort-ignore="true">Created By</th>
			<th data-sort-ignore="true">Created Time</th>
	        {include file="{$sys.uix.elm}/tbl/th_add.tpl"}
	    </tr>
	    </thead>
	    <tbody>
	    {if $sys.rsp.dat}
	        {foreach from=$sys.rsp.dat item=i}
                <tr id="{$sys.req.rid}/{$i.id}">
                    <td class="align-center">{$i@iteration + ($sys.nav.pgP * $sys.req.l)}</td>
	                <td>{$i.upl_action}</td>
	                <td>{$i.upl_action_type}</td>
	                <td>{$i.upl_action_step}</td>
	                <td>{$i.upl_rows}</td>
					<td>{$i.upl_dirty}</td>
					<td>{$i.upl_rows - $i.upl_dirty}</td>
	                <td>{$i.aaa_account}</td>
					<td>{$i.created_on}</td>
                    {include file="{$sys.uix.elm}/tbl/td_upd.tpl"}
                </tr>
	        {/foreach}
	    {/if}
	    </tbody>
	</table>
</div>
{include file="{$sys.uix.elm}/tbl/nav_lst.tpl"}
