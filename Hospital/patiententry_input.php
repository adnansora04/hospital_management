<?php
session_start();
if ($_SESSION['khname']==''){header("Location:login.php");}else{
$username=$_SESSION['khname'];
$branch=$_SESSION['khbranch'];
}
include ("config.php");
	if(isset($_GET['delete'])){
		 
			$code = $_GET['delete'];
			$q1=mysqli_query($con,"select roomno from patient_entry where code='$code'");
			$r1=mysqli_fetch_array($q1);
			$roomno=$r1[0];
			mysqli_query($con,"UPDATE `room_mst` SET `occupation`='' WHERE `code`='$roomno'");
			mysqli_query($con,"Delete from patient_entry where code = '$code'") ;
			mysqli_query($con,"Delete from patient_ac where code = '$code'") ;
			header("location:patient_entry_report.php");
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
									$time=$_POST['time'];
									$attedname=$_POST['attedname'];
									$roomno=$_POST['roomno'];
									$q1=mysqli_query($con,"select code from room_mst where roomno='$roomno'");
									$r1=mysqli_fetch_array($q1);
									$roomcode=$r1[0];
								    $terrif=$_POST['terrif'];
								    $pname=$_POST['pname'];
									$mob=$_POST['mob'];
								    $city=$_POST['city'];
									$check=mysqli_query($con,"select pname from patiant_mst where code='$pname'");
									$res=mysqli_fetch_array($check);
									$mstpnm=$res[0];
									if($mstpnm==""){
										$qr1=mysqli_query($con,"select Max(cast(`code` as decimal)) as code1 from patiant_mst");
										$r1=mysqli_fetch_array($qr1);
										$code1=$r1['code1']+1;
										mysqli_query($con,"insert into patiant_mst(`code`,`pname`,`city`,`mob`)VALUES('$code1','$pname','$city','$mob')");
									}
								    if($mstpnm<>""){$pname=$_POST['pname'];}else{$pname=$code1;}
								    $depamt=$_POST['depamt'];
								    $mode=$_POST['mode'];
                                   	$qry="INSERT INTO `patient_entry`(`code`,`dt`,`time`,`attedname`,`roomno`,`terrif`,`pname`,`mob`,`city`,`depamt`,`mode`) VALUES ('$code','$dt','$time','$attedname','$roomcode','$terrif','$pname','$mob','$city','$depamt','$mode')";
									//	echo $qry;
									if(mysqli_query($con,$qry)){
										mysqli_query($con,"UPDATE `room_mst` SET `occupation`='1' WHERE `code`='$roomcode'");
										mysqli_query($con,"INSERT INTO `patient_ac`(`code`, `dt`, `pname`, `roomno`)VALUES('$code','$dt','$pname','$roomcode')");
									}
									header("location:index.php");
					}
			}


if($_POST['update']=="Update")
{									
											
									$code=$_POST['code'];
									$dt=$_POST['dt'];
									$time=$_POST['time'];
									$attedname=$_POST['attedname'];
									$roomno=$_POST['roomno'];
									$q1=mysqli_query($con,"select code from room_mst where roomno='$roomno'");
									$r1=mysqli_fetch_array($q1);
									$roomcode=$r1[0];
								    $terrif=$_POST['terrif'];
								    $pname=$_POST['pname'];
								    $mob=$_POST['mob'];
								    $city=$_POST['city'];
								    $depamt=$_POST['depamt'];
								    $mode=$_POST['mode'];
									mysqli_query($con,"Delete from patient_entry where code = '$code'") ;
									//mysqli_query($con,"Delete from patiant_ac where code = '$code'") ;
                                   $qry="INSERT INTO `patient_entry`(`code`,`dt`,`time`,`attedname`,`roomno`,`terrif`,`pname`,`mob`,`city`,`depamt`,`mode`) VALUES ('$code','$dt','$time','$attedname','$roomcode','$terrif','$pname','$mob','$city','$depamt','$mode')";
									if(mysqli_query($con,$qry)){
										mysqli_query($con,"UPDATE `room_mst` SET `occupation`='1' WHERE `code`='$roomcode'");
										mysqli_query($con,"Delete from patient_ac where code = '$code'") ;
										mysqli_query($con,"INSERT INTO `patient_ac`(`code`, `dt`, `pname`, `roomno`)VALUES('$code','$dt','$pname','$roomcode')");
									}
										header("location:patient_entry_report.php");
					
}




					?>





