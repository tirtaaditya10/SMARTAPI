<div class="jarviswidget well" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">

            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->

            </div>
            <!-- widget content -->
            <div class="widget-body">
                <ul id="myTab1" class="nav nav-tabs bordered">
                    <li class="active">
                        <a href="#s1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-user"></i> Customer</a></a>
                    </li>
                    <li>
                        <a href="#s2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-child"></i> Child</a>
                    </li>
                    <li>
                        <a href="#s3" data-toggle="tab"><i class="fa fa-fw fa-lg fa-card"></i> Membership</a>
                    </li>
                </ul>

                <div id="myTabContent1" class="tab-content padding-10">
                    <div class="tab-pane fade in active" id="s1">
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
                                    <th>Cust name</th>
                                    <td>: </td>
                                    <th>Address</th>
                                    <td>: </td>
                                </tr>
                                <tr>
                                    <th>Member ID</th>
                                    <td>: </td>
                                    <th>Kelurahan</th>
                                    <td>: </td>
                                </tr>
                                <tr>
                                    <th>Phone number 1</th>
                                    <td>: </td>
                                    <th>Kecamatan</th>
                                    <td>: </td>
                                </tr>
                                <tr>
                                    <th>Phone number 2</th>
                                    <td>: </td>
                                    <th>City</th>
                                    <td>: </td>
                                </tr>
                                <tr>
                                    <th>Phone number 3</th>
                                    <td>: </td>
                                    <th>Created on</th>
                                    <td>: </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>: </td>
                                    <th>Oid</th>
                                    <td>: </td>
                                </tr>
                                <tr>
                                    <th>Sudah member parenting club?</th>
                                    <td>: </td>
                                    <th>Reward reference 1</th>
                                    <td>: </td>
                                </tr>
                                <tr>
                                    <th>Bersedia didaftarkan di PC?</th>
                                    <td>: </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <?php $this->load->view('__crm/cc/my_call_list_detail_customer'); ?>
                    </div>
                    <div class="tab-pane fade" id="s2">
                        <p>
                            Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee.
                        </p>
                    </div>
                    <div class="tab-pane fade" id="s3">
                        <p>
                            Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                        </p>
                    </div>
                </div>

            </div>
            <!-- end widget content -->
