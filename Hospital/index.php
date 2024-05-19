<?php
error_reporting(0);
session_start(); 
if ($_SESSION['khname']==''){header("Location:login.php");}else{
$username=$_SESSION['khname'];
$type=$_SESSION['khtype'];
$cat=$_SESSION['khcat'];
	include('config.php');
	include('header.php');
	include('sidemenu.php');
}


?>
<style>
	.disabled{
		pointer-events:none;
	}



</style>
<!--SWEETALERT-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DASHBOARD</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="index.php" style="color:#007cbc">Home</a></li>
              <li class="breadcrumb-item" >DASHBOARD</li>
            </ol>
          </div>
        </div>
		  <div class="row mb-2">
          <div class="col-sm-5" >
			  <a href="roomoccupacy-report.php" >
							<button type="submit" class="btn btn-default" style="margin-right:15px;font-weight:bold;color:white;background-color:#3CBC3C;">Vacant</button>
							</a>
			  
			  <a href="roomoccupacy-report.php" >
							<button type="submit" class="btn btn-default " style="margin-right:15px;font-weight:bold;color:black;background-color:#FFFF00;">Pending</button>
							</a>
            <a href="roomoccupacy-report.php" >
							<button type="submit" class="btn btn-default" style="margin-right:15px;font-weight:bold;color:white;background-color:red;">Occupied</button>
							</a>
			  
          	</div>
          <div class="col-sm-7">
            <ol class="breadcrumb float-sm-right">
			<?php if($cat<>"NURSING STAFF"){ ?>
					<a href="roomoccupacy-report.php" >
							<button type="submit" class="btn btn-default float-right" style="margin-right:15px;background-color:#B8B8B8;color:black;font-weight:bold">Room Occupacy Report</button>
							</a>
							<a href="patient-pending-report.php" >
							<button type="submit" class="btn btn-default float-right" style="margin-right:15px;background-color:#B8B8B8;color:black;font-weight:bold">Pending Report</button>
							</a>
        		<?php } ?>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 <section class="content">
   <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <div class="card">
          <div class="card-header" style="background-color:#007cbc;color:white;margin-bottom: 10px;height: 45px;text-align: center;">
          <h3 style="text-align: center;font-size: 20px">NICU</h3>
          </div>
		<div class="row">
		  <?php
			$sql1=mysqli_query($con,"select code from roomcatgry_mst where cat='NICU'");
			$row1=mysqli_fetch_array($sql1);
			$c1=$row1[0];
			$x=1;
			$q1=mysqli_query($con,"select roomno,occupation,code from room_mst where cat='$c1'");
			while($r1=mysqli_fetch_array($q1)){
				$nicuroom=$r1[0];
				$noccupy=$r1[1];
				$ncode=$r1[2];
		  ?>
			<div class="col-lg-1 col-6" style="margin-left:10px">
				<?php if($noccupy==1){ ?>
            	<a href="patientdis_entry.php?room=<?php echo $ncode; ?>">
					<button type="button" class="btn btn-default" id="nicu_<?php echo $x; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:red;'><?php echo $nicuroom; ?></button>
				</a>
				<?php }
				elseif($noccupy=='2'){ ?>
					<button type="button" class="btn btn-default" id="nicu_<?php echo $x; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:black;background-color:#FFFF00;'><?php echo $nicuroom; ?></button>
				<?php }else{ ?>
				<a href="patient_entry.php?room=<?php echo $ncode; ?>">
					<button type="button" class="btn btn-default" id="nicu_<?php echo $x; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:#3CBC3C;'><?php echo $nicuroom; ?></button>
				</a>
				<?php } ?>
            </div>
			<?php $x++; } ?>
		</div>
              
          <div class="card-header" style="background-color:#007cbc;color:white;margin-bottom: 10px;height: 45px;text-align: center;margin-top: 10px;border-radius: 0px">
               <h3 style="text-align: center;font-size: 20px">PICU</h3>
          </div>
			<div class="row">
		  <?php
			$sql2=mysqli_query($con,"select code from roomcatgry_mst where cat='PICU'");
			$row2=mysqli_fetch_array($sql2);
			$c2=$row2[0];
			$y=1;
			$q2=mysqli_query($con,"select roomno,occupation,code from room_mst where cat='$c2'");
			while($r2=mysqli_fetch_array($q2)){
				$picuroom=$r2[0];
				$ioccupy=$r2[1];
				$icode=$r2[2];
		  ?>
			<div class="col-lg-1 col-6" style="margin-left:15px">
				<?php if($ioccupy==1){ ?>
            	<a href="patientdis_entry.php?room=<?php echo $icode; ?>">
					<button type="button" class="btn btn-default" id="picu_<?php echo $y; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:red;'><?php echo $picuroom; ?></button>
				</a>
				<?php }
				elseif($ioccupy=='2'){ ?>
				<button type="button" class="btn btn-default" id="picu_<?php echo $y; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:black;background-color:#FFFF00;'><?php echo $picuroom; ?></button>
			<?php }else{ ?>
				<a href="patient_entry.php?room=<?php echo $icode; ?>">
					<button type="button" class="btn btn-default" id="picu_<?php echo $y; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:#3CBC3C;'><?php echo $picuroom; ?></button>
				</a>
				<?php } ?>
            </div>
			<?php $y++; } ?>
		</div>
			<div class="card-header" style="background-color:#007cbc;color:white;margin-bottom: 10px;height: 45px;text-align: center;margin-top: 10px;border-radius: 0px">
               <h3 style="text-align: center;font-size: 20px">DELUXE</h3>
          </div>
		  <div class="row">
		  <?php
			$sql3=mysqli_query($con,"select code from roomcatgry_mst where cat='DELUXE'");
			$row3=mysqli_fetch_array($sql3);
			$c3=$row3[0];
			$a=1;
			$q3=mysqli_query($con,"select roomno,occupation,code from room_mst where cat='$c3'");
			while($r3=mysqli_fetch_array($q3)){
				$deluxeroom=$r3[0];
				$doccupy=$r3[1];
				$dcode=$r3[2];
		  ?>
			<div class="col-lg-1 col-6" style="margin-left:15px">
				<?php if($doccupy==1){ ?>
            	<a href="patientdis_entry.php?room=<?php echo $dcode; ?>">
					<button type="button" class="btn btn-default" id="deluxe_<?php echo $a; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:red;'><?php echo $deluxeroom; ?></button>
				</a>
				<?php }
				elseif($doccupy=='2'){ ?>
					<button type="button" class="btn btn-default" id="deluxe_<?php echo $a; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:black;background-color:#FFFF00;'><?php echo $deluxeroom; ?></button>
				<?php }else{ ?>
				<a href="patient_entry.php?room=<?php echo $dcode; ?>">
					<button type="button" class="btn btn-default" id="deluxe_<?php echo $a; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:#3CBC3C;'><?php echo $deluxeroom; ?></button>
				</a>
				<?php } ?>
            </div>
			<?php $a++; } ?>
		</div>
           <div class="card-header" style="background-color:#007cbc;color:white;margin-bottom: 10px;height: 45px;text-align: center;margin-top: 10px;border-radius: 0px">
               <h3 style="text-align: center;font-size: 20px">SPECIAL</h3>
           </div>
			<div class="row">
		  <?php
			$sql4=mysqli_query($con,"select code from roomcatgry_mst where cat like '%SPECIAL (AC)%'");
			$row4=mysqli_fetch_array($sql4);
			$c4=$row4[0];
			$sql7=mysqli_query($con,"select code from roomcatgry_mst where cat like '%SPECIAL (NON-AC)%'");
			$row7=mysqli_fetch_array($sql7);
			$c7=$row7[0];
			$b=1;
			$q4=mysqli_query($con,"select roomno,occupation,code from room_mst where cat='$c4' or cat='$c7'");
			while($r4=mysqli_fetch_array($q4)){
				$spclroom=$r4[0];
				$spoccupy=$r4[1];
				$spcode=$r4[2];
		  ?>
			<div class="col-lg-1 col-6" style="margin-left:15px">
				<?php if($spoccupy==1){ ?>
            	<a href="patientdis_entry.php?room=<?php echo $spcode; ?>">
					<button type="button" class="btn btn-default" id="spcl_<?php echo $b; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:red;'><?php echo $spclroom; ?></button>
				</a>
				<?php }elseif($spoccupy=='2'){ ?>
					<button type="button" class="btn btn-default" id="spcl_<?php echo $b; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:black;background-color:#FFFF00;'><?php echo $spclroom; ?></button>
				<?php }else{ ?>
				<a href="patient_entry.php?room=<?php echo $spcode; ?>">
					<button type="button" class="btn btn-default" id="spcl_<?php echo $b; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:#3CBC3C;'><?php echo $spclroom; ?></button>
				</a>
				<?php } ?>
            </div>
			<?php $b++; } ?>
		</div>
          
			<div class="card-header" style="background-color:#007cbc;color:white;margin-bottom: 10px;height: 45px;text-align: center;margin-top: 10px;border-radius: 0px">
               <h3 style="text-align: center;font-size: 20px">SEMI</h3>
           </div>
		<div class="row">
		  <?php
			$sql5=mysqli_query($con,"select code from roomcatgry_mst where cat='SEMI'");
			$row5=mysqli_fetch_array($sql5);
			$c5=$row5[0];
			$c=1;
			$q5=mysqli_query($con,"select roomno,occupation,code from room_mst where cat='$c5'");
			while($r5=mysqli_fetch_array($q5)){
				$semiroom=$r5[0];
				$smoccupy=$r5[1];
				$smcode=$r5[2];
		  ?>
			<div class="col-lg-1 col-6" style="margin-left:15px">
				<?php if($smoccupy==1){ ?>
            	<a href="patientdis_entry.php?room=<?php echo $smcode; ?>">
					<button type="button" class="btn btn-default" id="semi_<?php echo $c; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:red;'><?php echo $semiroom; ?></button>
				</a>
				<?php }elseif($smoccupy=='2'){ ?>
				<button type="button" class="btn btn-default" id="semi_<?php echo $c; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:black;background-color:#FFFF00;'><?php echo $semiroom; ?></button>
				<?php }else{ ?>
				<a href="patient_entry.php?room=<?php echo $smcode; ?>">
					<button type="button" class="btn btn-default" id="semi_<?php echo $c; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:#3CBC3C;'><?php echo $semiroom; ?></button>
				</a>
				<?php } ?>
            </div>
			<?php $c++; } ?>
		</div>
           
           <div class="card-header" style="background-color:#007cbc;color:white;margin-bottom: 10px;height: 45px;text-align: center;margin-top: 10px;border-radius: 0px">
               <h3 style="text-align: center;font-size: 20px">GENERAL WARD</h3>
          </div>
		  		<div class="row" style="padding-bottom:10px">
		  <?php
			$sql6=mysqli_query($con,"select code from roomcatgry_mst where cat='GENERAL WARD'");
			$row6=mysqli_fetch_array($sql6);
			$c6=$row6[0];
			$d=1;
			$q6=mysqli_query($con,"select roomno,occupation,code from room_mst where cat='$c6'");
			while($r6=mysqli_fetch_array($q6)){
				$groom=$r6[0];
				$goccupy=$r6[1];
				$gcode=$r6[2];
		  ?>
			<div class="col-lg-1 col-6" style="margin-left:15px">
				<?php if($goccupy==1){ ?>
            	<a href="patientdis_entry.php?room=<?php echo $gcode; ?>">
					<button type="button" class="btn btn-default" id="gnrl_<?php echo $d; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:red;'><?php echo $groom; ?></button>
				</a>
				<?php }elseif($goccupy=='2'){ ?>
					<button type="button" class="btn btn-default" id="gnrl_<?php echo $d; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:black;background-color:#FFFF00;'><?php echo $groom; ?></button>
				<?php }else{ ?>
				<a href="patient_entry.php?room=<?php echo $gcode; ?>">
					<button type="button" class="btn btn-default" id="gnrl_<?php echo $d; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:#3CBC3C;'><?php echo $groom; ?></button>
				</a>
				<?php } ?>
            </div>
			<?php $d++; } ?>
		</div>
		           
           <div class="card-header" style="background-color:#007cbc;color:white;margin-bottom: 10px;height: 45px;text-align: center;margin-top: 10px;border-radius: 0px">
               <h3 style="text-align: center;font-size: 20px">KMC</h3>
          </div>
		  		<div class="row" style="padding-bottom:10px">
		  <?php
			$sql7=mysqli_query($con,"select code from roomcatgry_mst where cat='KMC'");
			$row7=mysqli_fetch_array($sql7);
			$c7=$row7[0];
			$e=1;
			$q7=mysqli_query($con,"select roomno,occupation,code from room_mst where cat='$c7'");
			while($r7=mysqli_fetch_array($q7)){
				$kroom=$r7[0];
				$koccupy=$r7[1];
				$kcode=$r7[2];
		  ?>
			<div class="col-lg-1 col-6" style="margin-left:15px">
				<?php if($koccupy==1){ ?>
            	<a href="patientdis_entry.php?room=<?php echo $kcode; ?>">
					<button type="button" class="btn btn-default" id="kmc_<?php echo $e; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:red;'><?php echo $kroom; ?></button>
				</a>
				<?php }elseif($koccupy=='2'){ ?>
					<button type="button" class="btn btn-default" id="kmc_<?php echo $e; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:black;background-color:#FFFF00;'><?php echo $kroom; ?></button>
				<?php }else{ ?>
				<a href="patient_entry.php?room=<?php echo $kcode; ?>">
					<button type="button" class="btn btn-default" id="kmc_<?php echo $e; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:#3CBC3C;'><?php echo $kroom; ?></button>
				</a>
				<?php } ?>
            </div>
			<?php $e++; } ?>
		</div>
			<!---WAITING CATEGORY-->
	 <div class="card-header" style="background-color:#007cbc;color:white;margin-bottom: 10px;height: 45px;text-align: center;margin-top: 10px;border-radius: 0px">
               <h3 style="text-align: center;font-size: 20px">WAITING</h3>
          </div>
		  		<div class="row" style="padding-bottom:10px">
		  <?php
			$sql8=mysqli_query($con,"select code from roomcatgry_mst where cat='WAITING'");
			$row8=mysqli_fetch_array($sql8);
			$c8=$row8[0];
			$f=1;
			$q8=mysqli_query($con,"select roomno,occupation,code from room_mst where cat='$c8'");
			while($r8=mysqli_fetch_array($q8)){
				$wroom=$r8[0];
				$woccupy=$r8[1];
				$wcode=$r8[2];
		  ?>
			<div class="col-lg-1 col-6" style="margin-left:15px">
				<?php if($woccupy==1){ ?>
            	<a href="patientdis_entry.php?room=<?php echo $wcode; ?>">
					<button type="button" class="btn btn-default" id="waiting_<?php echo $f; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:red;'><?php echo $wroom; ?></button>
				</a>
				<?php }elseif($woccupy=='2'){ ?>
					<button type="button" class="btn btn-default" id="waiting_<?php echo $f; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:black;background-color:#FFFF00;'><?php echo $wroom; ?></button>
				<?php }else{ ?>
				<a href="patient_entry.php?room=<?php echo $wcode; ?>">
					<button type="button" class="btn btn-default" id="waiting_<?php echo $f; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:#3CBC3C;'><?php echo $wroom; ?></button>
				</a>
				<?php } ?>
            </div>
			<?php $f++; } ?>
		</div>
          </div>
            
      </div>
    </div>
  
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  
  
    <!-- /.content -->
			<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
		  </div>                     <!-- /.container-fluid -->
 
    <!-- /.content -->
 
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="https://www.mksoftservice.com" style="color:#007cbc;">M.K.Softservice</a>.</strong> All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- ChartJS -->
<script src="../admintemplate/plugins/chart.js/Chart.min.js"></script>
	<link rel="stylesheet" href="../admintemplate/plugins/chart.js/Chart.min.css">
	<link rel="stylesheet" href="../admintemplate/plugins/chart.js/Chart.css">

