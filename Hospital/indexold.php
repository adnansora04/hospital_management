<?php
session_start(); 
if ($_SESSION['khname']==''){header("Location:login.php");}else{
$username=$_SESSION['khname'];
$type=$_SESSION['khtype'];
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
				<?php }else{ ?>
				<a href="patient_entry.php?room=<?php echo $ncode; ?>">
					<button type="button" class="btn btn-default" id="nicu_<?php echo $x; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:#3CBC3C;'><?php echo $nicuroom; ?></button>
				</a>
				<?php } ?>
            </div>
			<?php $x++; } ?>
		</div>
              
          <div class="card-header" style="background-color:#007cbc;color:white;margin-bottom: 10px;height: 45px;text-align: center;margin-top: 10px;border-radius: 0px">
               <h3 style="text-align: center;font-size: 20px">picu</h3>
          </div>
			<div class="row">
		  <?php
			$sql2=mysqli_query($con,"select code from roomcatgry_mst where cat='picu'");
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
					<button type="button" class="btn btn-default" id="picu_<?php echo $x; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:red;'><?php echo $picuroom; ?></button>
				</a>
				<?php }else{ ?>
				<a href="patient_entry.php?room=<?php echo $icode; ?>">
					<button type="button" class="btn btn-default" id="picu_<?php echo $x; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:#3CBC3C;'><?php echo $picuroom; ?></button>
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
					<button type="button" class="btn btn-default" id="deluxe_<?php echo $x; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:red;'><?php echo $deluxeroom; ?></button>
				</a>
				<?php }else{ ?>
				<a href="patient_entry.php?room=<?php echo $dcode; ?>">
					<button type="button" class="btn btn-default" id="deluxe_<?php echo $x; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:#3CBC3C;'><?php echo $deluxeroom; ?></button>
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
					<button type="button" class="btn btn-default" id="spcl_<?php echo $x; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:red;'><?php echo $spclroom; ?></button>
				</a>
				<?php }else{ ?>
				<a href="patient_entry.php?room=<?php echo $spcode; ?>">
					<button type="button" class="btn btn-default" id="spcl_<?php echo $x; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:#3CBC3C;'><?php echo $spclroom; ?></button>
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
					<button type="button" class="btn btn-default" id="semi_<?php echo $x; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:red;'><?php echo $semiroom; ?></button>
				</a>
				<?php }else{ ?>
				<a href="patient_entry.php?room=<?php echo $smcode; ?>">
					<button type="button" class="btn btn-default" id="semi_<?php echo $x; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:#3CBC3C;'><?php echo $semiroom; ?></button>
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
					<button type="button" class="btn btn-default" id="gnrl_<?php echo $x; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:red;'><?php echo $groom; ?></button>
				</a>
				<?php }else{ ?>
				<a href="patient_entry.php?room=<?php echo $gcode; ?>">
					<button type="button" class="btn btn-default" id="gnrl_<?php echo $x; ?>" style='width:90px;height:45px;font-size:15px;font-weight:bold;color:white;background-color:#3CBC3C;'><?php echo $groom; ?></button>
				</a>
				<?php } ?>
            </div>
			<?php $d++; } ?>
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
</script>
</body>
</html>
