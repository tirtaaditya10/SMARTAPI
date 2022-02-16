<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div role="main">
    <!-- MAIN CONTENT -->
    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark"><i class="fa fa-table fa-fw "></i> Stock Transaction</h1>
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
                                            <th>Type</th>
                                            <th>Item ID</th>
                                            <th>Warehouse ID</th>
                                            <th>Trans Category</th>
                                            <th>Quantity</th>
                                            <th>Reference</th>
                                            <th>Trans Date</th>
                                            <th>Note</th>
                                            <th>Created by</th>
                                            <th>Created on</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $query = 'SELECT b.wcrm_inv_trans_dir,
                                        c.wcrm_reward,
                                        d.wcrm_warehouse,
                                        e.wcrm_inv_trans_category,
                                        a.qty,
                                        a.reference,                                        
                                        a.transacted_on,
                                        a.notes,
                                        a.aaa_account_id,
                                        a.created_on
                                    FROM  wcrm_reward_transaction a
                                    LEFT JOIN wcrm_inventory_direction b ON a.wcrm_inventory_direction_id = b.id
                                    LEFT JOIN wcrm_reward c ON a.wcrm_reward_id = c.id
                                    LEFT JOIN wcrm_warehouse d ON a.wcrm_warehouse_id = d.id
                                    LEFT JOIN wcrm_inventory_category e ON a.wcrm_inventory_category_id = e.id
                                    ORDER BY a.created_on DESC LIMIT 50';
                                    $getData = $this->db->query($query);
                                    foreach ($getData->result() as $data):
                                    ?>
                                        <tr>
                                            <td><?php echo $data->wcrm_inv_trans_dir; ?></td>
                                            <td><?php echo $data->wcrm_reward; ?></td>
                                            <td><?php echo $data->wcrm_warehouse; ?></td>
                                            <td><?php echo $data->wcrm_inv_trans_category; ?></td>
                                            <td><?php echo $data->qty; ?></td>
                                            <td><?php echo $data->reference; ?></td>
                                            <td><?php echo $data->transacted_on; ?></td>
                                            <td><?php echo $data->notes; ?></td>
                                            
                                            <td><?php echo $data->aaa_account_id; ?></td>
                                            <td><?php echo $data->created_on; ?></td>
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

    $(document).ready(function() {
        // PAGE RELATED SCRIPTS
    })

</script>
