<?php
session_start(); 
if ($_SESSION['khname']==''){header("Location:login.php");}else{
$username=$_SESSION['khname'];
$type=$_SESSION['khtype'];
$branch=$_SESSION['khbranch'];
$year=$_SESSION['khyear'];
include('header.php');
include('sidemenu.php');
include('config.php');
}

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
?>
<script type="text/javascript">
  function ExportToExcel(){
    var htmltable= document.getElementById('tbl1');
    var html = htmltable.outerHTML;
    var a = document.createElement('a');
//getting data from our div that contains the HTML table
var data_type = 'data:application/vnd.ms-excel';
a.href = data_type + ', ' + encodeURIComponent(html) ;
//setting the file name

a.download = 'CONTRACT REPORT.xls';
//triggering the function
a.click();
//just in case, prevent default behaviour
//e.preventDefault();
return (a);
}
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Bill Report</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php" style="color:#007cbc">Home</a></li>
            <li class="breadcrumb-item">Bill Report</li>
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
          <h3 class="card-title"><b>Bill Report</b></h3>
          <div class="card-tools">
            <div class="input-group input-group-sm">
             <a href="bill_entry.php"><button  name="add" id="add"  class="btn btn-default" style="color:#007cbc;font-weight:bold">+ ADD NEW</button></a>
             <button type="button" name="dwnld" id="dwnld" onclick="ExportToExcel()" class="btn btn-default" style="margin-left:7px;color:#007cbc;font-weight:bold">DOWNLOAD</button>

           </div>
         </div>
       </div>
       <!-- /.card-header -->
       <div class="card-body table-responsive p-0" style="height:500px">
        <?php if(isset($_POST['search'])){$frmdt=$_POST['frmdt'];$todt=$_POST['todt'];$type=$_POST['type'];$pname=$_POST['pname'];$diagnosis=$_POST['diagnosis'];} ?>
        <form action="" method="post">
          <div class="row form-group">
            <div class="col col-md-2">
              <label for="hf-password" class=" form-control-label" style="margin-left:25px;margin-right:0px">From Date</label>

              <input type="date" class="form-control" name="frmdt" style="margin-left:25px" value="<?php echo $frmdt; ?>">
            </div>
            <div class="col col-md-2">
              <label for="hf-password" class=" form-control-label" style="margin-left:25px;margin-right:0px">To Date</label>

              <input type="date" name="todt" id="todt" class="form-control" style="margin-left:25px" value="<?php echo $todt; ?>">
            </div>
            

            <div class="col col-md-2" style="margin-left:25px">
             <label for="hf-password" class=" form-control-label" style="margin-right:0px">Type</label>

             <select id="type" name="type"  class="select2" style="width:100%;margin-left:25px">
              <?php if(isset($_GET['Type'])){?><option value="<?php echo $type; ?>"><?php echo $type; ?></option><?php } ?>
              <?php $sql2=mysqli_query($con,"select distinct billtype from bill_entry ");
              while($res2=mysqli_fetch_array($sql2)){
               ?>
               <option><?php echo $res2[0]; ?></option>
             <?php } ?>
           </select>

         </div>
         <div class="col col-md-2" style="margin-left:25px">
           <label for="hf-password" class=" form-control-label" style="margin-right:0px">Patient Nmae</label>

           <select id="pname" name="pname"  class="select2" style="width:100%;margin-left:25px">
            <?php if($pname<>''){ ?><option><?php echo $pname; ?></option><?php } ?>
            <option value="">~~SELECT~~</option>
            <?php $sql2=mysqli_query($con,"select distinct pname from bill_entry ");
            while($res2=mysqli_fetch_array($sql2)){
             ?>
             <option><?php echo $res2[0]; ?></option>
           <?php } ?>
         </select>
       </div>

       <div class="col col-md-3" style="margin-left:25px">
         <label for="hf-password" class=" form-control-label" style="margin-right:0px">Diagnosis</label>

           <select id="diagnosis" name="diagnosis"  class="select2" style="width:100%;margin-left:25px">
            <?php if($diagnosis<>''){ ?><option><?php echo $diagnosis; ?></option><?php } ?>
            <option value="">~~SELECT~~</option>
            <?php $sql2=mysqli_query($con,"select distinct diagnosis from bill_entry ");
            while($res2=mysqli_fetch_array($sql2)){
             ?>
             <option><?php echo $res2[0]; ?></option>
           <?php } ?>
         </select>
      </div>
      <div style="margin-top:30px">
       <button type="submit" name="search" id="search" class="btn btn-primary" style="color:white;background-color:#007cbc;font-weight:bold;margin-left:40px">Search</button></div>
     </div>  

   </form>

   <table class="table table-bordered text-nowrap table-striped" id="tbl1" border="1">
    <thead>
      <tr>
        <th style="width:10px">Sr No</th>
        <th>Date</th>
        <th>Patient</th>
        <th>Diagnosis</th>
        <th>Total</th>
        <th>Mod-1</th>
        <th>Amount</th>
        <th>Mod-2</th>
        <th>Amount</th>
        <th style="width:100px">Options</th>
		<th>Print</th>
      </tr>
    </thead>

    <?php  include('config.php');
              //ini_set("display_errors",1);
              //error_reporting(E_ALL);
    $sql="select * from bill_entry where  1=1";
    if(($frmdt<>"")&&($todt<>"")){
      $sql=$sql." and `dt` between '$frmdt' and '$todt'";
    }
    
    if($billtype<>""){
      $query3=mysqli_query($con,"select code from bill_entry where billtype='$billtype'");
      $r3=mysqli_fetch_array($query3);
      $sql=$sql." and billtype='$billtype'";
      //echo $qry;
    }
   
    if($pname<>""){
      $query3=mysqli_query($con,"select code from bill_entry where pname='$pname'");
      $r3=mysqli_fetch_array($query3);
      $sql=$sql." and pname='$pname'";
      //echo $qry;
    }
   if($diagnosis<>""){
      $query3=mysqli_query($con,"select code from bill_entry where diagnosis='$diagnosis'");
      $r3=mysqli_fetch_array($query3);
      $sql=$sql." and diagnosis='$diagnosis'";
    }

    //$sql=$sql." order by cast(MID(`code`,4) as decimal) desc";
          //echo $sql;
    if(mysqli_query($con,$sql)){
      $data = mysqli_query($con,$sql);
      ?>


      <tbody>


        <?php
        $srno='0';
        while ($row = mysqli_fetch_array($data))
        { 
              //$ewbno=$row['ewaybillno'];
          ?>
          <tr style="color:black">
            <td><?php echo $srno=$srno+1; ?></td>

            <td><?php $dt=$row['dt']; 
            $date=date("d-m-Y",strtotime($dt));
            echo $date;
            ?></td>
            <td><?php echo $row['pname']; ?></td>
            <td><?php echo $row['diagnosis']; ?></td>
            <td><?php echo $row['ttl']; ?></td>
            <td><?php echo $row['modefpay1']; ?></td>
            <td><?php echo $row['amt']; ?></td>
            <td><?php echo $row['modefpay2']; ?></td>
            <td><?php echo $row['amt']; ?></td>

            


            <td style="color:black">
             <a href ="bill_entry.php?edit=<?php echo $row['billno'];?>"><button class="btn btn-default btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Edit" style="margin-right:5px">
                                                            <i class="far fa-edit"></i>
                  </button></a><a href="bill_entry_input.php?delete=<?php echo $row['billno'];?>"><button class="btn btn-default btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure you want to delete this entry ?')">
                                                            <i class="far fa-trash-alt"></i>
                  </button></a>
             </td>
			 <td style="color:black">
            	<a href="invoice.php?code=<?php echo $row['billno'];?>"><button class="btn btn-default btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i></button></a>
             </td>
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
      //"buttons": ["excel"]
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
$("#billreport").addClass("active");
//$("#shiplinemst").css("background-color","#006699");
});
</script>

</body>
</html>
