<?php
session_start(); 
if ($_SESSION['khname']==''){header("Location:login.php");}else{
$username=$_SESSION['khname'];
$type=$_SESSION['khtype'];
$year=$_SESSION['khyear'];
	include('header.php');
	include('sidemenu.php');
	include('config.php');
}

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Room Occupacy Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="index.php" style="color:#007cbc">Home</a></li>
              <li class="breadcrumb-item">Room Occupacy Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      
		<div class="col-md-12">
            <div class="card">
              <div class="card-header" style="background-color:#007cbc;color:white;margin-bottom:10px">
				  <h3 class="card-title"><b>Room Occupacy Report</b></h3>
				  <div class="card-tools">
                  <div class="input-group input-group-sm" style="width:120px;">
                   <!--<a href="patient_entry.php"><button  name="add" id="add"  class="btn btn-default" style="color:#007cbc;font-weight:bold">+ ADD NEW</button></a>-->
					   <!--<button type="button" name="pdf" id="pdf" class="btn btn-default" style="color:#17a2b8;font-weight:bold">To pdf</button>-->
					  
                  </div>
				</div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height:900px">
				  
                <table class="table table-bordered text-nowrap table-striped" id="example1">
                  <thead>
                    <tr>
												<th style="width:10px">Sr No</th>
												<th>Roomno</th>
                     						   	<th>Patient Name</th>
												<th>Admit Date</th>
					</tr>
                  </thead>
                  <tbody>
                     <?php 
							
							$srno='0';
							$sql="select code,roomno from room_mst where occupation='1' order by cast(`code` as decimal)";
						
							if(mysqli_query($con,$sql)){
						$data = mysqli_query($con,$sql);
						while ($row = mysqli_fetch_array($data))
						{ 
							?>
										<tr style="color:black">
												<td><?php echo $srno=$srno+1; ?></td>
												<td><?php echo $row['roomno']; ?></td>
											<?php 
												$roomcode=$row['code'];
							
												$check=mysqli_query($con,"select rtflag from patient_ac where roomno='$roomcode' and MID(code,1,2)='RT' order by cast(substr(`code`,4) as decimal) desc");
												$ans=mysqli_fetch_array($check);
												$rtflag=$ans[0];
												if($rtflag=='Yes'){
													$qr1=mysqli_query($con,"select pname,dt from roomtransfer_entry where newroom='$roomcode'  order by cast(substr(`code`,4) as decimal) desc");
												}
												else{
													$qr1=mysqli_query($con,"select pname,dt from patient_entry where roomno='$roomcode' order by cast(`code` as decimal) desc");
												}
												$res1=mysqli_fetch_array($qr1);
												$pcode=$res1['pname'];
												$admitdt=$res1['dt'];
											?>
												<td><?php 
													$q1=mysqli_query($con,"select pname from patiant_mst where code='$pcode'");
													$r1=mysqli_fetch_array($q1);
													echo $r1[0];
													?></td>
												<td><?php echo $admitdt; ?></td>
												
												
											</tr>
					 
					  <?php  }} ?>
					
											
					  

                  </tbody>
                </table>
				  <a id="back-to-top" href="#" class="btn  back-to-top" style="background-color:#007cbc" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <!--<b>Version</b> 3.1.0-rc-->
    </div>
    <strong>Copyright &copy; 2023 <a href="https://www.mksoftservice.com" style="color:#007cbc">M.K.Softservice</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
<script>
		   // $("#billto").select2().on('select2-focus',function(){ $(this).select2('open'); });
		   var tabPressed = false;

    $(document).keydown(function (e) {
        // Listening tab button.
        if (e.which == 9) {
            tabPressed = true;
        }
    });

    $(document).on('focus', '.select2', function() {
        if (tabPressed) {
            tabPressed = false;
            $(this).siblings('select').select2('open');
        }
    });
	  </script>

	   <script src="../admintemplate/plugins/select2/js/select2.full.min.js"></script>
	  <script>
	$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
	})
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })  
			
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
	<script>
$( document ).ready(function() {
$("#reports").addClass("menu-open");
$("#reportsa").addClass("active");
$("#reportsa").css("background-color","#006699");
$("#admitreport").addClass("active");
//$("#shiplinemst").css("background-color","#006699");
});
</script>

</body>
</html>