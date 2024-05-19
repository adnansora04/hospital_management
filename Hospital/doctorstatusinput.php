<?php
include('config.php');
if(isset($_POST['update'])){
			  $numofcheckbox= count($_POST['records']);
				  $i=0;
				  while($i<$numofcheckbox){
				  $status=$_POST['newst'];
				  $keytoupdate = $_POST['records'][$i];
				   	mysqli_query($con,"UPDATE `patientdis_entry` SET `billstatus`='$status' WHERE `code`='$keytoupdate'");
					$qr=mysqli_query($con,"select roomno from patientdis_entry where code='$keytoupdate'");
					$r1=mysqli_fetch_array($qr);
					$roomcode=$r1[0];
					 mysqli_query($con,"UPDATE `room_mst` SET `occupation`='' WHERE `code`='$roomcode'");
					$i++;
					}
				 	header('location:patient-pending-report.php');  
			  }
?>