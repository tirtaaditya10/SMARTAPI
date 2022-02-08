<!-- ==========================CONTENT STARTS HERE ========================== -->
<?php
echo $id = isset($id) ? $id : '';

/*
$queryString = '
SELECT UPPER a.*
FROM upl_stage_customer a
WHERE a.phone_number_1 = "'.$phone.'" OR a.phone_number_2 = "'.$phone.'"';

$dataQuery = $this->db->query($queryString)->row();

if ($dataQuery->num_rows() > 0)
{
	$id = $dataQuery->id;
	$wcrm_account = $dataQuery->wcrm_account;
	$phone_number_1 = $dataQuery->phone_number_1;
	$phone_number_2 = $dataQuery->phone_number_2;
	$phone_number_3 = $dataQuery->phone_number_3;
	$address = $dataQuery->address;
	$address_2 = $dataQuery->address_2;
	$address_3 = $dataQuery->address_3;
	$city = $dataQuery->city;
	$zip_code = $dataQuery->zip_code;
	$email = $dataQuery->email;
	$upl_stage_customer_id = $dataQuery->upl_stage_customer_id;
	$member_no = $dataQuery->member_no;
	$wcrm_loyalty_member_id = $dataQuery->wcrm_loyalty_member_id;
	$wcrm_reward_pref_1_id = $dataQuery->wcrm_reward_pref_1_id;
	$wcrm_reward_pref_2_id = $dataQuery->wcrm_reward_pref_2_id;
	$is_member_pc = $dataQuery->is_member_pc;
	$is_willing_to_pc = $dataQuery->is_willing_to_pc;
	$is_cl_customer = $dataQuery->is_cl_customer;
	$wcrm_account_new_id = $dataQuery->wcrm_account_new_id;
	$aaa_account_id = $dataQuery->aaa_account_id;
	$created_on = $dataQuery->created_on;
	$aaa_account_upd_id = $dataQuery->aaa_account_upd_id;
	$updated_on = $dataQuery->updated_on;
	
} else {
	if $id = "";
	$wcrm_account = "";
	$phone_number_1 = "";
	$phone_number_2 = "";
	$phone_number_3 = "";
	$address = "";
	$address_2 = "" ;
	$address_3 = "";
	$city = "";
	$zip_code = "";
	$email = "";
	$upl_stage_customer_id = "";
	$member_no = "";
	$wcrm_loyalty_member_id = "";
	$wcrm_reward_pref_1_id = "";
	$wcrm_reward_pref_2_id = "";
	$is_member_pc = "";
	$is_willing_to_pc = "";
	$is_cl_customer = "";
	$wcrm_account_new_id = "";
	$aaa_account_id = "";
	$created_on = "";
	$aaa_account_upd_id = "";
	$updated_on = "";
	
}
*/
?>


<!-- MAIN PANEL -->
<div role="main">
	<!-- MAIN CONTENT -->
	<div>
		<div class="row">
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
				<h1 class="page-title txt-color-blueDark"><i class="fa fa-phone fa-fw "></i> Call Activity Confirmation - New User - [Non-Segment]</h1>
			</div>
		</div>

		<!-- widget grid -->
		<section id="widget-grid" class="">
			<!-- row -->
			<div class="row">
				<!-- NEW WIDGET START -->
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <div class="jarviswidget well" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body">
                                <h4 class="media-heading">Phone Call Log</h4>
                                <hr class="simple">
                                <!--<a href="http://10.86.184.20:8085/crondialer.do?task=dial&extension=3011&destitation=085710007907" target="_blank">call</a>-->
                                <a href="#" target="_blank" id="dialog_link" class="btn btn-default"><i class="fa fa-phone"></i>&nbsp; Call Now!</a>
                                <a class="btn btn-success pull-right" href="javascript:void(0);"><i class="fa fa-pencil"></i>&nbsp; Edit without call</a>
                                
                                <br><br>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="10%"><center>Dialed number</th>
                                                <th width="10%"><center>Con result</th>
                                                <th width="40%"><center>Voice recording file</th>
                                                <th width="10%"><center>Failed reason</th>
                                                <th width="10%"><center>Call Duration</th>
                                                <th width="10%"><center>Created by</th>
                                                <th width="10%"><center>Created on</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
										$queryString = '
										SELECT a.dialed_number AS Dialed,
											a.wcrm_call_result_id AS ConnResult,
											a.voice_record_file_path AS VoiceFile,
											a.wcrm_campaign_fail_id AS Failed,
											a.call_duration AS Duration,
											a.aaa_account_upd_id AS CreatedBy,
											created_on AS CreatedOn
										from wcrm_activity_d a
										where a.id = "'.$id.'"';
										
										$query = $this->db->query($queryString);
