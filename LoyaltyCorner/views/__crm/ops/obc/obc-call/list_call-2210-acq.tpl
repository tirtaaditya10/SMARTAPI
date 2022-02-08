<fieldset>
    <div class="row">
        <section class="col-md-6">
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"            name="wcrm_camp_acquisition_result"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"              cfg_1=[type=>"checkbox_inline"]    cfg_2=[type=>"checkbox_inline"]
            label_1="Terima Sample ?" 	    name_1="is_recieve_sample"
            label_2="Sudah Dicoba ?" 	    name_2="is_try_sample"}

            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"            name="wcrm_why_not_try"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"            name="wcrm_presentment_vol"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"            name="wcrm_presentment_freq"}
        </section>
        <section class="col-md-6">
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_checkbox_inline.tpl"   name="is_buy_again"         label="Sudah Beli Lagi ?"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"            name="wcrm_why_not_buy_again"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"              name="buy_place"            label="Tempat Membeli"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"            name="wcrm_product_grammage"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"            name="wcrm_why_buy_again"}
        </section>
    </div>
</fieldset>