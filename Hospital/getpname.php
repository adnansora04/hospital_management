<?php 
include ("config.php");
			$roomno=$_POST['roomno'];
			$check=mysqli_query($con,"select rtflag from patient_ac where roomno='$roomno' and MID(code,1,2)='RT' order by cast(substr(`code`,4) as decimal) desc");
			$ans=mysqli_fetch_array($check);
			$rtflag=$ans[0];
			if($rtflag=='Yes'){
				$sql2=mysqli_query($con,"select pname,code from roomtransfer_entry where newroom='$roomno' order by cast(substr(`code`,4) as decimal) desc");
				$response=array();
				while($row2=mysqli_fetch_array($sql2)){
					$pcode=$row2['pname'];
					$q2=mysqli_query($con,"select pname,mob from patiant_mst where code='$pcode'");
					$r2=mysqli_fetch_array($q2);
					$pname=$r2[0];
					$mob=$r2[1];
					$response[] = array("pname"=>$pname,"mob"=>$mob,"pentrycode"=>$row2['code']);
				}
			}
		else{
			 $qry="SELECT pname,code From `patient_entry` where roomno='$roomno' order by cast(`code` as decimal) desc";
			 if(mysqli_query($con,$qry)){
						$data =mysqli_query($con,$qry);
				 $response=array();
				 					while($row = mysqli_fetch_array($data)){
									$pcode=$row['pname'];
									$q2=mysqli_query($con,"select pname,mob from patiant_mst where code='$pcode'");
									$r2=mysqli_fetch_array($q2);
									$pname=$r2[0];
									$mob=$r2[1];
										   $response[] = array("pname"=>$pname,"mob"=>$mob,"pentrycode"=>$row['code']);
									   }
			 }}
			echo json_encode($response);	 
			  
			 
			 ?>
