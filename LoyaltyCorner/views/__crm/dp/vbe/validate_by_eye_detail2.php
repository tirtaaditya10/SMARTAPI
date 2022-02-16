<?php
#echo $cust_id = (isset ($this->input->get('cust_id', TRUE)))? $cust_id = $cust_id : $cust_id = "";exit();
?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
	.show-grid [class^="col-"] {
		padding-top: 10px;
		padding-bottom: 10px;
		background-color: rgba(61, 106, 124, 0.15);
		border: 1px solid rgba(61, 106, 124, 0.2);
	}

	.show-grid {
		margin-bottom: 15px;
	}
	
	th small {
		font-size:12px;
		display:block;
		color:#8D8D8D;
		font-weight:normal;
	}
	
/*
 * Responsive tests
 *
 * Generate a set of tests to show the responsive utilities in action.
 */

/* Responsive (scrollable) doc tables */
.table-responsive .highlight pre {
  white-space: normal;
}

/* Utility classes table  */
.bs-table th small,
.responsive-utilities th small {
  display: block;
  font-weight: normal;
  color: #999;
  font-size:12px;
}
.responsive-utilities tbody th {
  font-weight: normal;
}
.responsive-utilities td {
  text-align: center;
}
.responsive-utilities td.is-visible {
  color: rgba(61, 106, 124, 1);
  background-color: rgba(61, 106, 124, 0.07) !important;
}
.responsive-utilities td.is-hidden {
  color: #ccc;
  background-color: #f9f9f9 !important;
}

/* Responsive tests */
.responsive-utilities-test {
  margin-top: 5px;
}
.responsive-utilities-test .col-xs-6 {
  margin-bottom: 10px;
}
.responsive-utilities-test span {
  padding: 15px 10px;
  font-size: 14px;
  font-weight: bold;
  line-height: 1.1;
  text-align: center;
  border-radius: 4px;
}
.visible-on .col-xs-6 .hidden-xs,
.visible-on .col-xs-6 .hidden-sm,
.visible-on .col-xs-6 .hidden-md,
.visible-on .col-xs-6 .hidden-lg,
.hidden-on .col-xs-6 .visible-xs,
.hidden-on .col-xs-6 .visible-sm,
.hidden-on .col-xs-6 .visible-md,
.hidden-on .col-xs-6 .visible-lg {
  color: #999;
  border: 1px solid #ddd;
}
.visible-on .col-xs-6 .visible-xs,
.visible-on .col-xs-6 .visible-sm,
.visible-on .col-xs-6 .visible-md,
.visible-on .col-xs-6 .visible-lg,
.hidden-on .col-xs-6 .hidden-xs,
.hidden-on .col-xs-6 .hidden-sm,
.hidden-on .col-xs-6 .hidden-md,
.hidden-on .col-xs-6 .hidden-lg {
  color: #468847;
  background-color: #dff0d8;
  border: 1px solid #d6e9c6;
}
</style>
<?php 
	$sql = 'SELECT * 
		FROM upl_stage_customer 
		WHERE id="'.$cust_id.'"';

	$rst               = $this->db->query($sql)->result_array();
	$row               = $rst[0];
	$cust_name         = $row['custumer_name'];
	$cust_email        = $row['email'];
	$cust_member       = $row['custumer_name'];
	$cust_idtype       = "";
	$cust_joindate     = "";
	$cust_idno         = "";
	$cust_edu          = "";
	$cust_dob          = "";
	$cust_profession   = "";
	$cust_phone1       = $row['phone_number_1'];
	$cust_phone2       = $row['phone_number_2'];
	$address           = $row['address'];
	$province          = "";
	$city              = "";
    $rcp               = $row['upl_receipt_check_id'];
	
?>

