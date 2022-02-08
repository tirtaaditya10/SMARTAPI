<div class="table-scrollable">
	<form id="F{$sys.req.rid}{$sys.req.pid}" class="xForm" method="post" data-target="#{$sys.uix.pcm}">
        <input type="hidden" id="aaa_acm__sys_process__{$sys.req.rid}" name="sys_app_id" value="{$sys.cfg.app.id}" />
        <input type="hidden" id="aaa_acm__sys_process__{$sys.req.rid}" name="aaa_acm_id" value="{$sys.cfg.app.id}" />
		<div class="form-body">
			<table class="table toggle-arrow-circle table-hover table-striped" style="width:95%">
				<thead>
                    <tr class="dark_green">
                        <th data-sort-ignore="true">Menu</th>
                        <th data-sort-ignore="true">Inquiry</th>
                        <th data-sort-ignore="true">Add</th>
                        <th data-sort-ignore="true">Update</th>
                        <th data-sort-ignore="true">Delete</th>
                        <th data-sort-ignore="true">Attachment</th>
                        <th data-sort-ignore="true">Batch</th>
                        <th data-sort-ignore="true">Export</th>
                    </tr>
                    <tr class="dark_green">
                        <th data-sort-ignore="true"><a id="nol_all" class="btn btn-danger pull-right">Reset</a></th>
                        <th data-sort-ignore="true" class="text-center"><div class="checkbox"><label><input type="checkbox" class="checkbox style-3" id="inq_all"" /><span></span></label></div></th>
                        <th data-sort-ignore="true" class="text-center"><div class="checkbox"><label><input type="checkbox" class="checkbox style-3" id="ins_all"" /><span></span></label></div></th>
                        <th data-sort-ignore="true" class="text-center"><div class="checkbox"><label><input type="checkbox" class="checkbox style-3" id="upd_all"" /><span></span></label></div></th>
                        <th data-sort-ignore="true" class="text-center"><div class="checkbox"><label><input type="checkbox" class="checkbox style-3" id="del_all"" /><span></span></label></div></th>
                        <th data-sort-ignore="true" class="text-center"><div class="checkbox"><label><input type="checkbox" class="checkbox style-3" id="doc_all"" /><span></span></label></div></th>
                        <th data-sort-ignore="true" class="text-center"><div class="checkbox"><label><input type="checkbox" class="checkbox style-3" id="bat_all"" /><span></span></label></div></th>
                        <th data-sort-ignore="true" class="text-center"><div class="checkbox"><label><input type="checkbox" class="checkbox style-3" id="exp_all"" /><span></span></label></div></th>
                    </tr>
				</thead>
				<tbody>
				{foreach from=$sys.rsp.dat item=i}
					{if $i.sys_process_type_id}
						<tr>
							<td style="padding-left:{($i.tree)*16}px;">{$i.sys_process|replace:'#':' '}</td>
							<td class="text-center">
								<div class="checkbox">
                                    <label>
									    <input type="checkbox" class="checkbox style-3 inq" id="inq_{$i.xid}" name="is_allow_inq[{$i.xid}]" {if $i.is_allow_inq}checked{/if} />
                                        <span></span>
                                    </label>
								</div>
							</td>
							<td class="text-center">
								<div class="checkbox">
                                    <label>
									<input type="checkbox" class="checkbox style-3" id="ins_{$i.xid}" name="is_allow_ins[{$i.xid}]" {if !$i.prop_ins}disabled{elseif $i.is_allow_ins}checked{/if} />
                                        <span></span>
                                    </label>
								</div>
							</td>
							<td class="text-center">
								<div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="checkbox style-3" id="upd_{$i.xid}" name="is_allow_upd[{$i.xid}]" {if !$i.prop_upd}disabled{elseif $i.is_allow_upd}checked{/if} />
                                        <span></span>
                                    </label>
								</div>
							</td>
							<td class="text-center">
								<div class="checkbox">
									<label>
                                        <input type="checkbox" class="checkbox style-3" id="del_{$i.xid}" name="is_allow_del[{$i.xid}]" {if !$i.prop_del}disabled{elseif $i.is_allow_del}checked{/if} />
                                        <span></span>
                                    </label>
								</div>
							</td>
                            <td class="text-center">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="checkbox style-3" id="doc_{$i.xid}" name="is_allow_doc[{$i.xid}]" {if !$i.prop_doc}disabled{elseif $i.is_allow_doc}checked{/if} />
                                        <span></span>
                                    </label>
                                </div>
                            </td>
                            <td class="text-center">
								<div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="checkbox style-3" id="bat_{$i.xid}" name="is_allow_bat[{$i.xid}]" {if !$i.prop_bat}disabled{elseif $i.is_allow_bat}checked{/if} />
                                        <span></span>
                                    </label>
								</div>
							</td>
							<td class="text-center">
								<div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="checkbox style-3" id="exp_{$i.xid}" name="is_allow_exp[{$i.xid}]" {if !$i.prop_exp}disabled{elseif $i.is_allow_exp}checked{/if} />
                                        <span></span>
                                    </label>
								</div>
							</td>
						</tr>
					{else}
						<tr><td colspan="8" style="padding-left:{($i.tree)*16}px;"><b>{$i.sys_process|replace:'#':' '}</b></td></tr>
					{/if}
					{foreachelse}
				{/foreach}
				</tbody>
			</table>
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-1 col-md-10">
					<input id="act" name="act" value="add" type="hidden" />
					<input name="gid" value="{$sys.req.pid}" type="hidden" />
					{if $sys.rpc[$sys.cfg.app.id]['rpc'][$sys.req.rid].sys_aaa.right.ins || $sys.rpc[$sys.cfg.app.id]['rpc'][$sys.req.rid].sys_aaa.right.upd}
						<button id="submit_{$sys.req.rid}{$sys.req.pid}" type="button" class="btn green"><i class="icon-like"></i> Save</button>
					{/if}
				</div>
			</div>
		</div>
	</form>
