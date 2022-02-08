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
											<th>Status </th>
											<th>Shipment Id</th>
											<th>Shipment Status</th>
											<th>Old System Status</th>
											<th>Created By</th>
											<th>Crated On</th>
										</tr>
									</thead>
									<tbody>
<?php 
foreach ($point_trans as $data):
?>
    <tr>
        <td colspan="18">
            <div class="tree smart-form">
                <ul>
                    <li>
                        <span><i class="fa fa-lg fa-plus-circle"></i> OldOutletSource: <?php echo $data->wcrm_loyalty_source_misc; ?></span>
                        <ul>
                            <?php
                                $getmember = $this->db->query("SELECT * FROM vap_all_point_trans WHERE wcrm_loyalty_source_misc = '".$data->wcrm_loyalty_source_misc."'")->result();
                                foreach($getmember as $mData):
                            ?>
                            <li style="display:none;"><span><i class="fa fa-lg fa-plus-circle"></i> Member: <?php echo $mData->member_no; ?></span>
                                <ul>
                                    <?php
                                        $getData = $this->db->query("SELECT * FROM vap_all_point_trans WHERE member_no = '".$mData->member_no."'")->result();
                                        foreach($getData as $alData):
                                    ?>
                                        <li style="display:none;"><span><i></i> Member: <?php echo $alData->wcrm_loyalty_product; ?></span>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </td>
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
            </div>
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
// DO NOT REMOVE : GLOBAL FUNCTIONS!

$(document).ready(function() {

    pageSetUp();

    // PAGE RELATED SCRIPTS

    $('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
    $('.tree').find('li:has(ul)').addClass('parent_li').attr('role', 'treeitem').find(' > span').attr('title', 'Collapse this branch').on('click', function(e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(':visible')) {
            children.hide('fast');
            $(this).attr('title', 'Expand this branch').find(' > i').removeClass().addClass('fa fa-lg fa-plus-circle');
        } else {
            children.show('fast');
            $(this).attr('title', 'Collapse this branch').find(' > i').removeClass().addClass('fa fa-lg fa-minus-circle');
        }
        e.stopPropagation();
    });			

})
    function getMember(ID, OUTLET){
        console.log()
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/lp/lp/getMember',
            data: { 
                outlet   : OUTLET
            },
            cache: false,
            success: function (data) {
                console.log(data + "--" + ID)
                document.getElementById(ID).innerHTML = "" + data + ""
            }
        });
    }

</script>
