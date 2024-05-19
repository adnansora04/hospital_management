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
            <h1>Deposit Entry</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="index.php" style="color:#007cbc">Home</a></li>
              <li class="breadcrumb-item">Deposit Entry</li>
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
				  <h3 class="card-title"><b>Deposit Entry</b></h3>
              </div>
			<!-- /.card-header -->
              <!-- form start -->
         <form class="form-horizontal" method="post" action="deposit_input.php">
          <?php
    $curdt = date( 'Y-m-d', time ());
    $ctime=date("h:i:s A",time());    
    $cmonth=date('M',time());
    
    
    $query = mysqli_query($con,"SELECT MAX(cast(code as decimal)) as code1 FROM deposit_entry");
    $results = mysqli_fetch_array($query);
    $code = $results['code1']+1;
    date_default_timezone_set('Asia/Kolkata');
     
    if(isset($_GET['edit'])){
          $code=$_GET['edit'];
          //echo $code;
          $update= true;
          $qry="SELECT * FROM `deposit_entry` WHERE `code` = '$code'";
          //echo $qry;
  
            $result=mysqli_query($con,$qry);
            

                $row=mysqli_fetch_array($result);
                    $code1=$row['code'];
                    $dt=$row['dt'];
                    $rcode=$row['roomno'];
					$q1=mysqli_query($con,"select roomno from room_mst where code='$rcode'");
					$r1=mysqli_fetch_array($q1);
					$roomno=$r1[0];
					$ncode=$row['newroom'];
					$q2=mysqli_query($con,"select roomno from room_mst where code='$ncode'");
					$r2=mysqli_fetch_array($q2);
					$newroom=$r2[0];
                    $pcode=$row['pname'];
					$q2=mysqli_query($con,"select pname from patiant_mst where code='$pcode'");
					$r2=mysqli_fetch_array($q2);
					$pname=$r2[0];
                    $depamt=$row['depamt'];
                    $mode=$row['mode'];
                    
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
                                                    <label for="hf-password" class=" form-control-label">Date</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input type="date" id="dt" name="dt"  class="form-control" value="<?php if(isset($_GET['edit'])){echo $dt;}else{echo $curdt;} ?>" autofocus >
												</div>
                                            </div>
				 					 
				 <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Room No.</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                              
                                                    <select id="roomno" name="roomno" class="select2" style="width:100%">
														<?php if(isset($_GET['edit'])){ ?><option value="<?php echo $rcode; ?>"><?php echo $roomno; ?></option><?php } ?>
														<option value="">~~SELECT~~</option>
                                                        <?php
                                                         $sql = mysqli_query($con,"SELECT * FROM `room_mst` where occupation = 1");
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
                                                  <input type="text" name="pname" id="pname" value="<?php if(isset($_GET['edit'])){echo $pname;} ?>" class="form-control" >  			</div>
                                            </div>
				
                                            <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Deposit Amount</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                 <input type="text" id="depamt" name="depamt" value="<?php if(isset($_GET['edit'])){echo $depamt;} ?>" class="form-control" > 
												</div>
                                            </div>
                                                    <div class="row form-group">
                                                <div class="col col-md-3">
                                                    <label for="hf-password" class=" form-control-label">Mode</label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                     <select id="mode" name="mode"  class="select2" style="width:100%">
														<?php if(isset($_GET['edit'])){?><option><?php echo $mode; ?></option><?php } ?>
														<option value="">~~SELECT~~</option>
														<option>Cash</option>
														<option>NEFT</option>
														<option>Gpay</option>
														<option>CHq</option>

													  </select>
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
                  <a href="deposit_report.php"><button type="button" class="btn btn-danger float-right">Back</button></a>
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
$("#depositentry").addClass("active");
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
	$('#roomno').change(function(){
		var roomno=$('#roomno').val();
	$.ajax({
        url: 'getpname.php',
        type: 'post',
        data: {roomno : roomno},
        dataType: 'json',
        success:function(response) {
          $('#pname').val(response[0].pname);
		 
         } // /success
      });
	});
	
		  $("#add_row").unbind('click').bind('click', function() {
      var table = $("#item_table");
      var count_table_tbody_tr = $("#item_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;
	  var cust=$('#cust').val();
		if(cust==''){
			swal('Please Select The Customer..!');
		}
		else{
      $.ajax({
          url: 'getitemmst.php',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
               var html = '<tr id="row_'+row_id+'">'+
				     '<td style="width: 10px">'+row_id+'</td>'+
                   '<td style="width:250px">'+ 
                    '<select  class="select2 form-control item" id="item_'+row_id+'" name="item[]" style="width:100%;" onchange="getItemData('+row_id+')">'+
                        '<option value="">~~SELECT~~</option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.code+'">'+value.item+'</option>'; 
						 });
                        
                      html += '</select>'+
                    '</td>'+ 
					'<td style="width:80px">'+ 
                    '<select  class="select2 form-control size" id="size_'+row_id+'" name="size[]" style="width:100%;">'+
                        '<option value="">~~SELECT~~</option>';
			  			
					  html += '</select>'+
                    '</td>'+
					'<td style="width:100px"><input type="text" name="hsn[]" id="hsn_'+row_id+'" class="form-control"><input type="hidden" name="itemnm" id="itemnm_'+row_id+'"></td>'+
					'<td style="width:80px"><input type="text" name="unit[]" id="unit_'+row_id+'" class="form-control"></td>'+
					'<td style="width:80px"><input type="text" name="qty[]" onkeyup="qtykeyup('+row_id+')" id="qty_'+row_id+'" class="form-control"></td>'+
					'<td style="width:140px"><input type="text" name="rate[]" onkeyup="qtykeyup('+row_id+')" id="rate_'+row_id+'" class="form-control"></td>'+
					'<td style="width:60px"><input type="text" name="tax[]" id="tax_'+row_id+'" class="form-control"></td>'+
					'<td style="width:150px"><input type="text" name="amt[]"  id="amt_'+row_id+'" class="form-control"></td>'+
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-minus"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#item_table tbody tr:last").after(html);  
              }
              else {
                $("#item_table tbody").html(html);
              }

              $(".item").select2();
			  $(".size").select2();
          }
        });
		}
      return false;
    });

