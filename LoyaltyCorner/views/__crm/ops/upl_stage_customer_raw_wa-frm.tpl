<form id="F{$sys.req.rid}{$sys.req.pid}" method="post" action="#{$sys.req.rid}/{$sys.req.pid}" class="cForm smart-form" role="form">
	<legend><i class="fa fa-2x fa-database"></i> <span class="font-lg txt-camo-earth">{$sys.prc.sys_process|upper}</span></legend>
	<fieldset>
		<div class="col-sm-12 col-md-12 col-lg-6">
			<fieldset>
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_text_icon.tpl" label="Acq. Data" 	name="acq_date" icon="fa fa-calendar"}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_text_icon.tpl" label="Mom. Name" 	name="customer_name" icon="fa fa-female"}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_text_icon.tpl" label="Child. Name" 	name="children_name" icon="fa fa-child"}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_text_icon.tpl" label="Child. Birth" 	name="children_birthday" icon="fa fa-calendar"}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_text_icon.tpl" label="Phone 1" 		name="phone_number_1" icon="fa fa-mobile"}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_text_icon.tpl" label="Phone 2" 		name="phone_number_2" icon="fa fa-mobile"}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_textarea_resize.tpl" label="Address" name="address"}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_text_icon.tpl"	label="Email" 		name="email" icon="fa fa-email"}

				{include file="{$sys.uix.elm}/frm/bs-smart/elm_select.tpl" 		rff=$sys.rsp.ref.upl_data_type}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_select.tpl" 		rff=$sys.rsp.ref.wcrm_product_category}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_select.tpl" 		rff=$sys.rsp.ref.wcrm_channel_trade}
				<section>
					<label class="label">Upload Receipt</label>
					<div class="input input-file">
						<span class="button"><input type="file" id="file" name="file" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
					</div>
				</section>
			</fieldset>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-6">
			<fieldset>
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_select.tpl" 		rff=$sys.rsp.ref.wcrm_region}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_select.tpl" 		rff=$sys.rsp.ref.wcrm_region_sub}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_select.tpl" 		rff=$sys.rsp.ref.wcrm_promo_activity}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_select.tpl" 		rff=$sys.rsp.ref.wcrm_promo_activity_sub}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_select.tpl" 		rff=$sys.rsp.ref.wcrm_gimmick}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_select.tpl" 		rff=$sys.rsp.ref.wcrm_product_list_prev}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_select.tpl" 		rff=$sys.rsp.ref.wcrm_product_list_actual}
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_select.tpl" 		rff=$sys.rsp.ref.wcrm_grammage}
				<section>
					<label class="label">Quantity</label>
					<label class="select">
						<select id="quantity" name="quantity">
							<option value="null">Choose Quantity</option>
							
							<option value=">10">>10</option>
						</select> <i></i>
					</label>
				</section>
				{include file="{$sys.uix.elm}/frm/bs-smart/elm_text.tpl" 		label="Batch No" 	name="batch_no"}
			</fieldset>
		</div>
		<footer>
			<button type="submit" class="btn btn-primary">
				Submit
			</button>
			<button type="button" class="btn btn-default" onclick="window.history.back();">
				Back
			</button>
		</footer>
	</fieldset>
	{include file="{$sys.uix.elm}/frm/btn_crud.tpl"}
</form>