<?php 
	$sql = 'SELECT * 
		FROM upl_stage_customer 
		WHERE id="'.$cust_id.'"';

	$rst               = $this->db->query($sql)->result_array();
	$row               = $rst[0];
	$cust_name         = $row['customer_name'];
	$cust_email        = $row['email'];
	$cust_member       = $row['customer_name'];
	$cust_child        = $row['children_name'];
	$cust_phone1       = $row['phone_number_1'];
	$cust_phone2       = $row['phone_number_2'];
	$cust_address      = $row['address'];
    $rcp               = $row['upl_receipt_check_id'];
    $acq_date          = $row['acq_date'];
	
?>
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
            <h4 class="media-heading">Validate by Eye Detail</h4>
            <hr class="simple">

            <div class="col-md-6">
                <div class="col-md-5"><strong>Customer Name</strong></div>
                <div class="col-md-7">: <?php echo $cust_name; ?></div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Child Name</strong></div>
                <div class="col-md-7">: <?php echo $cust_child; ?></div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Phone 1</strong></div>
                <div class="col-md-7">: <?php echo $cust_phone1; ?></div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Phone 2</strong></div>
                <div class="col-md-7">: <?php echo $cust_phone2; ?></div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Address</strong></div>
                <div class="col-md-7">: <?php echo $cust_address; ?></div>
            </div>
            <div class="col-md-6">
                <div class="col-md-5"><strong>Acq Date</strong></div>
                <div class="col-md-7">: <?php echo $acq_date; ?></div>
            </div>
            <div class="col-md-6">
                <br>
                <form class="smart-form">
                    <section>
                        <label class="select">
                            <select id="receipt" name="receipt" onchange="setReceipt(<?php echo $cust_id; ?>)">
                                <option value="40" <?php echo ($rcp == 40) ? 'selected' : ''; ?>>Not Yet Checked</option>
                                <option value="41" <?php echo ($rcp == 41) ? 'selected' : ''; ?>>Valid Receipt</option>
                                <option value="42" <?php echo ($rcp == 42) ? 'selected' : ''; ?>>Invalid Receipt</option>
                            </select> <i></i> 
                        </label>
                    </section>
                    <input type="hidden" id="receiptStat" name="receiptStat" value="<?php echo $rcp; ?>"> 
                </form>
            </div>
        </div>
        <!-- end widget content -->
    </div>
    <!-- end widget div -->

</div>

