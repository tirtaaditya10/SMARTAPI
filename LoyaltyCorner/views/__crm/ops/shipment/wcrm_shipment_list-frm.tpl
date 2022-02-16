<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
	<fieldset>
		<legend><i class="fa fa-2x fa-database"></i> <span class="font-lg txt-camo-earth">Batch Upload</span>
			<small> {$sys.rsp.dat.upl_filename}</small>
		</legend>
		{include file="{$sys.uix.elm}/frm/dlg_error_form_validation.tpl"}
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_pkey.tpl"}
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="File Name" 	name="upl_filename" required=true}
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Data Entity" 	name="upl_entity_type" required=true}
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Data Stage"	name="upl_stage" required=true}
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Status"		name="upl_status" required=true}
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Row"			name="upl_rows_src" disabled=true}
	</fieldset>
	{include file="{$sys.uix.elm}/frm/btn_crud.tpl"}
</form>