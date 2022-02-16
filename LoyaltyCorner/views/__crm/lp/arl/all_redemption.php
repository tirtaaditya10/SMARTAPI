<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div role="main">
	<!-- MAIN CONTENT -->
	<div>
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa fa-table fa-fw "></i> All Redemption List</h1>
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
											<th>Member</th>
											<th>Old Redeem Id</th>
											<th>Member name</th>
											<th>Phone number</th>
											<th>Delivery address</th>
											<th>Period</th>
											<th>Channel Id</th>
											<th>Sub Channel</th>
											<th>Radeem Date</th>
											<th>Reward Id</th>
											<th>Qty</th>
											<th>Total Point</th>
											<th>Status</th>
											<th>Shipment Id</th>
											<th>Shipment Status</th>
											<th>Old System Status</th>
											<th>Created By</th>
											<th>Crated On</th>
										</tr>
                                    </thead>
									<tbody>
									<?php 
									foreach ($redeem_list as $data):
									{
									?>
										<tr>
											<td><?php echo $data->member_no; ?></td>
											<td><?php echo $data->_oldRedeemId; ?></td>
											<td><?php echo $data->wcrm_loyalty_member; ?></td>
											<td><?php echo $data->phone_number_1; ?></td>
											<td><?php echo $data->wcrm_address_id; ?></td>
											<td><?php echo $data->wcrm_loyalty_channel; ?></td>
											<td><?php echo $data->redeemed_on; ?></td>
											<td><?php echo $data->wcrm_reward; ?></td>
											<td><?php echo $data->total_point; ?></td>
											<td><?php echo $data->redeem_status; ?></td>
											<td><?php echo $data->wcrm_shipment_id; ?></td>
											<td><?php echo $data->_oldStatus; ?></td>
											<td><?php echo $data->wcrm_loyalty_period; ?></td>
											<td><?php echo $data->qty; ?></td>
											<td><?php echo $data->wcrm_loyalty_channel_sub; ?></td>
											<td><?php echo $data->aaa_account; ?></td>
											<td><?php echo $data->created_on; ?></td>
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
