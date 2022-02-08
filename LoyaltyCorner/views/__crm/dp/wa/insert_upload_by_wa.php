<article class="col-sm-12 col-md-12 col-lg-12">
				
    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
        <!-- widget div-->
        <div>

            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->

            </div>
            <!-- end widget edit box -->

            <!-- widget content -->
            <div class="widget-body no-padding">

                <form action="http://103.23.21.178/crm/dp/mbl/insert_wa" method="post" enctype="multipart/form-data" class="smart-form" id="form_wa">
                    <header> Insert upload by WA</header>
                    
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <fieldset>
                            <section>
                                <label class="label">Procom Date</label>
                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="procom_date" id="procom_date">
                                </label>
                            </section>
                            <section>
                                <label class="label">Mom Name *</label>
                                <label class="input">
                                    <input type="text" name="mom_name" id="mom_name" required>
                                </label>
                            </section>
                            <section>
                                <label class="label">Child Name</label>
                                <label class="input">
                                    <input type="text" name="child_name" id="child_name">
                                </label>
                            </section>
                            <section>
                                <label class="label">Child Date of Birth *</label>
                                <label class="input"> <i class="icon-append fa fa-calendar"></i>
                                    <input type="text" name="child_bod" id="child_bod" required>
                                </label>
                            </section>
                            <section>
                                <label class="label">Phone (1) *</label>
                                <label class="input">
                                    <input type="text" name="phone_1" id="phone_1" required>
                                </label>
                            </section>
                            <section>
                                <label class="label">Phone (2)</label>
                                <label class="input">
                                    <input type="text" name="phone_2" id="phone_2">
                                </label>
                            </section>
                            <section>
                                <label class="label">Address</label>
                                <label class="input">
                                    <input type="text" name="address" id="address">
                                </label>
                            </section>
                            <section>
                                <label class="label">Email</label>
                                <label class="input">
                                    <input type="text" name="email" id="email">
                                </label>
                            </section>
                            <section>
                                <label class="label">Data Type</label>
                                <label class="select">
                                    <select id="data_type" name="data_type" onchange="getProductCat()">
                                        <option value="null">Choose Data Type</option>
                                    <?php foreach($data_type as $data): ?>
                                        <option value="<?php echo $data->id; ?>"><?php echo $data->upl_data_type; ?></option>
                                    <?php endforeach; ?>
                                    </select> <i></i> 
                                </label>
                            </section>
                            <section>
                                <label class="label">Product Category</label>
                                <label class="select">
                                    <select id="product_category" name="product_category">
                                        <option value="null">Choose Product Category</option>
                                    </select> <i></i> 
                                </label>
                            </section>
                            <section>
                                <label class="label">Channel</label>
                                <label class="select">
                                    <select id="channel" name="channel" onchange="getSource()">
                                        <option value="null">Choose Channel</option>
                                    <?php foreach($channel as $data): ?>
                                        <option value="<?php echo $data->id; ?>"><?php echo $data->wcrm_channel_trade; ?></option>
                                    <?php endforeach; ?>
                                    </select> <i></i> 
                                </label>
                            </section>
                            <section>
                                <label class="label">Upload Receipt</label>
                                <div class="input input-file">
                                    <span class="button"><input type="file" id="file" name="file" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
                                </div>
                            </section>
                        </fieldset>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <fieldset>
                            <section>
                                <label class="label">Source</label>
                                <label class="select">
                                    <select id="source" name="source" onchange="getSubsource()">
                                        <option value="null">Choose Source</option>
                                    </select> <i></i> 
                                </label>
                            </section>
                            <section>
                                <label class="label">Sub Source</label>
                                <label class="select">
                                    <select id="sub_source" name="sub_source">
                                        <option value="null">Choose Sub Source</option>
                                    </select> <i></i> 
                                </label>
                            </section>
                            <section>
                                <label class="label">Promo Activity</label>
                                <label class="select">
                                    <select id="promo_activity" name="promo_activity" onchange="getSubpromo()">
                                        <option value="null">Choose Promo Activity</option>
                                    <?php foreach($promo_activity as $data): ?>
                                        <option value="<?php echo $data->id; ?>"><?php echo $data->wcrm_promo_activity; ?></option>
                                    <?php endforeach; ?>
                                    </select> <i></i> 
                                </label>
                            </section>
                            <section>
                                <label class="label">Promo Sub Activity</label>
                                <label class="select">
                                    <select id="promo_sub_activity" name="promo_sub_activity" onchange="getGimmick()">
                                        <option value="null">Choose Promo Sub Activity</option>
                                    </select> <i></i> 
                                </label>
                            </section>
                            <section>
                                <label class="label">Gimmick</label>
                                <label class="select">
                                    <select id="gimmick" name="gimmick">
                                        <option value="null">Choose Gimmick</option>
                                    <?php foreach($gimmick as $data): ?>
                                        <option value="<?php echo $data->id; ?>"><?php echo $data->wcrm_gimmick; ?></option>
                                    <?php endforeach; ?>
                                    </select> <i></i> 
                                </label>
                            </section>
                            <section>
                                <label class="label">Previous Product</label>
                                <label class="select">
                                    <select id="previous_product" name="previous_product">
                                        <option value="null">Choose Previous Product</option>
                                    <?php foreach($prev_product as $data): ?>
                                        <option value="<?php echo $data->oid; ?>"><?php echo $data->fromproduct_name; ?></option>
                                    <?php endforeach; ?>
                                    </select> <i></i> 
                                </label>
                            </section>
                            <section>
                                <label class="label">Actual Product</label>
                                <label class="select">
                                    <select id="actual_product" name="actual_product">
                                        <option value="null">Choose Actual Product</option>
                                    <?php foreach($actual_product as $data): ?>
                                        <option value="<?php echo $data->oid; ?>"><?php echo $data->actualproduct_name; ?></option>
                                    <?php endforeach; ?>
                                    </select> <i></i> 
                                </label>
                            </section> 
                            <section>
                                <label class="label">Grammage</label>
                                <label class="select">
                                    <select id="grammage" name="grammage">
                                        <option value="null">Choose Grammage</option>
                                    <?php foreach($grammage as $data): ?>
                                        <option value="<?php echo $data->id; ?>"><?php echo $data->wcrm_grammage; ?></option>
                                    <?php endforeach; ?>
                                    </select> <i></i> 
                                </label>
                            </section> 
                            <section>
                                <label class="label">Quantity</label>
                                <label class="select">
                                    <select id="quantity" name="quantity">
                                        <option value="null">Choose Quantity</option>
                                    <?php for($i=1; $i < 11; $i++){ ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                        <option value=">10">>10</option>
                                    </select> <i></i> 
                                </label>
                            </section>
                            <section>
                                <label class="label">Batch ID</label>
                                <label class="input">
                                    <input type="text" name="batch_id" id="batch_id">
                                </label>
                            </section>
                            
                            <section>
                                <label class="label">Start Use Product</label>
                                <label class="select">
                                    <select id="month" name="month">
                                        <option value="null">Choose Month</option>
                                    <?php  
                                        $month  = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "Novemeber", "December");
                                        $i      = 0;
                                        foreach($month as $monthname):
                                    ?>
                                        <option value="<?php echo $i++; ?>"><?php echo $monthname; ?></option>
                                    <?php endforeach; ?>
                                    </select> <i></i> 
                                </label>
                            </section>
                            <section>
                                <label class="label">Start Use Product</label>
                                <label class="select">
                                    <select id="year" name="year">
                                        <option value="null">Choose Years</option>
                                    <?php  
                                        $years  = array_combine(range(date("Y"), 1969), range(date("Y"), 1969));
                                        $i      = 0;
                                        foreach($years as $year):
                                    ?>
                                        <option value="<?php echo $i++; ?>"><?php echo $year; ?></option>
                                    <?php endforeach; ?>
                                    </select> <i></i> 
                                </label>
                            </section>
                        </fieldset>
                        
                    </div>
                    <footer>
                        <button type="submit" class="btn btn-primary">
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
    <!-- end widget -->

