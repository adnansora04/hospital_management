<?php 
include ("config.php");
			$pcode=$_POST['pcode'];
//$indno="1";
			 $qry="SELECT mob,city From `patiant_mst` where code='$pcode'";
			 if(mysqli_query($con,$qry)){
						$data =mysqli_query($con,$qry);
				 $response=array();
				 					   while( $row = mysqli_fetch_array($data)){
										   $response[] = array("mob"=>$row[0],"city"=>$row[1]);
									   }
			echo json_encode($response);	 
			  
			 }
			 ?>
