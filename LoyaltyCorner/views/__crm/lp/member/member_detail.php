<link href="http://103.23.21.178/crm/asset/dist/css/datepicker.min.css" rel="stylesheet" type="text/css">
<script src="http://103.23.21.178/crm/asset/dist/js/datepicker.min.js"></script>

<!-- Include English language -->
<script src="http://103.23.21.178/crm/asset/dist/js/i18n/datepicker.en.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
    <!-- widget div-->
    <div>

        <!-- widget edit box -->
        <div class="jarviswidget-editbox">
            <!-- This area used as dropdown edit box -->

        </div>
        <div class="widget-body">
            <h4 class="media-heading">MEMBER - <?php echo $get_detail->member_no; ?></h4>
            <hr class="simple">

            <div class="col-md-6">
                <div class="col-md-5"><strong>Customer</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->wcrm_loyalty_member; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Member ID</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->member_no; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Join Date</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->join_date; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Cust Name</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->wcrm_loyalty_member; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Birth Date</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->birthday; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Phone Number 1</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->phone_number_1; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Phone Number 2</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->phone_number_2; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Phone Number 3</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->phone_number_3; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Address</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->address; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Address 2</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->address_2; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Address 3</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->address_3; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Province</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->province; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>City</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->city; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Email</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->email; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>IDType</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->wcrm_id_type; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>IDNo</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->id_no; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Education</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->wcrm_education_id; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Profession</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->wcrm_profession_id; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Created By</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->created_on; ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Updated By</strong></div>
                <div class="col-md-7">:
                    <?php echo $get_detail->aaa_account_upd_id; ?>
                </div>
                <br>
                <br>
                <br>
                <br>
            </div>

        </div>
        <!-- end widget content -->
    </div>
    <!-- end widget div -->

</div>

