<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
	<fieldset>
		<legend><i class="fa fa-2x fa-mobile"></i> <span class="font-lg txt-camo-earth">{$sys.rsp.dat.upl_action_sms}</span>
		</legend>
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_pkey.tpl"}
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Batch Type" 		name="action_type"      cfg=['readonly' => 1]}
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Bacth Status" 	name="action_status"    cfg=['readonly' => 1]}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Created By" 	    name="aaa_account"      cfg=['readonly' => 1]}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_date_view.tpl" label="Created On" 	    name="created_on"       cfg=['readonly' => 1]}
	</fieldset>
{include file="{$sys.uix.elm}/frm/btn_close.tpl"}
</form>
{include file="{$sys.uix.tpl}/upl_stage_sms-view.tpl" data=$sys.rsp.aux.upl_stage_sms}