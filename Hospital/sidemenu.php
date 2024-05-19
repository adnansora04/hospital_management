<?php
session_start(); 
if ($_SESSION['khname']==''){header("Location:login.php");}else{
$username=$_SESSION['khname'];
$type=$_SESSION['khtype'];
$cat=$_SESSION['khcat'];
}
?>
<aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color:#ffffff;">
    <!-- Brand Logo -->
  <div style="background-color:#ffffff;">
	<img src="img/logo.jpg" style="width:120px;height:100px;margin-left:45px;margin-top:6px">
      <!--<img src="dist/img/clogo.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">-->
      <!--<span class="brand-text font-weight-light">SMS ORDER</span>-->
	</div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!--<div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>-->
        <div class="info">
          <a href="#" class="d-block" style="font-size:20px;font-weight:bold;color:black;padding-left: 20px;">Welcome <?php echo $username; ?></a>
        </div>
      </div>

     
      <!-- Sidebar Menu -->
      <nav class="mt-2" >
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link" id="index">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
           
          </li>
	
		<li class="nav-item" id="masters" >
				<a href="#" class="nav-link" id="mastera" >
              <i class="nav-icon fas fa-file"></i>
              <p>
              Masters
                <i class="fas fa-angle-right right"></i>
              </p>
            </a>
		<ul class="nav nav-treeview">
			
			<li class="nav-item" >
            <a href="patient_mst_report.php" class="nav-link" id="patientmst">
              <i class="far fa-circle nav-icon"></i>
              <p>
             Patient Master
              </p>
            </a>
			</li>
			<?php if($cat<>'NURSING STAFF'){ ?>
			<li class="nav-item" >
            <a href="diagnosis_mst_report.php" class="nav-link" id="diagmst">
              <i class="far fa-circle nav-icon"></i>
              <p>
               Diagnosis Master
              </p>
            </a>
			</li>

        <li class="nav-item" >
            <a href="treatment_mst_report.php" class="nav-link" id="treatmntmst">
              <i class="far fa-circle nav-icon"></i>
              <p>
               Treatment Master
              </p>
            </a>
      </li>

       <li class="nav-item" >
            <a href="roomcategy_mst_report.php" class="nav-link" id="roomcategymst">
              <i class="far fa-circle nav-icon"></i>
              <p>
               Room Category Master
              </p>
            </a>
      </li>
      <li class="nav-item" >
            <a href="room_mst_report.php" class="nav-link" id="roommst">
              <i class="far fa-circle nav-icon"></i>
              <p>
                Room Master
              </p>
            </a>
      </li>
       <li class="nav-item" >
            <a href="user_mst_report.php" class="nav-link" id="usermst">
              <i class="far fa-circle nav-icon"></i>
              <p>
                User Master
              </p>
            </a>
      </li>
		<?php } ?>	
		   		</ul>
			</li>
			
			<li class="nav-item" id="entry" >
				<a href="#" class="nav-link" id="entrya" >
              <i class="nav-icon fas fa-file"></i>
              <p>
              Entries
                <i class="fas fa-angle-right right"></i>
              </p>
            </a>
		<ul class="nav nav-treeview">
			
			
			
			<li class="nav-item" >
            <a href="deposit_entry.php" class="nav-link" id="depositentry">
            <i class="far fa-circle nav-icon"></i>
              <p>
               Deposit Entry
              </p>
            </a>
      		</li>
			<li class="nav-item" >
            <a href="roomtransfer_entry.php" class="nav-link" id="roomtransferentry">
            <i class="far fa-circle nav-icon"></i>
              <p>
               Room Transfer Entry
              </p>
            </a>
      	</li>
        </ul>
			</li>
			
		<li class="nav-item" id="reports" >
				<a href="#" class="nav-link" id="reportsa" >
              <i class="nav-icon fas fa-file"></i>
              <p>
              Reports
                <i class="fas fa-angle-right right"></i>
              </p>
            </a>
			<ul class="nav nav-treeview">
			<li class="nav-item">
            <a href="patient_entry_report.php" class="nav-link" id="admitreport">
            <i class="far fa-circle nav-icon"></i>
              <p>
               Patient Admit Search
              </p>
            </a>
			</li>
			<li class="nav-item" >
            <a href="patientdis_report.php" class="nav-link" id="dischrgreport">
            <i class="far fa-circle nav-icon"></i>
              <p>
               Patient Discharge Search
              </p>
            </a>
      		</li>
         
			<li class="nav-item" >
            <a href="roomtransfer_report.php" class="nav-link" id="roomtransferreport">
            <i class="far fa-circle nav-icon"></i>
              <p>
               Room Transfer Search
              </p>
            </a>
      	</li>
				<?php if($cat<>"NURSING STAFF"){ ?>
        <li class="nav-item" >
            <a href="deposit_report.php" class="nav-link" id="depositreport">
            <i class="far fa-circle nav-icon"></i>
              <p>
               Deposit Search
              </p>
            </a>
      		</li>
			<li class="nav-item" >
            <a href="patient-pending-report.php" class="nav-link" id="patientpendingreport">
            <i class="far fa-circle nav-icon"></i>
              <p>
               Patient Pending Report
              </p>
            </a>
      	</li>
				<li class="nav-item" >
            <a href="pendingbill-report.php" class="nav-link" id="pendingbillreport">
            <i class="far fa-circle nav-icon"></i>
              <p>
               Pending Bill Report
              </p>
            </a>
      	</li>
			<li class="nav-item" >
            <a href="bill_report.php" class="nav-link" id="billreport">
            <i class="far fa-circle nav-icon"></i>
              <p>
              Bill Search
              </p>
            </a>
      		</li>
			<?php } ?>
			
			</ul>
			</li>
			
      	<li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-circle text-pink" ></i>
              <p style="color:black">
                Logout
           		</p>
            </a>
			</li>
			</ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
