<fieldset>
    <div class="row">
        <section class="col-md-6">
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_camp_conf_result"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_camp_conf_result_sub"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_camp_conf_do_reason"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_camp_conf_reason"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_camp_conf_recommendation"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_receipt"}
        </section>
        <section class="col-md-6">
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_gimmick"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_presentment_vol_prev"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_presentment_freq_prev"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_checkbox_inline.tpl"  name="has_ae_complaint" label="Has AE Complaint"}
        </section>
    </div>
</fieldset>