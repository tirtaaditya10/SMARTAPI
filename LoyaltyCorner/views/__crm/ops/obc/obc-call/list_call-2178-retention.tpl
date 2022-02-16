<fieldset>
    <legend><i class="fa fa-2x fa-phone"></i> <span class="font-lg txt-camo-earth"{$sys.rsp.dat.wcrm_campaign_type|default:'RETENTION'}</span></legend>
    <div class="row">
        <section class="col-md-6">
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_camp_retention_result"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_camp_retention_result_sub"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_camp_retention_still_use"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_product_list_prev"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_product_list_actual"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_camp_retention_do_reason"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_triple.tpl"    cfg_1=[type=>"select"]    cfg_2=[type=>"number"]    cfg_3=[type=>"number"]
            label_1="Freq. Store Channel" 	    name_1="wcrm_channel_trade"
            name_2="freq_store_1"
            name_3="freq_store_2"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_checkbox_inline.tpl"  name="has_ae_complaint" label="Has AE Complaint"}
        </section>
        <section class="col-md-6">
            <h3>Daily Consumption</h3>
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"    cfg_1=[type=>"select"]    cfg_2=[type=>"select"]
            label_1="Vol. #1" 	    name_1="wcrm_presentment_vol_1"
            label_1="Freq. #1" 	    name_2="wcrm_presentment_freq_1"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"    cfg_1=[type=>"select"]    cfg_2=[type=>"select"]
            label_1="Vol. #2" 	    name_1="wcrm_presentment_vol_2"
            label_1="Freq. #2" 	    name_2="wcrm_presentment_freq_2"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"    cfg_1=[type=>"select"]    cfg_2=[type=>"select"]
            label_1="Vol. #3" 	    name_1="wcrm_presentment_vol_3"
            label_1="Freq. #3" 	    name_2="wcrm_presentment_freq_3"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"    cfg_1=[type=>"select"]    cfg_2=[type=>"select"]
            label_1="Vol. #4" 	    name_1="wcrm_presentment_vol_4"
            label_1="Freq. #4" 	    name_2="wcrm_presentment_freq_4"}
            <h3>Monthly Consumption</h3>
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_triple.tpl"    cfg_1=[type=>"select"]    cfg_2=[type=>"select"]    cfg_3=[type=>"select"]
            label_1="Month #1" 	    name_1="wcrm_product_category_1"
            name_2="wcrm_grammage_1"
            name_3="wcrm_serve_freq_prod_cat_1"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_triple.tpl"    cfg_1=[type=>"select"]    cfg_2=[type=>"select"]    cfg_3=[type=>"select"]
            label_1="Month #2" 	    name_1="wcrm_product_category_2"
            name_2="wcrm_grammage_2"
            name_3="wcrm_serve_freq_prod_cat_2"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_triple.tpl"    cfg_1=[type=>"select"]    cfg_2=[type=>"select"]    cfg_3=[type=>"select"]
            label_1="Month #3" 	    name_1="wcrm_product_category_3"
            name_2="wcrm_grammage_3"
            name_3="wcrm_serve_freq_prod_cat_3"}
        </section>
    </div>
</fieldset>