<div class="jarviswidget" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" id="input_point" style="display:none;">
        <!-- widget div-->
    <div>

        <!-- widget edit box -->
        <div class="jarviswidget-editbox">
            <!-- This area used as dropdown edit box -->

        </div>
        <!-- end widget edit box -->

        <!-- widget content -->
        <div class="widget-body no-padding">

            <form method="post" class="smart-form" action="/crm/#dp/mbl/vbe/">
                <header> Insert Pointt </header>

                <div class="col-sm-12 col-md-12 col-lg-6">
                    <fieldset>
                        <section>
                            <label class="label">Period</label>
                            <label class="select">
                                <select id="period" name="period">
                                     <option value="null">Choose Period</option>
                                <?php foreach($period as $data): ?>
                                    <option value="<?php echo $data->id; ?>"><?php echo $data->wcrm_loyalty_period; ?></option>
                                <?php endforeach; ?> 
                                </select> <i></i> 
                            </label>
                        </section>
                        <section>
                            <label class="label">Channel</label>
                            <label class="select">
                                <select id="channel" name="channel" onchange="getSubChannel()">
                                    <option value="null">Choose Channel</option>
                                <?php foreach($channel as $data): ?>
                                    <option value="<?php echo $data->id; ?>"><?php echo $data->wcrm_loyalty_channel; ?></option>
                                <?php endforeach; ?> 
                                </select> <i></i> 
                            </label>
                        </section>
                        <section>
                            <label class="label">Sub Channel</label>
                            <label class="select">
                                <select id="sub_channel" name="sub_channel">
                                    <option value="null">Choose Sub Channel</option>
                                </select> <i></i> 
                            </label>
                        </section>
                        <section>
                            <label class="label">Trade Channel</label>
                            <label class="select">
                                <select id="trade_channel" name="trade_channel">
                                    <option value="null">Choose Trade Channel</option>
                                    <?php foreach($channel_trade as $data): ?>
                                        <option value="<?php echo $data->id; ?>"><?php echo $data->wcrm_channel_trade; ?></option>
                                    <?php endforeach; ?>
                                </select> <i></i> 
                            </label>
                        </section>
                        <section>
                            <label class="label">Outlet Name</label>
                            <label class="select">
                                <select id="outlet_name" name="outlet_name" onchange="getLocation()">
                                    <option value="null">Choose Outlet Name</option>
                                <?php foreach($outlet_name as $data): ?>
                                    <option value="<?php echo $data->id; ?>"><?php echo $data->wcrm_outlet_group; ?></option>
                                <?php endforeach; ?>
                                </select> <i></i> 
                            </label>
                        </section>
                        <section>
                            <label class="label">Outlet Location</label>
                            <label class="select">
                                <select id="outlet_location" name="outlet_location">
                                    <option value="null">Choose Outlet Location</option>
                                </select> <i></i> 
                            </label>
                        </section> 
                        <section>
                            <label class="label">Transaction Date</label>
                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                <input type="text" name="transaction_date" id="transaction_date" onchange="getdate()">
                            </label>
                        </section>
                        <section>
                            <label class="label">Received Date</label>
                            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                <input type="text" name="received_date" id="received_date">
                            </label>
                        </section>
                    </fieldset>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <fieldset>
                        <section>
                            <label class="label">Product</label>
                            <label class="select">
                                <select id="product" name="product" onchange="getGrammage()">
                                    <option value="null">Choose Product</option>
                                    <?php foreach($product as $data): ?>
                                        <option value="<?php echo $data->id; ?>"><?php echo $data->wcrm_loyalty_product; ?></option>
                                    <?php endforeach; ?>
                                </select> <i></i> 
                            </label>
                        </section>
                        <section>
                            <label class="label">Product Grammage</label>
                            <label class="select">
                                <select id="product_grammage" name="product_grammage" onchange="getPoint()">
                                    <option value="null">Choose Product Grammage</option>
                                </select> <i></i> 
                            </label>
                        </section>
                        <section> 
                            <label class="label">Quantity</label>
                            <label class="select">
                                <select id="quantity" name="quantity" onchange="calcPoint()">
                                    <option value="null">Choose Quantity</option>
                                    <?php for($i=1; $i < 11; $i++){ ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select> <i></i> 
                            </label>
                        </section>
                        <section>
                            <label class="label">Price per Unit</label>
                            <label class="input">
                                <input type="text" name="price_per_unit" id="price_per_unit">
                            </label>
                        </section>
                        <section>
                            <label class="label">Percent Bonus Point</label>
                            <label class="input">
                                <input type="text" name="percent_bonus_point" id="percent_bonus_point" oninput="calcPoint()">
                            </label>
                        </section>
                        <section>
                            <label class="label">Total Point</label>
                            <label class="input">
                                <input type="text" name="total_point" id="total_point">
                            </label>
                        </section>
                        <input type="hidden" id="pointhid" name="pointhid">
                    </fieldset>
                </div>
                <footer>
                    <button type="submit" class="btn btn-primary" onclick="updatePoint(<?php echo $cust_id; ?>)">
                        Submit
                    </button>
                    <button type="button" class="btn btn-default" onclick="window.history.back();">
                        Back
                    </button>
                </footer>
            </form>

        </div>
        <!-- end widget content -->

    </div>
    <!-- end widget div -->

</div>

<!-- ==========================CONTENT ENDS HERE ========================== -->

<script>
    
    $('#formWidya').on('submit', function(e) {
        e.preventDefault();
        
        var period  = $('#period').val();
        var point   = $('#total_point').val();
        console.log("period " + period);
            
    });

    $( document ).ready(function() {
        var recStat = $('#receiptStat').val();
        if(recStat == 41){
            document.getElementById("input_point").style.display = "block";
        } else {
            document.getElementById("input_point").style.display = "none";
        }
    });
    
    function setReceipt(ID) {
        var rec = $('#receipt').val();
        event.preventDefault();
        
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/validateReceipt',
            data: {
                ID: ID,
                status:  rec
            },
            cache: false,
            success: function(data) {
                console.log(data + "--" + ID);
                
                if(rec == 41){
                    document.getElementById("input_point").style.display = "block";
                } else if(rec == 42){
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
	
    function addPoint(){
        var period  = $('#period').val();
        var point   = $('#total_point').val();
        console.log("period " + period);
        
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/addpoint',
            data: {
                period: period,
                point:  point
            },
            cache: false,
            success: function (response) {
                console.log(period + ' ' + point + ' ' + response);
                /*if(data == 'success'){
                    swal("Success", "", "success");
                } else {
                    swal("Failed", "", "error");
                }*/
            }
        });
    }
    
    function updatePoint(ID){
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/update_point',
            data: {
                cust_id: ID,
                period:  $('#period').val(),
                channel:  $('#channel').val(),
                sub_channel:  $('#sub_channel').val(),
                trade_channel:  $('#trade_channel').val(),
                outlet_name:  $('#outlet_name').val(),
                outlet_location:  $('#outlet_location').val(),
                received_date:  $('#received_date').val(),
                transaction_date:  $('#transaction_date').val(),
                product:  $('#product').val(),
                product_grammage:  $('#product_grammage').val(),
                quantity:  $('#quantity').val(),
                price_per_unit:  $('#price_per_unit').val(),
                percent_bonus_point:  $('#percent_bonus_point').val(),
                point:  $('#total_point').val(),
            },
            cache: false,
            success: function(data) {
                console.log(data + " " + ID);
                
                if(data == 'success'){
                    swal("Success", "", "success");
                } else {
                    swal("Failed", "", "error");
                }
            }
        });
        
    }
    
    function getSubChannel(){
        var ID = $('#channel').val();

        console.log()
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/get_subchannel',
            data: {
                channel_id  : ID
            },
            cache: false,
            success: function (data) {
                console.log(data + "--" + ID);
                document.getElementById('sub_channel').innerHTML = "" + data + "";
            }
        });
    }
    
    function getLocation() {
        var ID = $('#outlet_name').val();

        console.log()
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/get_subsource',
            data: {
                source_id   : ID
            },
            cache: false,
            success: function (data) {
                console.log(data + "--" + ID)
                document.getElementById('outlet_location').innerHTML = "" + data + ""
            }
        });
    }
    
    function getGrammage(){
        var ID = $('#product').val();

        console.log()
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/get_grammage',
            data: { 
                product_id   : ID
            },
            cache: false,
            success: function (data) {
                console.log(data + "--" + ID)
                document.getElementById('product_grammage').innerHTML = "" + data + ""
            }
        });
    }
    
    $('#transaction_date').datepicker({
        language : 'en',
        timepicker : true,
        position: 'top left',
        dateFormat: 'd M yyyy',
        timeFormat: 'h:i',
        onSelect : function(date){
            console.log("masuk sini");
            $('#received_date').datepicker({
                dateFormat : 'dd-mm-yy',
                language : 'en',
                position: 'top left',
                minDate : new Date(date),
            });
        }
    });
    
    function getPoint(){
        var ID = $('#product_grammage').val();

        console.log()
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/get_point',
            data: { 
                product_grammage_id   : ID
            },
            cache: false,
            success: function (data) {
                console.log(data + "--" + ID)
                document.getElementById('pointhid').value = data;
            }
        });
    }
    
    function calcPoint(){
        var point       = $('#pointhid').val() || 0;  
        var qty         = $('#quantity').val() || 1;
        var percent     = $('#percent_bonus_point').val() || 0;
        var result      = (point * qty) + (point * percent / 100); 
        
        console.log(result + ' ' + percent);
        document.getElementById('total_point').value = result;
    }
</script>