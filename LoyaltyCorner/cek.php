<?php
$kon = mysqli_connect("103.73.125.17",'wcrm_api',"Wy3th@crm#!","iop_sys_wcrm");
                     if (!$kon){
                        die("Koneksi database gagal:".mysqli_connect_error());
                     }else{
			echo "ok";
			}
                     ?>
