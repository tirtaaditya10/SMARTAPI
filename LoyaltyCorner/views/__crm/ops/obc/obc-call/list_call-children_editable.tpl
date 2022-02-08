<fieldset>
    <legend><i class="fa fa-2x fa-child"></i><span class="font-lg txt-camo-earth">{$sys.rsp.dat.wcrm_contact}</span></legend>
    <div class="row">
        <section class="col-md-6">
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"              label="Mom / Dad" 	name="wcrm_account" cfg=[readonly=>1]}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"              label="Children"    name="wcrm_contact" cfg=[required=>1]}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"              grid_22=6 cfg_1=[type=>"datepicker"]    cfg_2=[type=>"text", readonly=>1]
                    label_1="Acq-Date" 		name_1="acq_date"
                                            name_2="age_acq"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"              grid_22=6 cfg_1=[type=>"datepicker"]    cfg_2=[type=>"text", readonly=>1]
                    label_1="Birthday" 	    name_1="children_birthday"          name_2="age_now" }
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"              cfg_1=[type=>"number", l_icon=>"kg"]    cfg_2=[type=>"number", l_icon=>"cm"]
                    label_1="Berat" 	    name_1="body_weight"
                    label_2="Tinggi" 	    name_2="body_height"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"              cfg_1=[type=>"checkbox_inline"]         cfg_2=[type=>"checkbox_inline"]
                    label_1="Loyal User" 	    name_1="is_loyal_user"
                    label_2="Laps User" 	    name_2="is_laps_user"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"              label="Prev. Product"       name="wcrm_product_list_prev"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"              label="Actual Product"      name="wcrm_product_list_actual"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"              cfg_1=[type=>"select"]      cfg_2=[type=>"text"]
                    label_1="Usage Duration" 	name_1="wcrm_duration_of_use"   grid_11=4 grid_21=2
                    label_2="Usage Length" 	    name_2="body_height"}
        </section>
        <section class="col-md-6">
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"              cfg_1=[type=>"select"]      cfg_2=[type=>"select"]
                label_1="Data Type" 	    name_1="upl_data_type"
                label_2="Product Category" 	name_2="wcrm_product_category"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"              cfg_1=[type=>"select"]      cfg_2=[type=>"text"]
                label_1="Channel Trade" 	name_1="wcrm_channel_trade"
                label_2="Misc" 	            name_2="body_height"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"              cfg_1=[type=>"select"]      cfg_2=[type=>"select"]
                label_1="Region" 	        name_1="wcrm_region"
                label_2="Sub-Region" 	    name_2="wcrm_region_sub"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"              cfg_1=[type=>"select"]      cfg_2=[type=>"select"]
                label_1="DM" 	            name_1="wcrm_district_manager"
                label_2="TL" 	            name_2="wcrm_team_leader"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"            rff=$sys.rsp.ref.wcrm_brand_presenter}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"              cfg_1=[type=>"select"]      cfg_2=[type=>"number"]
                label_1="Receipt" 	        name_1="wcrm_receipt"
                label_2="QTY" 	            name_2="qty"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"              cfg_1=[type=>"select"]      cfg_2=[type=>"select"]
                label_1="Promo" 	        name_1="wcrm_promo_activity"
                name_2="wcrm_promo_activity_sub"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"            rff=$sys.rsp.ref.wcrm_gimmick}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"              label="Batch"    name="upl_logs"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_dual.tpl"              cfg_1=[type=>"text"]        cfg_2=[type=>"text"]
                label_1="Created by" 	    name_1="aaa_account"
                label_2="Created on" 	    name_2="created_on"}
        </section>
    </div>
</fieldset>