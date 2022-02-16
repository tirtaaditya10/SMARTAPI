<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
	<fieldset>
		<legend><i class="fa fa-2x fa-database"></i> <span class="font-lg txt-camo-earth">Batch Proses</span>
			<small> {$sys.rsp.dat.upl_action}</small>
		</legend>
		{** include file="{$sys.uix.elm}/frm/dlg_error_form_validation.tpl" **}
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_pkey.tpl"}
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Proses Type" 		name="upl_action_type" required=true}
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Process Step" 	name="upl_action_step" required=true}
	</fieldset>
</form>
{include file="__crm/dp/xls/upl_stage_customer-lst.tpl" data=$sys.rsp.aux pgP=0}