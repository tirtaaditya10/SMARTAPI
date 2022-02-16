<?php



?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div role="main">
	<!-- MAIN CONTENT -->
	<div>
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa fa-table fa-fw "></i> Customer Staging</h1>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
			</div>
		</div>

		<!-- widget grid -->
		<section id="widget-grid" class="">
			<!-- row -->
			<div class="row">
				<!-- NEW WIDGET START -->
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-1" data-widget-editbutton="false">
						<!-- widget options:
						usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

						data-widget-colorbutton="false"
						data-widget-editbutton="false"
						data-widget-togglebutton="false"
						data-widget-deletebutton="false"
						data-widget-fullscreenbutton="false"
						data-widget-custombutton="false"
						data-widget-collapsed="true"
						data-widget-sortable="false"

						-->
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						</header>

						<!-- widget div-->
						<div>

							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->

							</div>
							<!-- end widget edit box -->

							<!-- widget content -->
							<div class="widget-body no-padding"><div style = "width:100%">
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Cust Name</th>
											<th>Procom Date</th>
											<th>Child Birth Date</th>
											<th>Child Name</th>
											<th>Phone Number 1</th>
											<th>Phone Number 2</th>
											<th>Address</th>
											<th>Email</th>
											<th>Data Type</th>
											<th>Product Category</th>
											<th>Area</th>
											<!--th>Sub Area</th>
											<th>DM</th>
											<th>TL</th>
											<th>BP</th>
											<th>Channel</th>
											<th>Source</th>
											<th>Sub Source</th>
											<th>Promo Activity</th>
											<th>Sub Promo Activity</th>
											<th>Gimmick</th>
											<th>Previous Product</th>
											<th>Actual Product</th>
											<th>Grammage</th-->
											<th>Qty</th>
											<th>Struk</th>
											<th>Batch_ID</th>
											<th>Start Use Product</th>
											<th>Created By</th>
											<th>Created On</th>
										</tr>
									</thead>
									<tbody>
                                <?php
								$query = 'SELECT a.custumer_name,
											a.acq_date,
											a.children_birthday,
											a.children_name,
											a.phone_number_1,
											a.phone_number_2,
											a.address,
											a.email,
											a.upl_data_type_id,
											aa.wcrm_product_list,
											bb.wcrm_region,
											a.qty,
											a.wcrm_struk_id,
											a.batch_sampling,
											a.aaa_account_id,
											a.created_on
										FROM upl_staging_customer a
											LEFT JOIN wcrm_product_list aa ON aa.wcrm_product_category_id = a.wcrm_product_category_id
											LEFT JOIN wcrm_region bb ON bb.id_code = a.wcrm_region_id
										WHERE wrcm_screening_reason_id IS NULL
										ORDER BY a.created_on DESC LIMIT 500';
								$getData = $this->db->query($query);
								foreach ($getData->result() as $value) {								
								$param1 = $value->custumer_name;
								$param2 = $value->acq_date;
								$param3 = $value->children_birthday;
								$param4 = $value->children_name;
								$param5 = $value->phone_number_1;
								$param6 = $value->phone_number_2;
								$param7 = $value->address;
								$param8 = $value->email;
								$param9 = $value->upl_data_type_id;
								$param10 = $value->wcrm_product_list;
								$param11 = $value->wcrm_region;
/*								$param12 = $row['SubArea'];
								$param13 = $row['NamaDM'];
								$param14 = $row['NamaTL'];
								$param15 = $row['NamaBP'];
								$param16 = $row['Channel'];
								$param17 = $row['Source'];
								$param18 = $row['SubSource'];
								$param19 = $row['AktivitasPromo'];
								$param20 = $row['SubAktivitasPromo'];
								$param21 = $row['Gimmick'];
								$param22 = $row['AsalUsulProduct'];
								$param23 = $row['ActualProduct'];
								$param24 = $row['Gramasi'];
*/								$param25 = $value->qty;
								$param26 = $value->wcrm_struk_id;
								$param27 = $value->batch_sampling;
#								$param28 = $value->StartUsedProduct;
								$param29 = $value->aaa_account_id;
								$param30 = $value->created_on;
								?>									
										<tr>
											<td><?php echo $param1; ?></td>
											<td><?php echo $param2; ?></td>
											<td><?php echo $param3; ?></td>
											<td><?php echo $param4; ?></td>
											<td><?php echo $param5; ?></td>
											<td><?php echo $param6; ?></td>
											<td><?php echo $param7; ?></td>
											<td><?php echo $param8; ?></td>
											<td><?php echo $param9; ?></td>
											<td><?php echo $param10; ?></td>
											<td><?php echo $param11; ?></td>
											<!--td><?php echo $param12; ?></td>
											<td><?php echo $param13; ?></td>
											<td><?php echo $param14; ?></td>
											<td><?php echo $param15; ?></td>
											<td><?php echo $param16; ?></td>
											<td><?php echo $param17; ?></td>
											<td><?php echo $param18; ?></td>
											<td><?php echo $param19; ?></td>
											<td><?php echo $param20; ?></td>
											<td><?php echo $param21; ?></td>
											<td><?php echo $param22; ?></td>
											<td><?php echo $param23; ?></td>
											<td><?php echo $param24; ?></td-->
											<td><?php echo $param25; ?></td>
											<td><?php echo $param26; ?></td>
											<td><?php echo $param27; ?></td>
											<!--td><?php echo $param28; ?></td-->
											<td><?php echo $param29; ?></td>
											<td><?php echo $param30; ?></td>
										</tr>
                                <?php } ?>
									</tbody>
								</table>
								</div>
							</div>
							<!-- end widget content -->

						</div>
						<!-- end widget div -->

					</div>
					<!-- end widget -->

				</article>
				<!-- WIDGET END -->

			<!-- end row -->

		</section>
		<!-- end widget grid -->

	</div>
	<!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script>

	$(document).ready(function() {
		// PAGE RELATED SCRIPTS
	})

</script>