<!-- MAIN PANEL -->
<div role="main">


	<!-- MAIN CONTENT -->
	<div>

		<div class="well">
		
		<div class="row">
			
			<div class="col-sm-12">
		
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="col-sm-3"></th>
							<th class="col-sm-3"></th>
							<th class="col-sm-3"></th>
							<th class="col-sm-3"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th>Customer</th>
							<td>: <?php echo $cust_name ?></td>
							<th>Email</th>
							<td>: <?php echo $cust_email ?></td>
						</tr>
						<tr>
							<th>Member ID</th>
							<td>: <?php echo $cust_member ?></td>
							<th>ID Type</th>
							<td>: <?php echo $cust_idtype ?></td>
						</tr>
						<tr>
							<th>Join Date</th>
							<td>: <?php echo $cust_joindate ?></td>
							<th>ID No</th>
							<td>: <?php echo $cust_idno ?></td>
						</tr>
						<tr>
							<th>Cust Name</th>
							<td>: <?php echo $cust_name ?></td>
							<th>Education</th>
							<td>: <?php echo $cust_edu ?></td>
						</tr>
						<tr>
							<th>Birth Date</th>
							<td>: <?php echo $cust_dob ?></td>
							<th>Profesional</th>
							<td>: <?php echo $cust_profession ?></td>
						</tr>
						<tr>
							<th>Phone Number 1</th>
							<td>: <?php echo $cust_phone1 ?></td>
							<th>Created by</th>
							<td>: </td>
						</tr>
						<tr>
							<th>Phone Number 2</th>
							<td>: <?php echo $cust_phone2 ?></td>
							<th colspan=2>
                                    <label class="select">
                                    <select id="receiptStat">
                                        <option value="40" <?php echo ($rcp == 40) ? 'selected' : ''; ?>>Not Yet Checked</option>
                                        <option value="41" <?php echo ($rcp == 41) ? 'selected' : ''; ?>>Valid Receipt</option>
                                        <option value="42" <?php echo ($rcp == 42) ? 'selected' : ''; ?>>Invalid Receipt</option>
                                    </select> <i></i> </label>
                                <button onclick="validate(<?php echo $cust_id; ?>)" class="btn btn-primary btn-sm">Submit</button>
                            </th>
						</tr>
						<tr>
							<th>Address</th>
							<td>: <?php echo $address ?></td>
							<th colspan=2></th>
						</tr>
						<tr>
							<th>Province</th>
							<td>: <?php echo $province ?></td>
							<th colspan=2></th>
						</tr>
						<tr>
							<th>City</th>
							<td>: <?php echo $city ?></td>
							<th colspan=2><button id="dialog_link" class="btn btn-primary btn-sm">Add point earning</button></th>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		</div>
	</div>
	<!-- END MAIN CONTENT -->

</div>

<div id="dialog_simple" title="Dialog Simple Title">
<?php
$cust_id = (isset($_REQUEST['cust_id'])? $period = $_REQUEST['cust_id'] : $period = NULL);
$period = (isset($_REQUEST['period'])? $period = $_REQUEST['period'] : $period = NULL);
$channel = (isset($_REQUEST['channel'])? $channel = $_REQUEST['channel'] : $channel = NULL);
$sub_channel = (isset($_REQUEST['sub_channel'])? $sub_channel = $_REQUEST['sub_channel'] : $sub_channel = NULL);
$trade_channel = (isset($_REQUEST['trade_channel'])? $trade_channel = $_REQUEST['trade_channel'] : $trade_channel = NULL);
$outlet_name = (isset($_REQUEST['outlet_name'])? $outlet_name = $_REQUEST['outlet_name'] : $outlet_name = NULL);
$outlet_location = (isset($_REQUEST['outlet_location'])? $outlet_location = $_REQUEST['outlet_location'] : $outlet_location = NULL);
$received_date = (isset($_REQUEST['received_date'])? $received_date = $_REQUEST['received_date'] : $received_date = NULL);
$transaction_date = (isset($_REQUEST['transaction_date'])? $transaction_date = $_REQUEST['transaction_date'] : $transaction_date = NULL);
$product = (isset($_REQUEST['product'])? $product = $_REQUEST['product'] : $product = NULL);
$product_grammage = (isset($_REQUEST['product_grammage'])? $product_grammage = $_REQUEST['product_grammage'] : $product_grammage = NULL);
$product_qty = (isset($_REQUEST['product_qty'])? $product_qty = $_REQUEST['product_qty'] : $product_qty = NULL);
$unit_price = (isset($_REQUEST['unit_price'])? $unit_price = $_REQUEST['unit_price'] : $unit_price = NULL);
$point_bonus = (isset($_REQUEST['point_bonus'])? $point_bonus = $_REQUEST['point_bonus'] : $point_bonus = NULL);
$point = (isset($_REQUEST['point'])? $point = $_REQUEST['product'] : $point = NULL);

