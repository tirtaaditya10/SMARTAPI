<fieldset>
    <div class="row">
        <section class="col-md-6">
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    name="wcrm_camp_follow_up_result"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_textarea.tpl"  name="fu_note_response"    label="Response Note"}
        </section>
        <section class="col-md-6">
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_textarea.tpl"  name="fu_note"  label="Request Note"}
        </section>
    </div>
</fieldset>