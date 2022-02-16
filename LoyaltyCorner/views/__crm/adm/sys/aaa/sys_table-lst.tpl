<form class="cForm form-horizontal" action="#">
	<div class="form-body">
		<div class="form-group">
			<div class="col-md-12">
				<a id="audAll" class="btn blue">Select All</a>
				<a id="audNop"  class="btn red">Select None</a>
				<div class="pull-right">
					<input id="act" name="act" value="add" type="hidden" />
					<input name="gid" value="{$sys.req.pid}" type="hidden" />
					{if $sys.rpc[$sys.req.rid].right.ins || $sys.rpc[$sys.req.rid].right.upd}
						<button id="xSubmit" type="button" class="btn green display-hide"><i class="icon-like"></i> Save</button>
					{/if}
				</div>
			</div>
		</div>
	</div>
</form>
{**<form class="xForm" method="post" action="#{$sys.req.rid}/{$sys.req.pid}">**}
<form id="xForm" method="post" action="#{$sys.req.rid}" data-target="#{$sys.uix.pcm}" class="cForm form-horizontal">
	<div class="form-body">
		<table class="footable table toggle-arrow-circle table-hover table-striped">
			<thead>
				<tr class="green">
					<th data-class="expand" data-sort-ignore="true" style="width:22px"></th>
					<th data-sort-ignore="true">Table</th>
					<th data-hide="all" data-sort-ignore="true" style="width:200px;">Table-ID</th>
					<th data-hide="all" data-sort-ignore="true" style="width:200px;">TYPE</th>
					<th data-sort-ignore="true" style="width:75px;">Insert</th>
					<th data-sort-ignore="true" style="width:75px;">Update</th>
					<th data-sort-ignore="true" style="width:75px;">Delete</th>
					<th data-sort-ignore="true" style="width:75px;">Delete Cascade</th>
					<th data-sort-ignore="true" style="width:75px;">Upload XLS</th>
					<th data-sort-ignore="true" style="width:75px;">Upload PDF/Doc/Image</th>
					<th data-sort-ignore="true" style="width:75px;">Export</th>
					{include file="{$sys.uix.elm}/tbl/th_add.tpl"}
				</tr>
			</thead>
			<tbody>
				<tr class="green">
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td class="align-center"><input id="insAll" type="checkbox"></td>
					<td class="align-center"><input id="updAll" type="checkbox"></td>
					<td class="align-center"><input id="delAll" type="checkbox"></td>
					<td class="align-center"><input id="casAll" type="checkbox"></td>
					<td class="align-center"><input id="batAll" type="checkbox"></td>
					<td class="align-center"><input id="docAll" type="checkbox"></td>
					<td class="align-center"><input id="expAll" type="checkbox"></td>
					<td></td>
				</tr>
				{foreach from=$sys.rsp.dat item=i}
					<tr id="{$sys.req.rid}/{$i.id}">
						<td></td>
						<td>{$i.sys_table}</td>
						<td>{$i.id}</td>
						<td>{$i.sys_table_type}</td>
						{if isset($i.allow)}
							<td class="align-center"><input type="checkbox" name="ins[{$i.id}]" {if $i.allow.ins}checked{/if} value="{$i.allow.ins + 1}"/></td>
							<td class="align-center"><input type="checkbox" name="upd[{$i.id}]" {if $i.allow.upd}checked{/if} value="{$i.allow.upd + 1}"/></td>
							<td class="align-center"><input type="checkbox" name="del[{$i.id}]" {if $i.allow.del}checked{/if} value="{$i.allow.del + 1}"/></td>
							<td class="align-center"><input type="checkbox" name="cas[{$i.id}]" {if $i.allow.cas}checked{/if} value="{$i.allow.cas + 1}"/></td>
							<td class="align-center"><input type="checkbox" name="bat[{$i.id}]" {if $i.allow.bat}checked{/if} value="{$i.allow.bat + 1}"/></td>
							<td class="align-center"><input type="checkbox" name="doc[{$i.id}]" {if $i.allow.doc}checked{/if} value="{$i.allow.doc + 1}"/></td>
							<td class="align-center"><input type="checkbox" name="exp[{$i.id}]" {if $i.allow.exp}checked{/if} value="{$i.allow.exp + 1}"/></td>
						{else}
							<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
						{/if}
						{include file="{$sys.uix.elm}/tbl/td_upd.tpl"}
					</tr>
				{foreachelse}
					<tr>
						<td class="align-center" colspan="11">I don't have what you are looking for</td>
					</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
	{if !$sys.rpc[$sys.req.rid].right.ins && !$sys.rpc[$sys.req.rid].right.upd}
	<div class="form-action">
		<div class="col-md-offset-2">
			<strong>ATTENTION! </strong><br />
				<span style="color:#932ab6; font-size:1.15em; font-weight:bold;">You don't have any privilege to modify this content</span>
		</div>
	</div>
	{/if}
