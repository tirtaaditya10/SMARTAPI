<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div role="main">
	<!-- MAIN CONTENT -->
	<div>
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa fa-table fa-fw "></i> Upload By WA</h1>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
                <a href="/crm/#dp/mbl/insertby_wa" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp; Add data</a>
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
								<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
									<thead>
										<tr>
											<th width="10%"><center>Acq-Data</th>
											<th width="10%"><center>Moms</th>
											<th width="10%"><center>DOB</th>
											<th width="10%"><center>Children</th>
											<th width="10%"><center>Phone</th>
											<th width="10%"><center>Address</th>
											<th width="10%"><center>Email</th>
											<th width="5%"><center>Data Type</th>
											<th width="5%"><center>Actual Product</th>
											<th width="5%"><center>Gram</th>
											<th width="5%"><center>Qty</th>
											<th width="10%"><center>Created</th>
										</tr>
									</thead>
									<tbody>
                                        <?php
                                        foreach($get_wa as $data):
                                        ?>
										<tr>
											<td><?php echo date('d-m-Y', strtotime($data->acq_date)) ?></td>
											<td><?php echo strtoupper($data->customer_name); ?></td>
											<td><?php echo date('d-m-Y', strtotime($data->children_birthday)) ?></td>
											<td><?php echo strtoupper($data->children_name); ?></td>
											<td><?php echo $data->phone_number_1; ?></td>
											<td><?php echo strtoupper($data->address); ?></td>
											<td><?php echo strtoupper($data->email); ?></td>
											<td><?php echo $data->data_type; ?></td>
											<td><?php echo $data->product_list_actual; ?></td>
											<td><?php echo $data->grammage; ?></td>
											<td><?php echo $data->qty; ?></td>
											<td><?php echo $data->aaa_account; ?></td>
										</tr>
                                        <?php
                                        endforeach;
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
</script>
