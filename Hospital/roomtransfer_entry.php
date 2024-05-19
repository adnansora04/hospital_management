<?php
session_start(); 

if ($_SESSION['khname']==''){header("Location:login.php");}else{
$username=$_SESSION['khname'];
$type=$_SESSION['khtype'];
include('header.php');
  include('sidemenu.php');
  include('config.php');
}
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
?>
<style>
  
.select2-selection--single {
  height: 100% !important;
}
.select2-selection__rendered{
  word-wrap: break-word !important;
  text-overflow: inherit !important;
  white-space: normal !important;
  }</style>
<!----------SWEETALERT-->
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
            <h1>ROOM TRANSFER ENTRY</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="index.php" style="color:#007cbc">Home</a></li>
              <li class="breadcrumb-item">Room Transfer Entry</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
           
                      <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header" style="background-color:#007cbc;color:white">
          <h3 class="card-title"><b>ROOM TRANSFER ENTRY</b></h3>
              </div>
      <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="post" action="roomtransfer_input.php">
          <?php
    $curdt = date( 'Y-m-d', time ());
    $curtime=date("H:i",time());    
    $cmonth=date('M',time());
    
    
    $query = mysqli_query($con,"SELECT MAX(cast(substr(code,4) as decimal)) as code1 FROM roomtransfer_entry");
    $results = mysqli_fetch_array($query);
    $code = $results['code1']+1;
	$code='RT-'.$code;
    date_default_timezone_set('Asia/Kolkata');
     
    if(isset($_GET['edit'])){
          $code=$_GET['edit'];
          //echo $code;
          $update= true;
          $qry="SELECT * FROM `roomtransfer_entry` WHERE `code` = '$code'";
          //echo $qry;
  
            $result=mysqli_query($con,$qry);
            

                $row=mysqli_fetch_array($result);
                    $code1=$row['code'];
                    $dt=$row['dt'];
                    $attedname=$row['attedname'];
					$rcode=$row['curroomno'];
					$q2=mysqli_query($con,"select roomno from room_mst where code='$rcode'");
					$r2=mysqli_fetch_array($q2);
					$curroomno=$r2[0];
                    $pcode=$row['pname'];
					$q2=mysqli_query($con,"select pname from patiant_mst where code='$pcode'");
					$r2=mysqli_fetch_array($q2);
					$pname=$r2[0];
                    $mob=$row['mob'];
                    $ncode=$row['newroom'];
					$q3=mysqli_query($con,"select roomno from room_mst where code='$ncode'");
					$r3=mysqli_fetch_array($q3);
					$newroom=$r3[0];
					$pentrycode=$row['pentrycode'];
                    
               
            }  
    
          ?>
  

               <div class="card-body">
                 <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="hf-password" class=" form-control-label">Code</label>
                  </div>
                  <div class="col-12 col-md-4">
                   <input type="text" id="code" name="code" value="<?php if((isset($_GET['edit']))||(isset($_GET['view']))){ echo $code1;} else{ echo $code;} ?>"  class="form-control" readonly>
                 </div>


               </div>


               <div class="row form-group">
                <div class="col col-md-3">
                  <label for="hf-password" class=" form-control-label">Date</label>
                </div>
                <div class="col-12 col-md-4">
                  <input type="date" id="dt" name="dt"  class="form-control" value="<?php if(isset($_GET['edit'])){echo $dt;}else{echo $curdt;} ?>">
                </div>
				   <div class="col col-md-2">
                  <label for="hf-password" class=" form-control-label">Time</label>
                </div>
                <div class="col-12 col-md-3">
                  <input type="time" id="time" name="time"  class="form-control" value="<?php if(isset($_GET['edit'])){echo $time;}else{echo $curtime;} ?>" class="form-control">
                </div>
              </div>

              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="hf-password" class=" form-control-label">NURSING STAFF Name</label>
                </div>
                <div class="col-12 col-md-9">
                 <input type="text" id="attedname" name="attedname" value="<?php if(isset($_GET['edit'])){echo $attedname;} ?>" class="form-control" >

               </div>
             </div>
             <div class="row form-group">
              <div class="col col-md-3">
                <label for="hf-password" class=" form-control-label">Current Room No</label>
              </div>
              <div class="col-12 col-md-3">
				  <input type="hidden" name="pentrycode" id="pentrycode" value="<?php echo $pentrycode; ?>">
               <select id="curroomno" name="curroomno" class="select2" style="width:100%">
														<?php if(isset($_GET['edit'])){ ?><option value="<?php echo $rcode; ?>"><?php echo $curroomno; ?></option><?php } ?>
														<option value="">~~SELECT~~</option>
                                                        <?php
                                                         $sql = mysqli_query($con,"SELECT * FROM `room_mst` where occupation = 1");
                                                         while($row = mysqli_fetch_array($sql))
                                                         { ?>
                                                               <option value="<?php echo $row['code']; ?>"><?php echo $row['roomno']; ?></option>
                                                        <?php }  ?>
                                                    </select>

              </div>
				  <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Transfer Room No.</label>
                                                </div>
                                                <div class="col-12 col-md-3">
                                              
                                                    <select id="newroom" name="newroom" class="select2" style="width:100%">
														<?php if(isset($_GET['edit'])){ ?><option value="<?php echo $ncode; ?>"><?php echo $newroom; ?></option><?php } ?>
														<option value="">~~SELECT~~</option>
                                                        <?php
                                                         $sql = mysqli_query($con,"SELECT * FROM `room_mst` where occupation = ''");
                                                         while($row = mysqli_fetch_array($sql))
                                                         { ?>
                                                               <option value="<?php echo $row['code']; ?>"><?php echo $row['roomno']; ?></option>
                                                        <?php }  ?>
                                                    </select>
                                                 
                                                </div>
            </div>                           

            <div class="row form-group">
              <div class="col col-md-3">
                <label for="hf-password" class=" form-control-label">Patient Name</label>
              </div>
              <div class="col-12 col-md-9">
                <input type="text" name="pname" id="pname" value="<?php if(isset($_GET['edit'])){echo $pname;} ?>" class="form-control" >  
              </div>
            </div>
            <div class="row form-group">
              <div class="col col-md-3">
                <label for="hf-password" class=" form-control-label">Mob. No</label>
              </div>
              <div class="col-12 col-md-9">
               <input type="text" id="mob" name="mob" value="<?php if(isset($_GET['edit'])){echo $mob;} ?>" class="form-control" > 
             </div>
           </div>
           <input type="hidden" name="stcode" id="stcode" value="<?php if(isset($_GET['edit'])){echo $stcode;} ?>" class="form-control">
         </div>
         <div class="col-md-12">
         </div>

         
       <!-----footer----->
                                <div class="card-footer">
                <?php if(isset($_GET['edit'])){ ?>
                                        <button type="submit" name="update" value="Update" class="btn btn-primary float-right" style="margin-left:0">
                      Update
                    </button>
                    <?php }if((!isset($_GET['view']))&&(!isset($_GET['edit']))){ ?>
        <button type="submit" name="save" value="Save" class="btn btn-success float-right" style="margin-left:6px">Save</button>
                 <?php } ?>
                  <a href="roomtransfer_report.php"><button type="button" class="btn btn-danger float-right">Back</button></a>
                </div>
                 <a id="back-to-top" href="#" class="btn back-to-top" style="background-color:#007cbc" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
                <!-- /.card-footer -->
              </form>
      </div>
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
 <script src="../admintemplate/plugins/select2/js/select2.full.min.js"></script>
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

<script>
$( document ).ready(function() {
$("#entry").addClass("menu-open");
$("#entrya").addClass("active");
$("#entrya").css("background-color","#006699");
$("#roomtransferentry").addClass("active");
})
   </script>
    <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
      $('.select2').select2()
  
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    }) 
  $('#vehno').select2({tags:true})
  $('#transporter').select2({tags:true})
  
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })  
    })
</script>
<script>
 $('#curroomno').change(function(){
	var roomno=$('#curroomno').val();
	 $.ajax({
        url: 'getpname.php',
        type: 'post',
        data: {roomno : roomno},
        dataType: 'json',
        success:function(response) {
		  $('#pname').val(response[0].pname);
		  $('#mob').val(response[0].mob);
		  $('#pentrycode').val(response[0].pentrycode);
         } // /success
      });
	});
</script>
</body>
</html>
