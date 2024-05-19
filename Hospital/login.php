<?php 
session_start();
//echo $_SESSION['uname'];
define('DB_SERVER','dbm.mksoftservice.com');
define('DB_USER','killolhospital');
define('DB_PASS' ,'e6epyru9a');
define('DB_NAME', 'dbserver_killolhospitaldb1');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
/*if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
	
}
else{*/
  
 if(isset($_POST['submit']))
	 
 {
	  $name= $_POST['name'];
 	  $pass= $_POST['password'];
	 $year= $_POST['year'];
	 
	 //$company= $_POST['company'];
	//echo $name;
	 $query= mysqli_query($con,"SELECT `unm`,`pwd`,`cat` From `login` where `unm`='$name' and  `pwd`= '$pass'");
	 $num=mysqli_fetch_array($query);
	 $result=sizeof($num);
if($result>0){
	$unm=$num['unm'];
	$pwd=$num['pwd'];

	 $_SESSION['khname']=$num['unm'];
	 //$_SESSION['khtype']=$num['type'];
	 $_SESSION['khcat']=$num['cat'];
	 $_SESSION['khyear']=$year;
	 date_default_timezone_set('Asia/Kolkata');
	 $amcdt='2024-05-20';
	 //$crntdt='2023-09-27';
	 $crntdt=date('Y-m-d',time());
	 $date1=date_create($amcdt);
	 $date2=date_create($crntdt);
     $diff=date_diff($date2,$date1);
	 $diff=$diff->format("%R%a");
	//echo $diff;
	 if($diff<='10' && $diff>'0'){
		header("Location:index.php?msg=amc&days=$diff");
		// echo 'i';
	 }
	 elseif($diff<='0'){
		header("Location:login.php?msg=exp&days=$diff");
		}
	 else{
		 mysqli_query($con,"delete from amctbl");
		header("Location:index.php");
		}
		}
	else{
 			$error="Login Failed!!!";
 		}
 		}
 		
 	
 //}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
<!----------SWEETALERT--------->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'> 
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../admintemplate/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../admintemplate/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../admintemplate/dist/css/adminlte.min.css">
	<style>
		@media (min-width: 1024px) {
    .some-rule {  }
	}
		::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: white;
  opacity: 1; /* Firefox */
}
</style>
</head>
<body class="hold-transition login-page" >
<div class="login-box" >
  <!-- /.login-logo -->
	 <div class="card card-outline card-primary">
	<div class="card-header text-center" style="background-color:white">
		<!--<h2>VIMLA FUEL & METALS</h2>-->
		<a href="" class="h1"><img src="img/logo.png" style="height:150px;width:100px"></a>
    </div>
 
 <div class="card-body"style="background-color:white">
		<p class="login-box-msg">Sign In To Start Your Session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required >
          <div class="input-group-append">
            <div class="input-group-text" >
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
	
		   <div class="input-group mb-3">
			 <select class="form-control" name="year" required tabindex="-1">
				   <?php $q1=mysqli_query($con,"select yr from year");
				 		while($r1=mysqli_fetch_array($q1)){
				 ?>
				 		<option><?php echo $r1[0]; ?></option>
				 <?php } ?>
		  </select>
          
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-calendar"></span>
            </div>
          </div>
        </div>
        <div class="row">
          
          <div class="col-4">
            <button type="submit" name="submit" value="Submit" class="btn  btn-block" style="background-color:#007cbc;color:white;border:1px solid white">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../admintemplate/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../admintemplate/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../admintemplate/dist/js/adminlte.min.js"></script>
	<?php if(isset($_GET['msg'])){
	$msg='Your AMC Subscription Has been Expired..!';
	?>
	<script>
	$(document).ready(function() {
            		 swal('<?php echo $msg; ?>').then(function() {
 				   window.location = "http://mksoftservice.com/Killolhospital/login.php";
				});
			
              
	});
      
</script>
<?php 
include('config.php');
date_default_timezone_set("Asia/Kolkata");
$curdt=date('Y-m-d',time());
$q1=mysqli_query($con,"select dt from amctbl where dt='$curdt'");
$r1=mysqli_fetch_array($q1);
$dt=$r1[0];
	if($dt==$curdt){}
	else{
		mysqli_query($con,"insert into amctbl(`dt`)VALUES('$curdt')");
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
		$message3 = "AMC Subscription For Killol-Hospital Has been expired..!!";
			
		$mail3->Body = $message3." ";
		$mail3->Subject =$subject3." ";
		if(!$mail3->send()) {
			$resp3 = $mail3->ErrorInfo;
			} else {
			$resp3 = "Email Sent";
			header('location:login.php');
			}

	}
} 
?>	
</body>
</html>
