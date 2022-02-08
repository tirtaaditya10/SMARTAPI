<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
    <fieldset>
        <legend><i class="fa fa-2x fa-database"></i> <span class="font-lg txt-camo-earth">{$sys.prc.sys_prc.header}</span></legend>
        {include file="{$sys.uix.elm}/frm/dlg_error_form_validation.tpl"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_pkey.tpl"}
        &ensp;

        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Name"  name="wcrm_campaign" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Campaign Type"  name="wcrm_campaign_type" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Team"  name="wcrm_query" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Target Type"  name="target_type" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Param 1"  name="param_1" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Param 2"  name="param_2" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Param 3"  name="param_3" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Param 4"  name="param_4" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Dist To"  name="dist_to" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Dist To S"  name="dist_to_s" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Exec On"  name="exec_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Created On"  name="created_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/is_active.tpl"}
    </fieldset>
    {include file="{$sys.uix.elm}/frm/btn_crud.tpl"}
</form>