function removeRow(tr_id)
  {
    $("#item_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }
	function getItemData(row_id)
  {
    var item = $("#item_"+row_id).val();    
	if(item == "") {
      $("#hsn_"+row_id).val("");
	   $("#unit_"+row_id).val("");
     } else {
      $.ajax({
        url: 'getitemdtl.php',
        type: 'post',
        data: {item : item},
        dataType: 'json',
        success:function(response) {
          $("#hsn_"+row_id).val(response[0].hsn);
		  $("#itemnm_"+row_id).val(response[0].itemnm);
		  $("#unit_"+row_id).val(response[0].unit);
		  $("#tax_"+row_id).val(response[0].igst);
 		 var stcode=$('#stcode').val();
		 if(stcode=='24'){
		 	$('#cgst').val(response[0].cgst);
			$('#sgst').val(response[0].sgst);
			$('#igst').val(0);
		 }
		 else{
			 $('#cgst').val(0);
			 $('#sgst').val(0);
			$('#igst').val(response[0].igst);
		 }	
         } // /success
      }); // /ajax function to fetch the product data 
	$.ajax({
        url: 'getsize.php',
        type: 'post',
		data: {item : item},
		dataType: 'json',
        success:function(response) {
          var size=response.length;
				
				$('#size_'+row_id+' option').remove();
				$('#size_'+row_id).append('<option value="">~~SELECT~~</option>');
				for (var i=0;i<size;i++){
				$('#size_'+row_id).append('<option>'+response[i].size+'</option>');
				}
         } // /success
      });
    }
  }

	 </script>	 

</body>
</html>
