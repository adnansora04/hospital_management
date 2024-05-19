<?php
session_start();
if ($_SESSION['khname']==''){header("Location:login.php");}else{
$username=$_SESSION['khname'];
$branch=$_SESSION['khbranch'];
}
include ("config.php");

	if(isset($_GET['delete'])){
		 
			$code = $_GET['delete'];
			mysqli_query($con,"Delete from deposit_entry where code = '$code'") ;
			//mysqli_query($con,"Delete from cust_ac where code = '$code'") ;
			header("location:deposit_report.php");
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
									$roomno=$_POST['roomno'];
									$pname=$_POST['pname'];
									$q2=mysqli_query($con,"select code from patiant_mst where pname='$pname'");
									$r2=mysqli_fetch_array($q2);
									$pcode=$r2[0];
									$depamt=$_POST['depamt'];
								    $mode=$_POST['mode'];
								    
                                   	$qry="INSERT INTO `deposit_entry`(`code`,`dt`,`roomno`,`pname`,`depamt`,`mode`) VALUES ('$code','$dt','$roomno','$pcode','$depamt','$mode')";

										//echo $qry;
									mysqli_query($con,$qry);
									header("location:deposit_report.php");
					}
			}



if($_POST['update']=="Update")		
{									
											
									$code=$_POST['code'];
									$dt=$_POST['dt'];
									$roomno=$_POST['roomno'];
									$pname=$_POST['pname'];
									$q2=mysqli_query($con,"select code from patiant_mst where pname='$pname'");
									$r2=mysqli_fetch_array($q2);
									$pcode=$r2[0];
									$depamt=$_POST['depamt'];
								    $mode=$_POST['mode'];
								    
									mysqli_query($con,"Delete from deposit_entry where code = '$code'") ;
                                   	$qry="INSERT INTO `deposit_entry`(`code`,`dt`,`roomno`,`pname`,`depamt`,`mode`) VALUES ('$code','$dt','$roomno','$pcode','$depamt','$mode')";

										//echo $qry;
									mysqli_query($con,$qry);
									header("location:deposit_report.php");
					
}
	?>





