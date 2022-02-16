<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
    <fieldset>
        <legend><i class="fa fa-2x fa-database"></i> <span class="font-lg txt-camo-earth">{$sys.prc.sys_prc.header}</span></legend>
        {include file="{$sys.uix.elm}/frm/dlg_error_form_validation.tpl"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_pkey.tpl"}
        &ensp;

        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Sub Channel Name" 	name="wcrm_loyalty_channel_sub" required=true}
        
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Notes" 	name="notes" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Created On"    name="created_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Updated On"    name="updated_on" required=true}
}
        {include file="{$sys.uix.elm}/frm/bs-hrz/is_active.tpl"}
    </fieldset>
    {include file="{$sys.uix.elm}/frm/btn_crud.tpl"}
</form>