<div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
    <!-- widget div-->
    <div>

        <!-- widget edit box -->
        <div class="jarviswidget-editbox">
            <!-- This area used as dropdown edit box -->

        </div>
        <div class="widget-body">
            <ul id="myTab1" class="nav nav-tabs bordered">
                <li class="active">
                    <a href="#s1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gift"></i> Point Balance</a>
                </li>
                <li>
                    <a href="#s2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gift"></i> Point Trans</a>
                </li>
                <li>
                    <a href="#s3" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gift"></i> Point Redeem</a>
                </li>
                <li>
                    <a href="#s4" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gift"></i> Redeem Requirement</a>
                </li>
                <li>
                    <a href="#s5" data-toggle="tab"><i class="fa fa-fw fa-lg fa-truck"></i> Delivery Address</a>
                </li>
                <li>
                    <a href="#s6" data-toggle="tab"><i class="fa fa-fw fa-lg fa-cube"></i> Follow-Up Request </a>
                </li>
                <li>
                    <a href="#s7" data-toggle="tab"><i class="fa fa-fw fa-lg fa-cubes"></i> Pending Redeem</a>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle fa fa-paper-plane" data-toggle="dropdown"> Submit Menu<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#s8" data-toggle="tab"> Input Point Multiple</a>
                        </li>
                        <li>
                            <a href="#s9" data-toggle="tab"> Add Point Earning</a>
                        </li>
                        <li>
                            <a href="#s10" data-toggle="tab"> Submit Redemption</a>
                        </li>
                        <li>
                            <a href="#s11" data-toggle="tab"> Need Follow-Up</a>
                        </li>
                        <li>
                            <a href="#s12" data-toggle="tab"> Add Delivery Address</a>
                        </li>
                        <li>
                            <a href="#s13" data-toggle="tab"> Redeem Request</a>
                        </li>
                    </ul>
                </li>

            </ul>

            <div id="myTabContent1" class="tab-content padding-10">
                <div class="tab-pane fade in active" id="s1">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Period</th>
                                    <th>Total Point Earned</th>
                                    <th>Total Point Redeemed</th>
                                    <th>Point Balance</th>
                                    <th>Created By</th>
                                    <th>Created On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$queryString = 'select aa.wcrm_loyalty_period AS loyalty_period, 
									IFNULL (cc.total_earnpoint,0) as total_earnpoint,
									IFNULL ("0",0) as total_redeem,
									IFNULL (a.total_point,0) as  total_point,
									IFNULL (bb.aaa_account,0) as created_by,
									DATE_FORMAT(a.created_on, "%d-%m-%Y") as created_on	  
								from wcrm_loyalty_member_point a
									LEFT JOIN wcrm_loyalty_period aa on trim(aa.id) = trim(a.wcrm_loyalty_period_id)
									LEFT JOIN aaa_account bb on trim(bb.id) = trim(a.aaa_account_id)
									LEFT JOIN (
										SELECT wcrm_loyalty_member_id, wcrm_loyalty_period_id, SUM(total_point) AS total_earnpoint
										FROM wcrm_loyalty_member_point
										GROUP BY wcrm_loyalty_member_id, wcrm_loyalty_period_id
									) cc ON (cc.wcrm_loyalty_member_id = a.wcrm_loyalty_member_id) and (cc.wcrm_loyalty_period_id = a.wcrm_loyalty_period_id)
								WHERE TRIM(a.wcrm_loyalty_member_id) = "'.$get_detail->id.'" 
								group by trim(a.wcrm_loyalty_period_id)';
								$query = $this->db->query($queryString);
								foreach ($query->result_array() as $row){									
								?>
                                    <tr>
                                        <td>
                                            <?php echo $row['loyalty_period']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['total_earnpoint']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['total_redeem']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['total_point']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['created_by']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['created_on']; ?>
                                        </td>
                                    </tr>
                                    <?php 
								}?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="s2">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> Period</th>
                                    <th> Channel</th>
                                    <th> Sub Channel</th>
                                    <th> Trade Channel</th>
                                    <th> Outlet Name</th>
                                    <th> Outlet Location</th>
                                    <th> Source (OldSystem)</th>
                                    <th> SubSource (OldSystem)</th>
                                    <th> Received Date </th>
                                    <th> Transaction Date </th>
                                    <th> Product </th>
                                    <th> Product Grammage </th>
                                    <th> Qty </th>
                                    <th> Percent Bonus Point</th>
                                    <th> Prince Per Unit </th>
                                    <th> Total Point </th>
                                    <th> Created By </th>
                                    <th> Created On </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($get_trans as $data):
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $data->wcrm_loyalty_period; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_loyalty_channel; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_loyalty_channel_sub; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_channel_trade; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_outlet_group; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_outlet; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_loyalty_source; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_loyalty_source_sub; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->received_on; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->transacted_on; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_loyalty_product; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_loyalty_product_grammage; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->qty; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->loyalty_point_bonus; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->price_per_unit; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_loyalty_period; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->aaa_account_id; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->created_on; ?>
                                        </td>
                                        <?php 
                                        endforeach;
                                        ?>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="s3">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Delivery Address</th>
                                    <th>Period</th>
                                    <th>Channel Id</th>
                                    <th>Sub Channel Id</th>
                                    <th>Radeem Date</th>
                                    <th>Reward Id</th>
                                    <th>Qty</th>
                                    <th>Total Point</th>
                                    <th>Status </th>
                                    <th>Shipment Id</th>
                                    <th>Shipment Status </th>
                                    <th>Old System Status </th>
                                    <th>Old Redeem Id </th>
                                    <th>Created By</th>
                                    <th>Crated On </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($get_redeem as $data):
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $data->wcrm_address_id; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_loyalty_period; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_loyalty_channel; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_loyalty_channel_sub; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->redeemed_on; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_reward_id; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->qty; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->total_point; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->redeem_status; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_shipment_id; ?>
                                        </td>
                                        <td>
                                            <?php echo ''; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->_oldStatus; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->_oldRedeemId; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->aaa_account_id; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->created_on; ?>
                                        </td>
                                        <?php 
                                    endforeach;
                                        ?>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="s4">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Period</th>
                                    <th>Submit KK</th>
                                    <th>Date Submit KK</th>
                                    <th>Total Spoon Submitted</th>
                                    <th>Created By</th>
                                    <th>Created On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($get_redeem_req as $data):
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $data->wcrm_loyalty_member; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_loyalty_period; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->is_submit_kk; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->submited_kk; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->number_of_spoon; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->aaa_account_id; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->created_on; ?>
                                        </td>
                                    </tr>
                                    <?php 
                                    endforeach;
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="s5">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Address Summary</th>
                                    <th>Address Type</th>
                                    <th>Alamat</th>
                                    <th>Kelurahan</th>
                                    <th>Kecamatan</th>
                                    <th>City</th>
                                    <th>Province</th>
                                    <th>Zip Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($get_address as $data):
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo '['.strtoupper($data->wcrm_address_type).'] - '.$data->address_1.' - '.$data->wcrm_city; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_address_type; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->address_1; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->address_2; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->address_2; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_city; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->wcrm_province; ?>
                                        </td>
                                        <td>
                                            <?php echo $data->zip_code; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="s6">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Member</th>
                                    <th>FUCAtegory</th>
                                    <th>Created By</th>
                                    <th>Created On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($get_fureq as $fuData):
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $fuData->wcrm_account; ?>
                                        </td>
                                        <td>
                                            <?php echo $fuData->wcrm_loyalty_member; ?>
                                        </td>
                                        <td> </td>
                                        <td>
                                            <?php echo $fuData->aaa_account_id; ?>
                                        </td>
                                        <td>
                                            <?php echo $fuData->created_on; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="s7">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Delevery Address</th>
                                    <th>Period</th>
                                    <th>Channel ID</th>
                                    <th>Sub Channel Id</th>
                                    <th>Request Radeem Date</th>
                                    <th>Reward</th>
                                    <th>Qty</th>
                                    <th>Total Point</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Created On</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($get_red_req as $dt):
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $dt->wcrm_loyalty_member; ?>
                                        </td>
                                        <td>
                                            <?php echo $dt->address_1; ?>
                                        </td>
                                        <td>
                                            <?php echo $dt->wcrm_loyalty_period; ?>
                                        </td>
                                        <td>
                                            <?php echo $dt->wcrm_loyalty_channel_id; ?>
                                        </td>
                                        <td>
                                            <?php echo $dt->wcrm_loyalty_channel_sub; ?>
                                        </td>
                                        <td>
                                            <?php echo $dt->redeemed_on; ?>
                                        </td>
                                        <td>
                                            <?php echo $dt->wcrm_loyalty_reward; ?>
                                        </td>
                                        <td>
                                            <?php echo $dt->qty; ?>
                                        </td>
                                        <td>
                                            <?php echo $dt->loyalti_point; ?>
                                        </td>
                                        <td>
                                            <?php echo $dt->STATUS; ?>
                                        </td>
                                        <td>
                                            <?php echo $dt->aaa_account; ?>
                                        </td>
                                        <td>
                                            <?php echo $dt->created_on; ?>
                                        </td>
                                    </tr>
                                    <?php 
                                    endforeach;
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="s8">
                    <div>
                        <form class="smart-form">
                            <header> Input Point Multiple </header>

                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <fieldset>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Member ID</label>
                                            <label class="input">
                                                <input type="text" name="member_no1" id="member_no1" value="<?php echo $get_detail->member_no; ?>">
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="label">Member Name</label>
                                            <label class="input">
                                                <input type="text" name="name1" id="name1" value="<?php echo $get_detail->wcrm_loyalty_member; ?>">
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="label">Period</label>
                                            <label class="select">
                                                <select id="period1" name="period1">
                                                    <option value="null">Choose Period</option>
                                                    <?php foreach($period as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_loyalty_period; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Channel</label>
                                            <label class="select">
                                                <select id="channel1" name="channel1" onchange="getSubChannel(1)">
                                                    <option value="null">Choose Channel</option>
                                                    <?php foreach($channel as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_loyalty_channel; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Sub Channel</label>
                                            <label class="select">
                                                <select id="sub_channel1" name="sub_channel1">
                                                    <option value="null">Choose Sub Channel</option>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Trade Channel</label>
                                            <label class="select">
                                                <select id="trade_channel1" name="trade_channel1">
                                                    <option value="null">Choose Trade Channel</option>
                                                    <?php foreach($channel_trade as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_channel_trade; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Outlet Name</label>
                                            <label class="select">
                                                <select id="outlet_name1" name="outlet_name1" onchange="getLocation(1)">
                                                    <option value="null">Choose Outlet Name</option>
                                                    <?php foreach($outlet_name as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_outlet_group; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Outlet Location</label>
                                            <label class="select">
                                                <select id="outlet_location1" name="outlet_location1">
                                                    <option value="null">Choose Outlet Location</option>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <fieldset>
                                    <div class="row">
                                        <section class="col col-8">
                                            <label class="label">Transaction Date</label>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="transaction_date1" id="transaction_date1">
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-8">
                                            <label class="label">Received Date</label>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="received_date1" id="received_date1">
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Product</label>
                                            <label class="select">
                                                <select id="product1" name="product1" onchange="getGrammage(1)">
                                                    <option value="null">Choose Product</option>
                                                    <?php foreach($product as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_loyalty_product; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                        <section class="col col-2">
                                            <label class="label">Grammage</label>
                                            <label class="select">
                                                <select id="product_grammage1" name="product_grammage1" onchange="getPoint(1)">
                                                    <option value="null">Choose Product Grammage</option>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                        <section class="col col-2">
                                            <label class="label">Quantity</label>
                                            <label class="select">
                                                <select id="quantity1" name="quantity1" onchange="calcPoint(1)">
                                                    <option value="null">Choose Quantity</option>
                                                    <?php for($i=1; $i < 11; $i++){ ?>
                                                        <option value="<?php echo $i; ?>">
                                                            <?php echo $i; ?>
                                                        </option>
                                                        <?php } ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Price per Unit</label>
                                            <label class="input">
                                                <input type="text" name="price_per_unit1" id="price_per_unit1">
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Bonus Point</label>
                                            <label class="input">
                                                <input type="text" name="percent_bonus_point1" id="percent_bonus_point1" oninput="calcPoint(1)">
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Total Point</label>
                                            <label class="input">
                                                <input type="text" name="total_point1" id="total_point1">
                                            </label>
                                        </section>
                                        <input type="hidden" id="pointhid1" name="pointhid1">
                                    </div>
                                </fieldset>
                            </div>
                    </div>
                    <div>
                        <footer align="right">
                            <button class="btn btn-primary" onclick="addMultiplePoint()">
                                Submit
                            </button>
                            <button type="button" class="btn btn-default" onclick="window.history.back();">
                                Back
                            </button>
                        </footer>
                        <br>
                    </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>DUP</th>
                                    <th>Outlet Name</th>
                                    <th>Member</th>
                                    <th>Period</th>
                                    <th>Sub Channel</th>
                                    <th>Trade Channel</th>
                                    <th>Outlet Location</th>
                                    <th>Transaction Date</th>
                                    <th>Received Date</th>
                                    <th>Product</th>
                                    <th>product Grammage</th>
                                    <th>Price PerUnit</th>
                                    <th>Quantity</th>
                                    <th>Percent Bonus</th>
                                    <th>Total Point</th>
                                    <th>Created By</th>
                                    <th>Created On</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <?php ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- ADD POINT EARNING -->
                <div class="tab-pane fade" id="s9">
                    <div>
                        <fieldset>
                            <form method="post" class="smart-form">
                                <header> Add Point Earning </header>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <input type="hidden" id="member" name="member" value="<?php echo $get_detail->id; ?>">
                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="label">Period</label>
                                            <label class="select">
                                                <select id="period2" name="period2">
                                                    <option value="null">Choose Period</option>
                                                    <?php foreach($period as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_loyalty_period; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Channel</label>
                                            <label class="select">
                                                <select id="channel2" name="channel2" onchange="getSubChannel(2)">
                                                    <option value="null">Choose Channel</option>
                                                    <?php foreach($channel as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_loyalty_channel; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Sub Channel</label>
                                            <label class="select">
                                                <select id="sub_channel2" name="sub_channel2">
                                                    <option value="null">Choose Sub Channel</option>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                        <section class="col col-3">
                                            <label class="label">Trade Channel</label>
                                            <label class="select">
                                                <select id="trade_channel2" name="trade_channel2">
                                                    <option value="null">Choose Trade Channel</option>
                                                    <?php foreach($channel_trade as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_channel_trade; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Outlet Name</label>
                                            <label class="select">
                                                <select id="outlet_name2" name="outlet_name2" onchange="getLocation(2)">
                                                    <option value="null">Choose Outlet Name</option>
                                                    <?php foreach($outlet_name as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_outlet_group; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Outlet Location</label>
                                            <label class="select">
                                                <select id="outlet_location2" name="outlet_location2">
                                                    <option value="null">Choose Outlet Location</option>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-8">
                                            <label class="label">Transaction Date</label>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="transaction_date2" id="transaction_date2">
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-8">
                                            <label class="label">Received Date</label>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="received_date2" id="received_date2">
                                            </label>
                                        </section>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Product</label>
                                            <label class="select">
                                                <select id="product2" name="product2" onchange="getGrammage(2)">
                                                    <option value="null">Choose Product</option>
                                                    <?php foreach($product as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_loyalty_product; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Product Grammage</label>
                                            <label class="select">
                                                <select id="product_grammage2" name="product_grammage2" onchange="getPoint(2)">
                                                    <option value="null">Choose Product Grammage</option>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Quantity</label>
                                            <label class="select">
                                                <select id="quantity2" name="quantity2" onchange="calcPoint(2)">
                                                    <option value="null">Choose Quantity</option>
                                                    <?php for($i=1; $i < 11; $i++){ ?>
                                                        <option value="<?php echo $i; ?>">
                                                            <?php echo $i; ?>
                                                        </option>
                                                        <?php } ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Price per Unit</label>
                                            <label class="input">
                                                <input type="text" name="price_per_unit2" id="price_per_unit2">
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Percent Bonus Point</label>
                                            <label class="input">
                                                <input type="text" name="percent_bonus_point2" id="percent_bonus_point2" oninput="calcPoint(2)">
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Total Point</label>
                                            <label class="input">
                                                <input type="text" name="total_point2" id="total_point2">
                                            </label>
                                        </section>
                                        <input type="hidden" id="pointhid2" name="pointhid2">
                                    </div>
                                </div>

                                <div>
                                    <footer align="right">
                                        <button class="btn btn-primary" onclick="addPoint()">
                                            Submit
                                        </button>
                                        <button type="button" class="btn btn-default" onclick="window.history.back();">
                                            Back
                                        </button>
                                    </footer>
                                    <br>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                </div>
                <!-- SUBMIT REDEMPTION -->
                <div class="tab-pane fade" id="s10">
                    <div>
                        <fieldset>
                            <form method="post" class="smart-form">
                                <header> Submit Redemption </header>

                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="label">Period</label>
                                            <label class="select">
                                                <select id="period3" name="period3">
                                                    <option value="null">Choose Period</option>
                                                    <?php foreach($period as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_loyalty_period; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="label">Delivery Address</label>
                                            <label class="select">
                                                <select id="delivery_address3" name="delivery_address3">
                                                    <option value="null">Choose Address</option>
                                                    <?php foreach($address as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->address_1; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="label">Redeem Date</label>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="redeem_date3" id="redeem_date3">
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-5">
                                            <label class="label">Channel</label>
                                            <label class="select">
                                                <select id="channel3" name="channel3" onchange="getSubChannel(3)">
                                                    <option value="null">Choose Channel</option>
                                                    <?php foreach($channel as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_loyalty_channel; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                        <section class="col col-5">
                                            <label class="label">Sub Channel</label>
                                            <label class="select">
                                                <select id="sub_channel3" name="sub_channel3">
                                                    <option value="null">Choose Sub Channel</option>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="label">Reward ID</label>
                                            <label class="select">
                                                <select id="reward_id3" name="reward_id3" onchange="getPointNeed(3)">
                                                    <option value="null">Choose Reward ID</option>
                                                    <?php foreach($reward as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_reward; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="label">Quantity</label>
                                            <label class="select">
                                                <select id="quantity3" name="quantity3">
                                                    <option value="null">Choose Quantity</option>
                                                    <?php for($i=1; $i < 11; $i++){ ?>
                                                        <option value="<?php echo $i; ?>">
                                                            <?php echo $i; ?>
                                                        </option>
                                                        <?php } ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Point Balance</label>
                                            <input type="text" name="point_balance3" id="point_balance3">
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Point Needed</label>
                                            <input type="text" name="point_needed3" id="point_needed3">
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Stock Available</label>
                                            <input type="text" name="stock_available3" id="stock_available3">
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Spoon Needed</label>
                                            <input type="text" name="spoon_needed3" id="spoon_needed3">
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Spoon Submitted</label>
                                            <input type="text" name="total_point3" id="total_point3">
                                        </section>
                                    </div>
                                </div>
                                <div>
                                    <footer align="right">
                                        <button type="submit" class="btn btn-primary3" onclick="addRedemption(3)">
                                            Submit
                                        </button>
                                        <button type="button" class="btn btn-default3" onclick="window.history.back(3]);">
                                            Back
                                        </button>
                                    </footer>
                                    <br>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                </div>
                
                <!-- DELIVERY ADDRESS -->
                <div class="tab-pane fade" id="s12">
                    <div>
                        <fieldset>
                            <form method="post" class="smart-form">
                                <header> Delivery Address </header>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="label">Address Type</label>
                                            <label class="select">
                                                <select id="address_type" name="address_type">
                                                    <option value="null">Choose Address Type</option>
                                                    <?php foreach($address_type as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_address_type; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="label">Address Summary</label>
                                            <label class="input">
                                                <input type="text" name="address_summary" id="address_summary" readonly>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="label">Address</label>
                                            <label class="input">
                                                <input type="text" name="address" id="address">
                                            </label>
                                        </section>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="label">Kelurahan</label>
                                            <label class="input">
                                                <input type="text" name="kelurahan" id="kelurahan">
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="label">Kecamatan</label>
                                            <label class="input">
                                                <input type="text" name="kecamatan" id="kecamatan">
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Province</label>
                                            <label class="select">
                                                <select id="province" name="province" onchange="getCity()">
                                                    <option value="null">Choose Category</option>
                                                    <?php foreach($province as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_province; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">City</label>
                                            <label class="select">
                                                <select id="city" name="city">
                                                    <option value="null">Choose City</option>
                                                </select><i></i>
                                            </label>
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Zip Code</label>
                                            <label class="input">
                                                <input type="text" name="zip_code" id="zip_code">
                                            </label>
                                        </section>
                                    </div>
                                </div>
                                <div>

                                    <footer align="right">
                                        <button type="submit" class="btn btn-primary" onclick="updatePoint(<?php echo $cust_id; ?>)"> Copy From Member Data Adrress </button>
                                            <button class="btn btn-primary" onclick="addAddress()">
                                                Submit
                                            </button>
                                            <button type="button" class="btn btn-default" onclick="window.history.back();">
                                                Back
                                            </button>
                                    </footer>
                                    <br>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                </div>
                
                <!-- Need FU -->
                <div class="tab-pane fade" id="s11">
                    <div>
                        <fieldset>
                            <form method="post" class="smart-form">
                                <header> Need Follow-Up </header>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Customer</label>
                                            <label class="input">
                                                <input type="text" name="customer" id="customer" value="<?php echo $get_detail->wcrm_loyalty_member; ?>" readonly>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">FU Category</label>
                                            <label class="select">
                                                <select id="fucat" name="fucat">
                                                    <option value="null">Choose Category</option>
                                                    <?php foreach($fucat as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->call_name; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="label">Notes</label>
                                            <label class="input">
                                                <input type="text" name="note" id="note">
                                            </label>
                                        </section>
                                    </div>
                                </div>
                                <div>
                                    <footer align="right">
                                        <button class="btn btn-primary" onclick="addFU()">
                                            Submit
                                        </button>
                                        <button type="button" class="btn btn-default" onclick="window.history.back();">
                                            Back
                                        </button>
                                    </footer>
                                    <br>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                </div>
                <!-- REDEEM REQUEST -->
                <div class="tab-pane fade" id="s13">
                    <div>
                        <fieldset>
                            <form method="post" class="smart-form">
                                <header> Redeem Request </header>

                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Member</label>
                                            <label class="input">
                                                <input type="text" name="customer" id="customer" value="<?php echo $get_detail->wcrm_loyalty_member; ?>" readonly>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="label">Period</label>
                                            <label class="select">
                                                <select id="period4" name="period4">
                                                    <option value="null">Choose Period</option>
                                                    <?php foreach($period as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_loyalty_period; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="label">Delivery Address</label>
                                            <label class="select">
                                                <select id="delivery_address4" name="delivery_address4">
                                                    <option value="null">Choose Address</option>
                                                    <?php foreach($address as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->address_1; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="label">Redeem Date</label>
                                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                                <input type="text" name="redeem_date4" id="redeem_date4">
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-5">
                                            <label class="label">Channel</label>
                                            <label class="select">
                                                <select id="channel4" name="channel4" onchange="getSubChannel(4)">
                                                    <option value="null">Choose Channel</option>
                                                    <?php foreach($channel as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_loyalty_channel; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                        <section class="col col-5">
                                            <label class="label">Sub Channel</label>
                                            <label class="select">
                                                <select id="sub_channel4" name="sub_channel4">
                                                    <option value="null">Choose Sub Channel</option>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="label">Reward ID</label>
                                            <label class="select">
                                                <select id="reward_id4" name="reward_id4" onchange="getPointNeed(4)">
                                                    <option value="null">Choose Reward ID</option>
                                                    <?php foreach($reward as $data): ?>
                                                        <option value="<?php echo $data->id; ?>">
                                                            <?php echo $data->wcrm_reward; ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="label">Quantity</label>
                                            <label class="select">
                                                <select id="quantity4" name="quantity4">
                                                    <option value="null">Choose Quantity</option>
                                                    <?php for($i=1; $i < 11; $i++){ ?>
                                                        <option value="<?php echo $i; ?>">
                                                            <?php echo $i; ?>
                                                        </option>
                                                        <?php } ?>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Point Balance</label>
                                            <input type="text" name="point_balance4" id="point_balance4">
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Point Needed</label>
                                            <input type="text" name="point_needed4" id="point_needed4">
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Stock Available</label>
                                            <input type="text" name="stock_available4" id="stock_available4">
                                        </section>
                                    </div>
                                    <div class="row">
                                        <section class="col col-4">
                                            <label class="label">Spoon Needed</label>
                                            <input type="text" name="spoon_needed4" id="spoon_needed4">
                                        </section>
                                        <section class="col col-4">
                                            <label class="label">Spoon Submitted</label>
                                            <input type="text" name="total_point4" id="total_point4">
                                        </section>
                                    </div>
                                </div>
                                        <div>
                                            <footer align="right">
                                                <button class="btn btn-primary" onclick="addRedemption(4)">
                                                    Submit
                                                </button>
                                                <button type="button" class="btn btn-default" onclick="window.history.back();">
                                                    Back
                                                </button>
                                            </footer>
                                            <br>
                                        </div>
                                    </fieldset>
                                </div>
                            </form>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function setReceipt(ID) {
        var rec = $('#receipt').val();
        event.preventDefault();

        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/validateReceipt',
            data: {
                ID: ID,
                status: rec
            },
            cache: false,
            success: function(data) {
                console.log(data + "--" + ID);

                if (rec == 41) {
                    document.getElementById("input_point").style.display = "block";
                } else if (rec == 42) {
                    swal("Success", "", "success")
                        .then((value) => {
                            window.location = "http://103.23.21.178/crm/#dp/mbl/vbe";
                        });
                } else {
                    document.getElementById("input_point").style.display = "none";
                }
            }
        });
    }
    
    $(document).ready(function() {

        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/lp/member/getpointbalance',
            data: {
                member_id: $('#member').val()
            },
            cache: false,
            success: function(data) {
                document.getElementById('point_balance3').value = data;
                document.getElementById('point_balance4').value = data;
            }
        });
    })

    function addPoint() {
        console.log('pcb : ' +$('#percent_bonus_point2').val() + ' mem : ' + $('#member').val());

        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/lp/member/addpoint',
            data: {
                cust_id: $('#member').val(),
                period: $('#period2').val(),
                channel: $('#channel2').val(),
                sub_channel: $('#sub_channel2').val(),
                trade_channel: $('#trade_channel2').val(),
                outlet_name: $('#outlet_name2').val(),
                outlet_location: $('#outlet_location2').val(),
                received_date: $('#received_date2').val(),
                transaction_date: $('#transaction_date2').val(),
                product: $('#product2').val(),
                product_grammage: $('#product_grammage2').val(),
                quantity: $('#quantity2').val(),
                price_per_unit: $('#price_per_unit2').val(),
                percent_bonus_point: $('#percent_bonus_point2').val(),
                point: $('#total_point2').val(),
            },
            cache: false,
            success: function(response) {
                console.log(response);
                event.preventDefault();

                if (response == 'success') {
                    swal("Success", "", "success");
                } else {
                    swal("Failed", "", "error");
                }
            }
        });
    }
    
    function addMultiplePoint() {
        console.log('pcb : ' + $('#percent_bonus_point1').val() + ' mem : ' + $('#member').val());

        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/lp/member/addmultiplepoint',
            data: {
                cust_id: $('#member').val(),
                period: $('#period1').val(),
                channel: $('#channel1').val(),
                sub_channel: $('#sub_channel1').val(),
                trade_channel: $('#trade_channel1').val(),
                outlet_name: $('#outlet_name1').val(),
                outlet_location: $('#outlet_location1').val(),
                received_date: $('#received_date1').val(),
                transaction_date: $('#transaction_date1').val(),
                product: $('#product1').val(),
                product_grammage: $('#product_grammage1').val(),
                quantity: $('#quantity1').val(),
                price_per_unit: $('#price_per_unit1').val(),
                percent_bonus_point: $('#percent_bonus_point1').val(),
                point: $('#total_point1').val(),
            },
            cache: false,
            success: function(response) {
                console.log(response);
                event.preventDefault();

                if (response == 'success') {
                    swal("Success", "", "success");
                } else {
                    swal("Failed", "", "error");
                }
            }
        });
    }
    
    function addAddress() {
        console.log($('#address').val())
        $.ajax({
            type : "POST",
            dataType : "json",
            url: 'http://103.23.21.178/crm/lp/member/addaddress',
            data: {
                "member": $('#member').val(),
                "address_type": $('#address_type').val(),
                "address_summary": $('#address_summary').val(),
                "address": $('#address').val(),
                "kelurahan": $('#kelurahan').val(),
                "kecamatan": $('#kecamatan').val(),
                "province": $('#province').val(),
                "city": $('#city').val(),
                "zip_code": $('#zip_code').val(),
            },
            cache: false,
            success: function(response) {
                console.log(response);
                event.preventDefault();
                event.stopPropagation();
                
                if (response == 'success') {
                    swal("Success", "", "success");
                } else {
                    swal("Failed", "", "error");
                }
            }
        });
    }
    
    function addRedemption(IDF) {
        $.ajax({
            type : "POST",
            dataType : "json",
            url: 'http://103.23.21.178/crm/lp/member/addredemption',
            data: {
                "cust_id": $('#member').val(),
                "period": $('#period' + IDF).val(),
                "delivery_address": $('#delivery_address' + IDF).val(),
                "redeem_date": $('#redeem_date' + IDF).val(),
                "channel": $('#channel' + IDF).val(),
                "sub_channel": $('#sub_channel' + IDF).val(),
                "reward_id": $('#reward_id' + IDF).val(),
                "quantity": $('#quantity' + IDF).val(),
                "point_balance": $('#point_balance' + IDF).val(),
                "point_needed": $('#point_needed' + IDF).val(),
                "atock_available": $('#atock_available' + IDF).val(),
                "spoon_needed": $('#spoon_needed' + IDF).val(),
                "total_point": $('#total_point' + IDF).val(),
            },
            cache: false,
            success: function(response) {
                console.log(response);
                event.preventDefault();
                event.stopPropagation();
                
                if (response == 'success') {
                    swal("Success", "", "success");
                } else {
                    swal("Failed", "", "error");
                }
            }
        });
    }
    
    function addFU() {
        $.ajax({
            type : "POST",
            dataType : "json",
            url: 'http://103.23.21.178/crm/lp/member/addfu',
            data: {
                "cust_id": $('#member').val(),
                "fucat": $('#fucat').val(),
                "note": $('#note').val(),
            },
            cache: false,
            success: function(response) {
                console.log(response);
                
                if (response == 'success') {
                    swal("Success", "", "success");
                } else {
                    swal("Failed", "", "error");
                }
            }
        });
    }

    function getSubChannel(IDF) {
        var ID = $('#channel' + IDF).val();

        console.log()
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/get_subchannel',
            data: {
                channel_id: ID
            },
            cache: false,
            success: function(data) {
                console.log(data + "--" + ID);
                document.getElementById('sub_channel' + IDF).innerHTML = "" + data + "";
            }
        });
    }

    function getLocation(IDF) {
        var ID = $('#outlet_name' + IDF).val();

        console.log()
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/get_subsource',
            data: {
                source_id: ID
            },
            cache: false,
            success: function(data) {
                console.log(data + "--" + ID)
                document.getElementById('outlet_location' + IDF).innerHTML = "" + data + ""
            }
        });
    }

    function getPointNeed(IDF) {
        var ID = $('#reward_id' + IDF).val();
        var point_balance = $('#point_balance' + IDF).val();

        console.log()
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/lp/member/getpointneed',
            data: {
                reward_id: ID
            },
            cache: false,
            success: function(data) {
                
                var obj = JSON.parse(data);
                console.log(obj.point + "--" + ID);
                
                document.getElementById('point_needed' + IDF).value = obj.point;
                document.getElementById('stock_available' + IDF).value = obj.stock;
            }
        });
    }
    
    function getGrammage(IDF) {
        var ID = $('#product' + IDF).val();

        console.log()
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/get_grammage',
            data: {
                product_id: ID
            },
            cache: false,
            success: function(data) {
                console.log(data + "--" + ID)
                document.getElementById('product_grammage' + IDF).innerHTML = "" + data + ""
            }
        });
    }
    
    function getCity() {
        var ID = $('#province').val();

        console.log()
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/lp/member/getCity',
            data: {
                province_id: ID
            },
            cache: false,
            success: function(data) {
                console.log(data + "--" + ID)
                document.getElementById('city').innerHTML = "" + data + ""
            }
        });
    }
    
    function getSummary(){
        var city = $("#city option:selected").text();
        var address = $('#address').val();
        var address_type = $("#address_type option:selected").text();
        document.getElementById('city').value = '[' + address_type + '] - ' + address + ' - ' + city;
    }

    $('#transaction_date1').datepicker({
        language: 'en',
        timepicker: true,
        position: 'top left',
        dateFormat: 'd M yyyy',
        timeFormat: 'h:i',
        onSelect: function(date) {
            console.log("masuk sini");
            $('#received_date1').datepicker({
                dateFormat: 'd M yyyy',
                language: 'en',
                position: 'top left',
                minDate: new Date(date),
            });
        }
    });

    $('#transaction_date2').datepicker({
        language: 'en',
        timepicker: true,
        position: 'top left',
        dateFormat: 'd M yyyy',
        timeFormat: 'h:i',
        onSelect: function(date) {
            console.log("masuk sini");
            $('#received_date2').datepicker({
                dateFormat: 'd M yyyy',
                language: 'en',
                position: 'top left',
                minDate: new Date(date),
            });
        }
    });
    
    $('#redeem_date3').datepicker({
        language: 'en',
        timepicker: true,
        position: 'top left',
        dateFormat: 'd M yyyy',
        timeFormat: 'h:i',
    });
    
    $('#redeem_date4').datepicker({
        language: 'en',
        timepicker: true,
        position: 'top left',
        dateFormat: 'd M yyyy',
        timeFormat: 'h:i',
    });

    function getPoint(IDF) {
        var ID = $('#product_grammage' + IDF).val();

        console.log()
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/get_point',
            data: {
                product_grammage_id: ID
            },
            cache: false,
            success: function(data) {
                console.log(data + "--" + ID)
                document.getElementById('pointhid' + IDF).value = data;
            }
        });
    }

    function calcPoint(IDF) {
        var point = $('#pointhid' + IDF).val() || 0;
        var qty = $('#quantity' + IDF).val() || 1;
        var percent = $('#percent_bonus_point' + IDF).val() || 0;
        var result = (point * qty) + (point * percent / 100);

        console.log(result + ' ' + percent);
        document.getElementById('total_point' + IDF).value = result;
    }
    
    $(document).ready(function() {
        var city = $("#city option:selected").text() || '';
        var address = $('#address').val() || '';
        var address_type = $("#address_type option:selected").text() || '';
        document.getElementById('city').value = '[' + address_type + '] - ' + address + ' - ' + city;
    })
</script>