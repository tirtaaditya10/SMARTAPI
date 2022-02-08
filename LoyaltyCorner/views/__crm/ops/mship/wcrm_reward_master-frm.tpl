<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
    <fieldset>
        <legend><i class="fa fa-2x fa-database"></i> <span class="font-lg txt-camo-earth">{$sys.prc.sys_prc.header}</span></legend>
        {include file="{$sys.uix.elm}/frm/dlg_error_form_validation.tpl"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_pkey.tpl"}
        &ensp;

        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Reward Name:" name="wcrm_reward" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_number.tpl" label="Point:"       name="reward_point" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="ATTRIB1:"     name="attrib_1" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="ATTRIB2:  "   name="attrib_2" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="ATTRIB3:  "   name="attrib_3" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Image:"       name="reward_image" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Created By:"  name="aaa_account" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Updated By:"  name="created_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/is_active.tpl"}
    </fieldset>
    {include file="{$sys.uix.elm}/frm/btn_close.tpl"}
</form>