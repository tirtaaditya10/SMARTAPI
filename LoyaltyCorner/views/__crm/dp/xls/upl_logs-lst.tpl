<div class="table-scrollable">
	<table class="footable table toggle-arrow-circle table-hover table-striped">
	    <thead>
	    <tr class="blue">
	        <th data-class="expand" data-sort-ignore="true" style="width:50px">ID</th>
		    <th data-sort-ignore="true">Entity</th>
		    <th data-sort-ignore="true">Filename</th>
		    <th data-sort-ignore="true">Stage</th>
		    <th data-sort-ignore="true">Row Count</th>
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
	                <td>{$i.upl_entity_type}</td>
	                <td>{$i.upl_filename}</td>
	                <td>{$i.upl_stage}</td>
	                <td>{$i.upl_rows_src}</td>
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
