<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
    <fieldset>
        <legend><i class="fa fa-2x fa-database"></i> <span class="font-lg txt-camo-earth">{$sys.prc.sys_prc.header}</span></legend>

        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="KATEGORY NAME" 	name="wcrm_km_category" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/is_active.tpl"}
    </fieldset>
    {include file="{$sys.uix.elm}/frm/btn_crud.tpl"}
</form>