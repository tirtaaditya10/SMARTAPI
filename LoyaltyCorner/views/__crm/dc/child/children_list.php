<?php



?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div role="main">
	<!-- MAIN CONTENT -->
	<div>
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa fa-table fa-fw "></i> Children List</h1>
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

											<th>Child Name</th>
											<th>Customer ID</th>
											<th>Acq Date</th>
											<th>Child Birth Date</th>
											<th>Acq Age</th>
											<th>Age Now</th>
											<th>Duration Of Use</th>
											<th>Dur Of Use Now</th>
											<th>Berat Badan</th>
											<th>Tinggi Badan</th>
											<th>Laps User</th>
											<th>Loyal User</th>
											<th>Switch Back Reason</th>
											<th>Prev Prod Before DO</th>
											<th>Data Type</th>
											<th>Product Category</th>
											<th>Area</th>
											<th>Sub Area</th>
											<th>Source</th>
											<th>Sub Source</th>
											<th>Previous Product</th>
											<th>Actual Product</th>
											<th>DEBatch</th>
											<th>Created By</th>
											<th>Created On</th>
											<th>Oid</th>
											<th>Updated By</th>
											<th>Updated On</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$query = 'SELECT a.* 
										FROM  wcrm_contact a
										ORDER BY a.created_on DESC LIMIT 500';
									$getData = $this->db->query($query);
									foreach ($getData->result() as $value):
									{
									?>
										<tr>
											<td><?php echo $value->wcrm_contact;  ?></td>
											<td><?php echo $value->wcrm_account_id;  ?></td>
											<td><?php echo $value->acq_date;  ?></td>
											<td><?php echo date("Y-m-d",strtotime($value->children_birthday));  ?></td>
											<td><?php echo '';  ?></td>
											<td><?php echo '';  ?></td>
											<td><?php echo '';  ?></td>
											<td><?php echo '';  ?></td>
											<td><?php echo '';  ?></td>
											<td><?php echo '';  ?></td>
											<td><?php echo '';  ?></td>
											<td><?php echo ($value->is_loyal_user == '1'?'YES':'NO');  ?></td>
											<td><?php echo '';  ?></td>
											<td><?php echo '';  ?></td>
											<td><?php echo '';  ?></td>
											<td><?php echo $value->upl_data_type_id;  ?></td>
											<td><?php echo $value->wcrm_product_category_id;  ?></td>
											<td><?php echo $value->wcrm_region_id;  ?></td>
											<td><?php echo $value->wcrm_region_sub_id;  ?></td>
											<td><?php echo $value->source_val;  ?></td>
											<td><?php echo $value->source_sub_val;  ?></td>
											<td><?php echo $value->wcrm_product_list_prev_id;  ?></td>
											<td><?php echo $value->wcrm_product_list_actual_id;  ?></td>
											<td><?php echo $value->batch_sampling;  ?></td>
											<td><?php echo $value->aaa_account_id;  ?></td>
											<td><?php echo $value->created_on;  ?></td>
											<td><?php echo $value->id;  ?></td>
											<td><?php echo $value->aaa_account_upd_id;  ?></td>
											<td><?php echo $value->updated_on;  ?></td>
										</tr>
									<?php 
									}
									?>
									<?php endforeach ?>
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