?>
	<form id="point_form" class="smart-form">
        <fieldset>
            <div class="col-md-5">
            <section>
                <div class="row">
                    <label class="label col col-3">Period </label>
                    <div class="col col-4">:
					<select name="period" id="period">
						<option value="NULL">N/A</option>
						<option value="7" <?php if($period=="PHP") echo 'selected="selected"'; ?> >REGULAR PROGRAM</option>
						<option value="1" <?php if($period=="PHP") echo 'selected="selected"'; ?> >DEC 2015-DEC 2016</option>
						<option value="5" <?php if($period=="PHP") echo 'selected="selected"'; ?> >REGULAR PROGRAM</option>
					</select>
                    </div>
                </div>
            </section>

            <section>
                <div class="row">
                    <label class="label col col-3">Channel </label>
                    <div class="col col-4">:
					<select name="channel">
						<option value="NULL">N/A</option>
						<option value="PHP" <?php if($channel=="PHP") echo 'selected="selected"'; ?> >BP MOBILE</option>
						<option value="PHP" <?php if($channel=="PHP") echo 'selected="selected"'; ?> >DIGITAL</option>
						<?php /*#$result= mysql_query('SELECT DISTINCT year FROM id ORDER BY year'); ?>
						<?php #while($row= mysql_fetch_assoc($result)) { ?>
							<option <?php if ($row['year']==$year) { ?>selected="selected"<?php } ?>>
								<?php echo htmlspecialchars($row['year']); ?>
							</option>
						<?php #}*/ ?>
					</select>
                    </div>
                </div>
            </section>
            
            <section>
                <div class="row">
                    <label class="label col col-3">Sub Channel </label>
                    <div class="col col-4">:
					<select name="sub_channel">
						<option value="NULL">N/A</option>
						<option value="PHP" <?php if($sub_channel=="PHP") echo 'selected="selected"'; ?> >WHATSAPP</option>
						<option value="PHP" <?php if($sub_channel=="PHP") echo 'selected="selected"'; ?> >EMAIL</option>
						<?php /*#$result= mysql_query('SELECT DISTINCT year FROM id ORDER BY year'); ?>
						<?php #while($row= mysql_fetch_assoc($result)) { ?>
							<option <?php if ($row['year']==$year) { ?>selected="selected"<?php } ?>>
								<?php echo htmlspecialchars($row['year']); ?>
							</option>
						<?php #}*/ ?>
					</select>
                    </div>
                </div>
            </section>
            
            <section>
                <div class="row">
                    <label class="label col col-3">Trade Channel </label>
                    <div class="col col-4">:
					<select name="trade_channel">
						<option value="NULL">N/A</option>
						<option value="PHP" <?php if($trade_channel=="PHP") echo 'selected="selected"'; ?> >GT</option>
						<option value="PHP" <?php if($trade_channel=="PHP") echo 'selected="selected"'; ?> >MTI</option>
						<option value="PHP" <?php if($trade_channel=="PHP") echo 'selected="selected"'; ?> >MTKA</option>
						<?php /*#$result= mysql_query('SELECT DISTINCT year FROM id ORDER BY year'); ?>
						<?php #while($row= mysql_fetch_assoc($result)) { ?>
							<option <?php if ($row['year']==$year) { ?>selected="selected"<?php } ?>>
								<?php echo htmlspecialchars($row['year']); ?>
							</option>
						<?php #}*/ ?>
					</select>
                    </div>
                </div>
            </section>
            
            <section>
                <div class="row">
                    <label class="label col col-3">Outlet Name</label>
                    <div class="col col-4">:
					<select name="outlet_name">
						<option value="NULL">N/A</option>
						<option value="PHP" <?php if($outlet_name=="PHP") echo 'selected="selected"'; ?> >CAREFOUR</option>
						<option value="PHP" <?php if($outlet_name=="PHP") echo 'selected="selected"'; ?> >GIANT DFI</option>
						<option value="PHP" <?php if($outlet_name=="PHP") echo 'selected="selected"'; ?> >LOTTEMART</option>
						<?php /*#$result= mysql_query('SELECT DISTINCT year FROM id ORDER BY year'); ?>
						<?php #while($row= mysql_fetch_assoc($result)) { ?>
							<option <?php if ($row['year']==$year) { ?>selected="selected"<?php } ?>>
								<?php echo htmlspecialchars($row['year']); ?>
							</option>
						<?php #}*/ ?>
					</select>
                    </div>
                </div>
            </section>
            
            <section>
                <div class="row">
                    <label class="label col col-3">Outlet Location</label>
                    <div class="col col-4">:
					<select name="outlet_location">
						<option value="NULL">N/A</option>
						<?php /*#$result= mysql_query('SELECT DISTINCT year FROM id ORDER BY year'); ?>
						<?php #while($row= mysql_fetch_assoc($result)) { ?>
							<option <?php if ($row['year']==$year) { ?>selected="selected"<?php } ?>>
								<?php echo htmlspecialchars($row['year']); ?>
							</option>
						<?php #}*/ ?>
					</select>
                    </div>
                </div>
            </section>
            
            <section>
                <div class="row">
                    <label class="label col col-3">Received Date</label>
                    <div class="col col-4">:
                        <label class="input">
                            <input type="text" name="received_date">
                        </label>
                    </div>
                </div>
            </section>
            
            <section>
                <div class="row">
                    <label class="label col col-3">Transaction Date</label>
                    <div class="col col-4">:
                        <label class="input">
                            <input type="text" name="transaction_date">
                        </label>
                    </div>
                </div>
            </section>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5">
			<section>
				<div class="row">
				<label class="label col col-4">Product</label>
                    <div class="col col-4">:
					<select name="product">
						<option value="NULL">N/A</option>
						<?php /*#$result= mysql_query('SELECT DISTINCT year FROM id ORDER BY year'); ?>
						<?php #while($row= mysql_fetch_assoc($result)) { ?>
							<option <?php if ($row['year']==$year) { ?>selected="selected"<?php } ?>>
								<?php echo htmlspecialchars($row['year']); ?>
							</option>
						<?php #}*/ ?>
					</select>
					</div>
				</div>
			</section>

			<section>
				<div class="row">
					<label class="label col col-4">Product Grammage</label>
                    <div class="col col-4">:
					<select name="product_grammage">
						<option value="NULL">N/A</option>
						<?php /*#$result= mysql_query('SELECT DISTINCT year FROM id ORDER BY year'); ?>
						<?php #while($row= mysql_fetch_assoc($result)) { ?>
							<option <?php if ($row['year']==$year) { ?>selected="selected"<?php } ?>>
								<?php echo htmlspecialchars($row['year']); ?>
							</option>
						<?php #}*/ ?>
					</select>
					</div>
				</div>
			</section>

			<section>
				<div class="row">
					<label class="label col col-4">Qty</label>
                    <div class="col col-4">:
					<select name="product_qty">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">>10</option>
					</select>
					</div>
				</div>
			</section>

			<section>
				<div class="row">
					<label class="label col col-4">Price per unit</label>
                    <div class="col col-4">:
						<label class="input">
							<input type="text" name="unit_price">
						</label>
					</div>
				</div>
			</section>

			<section>
				<div class="row">
					<label class="label col col-4">Percent bonus point</label>
                    <div class="col col-4">:
						<label class="input">
							<input type="text" name="point_bonus">
						</label>
					</div>
				</div>
			</section>

			<section>
				<div class="row">
					<label class="label col col-4">Total point</label>
                    <div class="col col-4">:
						<label class="input">
							<input type="text" name="point" id="point">
						</label>
					</div>
				</div>
			</section>
            </div>
        </fieldset>
    </form>	
