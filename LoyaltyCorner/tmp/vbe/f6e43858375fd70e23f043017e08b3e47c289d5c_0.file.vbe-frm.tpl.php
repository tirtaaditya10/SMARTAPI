<?php
/* Smarty version 3.1.33, created on 2020-01-19 05:42:21
  from '/var/www/sandapi/views/vbe/vbe-frm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e2389cd33ae32_74955043',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f6e43858375fd70e23f043017e08b3e47c289d5c' => 
    array (
      0 => '/var/www/sandapi/views/vbe/vbe-frm.tpl',
      1 => 1579387334,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e2389cd33ae32_74955043 (Smarty_Internal_Template $_smarty_tpl) {
?><form action="/vbe/frm" method="post" class="smart-form">
	<header>
		Validate Receipt
	</header>
	<fieldset>
		<img src="http://103.90.251.10/<?php echo $_smarty_tpl->tpl_vars['dat']->value['receipt_path'];?>
" width="100%" />
	</fieldset>
	<fieldset>
		<section>
			<input type="hidden" name="oid" value="<?php echo $_smarty_tpl->tpl_vars['dat']->value['OID'];?>
" />
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
					<option value="8">Invalid Receipt - Invalid Receipt - Struk produk dibawah 1 tahun</option>
					<option value="9">Invalid Receipt - Invalid Receipt - Struk ECommerce tidak sesuai</option>
					<option value="10">Invalid Receipt - Invalid Receipt - Struk Sudah Invalid 1 Bulan</option>
					<option value="11">Invalid Receipt - Invalid Receipt - Struk Copy/Reprint/Cetak Ulang</option>
					<option value="12">Invalid Receipt - Invalid Receipt - Struk Product Specialist</option>
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
<?php }
}
