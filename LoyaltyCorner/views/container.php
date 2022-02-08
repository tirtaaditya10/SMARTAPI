<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url('assets/'); ?>Anchor-body.png" type="image/png">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <title>Wyeth</title>

    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/style.default.css" />

    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/jquery.tagsinput.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/colorpicker.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/dropzone.css" />
    <link href="<?php echo base_url('assets/')?>css/jquery.datatables.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
    </div>

    <section>

        <div class="leftpanel">

            <div class="logopanel">
                <img src="<?php echo base_url('assets/'); ?>logo.png" width="45%" style="margin-left: 50px; margin-right: auto;">
                <!--<h1><span>SatZAP</span></h1>-->
            </div>
            <!-- logopanel -->

            <div class="leftpanelinner">
                <h5 class="sidebartitle">Navigation</h5>
                <ul class="nav nav-pills nav-stacked nav-bracket">
                    <?php $uri = $this->uri->segment(1); $uri2 = $this->uri->segment(2); ?>
                    <li <?php echo($uri == '') ? 'class="active"' : ''; ?>><a href="<?php echo base_url(''); ?>"><i class="fa fa-user"></i> <span>Customers</span></a></li>
                </ul>
            </div>
            <!-- leftpanelinner -->
        </div>
        <!-- leftpanel -->

        <div class="mainpanel">

            <div class="headerbar">

                <a class="menutoggle"><i class="fa fa-bars"></i></a>

                <!-- header-right -->
            </div>
            <!-- headerbar -->
            <?php $this->load->view($content); ?>
        </div>
        <!-- mainpanel -->
    </section>

    <script src="<?php echo base_url('assets/'); ?>js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/jquery-ui-1.10.3.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/modernizr.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/toggles.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/retina.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/jquery.cookies.js"></script>

    <script src="<?php echo base_url('assets/'); ?>js/jquery.autogrow-textarea.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/bootstrap-timepicker.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/jquery.maskedinput.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/jquery.tagsinput.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/jquery.mousewheel.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/select2.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/dropzone.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/colorpicker.js"></script>

    <script src="<?php echo base_url('assets/')?>js/jquery.datatables.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>js/custom.js"></script>

    <script>
        jQuery(document).ready(function() {

            "use strict";
            jQuery('#table1').dataTable();
            
            jQuery('#abk').dataTable({
                searching: false,
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
            });
            
             jQuery('#aktivitas').dataTable({
                searching: false,
                "bLengthChange": false,
                "bFilter": true,
            });

            // Tags Input
            jQuery('#tags').tagsInput({
                width: 'auto'
            });

            // Select2
            jQuery(".select2").select2({
                width: '100%'
            });

            // Textarea Autogrow
            jQuery('#autoResizeTA').autogrow();

            // Color Picker
            if (jQuery('#colorpicker').length > 0) {
                jQuery('#colorSelector').ColorPicker({
                    onShow: function(colpkr) {
                        jQuery(colpkr).fadeIn(500);
                        return false;
                    },
                    onHide: function(colpkr) {
                        jQuery(colpkr).fadeOut(500);
                        return false;
                    },
                    onChange: function(hsb, hex, rgb) {
                        jQuery('#colorSelector span').css('backgroundColor', '#' + hex);
                        jQuery('#colorpicker').val('#' + hex);
                    }
                });
            }

            // Color Picker Flat Mode
            jQuery('#colorpickerholder').ColorPicker({
                flat: true,
                onChange: function(hsb, hex, rgb) {
                    jQuery('#colorpicker3').val('#' + hex);
                }
            });

            // Date Picker
            jQuery('#datepicker').datepicker();
            jQuery('#datepicker1').datepicker();

            jQuery('#datepicker-inline').datepicker();

            jQuery('#datepicker-multiple').datepicker({
                numberOfMonths: 3,
                showButtonPanel: true
            });

            // Spinner
            var spinner = jQuery('#spinner').spinner();
            spinner.spinner('value', 0);

            // Input Masks
            jQuery("#date").mask("99/99/9999");
            jQuery("#phone").mask("(999) 999-9999");
            jQuery("#ssn").mask("999-99-9999");

            // Time Picker
            jQuery('#timepicker').timepicker({
                defaultTIme: false
            });
            jQuery('#timepicker2').timepicker({
                showMeridian: false
            });
            jQuery('#timepicker3').timepicker({
                minuteStep: 15
            });

        });
    </script>

</body>

</html>