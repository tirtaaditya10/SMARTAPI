<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div role="main">
	<!-- MAIN CONTENT -->
	<div>
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa fa-table fa-fw "></i>Screening by Eye</h1>
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
											<th width="20%">Action</th>
											<th width="8%">Procom Date</th>
											<th width="8%">Created On</th>
											<th width="8%">Mom's Name</th>
											<th width="8%">Phone Number 1</th>
											<th width="8%">Phone Number 2</th>
											<th width="8%">Child Name</th>
											<th width="8%">Child Birth Date</th>
											<th width="8%">Address</th>
											<th width="8%">Email</th>
											<th width="8%">Created By (BP)</th>
										</tr>
									</thead>
									<tbody>
										<?php
                                        $prev_number    = null;
                                        $prev_id        = null;
										foreach ($get_sbe as $value) { 
                                            if($prev_number == $value->phone_number_1){
                                        ?>	
                                            
											<tr>
												<td>
                                                    <button onclick="sbeFlag(<?php echo $prev_number.', '.$prev_id.', '.$value->id_cust ?>, 1)"  data-toggle="tooltip" title="Double" class="btn btn-danger btn-circle"><i class="glyphicon glyphicon-eye-close"></i></button>
                                                    <button onclick="sbeFlag(<?php echo $prev_number.', '.$prev_id.', '.$value->id_cust ?>, 2)"  data-toggle="tooltip" title="Valid" class="btn btn-success btn-circle"><i class="glyphicon glyphicon-eye-open"></i></button>
                                                </td>
												<td><?php echo $value->acq_date; ?></td>
												<td><?php echo $value->created_on; ?></td>
												<td><?php echo $value->customer_name; ?></td>
												<td><?php echo $value->phone_number_1; ?></td>
												<td><?php echo $value->phone_number_2; ?></td>
												<td><?php echo $value->children_name; ?></td>
												<td><?php echo $value->children_birthday; ?></td>
												<td><?php echo $value->address; ?></td>
												<td><?php echo $value->email; ?></td>
												<td><?php echo $value->wcrm_brand_presenter; ?></td>
											</tr>
									<?php } else { 
                                            $prev_id    = $value->id_cust;
                                        ?>
                                            <tr class="danger">
												<td></td>
												<td><?php echo $value->acq_date; ?></td>
												<td><?php echo $value->created_on; ?></td>
												<td><?php echo $value->customer_name; ?></td>
												<td><?php echo $value->phone_number_1; ?></td>
												<td><?php echo $value->phone_number_2; ?></td>
												<td><?php echo $value->children_name; ?></td>
												<td><?php echo $value->children_birthday; ?></td>
												<td><?php echo $value->address; ?></td>
												<td><?php echo $value->email; ?></td>
												<td><?php echo $value->wcrm_brand_presenter; ?></td>
											</tr>
                                    <?php }
                                            $prev_number = $value->phone_number_1;
                                        }
                                    ?>
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
<script src="http://103.23.21.178/crm/asset/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="http://103.23.21.178/crm/asset/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="http://103.23.21.178/crm/asset/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="http://103.23.21.178/crm/asset/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="http://103.23.21.178/crm/asset/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
    

<script>

    var responsiveHelper_dt_basic = undefined;
    var responsiveHelper_datatable_fixed_column = undefined;
    var responsiveHelper_datatable_col_reorder = undefined;
    var responsiveHelper_datatable_tabletools = undefined;

    var breakpointDefinition = {
        tablet : 1024,
        phone : 480
    };
    
    $('#dt_basic').dataTable({
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
            "t"+
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "autoWidth" : true,
        "oLanguage": {
            "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
        },
        "preDrawCallback" : function() {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
            }
        },
        "rowCallback" : function(nRow) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
        },
        "drawCallback" : function(oSettings) {
            responsiveHelper_dt_basic.respond();
        }
    });
    
	function sbeFlag(PREV_NUMBER, PREV_ID, ID, FLAG){
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/sbeFlag',
            data: {
                flag: FLAG,
                prev_id: PREV_ID,
                prev_number: PREV_NUMBER,
                id:  ID
            },
            cache: false,
            success: function (response) {
                console.log(response);
                if(response == 'success'){
                    swal("Success", "", "success")
                    .then((value) => {
                        location.reload();
                    });
                } else {
                    swal("Failed", "", "error");
                }
            }
        });
    }

</script>
