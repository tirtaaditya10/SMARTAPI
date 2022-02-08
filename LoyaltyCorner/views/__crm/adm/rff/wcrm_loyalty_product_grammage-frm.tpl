<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
    <fieldset>
        <legend><i class="fa fa-2x fa-database"></i> <span class="font-lg txt-camo-earth">{$sys.prc.sys_prc.header}</span></legend>
        {include file="{$sys.uix.elm}/frm/dlg_error_form_validation.tpl"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_pkey.tpl"}

        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="GRAMMAGE NAME" 	name="wcrm_loyalty_product_grammage" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="NOTES" 	name="notes"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="PRICE" 	name="price"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_number.tpl" label="POINT" name="number"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="_OldGramID" name="_oldGramID"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/is_active.tpl"}
    </fieldset>
    {include file="{$sys.uix.elm}/frm/btn_crud.tpl"}
</form>