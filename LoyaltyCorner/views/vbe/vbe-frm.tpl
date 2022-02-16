<form action="/vbe/frm" method="post" class="smart-form">
	<header>
		Validate Receipt
	</header>
	<fieldset>
		<img src="http://103.90.251.10/{$dat.receipt_path}" width="100%" />
	</fieldset>
	<fieldset>
		<section>
			<input type="hidden" name="oid" value="{$dat.OID}" />
			<label class="label">Status Receipt</label>
			<label class="select">
				<select name="receipt_status_id" class="input-sm">
					<option value="0">Pending for Review</option>
					<option value="1">Valid Receipt</option>
					<option value="2">Invalid Receipt - Bukan Struk Beli Susu</option>
					<option value="3">Invalid Receipt - Struk Manual</option>
					<option value="4">Invalid Receipt - Struk Tidak Terbaca</option>
					<option value="5">Invalid Receipt - Struk Tidak Lengkap</option>
					<option value="6">Invalid Receipt - Struk Double Upload</option>
				</select> <i></i>
			</label>
		</section>
		<section>
			<label class="label">TRANS_POINT_OID (COPY-PASTE FORM SMART-CRM IF VALID-RECEIPT)</label>
			<label class="input">
				<input type="number" name="FK_RCV_ID" class="input-sm">
			</label>
		</section>
	</fieldset>
	<footer>
		<button type="submit" class="btn btn-primary">
			Submit
		</button>
	</footer>
</form>
