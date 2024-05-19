<?php
session_start();
if ($_SESSION['cfname']==''){header("Location:login.php");}else{
$username=$_SESSION['cfname'];
$branch=$_SESSION['cfbranch'];
}
include ("config.php");

	if(isset($_GET['delete'])){
		 
			$code = $_GET['delete'];
			mysqli_query($con,"Delete from treatment_mst where code = '$code'") ;
			//mysqli_query($con,"Delete from cust_ac where code = '$code'") ;
			header("location: treatment_mst_report.php");
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
									$treatment=$_POST['treatment'];
								    $rate=$_POST['rate'];
								    $type=$_POST['type'];
                                   	$qry="INSERT INTO  `treatment_mst`(code,treatment,rate,type) VALUES ('$code','$treatment','$rate','$type')";
										//echo $qry;
									mysqli_query($con,$qry);
									header("location:treatment_mst_report.php");
					}
			}

if($_POST['update']=="Update")
{									
											
									$code=$_POST['code'];
									$treatment=$_POST['treatment'];
								    $rate=$_POST['rate'];
								    $type=$_POST['type'];
									mysqli_query($con,"Delete from treatment_mst where code = '$code'") ;
									//mysqli_query($con,"Delete from patiant_ac where code = '$code'") ;
                                   	$qry="INSERT INTO  `treatment_mst`(code,treatment,rate,type) VALUES ('$code','$treatment','$rate','$type')";
									if(mysqli_query($con,$qry)){
								//mysqli_query($con,"insert into `patiant_ac`(`code`,`dt`,`custid`,`add`,`less`,`other`,`tds`)VALUES('$code','2022-04-01','$code','$opnbal','0','0','0')");
									}
									header("location:treatment_mst_report.php");
}







if($_POST['submit']=="Submit")
			  {
								ini_set("display_errors",1);
								error_reporting(E_ALL);				

								//echo"connected...";	
	
								if (!$con)
								{
									
										echo"connection unsuccessfull";}
								else{
									$code=$_POST['code'];
									$treatment=$_POST['treatment'];
								    $rate=$_POST['rate'];
								    $type=$_POST['type'];
                                   	$qry="INSERT INTO  `treatment_mst`(code,treatment,rate,type) VALUES ('$code','$treatment','$rate','$type')";
										//echo $qry;
									mysqli_query($con,$qry);
									header("location:treatment_mst_report.php");
					}
			}


					?>





