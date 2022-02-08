<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div role="main">
	<!-- MAIN CONTENT -->
	<div>
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="page-title txt-color-blueDark"><i class="fa fa-table fa-fw "></i> Member List</h1>
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
								<table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
									<thead>
                                        <tr>
                                            <th class="hasinput"><input type="text" class="form-control" placeholder="Member-ID"/></th>
                                            <th class="hasinput"><input type="text" class="form-control" placeholder="Mom"/></th>
                                            <th class="hasinput"><input type="text" class="form-control" placeholder="Join"/></th>
                                            <th class="hasinput"><input type="text" class="form-control" placeholder="DOB"/></th>
                                            <th class="hasinput"><input type="text" class="form-control" placeholder="Phone"/></th>
                                            <th class="hasinput"><input type="text" class="form-control" placeholder="Address"/></th>
                                            <th class="hasinput"><input type="text" class="form-control" placeholder="City"/></th>
                                            <th class="hasinput"><input type="text" class="form-control" placeholder="Email"/></th>
                                            <th class="hasinput"><input type="text" class="form-control" placeholder="Created"/></th>
                                        </tr>
										<tr>
											<th width="10%"><center>Member-ID</th>
											<th width="10%"><center>Mom's</th>
											<th width="10%"><center>Join</th>
											<th width="10%"><center>DOB</th>
											<th width="10%"><center>Phone</th>
											<th width="10%"><center>Address</th>
											<th width="10%"><center>City</th>
											<th width="10%"><center>Email</th>
											<th width="10%"><center>Created</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$query = 'SELECT a.id,
										a.member_no,
										a.wcrm_loyalty_member,
										a.join_date,
										a.birthday,
										a.phone_number_1,
										a.address,
										a.city,
										a.email,
										a.created_on
									FROM  wcrm_loyalty_member a
									WHERE a.is_active = "1"
									ORDER BY a.created_on DESC LIMIT 50';
									$getData = $this->db->query($query);
									foreach ($getData->result() as $value):
									{
									?>
										<tr>
											<td><a href="/crm/#lp/member/member_detail/<?php echo $value->id; ?>"><?php echo $value->member_no;  ?></a></td>
											<td><?php echo $value->wcrm_loyalty_member;  ?></td>
											<td><?php echo date("d-m-Y",strtotime($value->join_date));  ?></td>
											<td><?php echo ($value->birthday == null) ? '' : date("d-m-Y",strtotime($value->birthday));  ?></td>
											<td><?php echo $value->phone_number_1;  ?></td>
											<td><?php echo $value->address;  ?></td>
											<td><?php echo $value->city;  ?></td>
											<td><?php echo $value->email;  ?></td>
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
<script src="http://103.23.21.178/crm/asset/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="http://103.23.21.178/crm/asset/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="http://103.23.21.178/crm/asset/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="http://103.23.21.178/crm/asset/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="http://103.23.21.178/crm/asset/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script>
var responsiveHelper_datatable_fixed_column = undefined;
    var breakpointDefinition = {
					tablet : 1024,
					phone : 480
				};
	
var otable = $('#datatable_fixed_column').DataTable({
    //"bFilter": false,
    //"bInfo": false,
    //"bLengthChange": false
    //"bAutoWidth": false,
    //"bPaginate": false,
    //"bStateSave": true // saves sort state using localStorage
    "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
            "t"+
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
    "autoWidth" : true,
    "oLanguage": {
        "sSearch": '<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
    },
    "preDrawCallback" : function() {
        // Initialize the responsive datatables helper once.
        if (!responsiveHelper_datatable_fixed_column) {
            responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
        }
    },
    "rowCallback" : function(nRow) {
        responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
    },
    "drawCallback" : function(oSettings) {
        responsiveHelper_datatable_fixed_column.respond();
    }		

});

// custom toolbar
$("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

// Apply the filter
$("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {

    otable
        .column( $(this).parent().index()+':visible' )
        .search( this.value )
        .draw();

} );
</script>