//										echo $queryString;
										foreach ($query->result_array() as $row){									
										?>
                                            <tr>
												<td><?php echo $row['Dialed']; ?></td>
												<td><?php echo $row['ConnResult']; ?></td>
												<td><?php echo $row['VoiceFile']; ?></td>
												<td><?php echo $row['Failed']; ?></td>
												<td><?php echo $row['Duration']; ?></td>
												<td><?php echo $row['CreatedBy']; ?></td>
												<td><?php echo $row['CreatedOn']; ?></td>
                                            </tr>
										<?php
										} ?>
                                        </tbody>
                                    </table>
                                </div>                             
   
							</div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    
                    <div class="jarviswidget well" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body">
                                <h4 class="media-heading">Call Activity Base</h4>
                                <hr class="simple">
                                
                                <div class="col-md-3">
                                    <div class="col-md-5"><strong>Customer</strong></div>
                                    <div class="col-md-7">: <?php # echo $wcrm_account ?></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-7"><strong>Child Name</strong></div>
                                    <div class="col-md-5">: <?php #echo $wcrm_account ?></div>
                                </div>
                                <div class="col-md-5">
                                    <div class="col-md-5"><strong>Campaign Category</strong></div>
                                    <div class="col-md-7">: <?php #echo $wcrm_account ?></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-md-5"><strong>Result</strong></div>
                                    <div class="col-md-7">: <?php #echo $wcrm_account ?></div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-md-7"><strong>Unsuccess Reason</strong></div>
                                    <div class="col-md-5">: <?php #echo $wcrm_account ?></div>
                                </div>
                                <div class="col-md-5">
                                    <div class="col-md-5"><strong>Date Next FU</strong></div>
                                    <div class="col-md-7">: <?php #echo $wcrm_account ?></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-md-5"><strong>Oid</strong></div>
                                    <div class="col-md-7">: <?php #echo $wcrm_account ?></div>
                                </div>
                                <div class="col-md-9">
                                    <div class="col-md-3"><strong>NOTE</strong></div>
                                    <div class="col-md-9">: <?php #echo $wcrm_account ?></div>
                                </div>
                                <br><br><br>
                            </div>
                            <!-- end widget content -->
                        </div>
                        <!-- end widget div -->

                    </div>
                    
                    <div class="jarviswidget well" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body">
                                <h4 class="media-heading">Call Activity Confirmation</h4>
                                <hr class="simple">
                                
                                <div class="col-md-12">
                                    <table width="100%" style="border-collapse:collapse">
                                        <thead>
                                            <tr>
                                                <th width="20%"></th>
                                                <th width="35%"></th>
                                                <th width="15%"></th>
                                                <th width="35%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Confirmation result</th>
                                                <td>: </td>
                                                <th>Gimmick Confirmation</th>
                                                <td>: </td>
                                            </tr>
                                            <tr>
                                                <th>Sub result</th>
                                                <td>: </td>
                                                <th>Vol use prev</th>
                                                <td>: </td>
                                            </tr>
                                            <tr>
                                                <th>DOReason</th>
                                                <td>: </td>
                                                <th>Freq use prev</th>
                                                <td>: </td>
                                            </tr>
                                            <tr>
                                                <th>Reason</th>
                                                <td>: </td>
                                                <th>AEComplaint</th>
                                                <td>: </td>
                                            </tr>
                                            <tr>
                                                <th>Recommendation</th>
                                                <td>: </td>
                                            </tr>
                                            <tr>
                                                /* <th>Struk Availability</th> */
                                                <td>: </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br><br>
                                </div>
                            </div>
                            <!-- end widget content -->
                        </div>
                        <!-- end widget div -->

                    </div>
                    
                    <?php $this->load->view('__crm/cc/my_call_list_detail_ext'); ?>
				</article>
				<!-- WIDGET END -->

			<!-- end row -->
            </div>

		</section>
		<!-- end widget grid -->

	</div>
	<!-- END MAIN CONTENT -->

</div>

<!-- ui-dialog -->
<div id="dialog_simple" title="Dialog Simple Title">
	<table width="100%" style="border-collapse:collapse">
        <thead>
            <tr>
                <th width="40%"></th>
                <th width="65%"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Phone number</th>
                <td>: 
                    <input type="text" name="phone_number" value="<?php echo $this->uri->segment(4)?>" id="phone_number"> 
                    <a href="#" class="btn btn-primary btn-xs" id="dial_button">DIAL</a>
                    <br><br>
                </td>
            </tr>
            <tr>
                <th>Failed reason</th>
                <td>:
                    <label class="input">
                        <input type="text" list="list">
                        <datalist id="list">
                            <option value="N/A">N/A</option>
                            <option value="MB/MV/PS">MB/MV/PS</option>
                            <option value="TA/TDH/LJ/NS/JS">TA/TDH/LJ/NS/JS</option>
                            <option value="TDA">TDA</option>
                            <option value="TR/TDF/TTL/NK">TR/TDF/TTL/NK</option>
                        </datalist></label>
                    <br><br>
                </td>
            </tr>
            <tr>
                <th>Voice recording file</th>
                <td>: </td>
            </tr>
        </tbody>
    </table>
    <br>
    <label>Connection result</label><br>
    <a href="#" id="dialog_link" class="btn btn-default">Connected</a>
    <a class="btn btn-default" href="javascript:void(0);">Unconnected</a>
</div>

<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE RELATED PLUGIN(S) 
<script src="..."></script>-->

<script>

	$('#dialog_link').click(function() {
        $('#dialog_simple').dialog('open');
        return false;

    });

    $('#dialog_simple').dialog({
        autoOpen : false,
        width : 600,
        resizable : false,
        modal : true,
        title : "Auto Dialer",
        buttons : [{
            html : "<i class='fa fa-times'></i>&nbsp; Cancel",
            "class" : "btn btn-default",
            click : function() {
                $(this).dialog("close");
            }
        }]
    });
    
    $('#dial_button').click(function() {
        var number = $('#phone_number').val();
        window.open(
          'http://10.86.184.20:8085/crondialer.do?task=dial&extension=3011&destination=' + number,
          '_blank' // <- This is what makes it open in a new window.
        );
    });

</script>
