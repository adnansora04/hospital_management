<?php
session_start();
if ($_SESSION['khname']==''){header("Location:login.php");}else{
$username=$_SESSION['khname'];
$branch=$_SESSION['khbranch'];
}
include ("config.php");
	if(isset($_GET['delete'])){
		 
			$code = $_GET['delete'];
			mysqli_query($con,"Delete from patientdis_entry where code = '$code'") ;
			//mysqli_query($con,"Delete from cust_ac where code = '$code'") ;
			header("location:patientdis_report.php");
}

if($_POST['save']=="Save")
			  {
								ini_set("display_errors",1);
								error_reporting(E_ALL);				

								//echo"connected...";	
	
								if (!$con)
								{
									
										echo"connection unsuccessfull";}
								else{
									$code=$_POST['code'];
									$dt=$_POST['dt'];
									$attednamedis=$_POST['attednamedis'];
									$pname=$_POST['pname'];
									
									$q2=mysqli_query($con,"select code from patiant_mst where pname='$pname'");
									$r2=mysqli_fetch_array($q2);
									$pcode=$r2[0];
									$admitdt=$_POST['admitdt'];
								    $attednamead=$_POST['attednamead'];
								    $discdt=$_POST['discdt'];
								    $totday=$_POST['totday'];
								    $roomno=$_POST['roomno'];
									$q1=mysqli_query($con,"select code from room_mst where roomno='$roomno'");
									$r1=mysqli_fetch_array($q1);
									$roomcode=$r1[0];
								    $terrif=$_POST['terrif'];
								    $bllamtrs=$_POST['bllamtrs'];
									$time=$_POST['time'];
									$admittime=$_POST['admittime'];
                                   	$qry="INSERT INTO `patientdis_entry`(`code`,`dt`,`attednamedis`,`pname`,`admitdt`,`attednamead`,`discdt`,`totday`,`roomno`,`terrif`,`bllamtrs`,`time`,`admittime`) VALUES ('$code','$dt','$attednamedis','$pcode','$admitdt','$attednamead','$discdt','$totday','$roomcode','$terrif','$bllamtrs','$time','$admittime')";
										//echo $qry;
									if(mysqli_query($con,$qry)){
										//echo "UPDATE `room_mst` SET `occupation`='2' WHERE `code`='$roomcode'";
										mysqli_query($con,"UPDATE `patient_ac` SET `rtflag`='' WHERE roomno='$roomcode'");
										mysqli_query($con,"UPDATE `room_mst` SET `occupation`='2' WHERE `code`='$roomcode'");
									}
									
									header("location:patientdis_report.php");
					}
			}


if($_POST['update']=="Update")		
{									
											
									$code=$_POST['code'];
									$dt=$_POST['dt'];
									$attednamedis=$_POST['attednamedis'];
									$pname=$_POST['pname'];
									$q2=mysqli_query($con,"select code from patiant_mst where pname='$pname'");
									$r2=mysqli_fetch_array($q2);
									$pcode=$r2[0];
									$admitdt=$_POST['admitdt'];
								    $attednamead=$_POST['attednamead'];
								    $discdt=$_POST['discdt'];
								    $totday=$_POST['totday'];
								    $roomno=$_POST['roomno'];
									$q1=mysqli_query($con,"select code from room_mst where roomno='$roomno'");
									$r1=mysqli_fetch_array($q1);
									$roomcode=$r1[0];
								    $terrif=$_POST['terrif'];
								    $bllamtrs=$_POST['bllamtrs'];
									$billstatus=$_POST['billstatus'];
									$time=$_POST['time'];
									$admittime=$_POST['admittime'];
									mysqli_query($con,"Delete from patientdis_entry where code = '$code'") ;
									 $qry="INSERT INTO `patientdis_entry`(`code`,`dt`,`attednamedis`,`pname`,`admitdt`,`attednamead`,`discdt`,`totday`,`roomno`,`terrif`,`bllamtrs`,`time`,`admittime`) VALUES ('$code','$dt','$attednamedis','$pcode','$admitdt','$attednamead','$discdt','$totday','$roomcode','$terrif','$bllamtrs','$time','$admittime')";
									if(mysqli_query($con,$qry)){
										mysqli_query($con,"UPDATE `room_mst` SET `occupation`='2' WHERE `code`='$roomcode'");
									}
										header("location:patientdis_report.php");
					
}

	?>





