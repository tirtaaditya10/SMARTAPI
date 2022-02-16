<?php
/* Smarty version 3.1.33, created on 2021-12-19 00:16:18
  from '/home/site/wwwroot/LoyaltyCorner/views/vbe/vbe-frm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_61be1762dfc9c4_85440341',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '31088a35c6c6055616c5cf362b40edda09d7c587' => 
    array (
      0 => '/home/site/wwwroot/LoyaltyCorner/views/vbe/vbe-frm.tpl',
      1 => 1639847775,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61be1762dfc9c4_85440341 (Smarty_Internal_Template $_smarty_tpl) {
?><form action="/vbe/frm" method="post" class="smart-form">
	<header>
		Validate Receipt
	</header>
	<fieldset>
<?php echo '<?php
';?>$image = '/fs-smart-1/receipt/2021/12/1059166_1639066530.png';

$imageData = base64_encode(file_get_contents($image));

$src = 'data: '.mime_content_type($image).';base64,'.$imageData;

echo '<img src="' . $src . '" width="100%" /> ';

<?php echo '?>';?>
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
					<option value="13">Invalid Receipt - Usia si Kecil Belum Genap 1 Tahun</option>
					<option value="14">Invalid Receipt - Nama Toko Belum Terdaftar</option>

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
