<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm form-horizontal" role="form">
    <fieldset>
        <legend><i class="fa fa-2x fa-database"></i> <span class="font-lg txt-camo-earth">{$sys.prc.sys_prc.header}</span></legend>
        {include file="{$sys.uix.elm}/frm/dlg_error_form_validation.tpl"}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_pkey.tpl"}
        &ensp;

        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Type:"               name="wcrm_inv_trans_dir" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Item ID:"            name="wcrm_reward" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Warehouse ID:"       name="wcrm_warehouse" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Purchase Order ID:"  name="po_no" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Order ID:  "         name="order_no" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Quantity:  "         name="qty" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Trans Category:"     name="wcrm_inv_trans_category" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Reference"           name="reference" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Trans Date:"         name="transacted_on" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Note:"               name="notes" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Created By:"         name="aaa_account" required=true}
        {include file="{$sys.uix.elm}/frm/bs-hrz/is_active.tpl"}
    </fieldset>
    {include file="{$sys.uix.elm}/frm/btn_close.tpl"}
</form>