<?php 
include ("config.php");

			 $qry="SELECT distinct code,treatment From treatment_mst";
			 if(mysqli_query($con,$qry)){
						$data =mysqli_query($con,$qry);
				 $response=array();
				 					   while( $row = mysqli_fetch_array($data)){
										  
				 		$response[] = array("code"=>$row[0],"perticular"=>$row[1]);
									   }
			echo json_encode($response);	 
			  
			 }
			 ?>
