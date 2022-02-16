<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
	<fieldset>
		<legend><i class="fa fa-2x fa-database"></i> <span class="font-lg txt-camo-earth">Batch Upload</span>
			
		</legend>
        {include file="{$sys.uix.elm}/frm/dlg_error_form_validation.tpl"}
		{include file="{$sys.uix.elm}/frm/bs-hrz/elm_pkey.tpl"}
		&ensp;
    
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="PHONE NUMBER"     name="phone_number" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="CUSTOMER"         name="wcrm_account" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="DESCRIPTION"      name="upl_stage_sms" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="SENT ON"          name="sent_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="SENT STATUS"      name="sent_status" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_textarea.tpl" label="MESSAGE"      name="text_message" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="#STAGE_ID"        name="upl_action_sms_id" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="CREATED BY"       name="aaa_account" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="CREATED ON"  name="created_on" required=true}
        


        {include file="{$sys.uix.elm}/frm/bs-hrz/is_active.tpl"}
	</fieldset>
	{include file="{$sys.uix.elm}/frm/btn_close.tpl"}
</form>