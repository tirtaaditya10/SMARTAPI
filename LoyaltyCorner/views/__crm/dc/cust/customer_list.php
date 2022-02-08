<?php



?>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div role="main">
	<!-- MAIN CONTENT -->
	<div>
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa fa-table fa-fw "></i> Customer List</h1>
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
											<th>Phone Number 1</th>
											<th>Phone Number 2</th>
											<th>Phone Number 3</th>
											<th>Kelurahan</th>
											<th>Kecamatan</th>
											<th>City</th>
											<th>Zip Code</th>
											<th>Email</th>
											<th>Sudah Member Parenting Club?</th>
											<th>Bersedia didaftarkan di PC?</th>
											<th>Member ID</th>
											<th>Reward Preference 1</th>
											<th>Reward Preference 2</th>
											<th>Contact Type</th>
											<th>City</th>
											<th>Created By</th>
											<th>Created On</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$query = 'SELECT a.* 
										FROM  wcrm_account a
										ORDER BY a.created_on DESC LIMIT 500';
									$getData = $this->db->query($query);
									foreach ($getData->result() as $value):
									{
									?>
										<tr>
											<td><?php echo $value->wcrm_account;  ?></td>
											<td><?php echo $value->phone_number_1;  ?></td>
											<td><?php echo $value->phone_number_2;  ?></td>
											<td><?php echo $value->phone_number_3;  ?></td>
											<td><?php echo $value->address;  ?></td>
											<td><?php echo $value->address_2;  ?></td>
											<td><?php echo $value->wcrm_city_id;  ?></td>
											<td><?php echo $value->zip_code;  ?></td>
											<td><?php echo $value->email;  ?></td>
											<td><?php echo ($value->is_member_pc == '1'?'YES':'NO');  ?></td>
											<td><?php echo ($value->is_willing_to_pc == '1'?'YES':'NO');  ?></td>
											<td><?php echo $value->wcrm_account_new_id;  ?></td>
											<td><?php echo '';  ?></td>
											<td><?php echo '';  ?></td>
											<td><?php echo '';  ?></td>
											<td><?php echo '';  ?></td>
											<td><?php echo $value->aaa_account_id;  ?></td>
											<td><?php echo $value->created_on;  ?></td>
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
