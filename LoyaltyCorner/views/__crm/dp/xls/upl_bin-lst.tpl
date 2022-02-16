<div class="table-scrollable">
	<table class="table toggle-arrow-circle table-hover table-striped">
	    <thead>
	    <tr class="blue">
	        <th data-class="expand" data-sort-ignore="true" style="width:50px">#</th>
		    <th data-sort-ignore="true">File Upload</th>
		    <th data-sort-ignore="true">Existing Customer</th>
		    <th data-sort-ignore="true">Staging Customer</th>
		    <th data-sort-ignore="true">Data Created</th>
	        {include file="{$sys.uix.elm}/tbl/th_add.tpl"}
	    </tr>
	    </thead>
	    <tbody>
	    {if $sys.rsp.dat}
	        {foreach from=$sys.rsp.dat item=i}
                <tr id="{$sys.req.rid}/{$i.id}">
                    <td class="align-center">{$i@iteration + ($sys.nav.pgP * $sys.req.l)}</td>
	                <td>{$i.upl_filename}</td>
	                <td>{$i.wcrm_account}<br>{$i.account_number_1}</td>
	                <td>{$i.custumer_name}<br>{$i.staging_number_1}</td>
	                <td>{$i.created_on}</td>
                    {include file="{$sys.uix.elm}/tbl/td_upd.tpl"}
                </tr>
	        {/foreach}
	    {/if}
	    </tbody>
	</table>
</div>
{include file="{$sys.uix.elm}/tbl/nav_lst.tpl"}
