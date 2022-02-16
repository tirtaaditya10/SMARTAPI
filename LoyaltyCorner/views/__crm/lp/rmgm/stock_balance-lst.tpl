<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div role="main">
	<!-- MAIN CONTENT -->
	<div>
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa fa-table fa-fw "></i> Stock Balance</h1>
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
											<th>Reward Item</th>
											<th>Quantity Available</th>
											<th>Quantity On Hand</th>
											<th>Alert Level</th>
<!--											<th>Image</th>-->
											<th>Created by</th>
											<th>Created on</th>
										</tr>
									</thead>
									<tbody>
									<?php 
										$query = 'SELECT a.id,
										a.qty_available,
										a.qty_onhand,
										a.alert_level,
										a.aaa_account_id,
										a.created_on
									FROM  wcrm_reward_balance a
									WHERE a.is_active = "1"
									ORDER BY a.created_on DESC LIMIT 50';
									$getData = $this->db->query($query);
									foreach ($getData->result() as $value):
									{
									?>
										<tr>
											<td><?php echo $data->wcrm_reward_id; ?></td>
											<td><?php echo $data->qty_available; ?></td>
											<td><?php echo $data->qty_onhand; ?></td>
											<td><?php echo $data->alert_level; ?></td>

											<td><?php echo $data->aaa_account_id; ?></td>
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