<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

	
<script>
$( document ).ready(function() {
$("#index").addClass("active");
$("#index").css("background-color","#006699");
});
//$(window).focus(function() {
//		location.reload();
	//});
</script>

<?php if(isset($_GET['msg'])){
	$days=$_GET['days'];
	$msg='Your AMC Subscription Will Expire In '.$days.' Days..!';
	?>
	<script>
	$(document).ready(function() {
            		 swal('<?php echo $msg; ?>');
			});
      
</script>
<?php 
include('config.php');
date_default_timezone_set("Asia/Kolkata");
$curdt=date('Y-m-d',time());
//$curdt='2023-10-25';
$q1=mysqli_query($con,"select dt from amctbl where dt='$curdt'");
$r1=mysqli_fetch_array($q1);
$dt=$r1[0];
	if($dt==$curdt){}
	else{
		mysqli_query($con,"insert into amctbl (`dt`)VALUES('$curdt')");
		include('../admintemplate/PHPMailer/PHPMailerAutoload.php');
		$subject3 ="AMC Subscription Expiry Alert For ~ Killol-Hospital";
		$message3 = $_REQUEST['message'];
//echo "Mailer..";
		$mail3 = new PHPMailer;
		// echo !extension_loaded('openssl')?"Not Available":"Available";
		$mail3->isSMTP();               // Set mailer to use SMTP
		//$mail->SMTPDebug = 1;
		//$mail->Host = 'mail.suprementerprise.com'; //'smtp.gmail.com';
		$mail3->Host = 'ssl://smtp.gmail.com'; //'smtp.gmail.com';
		$mail3->SMTPAuth = true;   // Enable SMTP authentication
		$mail3->Username = 'info@mksoftservice.com';
		$mail3->Password = 'ajwusstvddhavwck'; // SMTP password

		$mail3->SMTPSecure = 'ssl';         // Enable TLS encryption, `ssl` al
		$mail3->Port = 465;                 // TCP port to connect to

		$mail3->setFrom('info@mksoftservice.com', 'M.K.Softservice');
		$mail3->addAddress('kuldeep@mksoftservice.com');
		$mail3->isHTML(true);  // Set email format to HTML
		$message3 = "AMC Subscription For Killol-Hospital Will Expire In ".$days." Days..!!";
			
		$mail3->Body = $message3." ";
		$mail3->Subject =$subject3." ";
		if(!$mail3->send()) {
			$resp3 = $mail3->ErrorInfo;
			} else {
			$resp3 = "Email Sent";
			}

	}
} ?>
</body>
</html>
