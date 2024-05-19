<?php
session_start(); 
if ($_SESSION['khname']==''){header("Location:login.php");}else{
$username=$_SESSION['khname'];
$type=$_SESSION['khtype'];
$year=$_SESSION['khyear'];
include('config.php');
include('header.php');
include('sidemenu.php');
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
            <h1>Patient Pending Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="index.php" style="color:#007cbc;">Home</a></li>
              <li class="breadcrumb-item">Patient Pending Report</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
			<!--<form action="" method="post">
				<div class="row form-group">
						<?php 
								if(isset($_POST['search'])){$status=$_POST['status'];$line=$_POST['line'];}else{$status="";$line="";}
						?>
					<div class="row form-group" style="margin-left:15px">
                                                <div class="col col-md-6">
                                                    <label for="hf-password" class=" form-control-label">Status</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <select  class="select2"   id="status" name="status" style="width:100%" >
													<?php if(isset($_POST['search'])){ ?> <option><?php echo $status; ?></option><?php } ?>
                    									<option value="">~SELECT~</option>
														<option>DAMAGE</option>
													    <option>UNDER SURVEY</option>
													    <option>PENDING ESTIMATION</option>
													    <option>AWAITING APPROVAL</option>
													    <option>UNDER REPAIR</option>
													    <option>AVAILABLE</option>
														<option>DIRECT AVAILABLE</option>
                    							</select>
                                                </div>
                                            </div>
					<div class="row form-group" style="margin-left:15px">
                                                <div class="col col-md-6">
                                                    <label for="hf-password" class=" form-control-label">Line</label>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                   <select  class="select2"   id="line" name="line" style="width:100%" >
													<?php if(isset($_POST['search'])){ ?> <option><?php echo $line; ?></option><?php } ?>
                    									<option value="">~SELECT~</option>
													 		<?php
                     											$res= mysqli_query($con,"select * from line_mst order by `line name` asc");
																while($row= mysqli_fetch_array($res))
                       											{
                      											?>
                      											<option><?php echo $row["line name"]; ?></option>
                      										<?php
                      											}
                      										?>
                    							</select>
                                                </div>
					</div>
			<div class="row form-group">
			<div class="col-md-6" style="margin-left:5px;margin-top:30px">
				<button type="submit" name="search" id="srch" class="btn btn-success">Search</button>
				
				</div>
				
			</div>
				</div>
			</form>-->
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color:#007cbc;color:white;">
                <h3 class="card-title" style="font-weight:bold">Patient Pending Report</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width:120px;">
<!--                   <button type="submit" name="dwnld" id="dwnld" onclick="ExportToExcel()" class="btn btn-default" style="color:#17a2b8;font-weight:bold">Download</button>-->
					   <!--<button type="button" name="pdf" id="pdf" class="btn btn-default" style="color:#17a2b8;font-weight:bold">To pdf</button>-->
					  
                  </div>
				</div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table  class="table table-bordered table-striped text-nowrap" id="tbl1" border="1">
                  <thead>
                    <tr>
                     	<th style="width:20px">Sr No</th>
                        <th>Patient Name</th>
						<th>Room No</th>
						<th>Admit Date</th>
						<th>Discharge Date</th>
						<th>NURSING STAFF Disch.</th>
						<th style="width:50px">Update</th>
                    </tr>
                  </thead>
                  
                     <?php  
							//ini_set("display_errors",1);
							//error_reporting(E_ALL);
							
							$frmdt="";
							$todt="";
							
							$curdate=date( 'Y-m-d', time () );
							
						$sql="SELECT * from patientdis_entry where billstatus=''";
						
						if(mysqli_query($con,$sql)){
						$data =mysqli_query($con,$sql);
						?>
					<tbody>
						<?php
						while ($row = mysqli_fetch_array($data))
						{ 
							
							$count=$count+1;
							?>
						<tr style="color:black">
							<td style="color:black"><?php echo $count; ?></td>
							<td style="color:black"><?php $pcode=$row['pname'];
									$q2=mysqli_query($con,"select pname from patiant_mst where code='$pcode'");
									$r2=mysqli_fetch_array($q2);
									echo $pname=$r2[0]; ?></td>
							<td style="color:black">
								<?php 
								$roomcode=$row['roomno'];
								$q1=mysqli_query($con,"select roomno from room_mst where code='$roomcode'");
								$r1=mysqli_fetch_array($q1);
								echo $roomno=$r1[0];
								?>
							</td>
							<td style="color:black"><?php echo $row['admitdt']; ?></td>
							<td><?php echo $row['discdt']; ?></td>
							<td><?php echo $row['attednamedis']; ?></td>
							<td style="color:black;text-align:center">
								<form action="doctorstatusinput.php" method="post">
									<input type="checkbox" name="records[]" value="<?php echo $row['code']; ?>">
							</td>
						</tr>
					  
					  <?php  }} ?>
					  	
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td><b>DOCTOR REMARKS</b>
													<select  class="select2"  name="newst" style="width:100%" required>
														<option value="">~SELECT~</option>
														<!--<option>Pending for Bill</option>-->
													    <option>Cleared</option>
													</select></td>
													<td><input type="submit" name="update" value="Update" class="btn btn-info" style="margin-top:15px"></td>
													</form>
											</tr>					
					  

                  </tbody>
                </table>
				 
				  <a id="back-to-top" href="#" class="btn  back-to-top" style="background-color:#dc3545;" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      
    </div>
     <strong>Copyright &copy; 2023 <a href="https://www.mksoftservice.com" style="color:#007cbc">M.K.Softservice</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
	<script>

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
	
<!-- jQuery -->
<!--<script src="plugins/jquery/jquery.min.js"></script>-->
<!-- Bootstrap 4 -->
<script src="../admintemplate/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../admintemplate/plugins/select2/js/select2.full.min.js"></script>

<!-- AdminLTE App -->
<script src="../admintemplate/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../admintemplate/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>
	<!-- DataTables  & Plugins -->
<script src="../admintemplate/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../admintemplate/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../admintemplate/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../admintemplate/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../admintemplate/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../admintemplate/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../admintemplate/plugins/jszip/jszip.min.js"></script>
<script src="../admintemplate/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../admintemplate/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../admintemplate/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../admintemplate/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../admintemplate/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
 <script>
$( document ).ready(function() {
$("#reports").addClass("menu-open");
$("#reportsa").addClass("active");
$("#reportsa").css("background-color","#006699");
$("#patientpendingreport").addClass("active");
//$("#shiplinemst").css("background-color","#006699");
});
</script>
	
	
</body>
</html>
