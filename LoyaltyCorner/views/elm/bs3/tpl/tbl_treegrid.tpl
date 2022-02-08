<table class="treeGrid table toggle-arrow-circle table-hover table-striped">
	<thead>
	<tr>
		{block name="th"}
			{if $sys.prc.sys_tbl.has.col_self}
				<th></th>
				<th data-sort-ignore="true">{$label|default:'Name'}</th>
			{/if}
		{/block}
		{block name="th_ext"}{/block}
		{include file="{$sys.uix.elm}/tbl/th_add.tpl"}
	</tr>
	</thead>
	<tbody>
	{foreach from=$sys.rsp.dat item=i}
		<tr id="{$sys.req.rid}/{$i.id}" class="treegrid-{$i.id} {if $i.pid}treegrid-parent-{$i.pid}{/if}">
			{block name="td"}
                {if $sys.prc.sys_tbl.has.col_self}
					<td></td>
					<td style="padding-left:{$i.tree|default:0 * 20}px">{$i[$sys.prc.sys_tbl.has.col_self]}</td>
				{/if}
			{/block}
			{block name="td_ext"}{/block}
			{include file="{$sys.uix.elm}/tbl/td_upd.tpl"}
		</tr>
	{/foreach}
	</tbody>
</table>