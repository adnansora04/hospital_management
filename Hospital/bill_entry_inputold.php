<?php
session_start();
if ($_SESSION['khname']==''){header("Location:login.php");}else{
$username=$_SESSION['khname'];}
include ("config.php");

	if(isset($_GET['delete'])){
		 
			$code = $_GET['delete'];
			mysqli_query($con,"Delete from bill_entry where billno = '$code'") ;
			//mysqli_query($con,"Delete from patiant_ac where code = '$code'") ;
			header("location:bill_report.php");
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
								        $billno=$_POST['billno'];
										$dt=$_POST['dt'];
										$billtype=$_POST['billtype'];
										$dtofadmiss=$_POST['dtofadmiss'];
										$dtfdisc=$_POST['dtfdisc'];
										$pname=$_POST['pname'];
										$diagnosis=$_POST['diagnosis'];
										$particular=$_POST['particular'];
										$rate=$_POST['rate'];
										$days=$_POST['days'];
										$ttl=$_POST['ttl'];
										$type=$_POST['type'];
										$ttl=$_POST['gttl'];
										$modefpay1=$_POST['modefpay1'];
										$modefpay2=$_POST['modefpay2'];
										$dcode=$_POST['dcode'];
								   		$qry="INSERT INTO `bill_entry`(`billno`, `dt`, `billtype`, `dtofadmiss`,`dtfdisc`, `pname`, `diagnosis`,`ttl`, `modefpay1`, `modefpay2`) VALUES ('$billno','$dt','$billtype','$dtofadmiss','$dtfdisc','$pname','$diagnosis','$ttl','$modefpay1','$modefpay2')";
										if(mysqli_query($con,$qry)){
											for ($i=0;$i<count($_POST['perticular']);$i++)
											   {		
													$j=$i+1;
												   $pcode=$_POST['perticular'][$i];

												   //this is item table
												   $qr="INSERT INTO `bill_child`(`billno`, `srno`, `perticular`, `rate`, `days`, `ttl`, `type`) VALUES('$billno','$j','".$_POST['perticular'][$i]."','".$_POST['rate'][$i]."','".$_POST['days'][$i]."','".$_POST['ttl'][$i]."','".$_POST['type'][$i]."')";
													if($pcode<>''){
														//echo $qr;
														 mysqli_query($con,$qr);
													  }
											   }
											mysqli_query($con,"UPDATE `patientdis_entry` SET `billstatus`='Cleared' WHERE code='$dcode'");
										}
										header("location:invoice.php?code=$billno");
					}
			}	



if($_POST['update']=="Update")
{									
											
										$billno=$_POST['billno'];
										$dt=$_POST['dt'];
										$billtype=$_POST['billtype'];
										$dtofadmiss=$_POST['dtofadmiss'];
										$dtfdisc=$_POST['dtfdisc'];
										$pname=$_POST['pname'];
										$diagnosis=$_POST['diagnosis'];
										$ttl=$_POST['ttl'];
										$modefpay1=$_POST['modefpay1'];
										$modefpay2=$_POST['modefpay2'];
										$particular=$_POST['particular'];
										$rate=$_POST['rate'];
										$days=$_POST['days'];
										$ttl=$_POST['gttl'];
										$type=$_POST['type'];
									mysqli_query($con,"Delete from bill_entry where billno = '$billno'") ;
									mysqli_query($con,"Delete from bill_child where billno = '$billno'") ;
                                   $qry="INSERT INTO `bill_entry`(`billno`, `dt`, `billtype`, `dtofadmiss`,`dtfdisc`, `pname`, `diagnosis`,`ttl`, `modefpay1`, `modefpay2`) VALUES('$billno','$dt','$billtype','$dtofadmiss','$dtfdisc','$pname','$diagnosis','$ttl','$modefpay1','$modefpay2')";
									if(mysqli_query($con,$qry)){
											for ($i=0;$i<count($_POST['perticular']);$i++)
											   {		
													$j=$i+1;
												   $pcode=$_POST['perticular'][$i];

												   //this is item table
												   $qr="INSERT INTO `bill_child`(`billno`, `srno`, `perticular`, `rate`, `days`, `ttl`, `type`) VALUES('$billno','$j','".$_POST['perticular'][$i]."','".$_POST['rate'][$i]."','".$_POST['days'][$i]."','".$_POST['ttl'][$i]."','".$_POST['type'][$i]."')";
													if($pcode<>''){
														//echo $qr;
														 mysqli_query($con,$qr);
													  }
											   }
										}
									header("location:bill_report.php");
}



?>
