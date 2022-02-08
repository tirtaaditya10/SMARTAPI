<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
    <fieldset>
        <legend><i class="fa fa-2x fa-database"></i> <span class="font-lg txt-camo-earth">{$sys.prc.sys_prc.header}</span></legend>

        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Product Name" 	name="wcrm_loyalty_product" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Category" 	name="category"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Notes" 	name="notes"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="_OldProdID" 	name="_OldProdID"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_number.tpl" label="Order No" name="order_no"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/is_active.tpl"}
    </fieldset>
    {include file="{$sys.uix.elm}/frm/btn_crud.tpl"}
</form>

