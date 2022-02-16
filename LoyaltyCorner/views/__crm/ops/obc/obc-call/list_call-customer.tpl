<fieldset>
    <legend><i class="fa fa-female"></i> <span class="font-lg txt-camo-earth">Mom / Dad</span>
        <small></small>
    </legend>
    <div class="row">
        <section class="col-md-6">
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text_view.tpl" label="#ID"     name="wcrm_account_id"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl" label="Mom / Dad" 	name="wcrm_account"}
            <div class="form-group">
                <label for="phone_number_1" class="col-md-3 control-label">Phone <span class="required">*</span></label>
                <div class="col-md-3">
                    <div class="input-group input-icon">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="number" class="form-control phone" id="phone_number_1_{$sys.req.rid}" name="phone_number_1" value="{$sys.rsp.dat.phone_number_1}" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group input-icon">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="number" class="form-control phone" title="Phone - 2"
                               id="phone_number_2_{$sys.req.rid}" name="phone_number_2" value="{$sys.rsp.dat.phone_number_2}" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group input-icon">
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                        <input type="number" class="form-control phone" title="Phone - 3"
                               id="phone_number_3_{$sys.req.rid}" name="phone_number_3" value="{$sys.rsp.dat.phone_number_3}" />
                    </div>
                </div>
            </div>
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_email.tpl"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"      label="Member-No" 		        name="member_no"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_boolean.tpl"   label="Sudah Member PC"         name="is_member_pc"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_boolean.tpl"   label="Bersedia didaftarkan"    name="is_willing_to_pc"}
        </section>
        <section class="col-md-6">
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_textarea.tpl"  label="Address" 	name="address"      title="Alamat"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"      label="Village"     name="address_2"    title="Kelurahan"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"      label="Distric" 	name="address_3"    title="Kecamatan"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select_group.tpl"                  rff=$sys.rsp.ref.wcrm_city}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_text.tpl"      label="Zip Code" 	name="zip_code"     title="Kode Pos"}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    rff=$sys.rsp.ref.wcrm_reward_pref_1}
            {include file="{$sys.uix.elm}/frm/bs-hrz/elm_select.tpl"    rff=$sys.rsp.ref.wcrm_reward_pref_2}
        </section>
    </div>
</fieldset>
<ul id="myCust" class="nav nav-tabs bordered">
    <li class="active"><a href="#cust-1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-child"></i> Children</a></li>
    <li><a href="#cust-2" data-toggle="tab" data-url="#520004220/{$sys.rsp.dat.wcrm_account_id}/call_hist"><i class="fa fa-fw fa-lg fa-gear"></i> Call History</a></li>
    <li><a href="#cust-3" data-toggle="tab" data-url="#520004220/{$sys.rsp.dat.wcrm_account_id}/careline"><i class="fa fa-fw fa-lg fa-phone"></i> Careline Contact</a></li>
    <li><a href="#cust-4" data-toggle="tab" data-url="#520004220/{$sys.rsp.dat.wcrm_account_id}/shipment"><i class="fa fa-fw fa-lg fa-ship"></i> Shipment</a></li>
    <li><a href="#cust-5" data-toggle="tab" data-url="#520004220/{$sys.rsp.dat.phone_number_1}/smsbox" class="refresh"><i class="fa fa-fw fa-lg fa-whatsapp"></i> SMS-Box</a></li>
</ul>

<div id="myCustContent" class="tab-content padding-10">
    <div class="tab-pane fade in active" id="cust-1">{include file="{$sys.uix.tpl}/obc-call/list_call-customer-children.tpl" data=$sys.rsp.child}</div>
    <div class="tab-pane fade" id="cust-2"></div>
    <div class="tab-pane fade" id="cust-3"></div>
    <div class="tab-pane fade" id="cust-4"></div>
    <div class="tab-pane fade" id="cust-5"></div>
</div>