</form>
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

		$('input:checkbox:not(:disabled)', $('#xForm')).each(function() {
			var x = $(this),
				v = x.prop('checked') ? 2 : 1,
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
		var p = [{ name:'act', value:'upd' },
				 { name:'jsd', value:'allow' }];
		$('input:checkbox', $('#xForm')).each(function() {
			var x = $(this),
				v = x.prop('checked') ? 2 : 1,
				o = parseInt(x.val());
			if(x.attr('name') !== undefined)
				p.push({ name:x.attr('name'), value:v-1 })
		});
		if(p.length > 1) {
			App.startPageLoading();
			console.info(p);
			$.post(AGV.site + '{$sys.req.rid}', p, function (rsp) {
				$('#PCM').html(rsp);
				dPage.init();
			});
		}
	});
	$('#audAll').click(function() {
		$('input:checkbox:not(:disabled)').prop('checked', true).trigger('change');
	});
	$('#audNop').click(function() {
		$('input:checkbox:not(:disabled)').removeAttr('checked').trigger('change');
	});
	$('#insAll').click(function() {
		if ($(this).is(':checked'))
			$('input:checkbox[name^=ins]:not(:disabled)').prop('checked', true).trigger('change');
		else
			$('input:checkbox[name^=ins]:not(:disabled)').removeAttr('checked').trigger('change');
	});
	$('#updAll').click(function() {
		if ($(this).is(':checked'))
			$('input:checkbox[name^=upd]:not(:disabled)').prop('checked', true).trigger('change');
		else
			$('input:checkbox[name^=upd]:not(:disabled)').removeAttr('checked').trigger('change');
	});
	$('#delAll').click(function() {
		if ($(this).is(':checked'))
			$('input:checkbox[name^=del]:not(:disabled)').prop('checked', true).trigger('change');
		else
			$('input:checkbox[name^=del]:not(:disabled)').removeAttr('checked').trigger('change');
	});
	$('#casAll').click(function() {
		if ($(this).is(':checked'))
			$('input:checkbox[name^=cas]:not(:disabled)').prop('checked', true).trigger('change');
		else
			$('input:checkbox[name^=cas]:not(:disabled)').removeAttr('checked').trigger('change');
	});
	$('#batAll').click(function() {
		if ($(this).is(':checked'))
			$('input:checkbox[name^=bat]:not(:disabled)').prop('checked', true).trigger('change');
		else
			$('input:checkbox[name^=bat]:not(:disabled)').removeAttr('checked').trigger('change');
	});
	$('#docAll').click(function() {
		if ($(this).is(':checked'))
			$('input:checkbox[name^=doc]:not(:disabled)').prop('checked', true).trigger('change');
		else
			$('input:checkbox[name^=doc]:not(:disabled)').removeAttr('checked').trigger('change');
	});
	$('#expAll').click(function() {
		if ($(this).is(':checked'))
			$('input:checkbox[name^=exp]:not(:disabled)').prop('checked', true).trigger('change');
		else
			$('input:checkbox[name^=exp]:not(:disabled)').removeAttr('checked').trigger('change');
	});
});
-->
</script>
