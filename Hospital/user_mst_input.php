<?php
session_start();
if ($_SESSION['khname']==''){header("Location:login.php");}else{
$username=$_SESSION['khname'];
$branch=$_SESSION['ckhbranch'];
}
define('DB_SERVER','dbm.mksoftservice.com');
define('DB_USER','killolhospital');
define('DB_PASS' ,'e6epyru9a');
define('DB_NAME', 'dbserver_killolhospitaldb1');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

	if(isset($_GET['delete'])){
		 
			$code = $_GET['delete'];
			mysqli_query($con,"Delete from login where code = '$code'") ;
			//mysqli_query($con,"Delete from cust_ac where code = '$code'") ;
			header("location: user_mst_report.php");
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
									$unm=$_POST['unm'];
									$pwd=$_POST['pwd'];
									$cat=$_POST['cat'];
                                   	$qry="INSERT INTO `login`(`code`, `unm`, `pwd`, `cat`) VALUES ('$code','$unm','$pwd','$cat')";
										//echo $qry;
									mysqli_query($con,$qry);
									header("location:user_mst_report.php");
					}
			}


if($_POST['update']=="Update")
{									
											
									$code=$_POST['code'];
									$unm=$_POST['unm'];
									$pwd=$_POST['pwd'];
									$cat=$_POST['cat'];
									
									mysqli_query($con,"Delete from login where code = '$code'") ;
									$qry="INSERT INTO `login`(`code`, `unm`, `pwd`, `cat`) VALUES ('$code','$unm','$pwd','$cat')";
									if(mysqli_query($con,$qry)){
									
									header("location:user_mst_report.php");
									}
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
									$unm=$_POST['unm'];
									$pwd=$_POST['pwd'];
									$type=$_POST['type'];
									$cat=$_POST['cat'];
                                   	$qry="INSERT INTO `login`(`code`, `unm`, `pwd`,`cat`) VALUES ('$code','$unm','$pwd','$cat')";
										//echo $qry;
									mysqli_query($con,$qry);
									header("location:user_mst_report.php");
					}
}

					?>