</div>
<script>
<!--
jQuery(function($) {
	var inq, ins, upd, del, bat, doc, exp, pid, fid;

	inq = ins = upd = del = bat = doc = exp = true;
	pid = {$sys.req.pid|default:0};
	fid = '';

	{if $sys.req.fid|default:0}
	fid = {$sys.req.fid|default:0};
	{/if}


	$('input:checkbox').data('value', 1);
	$('input:checked').data('value', 2);

	$('input:checkbox').change(function() {
		var e = $(this);

		if(e.prop('checked'))
			e.parents('tr:first').find('input[name^=is_allow_inq]').prop('checked', true);
		else
            if(e.hasClass('inq'))
                e.parents('tr:first').find('input:checkbox').prop('checked', false);
	});
	$('#submit_{$sys.req.rid}{$sys.req.pid}').click(function() {

		var f = $(this).parents('form:first'),
		    p = [
		        { name:'act', value:'upd' },
			    { name:'sys_app_id', value:$('#fs_sys_app_id_{$sys.req.rid}').val() },
			    { name:'aaa_acm_id', value:$('#fs_aaa_acm_id_{$sys.req.rid}').val() }
		        ];
		$('input:checkbox', f).each(function() {
			var x = $(this),
			    v = x.prop('checked') ? 2 : 1,
			    o = parseInt(x.data('value'));
			if(o != v)
				p.push({ name:x.attr('name'), value:v-1 })
		});

		if(p.length > 3) {
			AGV.cTarget = $('#{$sys.uix.pcm}');
			AGV.xhr = $.post(AGV.site + {$sys.req.rid}, p, function (rsp) {
				AGV.cTarget.html(rsp);
				dPage.init();
			});
		}
	});
	$('#inq_all').click(function() {
		if(inq)
			$('input:checkbox[name^=is_allow_inq]').not(':disabled').prop('checked', true);
		else
			$('input:checkbox[name^=is_allow_inq]').not(':disabled').prop('checked', false);
		inq = !inq;
	});
	$('#ins_all').click(function() {
		if(ins)
			$('input:checkbox[name^=is_allow_ins]').not(':disabled').prop('checked', true);
		else
			$('input:checkbox[name^=is_allow_ins]').not(':disabled').prop('checked', false);
		ins = !ins;
	});
	$('#upd_all').click(function() {
		if(upd)
			$('input:checkbox[name^=is_allow_upd]').not(':disabled').prop('checked', true);
		else
			$('input:checkbox[name^=is_allow_upd]').not(':disabled').prop('checked', false);
		upd = !upd;
	});
	$('#del_all').click(function() {
		if(del)
			$('input:checkbox[name^=is_allow_del]').not(':disabled').prop('checked', true);
		else
			$('input:checkbox[name^=is_allow_del]').not(':disabled').prop('checked', false);
		del = !del;
	});
	$('#bat_all').click(function() {
		if(bat)
			$('input:checkbox[name^=is_allow_bat]').not(':disabled').prop('checked', true);
		else
			$('input:checkbox[name^=is_allow_bat]').not(':disabled').prop('checked', false);
		bat = !bat;
	});
	$('#doc_all').click(function() {
		if(doc)
			$('input:checkbox[name^=is_allow_doc]').not(':disabled').prop('checked', true);
		else
			$('input:checkbox[name^=is_allow_doc]').not(':disabled').prop('checked', false);
		doc = !doc;
	});
	$('#exp_all').click(function() {
		if(exp)
			$('input:checkbox[name^=is_allow_exp]').not(':disabled').prop('checked', true);
		else
			$('input:checkbox[name^=is_allow_exp]').not(':disabled').prop('checked', false);
		exp = !exp;
	});
	$('#nol_all').click(function() {
		$('input:checkbox').not(':disabled').prop('checked', false);
	});
});
-->
</script>