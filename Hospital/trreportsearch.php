<?php
//session_start(); 
/*if ($_SESSION['dmlname']==''){header("Location:login.php");}else{
$username=$_SESSION['dmlname'];
$type=$_SESSION['dmltype'];
$branch=$_SESSION['dmlbranch'];*/
//$year=$_SESSION['mfcyear'];
	include('header.php');
	include('sidemenu.php');
	include('config.php');
//}
date_default_timezone_set('Asia/Kolkata');
$curdt = date( 'Y-m-d', time ());
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
	
a.download = 'INWARD REPORT.xls';
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
            <h1>T R Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="index.php" style="color:#007cbc">Home</a></li>
              <li class="breadcrumb-item">T R Report</li>
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
				  <h3 class="card-title"><b>T R Report</b></h3>
				  <div class="card-tools">
                
				</div>
              </div>
              <!-- /.card-header -->

              <?php

              			//Max(cast(substr(code,6,3) as decimal))
              			$query=mysqli_query($con,"Select MAX(cast(substr(code,63) as decimal)) as code1 from trentry");
						$results = mysqli_fetch_array($query);
						$code = $results['code1']+1;
						$clen=strlen($code);
						if($clen=='2'){$ad='0';}
						if($clen=='1'){$ad='00';}
						$code='DMLA/'.$ad.$code.'/23-24';
               ?>
              <div class="card-body table-responsive p-0" style="height:500px">
				<!-- <?php if(isset($_POST['search'])){$frmdt=$_POST['frmdt'];$todt=$_POST['todt'];$truckno=$_POST['truckno'];$cargo=$_POST['cargo'];$godown=$_POST['godown'];$cmpny=$_POST['cmpny'];$sup=$_POST['sup'];$cno=$_POST['cno'];} ?>-->
				  <?php if(isset($_POST['search'])){$cno=$_POST['cno'];} ?>
				   <form action="" method="post" id="formfield">
				  <div class="row form-group">
					  				<div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="margin-left:25px;margin-right:0px">From</label>
                                                
                                                   <input type="date" class="form-control" name="frmdt" style="margin-left:25px" value="<?php echo $code; ?>">
                                                </div>
					  <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label" style="margin-left:25px;margin-right:0px">To</label>
                                                
                                                   <input type="date" name="todt" id="todt" class="form-control" style="margin-left:25px" value="<?php echo $curdt; ?>" >
                                                </div>
					  
             
					   <div class="col col-md-3" style="margin-left:25px">
                                         <label for="hf-password" class=" form-control-label" style="margin-right:0px">Contract No</label>
                                                
                                                   <select id="cno" name="cno"  class="select2" style="width:100%;margin-left:25px">
													<?php if($contractno<>''){ ?><option><?php echo $contractno; ?></option><?php } ?>
                            <option value="">~~SELECT~~</option>
                            <?php $sql2=mysqli_query($con,"select distinct cno from cpurentry");
                            while($res2=mysqli_fetch_array($sql2)){
                            ?>
                            <option><?php echo $res2[0]; ?></option>
                            <?php } ?>
													</select>
                                                </div>
					   </div>
					
					
					
					   <div class="row form-group">
						   
						  
					  <div style="margin-top:30px">
					   <button type="submit" name="search" id="search" class="btn btn-primary" style="color:white;background-color:#007cbc;font-weight:bold;margin-left:25px">Search</button></div>
					  	</div>	
					                    
				

                <table class="table table-bordered text-nowrap table-striped" id="tbl1" border="1">
                  <thead>
                    <tr STYLE="text-align:center">
						<th style="width:10%">Sr No</th>
                     	<th style="width:10%">DATE</th>
						<th style="width:20%">TRNO</th>
						<th style="width:20%">TRDATE</th>
						<th style="width:20%">CONTRACT NO.</th>
						<th style="width:20%">EDIT/DELETE</th>
					</tr>
                  </thead>
                  
                     <?php  include('config.php');
							//ini_set("display_errors",1);
							//error_reporting(E_ALL);
							
							$sql="select * from trreportmain where 1=1";
							if($frmdt<>"" && $todt<>""){
								$sql=$sql." and `dt` between '$frmdt' and '$todt'";
							}
							if($cno<>""){
									$qr5=mysqli_query($con,"select code from cpurentry where cno='$cno'");
									$res5=mysqli_fetch_array($qr5);
									$contractno=$res5[0];
							$sql=$sql." and cno='$contractno'";
							
							}
					  		$sql=$sql." order by cast(MID(`trno`,6) as decimal) desc";
					//echo $sql;
							if(mysqli_query($con,$sql)){
						$data = mysqli_query($con,$sql);
								?>
					<tbody>
						<?php
								$totcont=0;
								$tjbags=0;
								$tppbags=0;
								$twt=0;
						while ($row = mysqli_fetch_array($data))
						{ 
							//$ewbno=$row['ewaybillno'];
							?>
										<tr style="color:black;text-align:center">
												<td><?php echo $srno=$srno+1; ?></td>
												
												<td><?php $dt=$row['dt']; 
													$date=date("d-m-Y",strtotime($dt));
													echo $date;
													?></td>
												<td><?php 
													$scode=$row['trno'];
													$qr2=mysqli_query($con,"select trno from `trreportmain where tr='$trno'");
													$res2=mysqli_fetch_array($qr2);
													echo $res2['name'];
													?></td>
												<td><?php 
													$crcode=$row['trdt'];
													$qr3=mysqli_query($con,"select name from cargomst where code='$trdt'");
													$res3=mysqli_fetch_array($qr3);
													echo $res3['name'];
													?></td>
												<td><?php echo $row['cno']; ?></td>
												

												<td style="color:black">
													<?php if($type=='user'){ ?>
													<a href ="inentry.php?edit=<?php echo $row['code'];?>"><button class="btn btn-default btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="View" style="margin-right:5px">
                                                            <i class="fa fa-eye"></i>
													</button></a>
													<?php }else{ ?>
													<a href ="inentry.php?edit=<?php echo $row['code'];?>"><button class="btn btn-default btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Edit" style="margin-right:5px">
                                                            <i class="far fa-edit"></i>
													</button></a>
													<a href="inwardinput.php?delete=<?php echo $row['code'];?>"><button class="btn btn-default btn-sm" type="button" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure you want to delete this entry ?')">
                                                            <i class="far fa-trash-alt"></i>
													</button></a>
													<?php } ?>
											</td>
											
											</tr>
					 
					  <?php
						$tjbags=$tjbags+$row['jutebag'];
						$tppbags=$tppbags+$row['ppbag'];
						$twt=$twt+$row['wt'];
							
						}} ?>
								
					  

                  </tbody>
                </table>
				  <a id="back-to-top" href="#" class="btn  back-to-top" style="background-color:#007cbc" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>


              </div>
              
					  	  </form>
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
$("#inward").addClass("menu-open");
$("#inwarda").addClass("active");
$("#inwarda").css("background-color","#006699");
$("#inreport").addClass("active");
});
</script>
<script>
	$('#cno').change(function(){
		var cno=$('#cno').val();
		alert('hi');
		$.ajax({
          url: 'gettrdata.php',
          type: 'post',
		  data:{cno:cno},
          dataType: 'json',
          success:function(response) {
			  		$('#brokername').val(response[0].broker);
			  		//$('#cust').val(response[0].cust).trigger('change');
			  		var cargo=response[0].cargo;
			  		$('#cargo').val(cargo.trim());
                   }
		});
		
	});
</script>
<script>
$('#submitBtn').click(function() {
     $('#mdcno').text($('#dcno').val());							
});

$('#submit').click(function(){
    alert('Submitting');
    $('#formfield').submit();
});
							
$('#submit1').click(function(){
    alert('Submitting');
	$('#formfield').attr('action','');
    $('#formfield').submit();
});
$('#update').click(function(){
    alert('Submitting');
	$('#formfield').attr('action','chinput.php');
    $('#formfield').submit();
});
</script>
</body>
</html>