</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<script>
    $('#dialog_link').click(function() {
        $('#dialog_simple').dialog('open');
        return false;

    });

    $('#dialog_simple').dialog({
        autoOpen : false,
        width : 1000,
        resizable : false,
        modal : true,
        title : "Point Trans",
        buttons : [{
            html : "<i class='fa fa-save'></i>&nbsp; Save",
            "class" : "btn btn-primary",
            click : function() {
                addpoint();
            }
        }, {
            html : "<i class='fa fa-times'></i>&nbsp; Cancel",
            "class" : "btn btn-default",
            click : function() {
                $(this).dialog("close");
            }
        }]
    });
    
    function validate(ID) {
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/validateReceipt',
            data: {
                ID: ID,
                status:  $('#receiptStat').val()
            },
            cache: false,
            success: function(data) {
                console.log(data + "--" + ID);
                if(data == 'success'){
                    swal("Success", "", "success");
                } else {
                    swal("Failed", "", "error");
                }
            }
        });
    }
	
    function addpoint(ID) {
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/addpoint',
            data: {
                period: $('#period').val(),
                point:  $('#point').val()
            },
            cache: false,
            success: function (response) {
                console.log(response);
                if(data == 'success'){
                    swal("Success", "", "success");
                } else {
                    swal("Failed", "", "error");
                }
            }
        });
    }
</script>

<?php
#INSERT INTO wcrm_loyalty_member_point (wcrm_loyalty_member_id, wcrm_loyalty_period_id, total_point, aaa_account_id, created_on, aaa_account_upd_id, updated_in)
#values ("","","","","","","",)

?>

