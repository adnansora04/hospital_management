<?php
session_start(); 
if ($_SESSION['khname']==''){header("Location:login.php");}else{
	$username=$_SESSION['khname'];
  	$type=$_SESSION['khtype'];
	$year=$_SESSION['khyear'];
  include('header.php');
  include('sidemenu.php');
  define('DB_SERVER','dbm.mksoftservice.com');
define('DB_USER','killolhospital');
define('DB_PASS' ,'e6epyru9a');
define('DB_NAME', 'dbserver_killolhospitaldb1');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<style>
.password-container{
  width: 400px;
  position: relative;
}
.password-container input[type="password"],
.password-container input[type="text"]{
  width: 100%;
  padding: 12px 36px 12px 12px;
  box-sizing: border-box;
}
.fa-eye{
  position: absolute;
  top: 28%;
  right: 4%;
  cursor: pointer;
  color: lightgray;
}
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>USER MASTER</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php" style="color:#007cbc">Home</a></li>
              <li class="breadcrumb-item" >User Master</li>
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
          <div class="col-md-9">

            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header" style="background-color:#007cbc;color:white">
                <h3 class="card-title"><b>USER MASTER</b></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="post" action="user_mst_input.php">
                <?php

                $query = mysqli_query($con,"SELECT MAX(cast(code as decimal)) as code1 FROM login");
                $results = mysqli_fetch_array($query);
                $code = $results['code1']+1;

                date_default_timezone_set('Asia/Kolkata');
                $currentTime = date( 'Y-m-d', time ());

                if(isset($_GET['edit'])){
                 $code=$_GET['edit'];
					//echo $code;
                 $update= true;
                 $qry="SELECT * FROM `login` WHERE `code` = '$code'";
					//echo $qry;

                 $result=mysqli_query($con,$qry);
						//if(count($result==1)){

                 $row=mysqli_fetch_array($result);

                 $code1=$row['code'];
				 $unm=$row['unm'];
				 $pwd=$row['pwd'];
				 $cat=$row['cat'];
                 
               }	 

               ?>

               <div class="card-body">
                 <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="hf-password" class=" form-control-label">Code</label>
                  </div>
                  <div class="col-12 col-md-9">
                    <input type="text" id="code" name="code" value="<?php if((isset($_GET['edit']))||(isset($_GET['view']))){ echo $code1;} else{ echo $code;} ?>" placeholder="code" class="form-control" readonly>

                  </div>
                </div>
				                         <div class="row form-group">
                      		 <div class="col col-md-3">
                         		<label for="hf-password" class=" form-control-label">User Name</label>
                             </div>
                             <div class="col-12 col-md-9">
                         		<input type="text" id="unm" name="unm" value="<?php if(isset($_GET['edit'])){ echo $unm;}?>"  class="form-control">
                            </div>
                       </div>
				 		<div class="row form-group">
                      		 <div class="col col-md-3">
                         		<label for="hf-password" class=" form-control-label">Password</label>
                             </div>
                             <div class="col-12 col-md-9" class="password-container">
                         		<input type="password" id="pwd" name="pwd" value="<?php if(isset($_GET['edit'])){ echo $pwd;}?>"  class="form-control"><i class="fa-solid fa-eye" id="eye"></i>
                            </div>
                       </div>
				 <!--<div class="row form-group">
                      		 <div class="col col-md-3">
                         		<label for="hf-password" class=" form-control-label">Type</label>
                             </div>
                             <div class="col-12 col-md-9">
                         		<select id="typ" name="typ" class="form-control">
									<?php if($typ<>''){ ?><option><?php echo $typ; ?></option><?php } ?>
									<option value="">~~SELECT~~</option>
									<option>Admin</option>
									<option>User</option>
								 </select>
                            </div>
                       </div>-->
                <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="hf-password" class=" form-control-label">User Category</label>
                  </div>
                  <div class="col-12 col-md-9">
                   <select id="cat" name="cat"  class="select2" style="width:100%">
                    <?php if(isset($_GET['edit'])){?><option><?php echo $cat; ?></option><?php } ?>
                    <option value="">~~SELECT~~</option>
                    <option>NURSING STAFF</option>
                    <option>OFFICE STAFF</option>
                    <option>ADMIN</option>
                    </select>

                </div>
              </div>






            </div>





            <!-----footer----->
            <div class="card-footer">
              <?php if(isset($_GET['edit'])){ ?>
                <button type="submit" name="update" value="Update" class="btn btn-primary float-right" style="margin-left:6px">
                 Update
               </button>
             <?php }if((!isset($_GET['view']))&&(!isset($_GET['edit']))){ ?>	
              <button type="submit" name="save" value="Save" class="btn btn-success float-right" style="margin-left:6px">Save</button>
            <?php } ?>
            <a href="user_mst_report.php"><button type="button" class="btn btn-danger float-right">Back</button></a>
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

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })  

  })
</script>
<script>
  $( document ).ready(function() {
    $("#masters").addClass("menu-open");
    $("#mastera").addClass("active");
    $("#mastera").css("background-color","#006699");
    $("#usermst").addClass("active");
//$("#shiplinemst").css("background-color","#006699");
	 const passwordInput = document.querySelector("#pwd");
const eye = document.querySelector("#eye");
eye.addEventListener("click", function(){
  this.classList.toggle("fa-eye-slash");
  const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);
})
});
</script>
</body>
</html>
