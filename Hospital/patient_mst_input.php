<?php
session_start();
if ($_SESSION['khname']==''){header("Location:login.php");}else{
$username=$_SESSION['khname'];
$branch=$_SESSION['khbranch'];
}
include ("config.php");

	if(isset($_GET['delete'])){
		 
			$code = $_GET['delete'];
			mysqli_query($con,"Delete from patiant_mst where code = '$code'") ;
			//mysqli_query($con,"Delete from patiant_ac where code = '$code'") ;
			header("location: patient_mst_report.php");
}

if($_POST['update']=="Update")
{									
											
									$code=$_POST['code'];
									$pname=$_POST['pname'];
									$city=$_POST['city'];
									$mob=$_POST['mob'];
									mysqli_query($con,"Delete from patiant_mst where code = '$code'") ;
									//mysqli_query($con,"Delete from patiant_ac where code = '$code'") ;
                                   $qry="INSERT INTO `patiant_mst`(`code`, `pname`,`city`,`mob`) VALUES ('$code','$pname','$city','$mob')";
									//echo $qry;
									mysqli_query($con,$qry);
									
									header("location:patient_mst_report.php");
}




if($_POST['save']=="Save")
			  {	ini_set("display_errors",1);
								error_reporting(E_ALL);				

								//echo"connected...";	
	
								if (!$con)
								{
									
										echo"connection unsuccessfull";}
								else{
									$code=$_POST['code'];
									$pname=$_POST['pname'];
									$city=$_POST['city'];
									$mob=$_POST['mob'];
								
                                   	$qry="INSERT INTO `patiant_mst`(code,pname,city,mob) VALUES ('$code','$pname','$city','$mob')";
										//echo $qry;
									mysqli_query($con,$qry);
									header("location:patient_mst_report.php");
					}
			}

					?>





