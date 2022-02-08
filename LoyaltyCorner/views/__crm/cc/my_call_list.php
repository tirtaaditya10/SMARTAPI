<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div role="main">
	<!-- MAIN CONTENT -->
	<div>
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa fa-table fa-fw "></i> All Call List</h1>
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
											<th width="10%"><center>Action</th>
											<th width="10%"><center>Status</th>
											<th width="10%"><center>Area</th>
											<th width="10%"><center>Campaign</th>
											<th width="10%"><center>Sub-Campaign</th>
											<th width="10%"><center>Phone</th>
											<th width="10%"><center>Child-Name</th>
											<th width="10%"><center>Customer</th>
											<th width="10%"><center>Last Call</th>
											<th width="10%"><center>#Call</th>
											<th width="10%"><center>Closed Date</th>
											<th width="10%"><center>Result</th>
											<th width="10%"><center>Unsuccess Reason</th>
											<th width="10%"><center>MemberID</th>
											<th width="10%"><center>Next FU Date</th>
										</tr>
									</thead>
									<tbody>	
                                        <?php
                                        foreach($datalist as $key):
                                        ?>
										<tr>
                                            <td><center><a href="#cc/cca/my_detail/<?php echo $key->id; ?>"><span class="glyphicon glyphicon-earphone"> [call]</span> </a></td>
											<td><?php echo $key->callStatus; ?></td>
											<td><?php echo $key->callArea; ?></td>
											<td><?php echo $key->Campaign; ?></td>
											<td><?php echo $key->SubCampaign; ?></td>
											<td><?php echo $key->phone; ?></td>
											<td><?php echo $key->ChildName; ?></td>
											<td><?php echo $key->CustomerName; ?></td>
											<td><?php echo $key->LastCall; ?></td>
											<td><?php echo $key->numCall; ?></td>
											<td><?php echo $key->ClosedDate; ?></td>
											<td><?php echo $key->CampaignResult; ?></td>
											<td><?php echo $key->UnsuccessReason; ?></td>
											<td><?php echo $key->MemberID; ?></td>
											<td><?php echo $key->NextFuDate; ?></td>
										</tr>
                                        <?php endforeach; ?>
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
