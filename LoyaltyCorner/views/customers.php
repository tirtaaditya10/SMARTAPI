<div class="pageheader">
    <h2><i class="fa fa-person"></i> Wyeth Mobile Customers Data</h2>
    <div class="breadcrumb-wrapper">
    </div>
</div>

<div class="contentpanel">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Procom Date</th>
                            <th>Mom Name</th>
                            <th>Child Name</th>
                            <th>Child DOB</th>
                            <th>Phone 1</th>
                            <th>Data Type</th>
                            <th>Product Category</th>
                            <th>Area</th>
                            <th>Sub Area</th>
                            <th>Channel</th>
                            <th>Source</th>
                            <th>Sub Source</th>
                            <th>Promo Act</th>
                            <th>Promo SubAct</th>
                            <th>Previous Product</th>
                            <th>Actual Produck</th>
                            <th>Start Used</th>
                            <th>Struck</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php 
//                            $getData = $this->db->get('tb_customers');
							$query = 'SELECT IF(aa.ganda1 IS NULL,2,aa.ganda1) AS ganda1, a.* 
								FROM `tb_mobile_customers` a
								LEFT JOIN (
										SELECT COUNT(oid) AS ganda1,oid
										FROM tb_mobile_customers
										GROUP BY Telp1 , TanggalLahir
									) AS aa
									ON aa.oid = a.oid';
                            $getData = $this->db->query($query);
                            foreach ($getData->result() as $value):
							if($value->ganda1 > 1){
                            ?>
                            <tr>
                            <td><b><?php echo $value->TanggalProcom;  ?> </b></td>
                            <td><b><?php echo $value->NamaIbu;  ?> </b></td>
                            <td><b><?php echo $value->NamaAnak;  ?></b></td>
                            <td><b><?php echo $value->TanggalLahir;  ?></b></td>
                            <td><b><?php echo $value->Telp1;  ?></b></td>
                            <td><b><?php echo $value->DataType;?> </b></td>
                            <td><b><?php echo $value->ProductCategory;?> </b></td>
                            <td><b><?php echo $value->Area;?> </b></td>
                            <td><b><?php echo $value->SubArea;?> </b></td>
                            <td><b><?php echo $value->Channel;?> </b></td>
                            <td><b><?php echo $value->Source;?> </b></td>
                            <td><b><?php echo $value->SubSource;?></b> </td>
                            <td><b><?php echo $value->AktivitasPromo;?> </b></td>
                            <td><b><?php echo $value->SubAktivitasPromo;?> </b></td>
                            <td><b><?php echo $value->AsalUsulProduct;  ?></b></td>
                            <td><b><?php echo $value->ActualProduct;  ?></b></td>
                            <td><b><?php echo $value->StartUsedProduct;  ?></b></td>
                            <td><a href="http://yppti.id/wyeth/images/<?php echo $value->Struk;?>" target="_blank">[ view ]</a> </td>
                            </tr>
							<?php 
							} else {
                            ?>
                            <tr>
                            <td><?php echo $value->TanggalProcom;  ?></td>
                            <td><?php echo $value->NamaIbu;  ?></td>
                            <td><?php echo $value->NamaAnak;  ?></td>
                            <td><?php echo $value->TanggalLahir;  ?></td>
                            <td><?php echo $value->Telp1;  ?></td>
                            <td><?php echo $value->DataType;?></td>
                            <td><?php echo $value->ProductCategory;?></td>
                            <td><?php echo $value->Area;?></td>
                            <td><?php echo $value->SubArea;?></td>
                            <td><?php echo $value->Channel;?></td>
                            <td><?php echo $value->Source;?></td>
                            <td><?php echo $value->SubSource;?></td>
                            <td><?php echo $value->AktivitasPromo;?></td>
                            <td><?php echo $value->SubAktivitasPromo;?></td>
                            <td><?php echo $value->AsalUsulProduct;  ?></td>
                            <td><?php echo $value->ActualProduct;  ?></td>
                            <td><?php echo $value->StartUsedProduct;  ?></td>
                            <td><a href="http://yppti.id/wyeth/images/<?php echo $value->Struk;?>" target="_blank">[ view ]</a> </td>
                            </tr>
							<?php 
							}
							?>
                            <?php endforeach ?>
                            
                    </tbody>
                </table>
            </div>
            <!-- table-responsive -->

        </div>
        <!-- panel-body -->
    </div>
    <!-- panel -->
</div>
<!-- contentpanel -->

