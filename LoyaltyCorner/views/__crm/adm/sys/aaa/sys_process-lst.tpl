<div class="row">
	<div class="col-md-12">
		<a id="selAll" class="btn blue">Select All</a>
		<a id="selNop" class="btn red">Select None</a>
		<div class="pull-right">
			<input id="act" name="act" value="add" type="hidden" />
			<input name="gid" value="{$sys.req.pid}" type="hidden" />
			{if $sys.rpc[$sys.req.rid].right.ins || $sys.rpc[$sys.req.rid].right.upd}
				<button id="xSubmit" type="button" class="btn green display-hide"><i class="icon-like"></i> Save</button>
			{/if}
		</div>
	</div>
	<div class="col-md-12 margin-top-10">
		<a id="insAll" class="btn yellow-gold">Insert</a>
		<a id="updAll" class="btn green-jungle">Update</a>
		<a id="delAll" class="btn purple">Delete</a>
		<a id="batAll" class="btn yellow-gold">Batch Update</a>
		<a id="docAll" class="btn yellow-gold">Attach Doc/Image</a>
		<a id="expAll" class="btn green-jungle">Export</a>
	</div>
</div>
<div class="table-scrollable">
	<table class="footable treeGrid table toggle-arrow-circle table-hover table-striped">
	    <thead>
	    <tr class="blue">
		    <th data-sort-ignore="true">Process</th>
	        <th data-sort-ignore="true">Base Table</th>
		    <th data-sort-ignore="true">Insert</th>
		    <th data-sort-ignore="true">Update</th>
		    <th data-sort-ignore="true">Delete</th>
		    <th data-sort-ignore="true">Batch<br />Update</th>
		    <th data-sort-ignore="true">Attach<br />Doc/Image</th>
	        <th data-sort-ignore="true">Export</th>
	        {include file="{$sys.uix.elm}/tbl/th_add.tpl"}
	    </tr>
	    </thead>
	    <tbody id="menu_prop">
	        {foreach from=$sys.rsp.dat item=i}
	            {if $i.sys_process_type_id eq 0}
	                <tr class="treegrid-{$i.id} {if $i.pid}treegrid-parent-{$i.pid}{/if}">
						<td><i class="{$i.sys_icon}"> <b>{$i.sys_process|replace:'#':' '}</b></td>
		                <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
		                {include file="{$sys.uix.elm}/tbl/td_upd.tpl"}
	                </tr>
	            {else}
	                <tr id="{$i.id}" class="treegrid-{$i.id} {if $i.pid}treegrid-parent-{$i.pid}{/if}">
		                <td><i class="{$i.sys_icon}"> {$i.sys_process|replace:'#':' '}</td>
	                    <td>{if $i.qry_table_id}{$i.qry_table_id}<br />{$i.sys_table_id}{else}{$i.sys_table_id}{/if}</td>
	                    <td class="align-center"><input type="checkbox" name="prop_ins[{$i.id}]" {if !$i.is_allow_ins}disabled{elseif $i.ins}checked{/if} value="{$i.ins}"/></td>
						<td class="align-center"><input type="checkbox" name="prop_upd[{$i.id}]" {if !$i.is_allow_upd}disabled{elseif $i.upd}checked{/if} value="{$i.upd}"/></td>
						<td class="align-center"><input type="checkbox" name="prop_del[{$i.id}]" {if !$i.is_allow_del}disabled{elseif $i.del}checked{/if} value="{$i.del}"/></td>
						<td class="align-center"><input type="checkbox" name="prop_bat[{$i.id}]" {if !$i.is_allow_bat}disabled{elseif $i.bat}checked{/if} value="{$i.bat}"/></td>
						<td class="align-center"><input type="checkbox" name="prop_doc[{$i.id}]" {if !$i.is_allow_doc}disabled{elseif $i.doc}checked{/if} value="{$i.doc}"/></td>
						<td class="align-center"><input type="checkbox" name="prop_exp[{$i.id}]" {if !$i.is_allow_exp}disabled{elseif $i.exp}checked{/if} value="{$i.exp}"/></td>
	                    {include file="{$sys.uix.elm}/tbl/td_upd.tpl"}
	                </tr>
	            {/if}
	        {foreachelse}
	        {/foreach}
	    </tbody>
	</table>
</div>
<script>
<!--
jQuery(function($) {
	$('input:checkbox').change(function() {
		var e = $(this),
			d = 0;

		if(e.prop('checked'))
			e.parents('td:first').find('input:checkbox').prop('checked', true).parent().addClass("checked");
		else
			e.parents('td:first').find('input:checkbox').removeAttr('checked').parent().removeClass("checked");
		e = null;

		$('input:checkbox:not(:disabled)', $('#menu_prop')).each(function() {
			var x = $(this),
				v = x.prop('checked') ? 1 : 0,
				o = parseInt(x.val());
			if(o != v) {
				d = 1;
				return false;
			}
			x = null;
		});
		if(d)
			$('#xSubmit').removeClass('display-hide');
		else
			$('#xSubmit').addClass('display-hide');
	});
	$('#xSubmit').click(function(e) {
		var p = [{ name:'act', value:'upd' }];
		$('input:checkbox:not(:disabled)', $('#menu_prop')).each(function() {
			var x = $(this),
				e = x.parents('tr:first').find('input:checkbox'),
				v = x.prop('checked') ? 1 : 0,
				c = '',
				o = parseInt(x.val());
			if(o != v) {
				c =  e.eq(0).prop('checked') ? '1' : '0'
				c += e.eq(1).prop('checked') ? '1' : '0';
				c += e.eq(2).prop('checked') ? '1' : '0';
				c += e.eq(3).prop('checked') ? '1' : '0';
				c += e.eq(4).prop('checked') ? '1' : '0';
				c += e.eq(5).prop('checked') ? '1' : '0';
				p.push({ name: e.eq(0).attr('name'), value: c });
			}
			x = null;
			c = null;
		});
		if(p.length > 1) {
			App.startPageLoading();
			AGV.target = $('#PCM');
			$.post(AGV.site + '{$sys.req.rid}', p, function (rsp) {
				AGV.target.html(rsp);
				AGV.target = null;
				App.stopPageLoading();
				dPage.init();
			});
		}
	});
	$('#selAll').click(function() {
		$('input:checkbox:not(:disabled)').prop('checked', true).trigger('change');
	});
	$('#selNop').click(function() {
		$('input:checkbox').removeAttr('checked').trigger('change');
	});
	$('#insAll').click(function() {
		$('input:checkbox[name^=prop_ins]:not(:disabled)').prop('checked', true).trigger('change');
	});
	$('#updAll').click(function() {
		$('input:checkbox[name^=prop_upd]:not(:disabled)').prop('checked', true).trigger('change');
	});
	$('#delAll').click(function() {
		$('input:checkbox[name^=prop_del]:not(:disabled)').prop('checked', true).trigger('change');
	});
	$('#batAll').click(function() {
		$('input:checkbox[name^=prop_bat]:not(:disabled)').prop('checked', true).trigger('change');
	});
	$('#docAll').click(function() {
		$('input:checkbox[name^=prop_doc]:not(:disabled)').prop('checked', true).trigger('change');
	});
	$('#expAll').click(function() {
		$('input:checkbox[name^=prop_exp]:not(:disabled)').prop('checked', true).trigger('change');
	});
});
-->
</script>