</article>

<script>
    $('#procom_date').datepicker({
        dateFormat : 'dd.mm.yy',
        prevText : '<i class="fa fa-chevron-left"></i>',
        nextText : '<i class="fa fa-chevron-right"></i>',
        onSelect : function(selectedDate) {
            $('#finishdate').datepicker('option', 'minDate', selectedDate);
        }
    });
    
    $('#child_bod').datepicker({
        dateFormat : 'dd.mm.yy',
        prevText : '<i class="fa fa-chevron-left"></i>',
        nextText : '<i class="fa fa-chevron-right"></i>',
        onSelect : function(selectedDate) {
            $('#finishdate').datepicker('option', 'minDate', selectedDate);
        }
    });
    
    function getSource() {
        var ID = $('#channel').val();

        console.log()
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/get_source',
            data: {
                channel_id   : ID
            },
            cache: false,
            success: function (data) {
                console.log(data + "--" + ID)
                document.getElementById('source').innerHTML = "" + data + ""
            }
        });
    }
    
    function getSubsource() {
        var ID = $('#source').val();

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
                document.getElementById('sub_source').innerHTML = "" + data + ""
            }
        });
    }
    
    function getSubpromo() {
        var ID = $('#promo_activity').val();

        console.log()
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/get_promo_subactivity',
            data: {
                promo_activity_id   : ID
            },
            cache: false,
            success: function (data) {
                console.log(data + "--" + ID);
                document.getElementById('promo_sub_activity').innerHTML = "" + data + "";
            }
        });
    }
    
    function getProductCat() {
        var ID = $('#data_type').val();

        console.log()
        $.ajax({
            type: "POST",
            url: 'http://103.23.21.178/crm/dp/mbl/get_product_cat',
            data: {
                data_type_id  : ID
            },
            cache: false,
            success: function (data) {
                console.log(data + "--" + ID);
                document.getElementById('product_category').innerHTML = "" + data + "";
            }
        });
    }
    
    function insertdata(){
        $.ajax({
            url: 'http://103.23.21.178/crm/dp/mbl/insert_wa',
            type: 'POST',
            data: new FormData($("#form_wa")[0]),
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
            }
        });
    }
</script>