<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
	<div class="form-body">
		<ul id="dTabs" class="nav nav-tabs">
			<li class="active"><a href="#tabA" data-toggle="tab">Menu</a></li>
			{if $sys.rsp.dat.is_atomic}
				<li><a href="#tabB" data-toggle="tab">Query</a></li>
				<li><a href="#tabC" data-toggle="tab">Control</a></li>
				<li><a href="#tabD" data-toggle="tab">Extend</a></li>
				<li><a href="#tabE" data-toggle="tab">Ex-Imp</a></li>
				<li><a href="#tabF" data-toggle="tab">Upload</a></li>
				<li><a href="#tabG" data-toggle="tab">Notification</a></li>
				<li><a href="#tabH" data-toggle="tab" data-url="#{$sys.req.rid+1}/0/{$sys.req.pid}" class="refresh">Lookup</a></li>
			{/if}
		</ul>
		<div class="tab-content" style="margin: 0 10px;">
			<div class="tab-pane active" id="tabA">
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_pkey.tpl"   WElm=3}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"   label="Name"  name="sys_process" required=true}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_select_tree.tpl" 	dtx=$sys.rsp.ref.sys_process}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl" 		dtx=$sys.rsp.ref.sys_process_type}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"   label="Title"	name="sys_title"}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"   label="Header" name="sys_header"}
                {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"   label="Desc"	name="sys_desc"}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"   label="URL"   name="uri"  helper="Kosongkan, kecuali mempunyai kekhususan"}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"   label="Icon"  name="font_icon"}
                {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"   label="Class"  name="class_icon"}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_boolean.tpl"	label="Type" 	name="is_atomic" lbl_on="Menu" lbl_off="Grp. Menu"}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_boolean.tpl"	label="Task ?"	name="has_task"}
                {include file="{$sys.uix.elm}/frm/bs-hrz/elm_boolean.tpl"	label="Send Notif. ?" name="has_notification"}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_is_active.tpl"}
			</div>
			<div class="tab-pane" id="tabB">
				{**include file="{$sys.uix.elm}/frm/bs-hrz/elm_select_tree.tpl"	dtx=$sys.rsp.ref.sys_module**}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_select_group.tpl"	dtx=$sys.rsp.ref.sys_table}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"   	label="Query"  name="qry"}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_textarea.tpl"  label="Filter" name="qry_param"}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_numeric.tpl"   	label="Limit"  name="qry_lim"}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_textarea.tpl"  label="Sort"   name="qry_ord"}
				{include file="{$sys.uix.elm}/frm/bs-hrz/elm_boolean.tpl" 	name="is_ajaxify" label="Ajaxify"}
			</div>
			<div class="tab-pane" id="tabC">
				<div id="ctrlx" class="form-group form-md-checkboxes{if !$sys.rsp.dat.is_atomic} display-hide{/if}">
					<label class="col-md-2 control-label">Action Control <span class="required">*</span></label>
					<div class="col-md-3">
						<div class="form-group form-md-checkboxes">
							<div class="md-checkbox-list">
								<input type="hidden" name="ctrl[inq]" value="1" />
								{**<div class="md-checkbox">
									<input type="checkbox" {if $sys.rsp.dat.inq} checked{/if} class="md-check" id="cb_01" name="ctrl[inq]" value="1" readonly />
									<label for="cb_01"><span class="inc"></span><span class="check"></span><span class="box"></span>Read</label>
								</div>
								**}
								<div class="md-checkbox">
									<input type="checkbox" {if $sys.rsp.dat && $sys.rsp.dat.is_allow_ins && $sys.rsp.dat.ins} checked{/if} class="md-check" id="cb_02" name="ctrl[ins]" value="1" {if !$sys.rsp.dat.is_allow_ins}disabled{/if} />
									<label for="cb_02"><span class="inc"></span><span class="check"></span><span class="box"></span>Insert</label>
								</div>
								<div class="md-checkbox">
									<input type="checkbox" {if $sys.rsp.dat && $sys.rsp.dat.is_allow_upd && $sys.rsp.dat.upd} checked{/if} class="md-check" id="cb_03" name="ctrl[upd]" value="1" {if !$sys.rsp.dat.is_allow_upd}disabled{/if} />
									<label for="cb_03"><span class="inc"></span><span class="check"></span><span class="box"></span>Update</label>
								</div>
								<div class="md-checkbox">
									<input type="checkbox" {if $sys.rsp.dat && $sys.rsp.dat.is_allow_del && $sys.rsp.dat.del} checked{/if} class="md-check" id="cb_04" name="ctrl[del]" value="1" {if !$sys.rsp.dat.is_allow_del}disabled{/if} />
									<label for="cb_04"><span class="inc"></span><span class="check"></span><span class="box"></span>Delete</label>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-md-checkboxes">
							<div class="md-checkbox-list">
								<div class="md-checkbox">
									<input type="checkbox" {if $sys.rsp.dat && $sys.rsp.dat.is_allow_bat && $sys.rsp.dat.bat} checked{/if} class="md-check" id="cb_05" name="ctrl[bat]" value="1" {if !$sys.rsp.dat.is_allow_bat}disabled{/if} />
									<label for="cb_05"><span class="inc"></span><span class="check"></span><span class="box"></span>Import (XLS)</label>
								</div>
								<div class="md-checkbox">
									<input type="checkbox" {if $sys.rsp.dat && $sys.rsp.dat.is_allow_exp && $sys.rsp.dat.exp} checked{/if} class="md-check" id="cb_07" name="ctrl[exp]" value="1" {if !$sys.rsp.dat.is_allow_exp}disabled{/if} />
									<label for="cb_07"><span class="inc"></span><span class="check"></span><span class="box"></span>Export as EXL / DOC / PDF</label>
								</div>
								<div class="md-checkbox">
									<input type="checkbox" {if $sys.rsp.dat && $sys.rsp.dat.is_allow_doc && $sys.rsp.dat.doc} checked{/if} class="md-check" id="cb_06" name="ctrl[doc]" value="1" {if !$sys.rsp.dat.is_allow_doc}disabled{/if} />
									<label for="cb_06"><span class="inc"></span><span class="check"></span><span class="box"></span>Upload (Doc/Image)</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tabD"></div>
			<div class="tab-pane" id="tabE"></div>
			<div class="tab-pane" id="tabF">{include file="{$sys.uix.elm}/frm/bs-hrz/elm_select_group.tpl" dtx=$sys.rsp.ref.dms_catalog}</div>
			<div class="tab-pane" id="tabG"></div>
			<div class="tab-pane" id="tabH">
				<table class="footable table toggle-square-filled table-hover table-striped">
					<thead>
					<tr class="blue">
						<th data-sort-ignore="true">Name</th>
						<th data-sort-ignore="true">Action</th>
						<th data-sort-ignore="true">Markers</th>
						<th data-sort-ignore="true">Map</th>
						<th data-sort-ignore="true">Carrier</th>
						<th data-sort-ignore="true">Email-To</th>
						<th data-sort-ignore="true">Email-CC</th>
						<th data-sort-ignore="true">Email-BCC</th>
						<th data-sort-ignore="true">SMS-To</th>
						{include file="{$sys.uix.elm}/tbl/th_add.tpl"}
					</tr>
					</thead>
					<tbody id="menu_prop">
					{if $sys.rsp.ntf}
						{foreach from=$sys.rsp.ntf item=i}
							<tr id="{$sys.req.rid}/{$i.sys_process_id}/{$i.ntf_cfg_id}">
								<td>{$i.sys_notification_tpl}</td>
								<td>{$i.aud_act}</td>
								<td>{$i.aud_markers}</td>
								<td class="align-center">{$i.aud_maps}</td>
								<td class="align-center">{$i.sys_notification_type}</td>
								<td class="align-center">{$i.eml_to}</td>
								<td class="align-center">{$i.eml_cc}</td>
								<td class="align-center">{$i.eml_bcc}</td>
								<td class="align-center">{$i.sms_to}</td>
								<td class="align-center"><a class="ajaxify" href="javascript:" data-url="#{$sys.req.rid}/{$i.sys_process_id}/{$i.ntf_cfg_id}" title="Edit Data"><i class="fa fa-edit"></i></a></td>
							</tr>
						{/foreach}
					{/if}
					</tbody>
				</table>
			</div>

		</div>
	</div>
	{include file="{$sys.uix.elm}/frm/btn_crud.tpl"}
</form>
{include file="{$sys.uix.elm}/frm/dlg_crud_del_conf.tpl" cForm="F{$sys.req.rid}{$sys.req.pid}" dlgHead="Sys. Process" dlgBody="<dt>Menu</dt><dd>{$sys.rsp.dat.sys_process}</dd><dt>Application</dt><dd>{$sys.rsp.dat.sys_app}</dd>"}
<script>
<!--
jQuery(function(){
	$('.footable').footable();

	$('#is_atomic').change(function(){
		$('#ctrlx').toggle();
	});
	/*
	$("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
		//fire initialize of footable because the footable plugin only processes tables that are visible
		$('.footable').trigger('footable_initialize');
	});
	*/
	$('.nav-tabs a').click(function (e) {
		e.preventDefault(); //prevents re-size from happening before tab shown
		$(this).tab('show'); //show tab panel
		$('.footable').trigger('footable_resize'); //fire re-size of footable
	});
});
-->
</script>
