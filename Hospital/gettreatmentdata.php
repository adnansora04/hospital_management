<?php 
include ("config.php");
			$perticular=$_POST['perticular'];
//$indno="1";
			 $qry="SELECT rate,type From `treatment_mst` where code='$perticular'";
			 if(mysqli_query($con,$qry)){
						$data =mysqli_query($con,$qry);
				 $response=array();
				 					   while( $row = mysqli_fetch_array($data)){
										   $response[] = array("rate"=>$row[0],"type"=>$row[1]);
									   }
			echo json_encode($response);	 
			  
			 }
			 ?>
