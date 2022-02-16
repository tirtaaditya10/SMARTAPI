<h2 class="row-seperator-header txt-camo-earth"><i class="fa fa-phone"></i> Call Activity Base</h2>
<fieldset>
    <div class="row">
        <section class="col-md-4">
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text_view.tpl" label="Mom / Dad" 	name="wcrm_account"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text_view.tpl" label="Children" 	name="wcrm_contact"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text_view.tpl" label="Category" 	name="wcrm_campaign_type"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text_view.tpl" label="#CALL" 	    name="call_name"}
        </section>
        <section class="col-md-4">
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    rff=$sys.rsp.ref.wcrm_call_result   cfg=[disabled=>1]}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    rff=$sys.rsp.ref.wcrm_campaign_fail cfg=[readonly=>1]}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text_view.tpl" label="Follow-Up" 	name="call_next_on"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"      label="Best Time"   name="best_time" control=0}
        </section>
        <section class="col-md-4">
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_textarea.tpl"  label="Notes" 		name="call_notes" required=true}
        </section>
    </div>
</fieldset>