<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div role="main">
	<!-- MAIN CONTENT -->
	<div>
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa fa-table fa-fw "></i>Validate Receipt & Add Point</h1>
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
								<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
									<thead>
										<tr> 
											<th width="10%" colspan="2"><center>Action</th>
											<th width="10%"><center>Procom Date</th>
											<th width="10%"><center>Created</th>
											<th width="10%"><center>Mom's</th>
											<th width="10%"><center>Phone 1</th>
											<th width="10%"><center>Phone 2</th>
											<th width="10%"><center>Child Name</th>
											<th width="10%"><center>Birth Date</th>
											<th width="10%"><center>Address</th>
											<th width="10%"><center>Email</th>
											<th width="10%"><center>Screening</th>
											<th width="10%"><center>Validate-Status</th>
											<th width="10%"><center>Upload By</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$query = 'SELECT a.acq_date,
											a.created_on,
											a.customer_name,
											a.children_birthday,
											a.children_name,
											a.phone_number_1,
											a.phone_number_2,
											a.address,
											a.email,
											aa.wcrm_product_list,
											bb.wcrm_region,
											a.qty,
											a.receipt_path,
											wcrm_screening,
											upl_receipt_check,
											a.aaa_account_id,
											a.id,
											cc.wcrm_brand_presenter
										FROM upl_stage_customer a
											LEFT JOIN wcrm_product_list aa ON aa.wcrm_product_category_id = a.wcrm_product_category_id
											LEFT JOIN wcrm_region bb ON bb.id_code = a.wcrm_region_id
											LEFT JOIN wcrm_brand_presenter cc ON cc.id = a.wcrm_brand_presenter_id
											left join upl_receipt_check     dd on dd.id = a.upl_receipt_check_id
											left join wcrm_screening        de on de.id = a.wcrm_screening_id
											where upl_data_source_id = 33
										ORDER BY a.created_on DESC';
										
										$getData = $this->db->query($query);
										foreach ($getData->result() as $value) {
											$acq_date            = $value->acq_date;
											$custumer_name       = $value->customer_name;
											$children_birthday   = $value->children_birthday;
											$children_name       = $value->children_name;
											$phone_number_1      = $value->phone_number_1;
											$phone_number_2      = $value->phone_number_2;
											$address             = $value->address;
											$email               = $value->email;
											$wcrm_product_list   = $value->wcrm_product_list;
											$wcrm_region         = $value->wcrm_region;
											$qty                 = $value->qty;
											$receipt_path        = $value->receipt_path;
											$upl_receipt_check   = $value->upl_receipt_check;
											$wcrm_screening       = $value->wcrm_screening;
											$aaa_account_id      = $value->aaa_account_id;
											$created_on          = $value->created_on;
											$id                  = $value->id;
											$wcrm_brand_presenter= $value->wcrm_brand_presenter;
											?>									
											<tr>
												<td><center><a href="/crm/#dp/mbl/vbe_detail/<?php echo $id; ?>"> <span class="glyphicon glyphicon-check @2x"> [validate]</span> </a></td>
												<td><center><a href="/crm/<?php echo $receipt_path; ?>" target="_blank"> <span class="glyphicon glyphicon-eye-open @2x"> [view]</span> </a></td>
												<td><?php echo date('d-m-Y',strtotime($acq_date)); ?></td>
												<td><?php echo date('d-m-Y H:i:s',strtotime($created_on)); ?></td>
												<td><?php echo $custumer_name; ?></td>
												<td><?php echo "0".$phone_number_1; ?></td>
												<td><?php echo "0".$phone_number_2; ?></td>
												<td><?php echo $children_name; ?></td>
												<td><?php echo date('d-m-Y',strtotime($children_birthday)); ?></td>
												<td><?php echo $address; ?></td>
												<td><?php echo $email; ?></td>
												<td><?php echo $wcrm_screening; ?></td>
												<td><?php echo $upl_receipt_check; ?></td>
												<td><?php echo $wcrm_brand_presenter; ?></td>
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