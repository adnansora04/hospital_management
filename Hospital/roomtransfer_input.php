<?php
session_start();
if ($_SESSION['khname']==''){header("Location:login.php");}else{
$username=$_SESSION['khname'];
$branch=$_SESSION['khbranch'];
}
include ("config.php");
	if(isset($_GET['delete'])){
		 
			$code = $_GET['delete'];
			mysqli_query($con,"Delete from roomtransfer_entry where code = '$code'") ;
			mysqli_query($con,"Delete from patient_ac where code = '$code'") ;
			header("location:roomtransfer_report.php");
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
									$attedname=$_POST['attedname'];
									$curroomno=$_POST['curroomno'];
									$pname=$_POST['pname'];
									$q2=mysqli_query($con,"select code from patiant_mst where pname='$pname'");
									$r2=mysqli_fetch_array($q2);
									$pcode=$r2[0];
								    $mob=$_POST['mob'];
									$newroom=$_POST['newroom'];
									$pentrycode=$_POST['pentrycode'];
									$time=$_POST['time'];
                     $qry="INSERT INTO `roomtransfer_entry`(`code`,`dt`,`attedname`,`curroomno`,`pname`,`mob`,`newroom`,`pentrycode`,`time`) VALUES ('$code','$dt','$attedname','$curroomno','$pcode','$mob','$newroom','$pentrycode','$time')";
										//echo $qry;
									if(mysqli_query($con,$qry)){
									mysqli_query($con,"INSERT INTO `patient_ac`(`code`, `dt`, `pname`, `roomno`,`rtflag`)VALUES('$code','$dt','$pcode','$newroom','Yes')");
									mysqli_query($con,"UPDATE `patient_ac` SET `rtflag`='' WHERE roomno='$curroomno'");
									mysqli_query($con,"UPDATE `room_mst` SET `occupation`='' WHERE `code`='$curroomno'");
									mysqli_query($con,"UPDATE `room_mst` SET `occupation`='1' WHERE `code`='$newroom'");
									}
									header("location:roomtransfer_report.php");
					}
			}


if($_POST['update']=="Update")		
{									
											
									$code=$_POST['code'];
									$dt=$_POST['dt'];
									$attedname=$_POST['attedname'];
									
									$curroomno=$_POST['curroomno'];
									$pname=$_POST['pname'];
									$q2=mysqli_query($con,"select code from patiant_mst where pname='$pname'");
									$r2=mysqli_fetch_array($q2);
									$pcode=$r2[0];
								    $mob=$_POST['mob'];
									$newroom=$_POST['newroom'];
									$pentrycode=$_POST['pentrycode'];
									$time=$_POST['time'];
									mysqli_query($con,"Delete from roomtransfer_entry where code = '$code'") ;
									
                				$qry="INSERT INTO `roomtransfer_entry`(`code`,`dt`,`attedname`,`curroomno`,`pname`,`mob`,`newroom`,`pentrycode`,`time`) VALUES ('$code','$dt','$attedname','$curroomno','$pcode','$mob','$newroom','$pentrycode','$time')";
	
									if(mysqli_query($con,$qry)){
									mysqli_query($con,"Delete from patient_ac where code = '$code'") ;
									mysqli_query($con,"INSERT INTO `patient_ac`(`code`, `dt`, `pname`, `roomno`,`rtflag`)VALUES('$code','$dt','$pcode','$newroom','Yes')");
									mysqli_query($con,"UPDATE `room_mst` SET `occupation`='' WHERE `code`='$curroomno'");
									mysqli_query($con,"UPDATE `room_mst` SET `occupation`='1' WHERE `code`='$newroom'");
									}
									
										header("location:roomtransfer_report.php");
					
}
?>
