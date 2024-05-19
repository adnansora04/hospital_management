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
            <h1>PATIENT DISCHARGE ENTRY</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="index.php" style="color:#007cbc">Home</a></li>
              <li class="breadcrumb-item">Patient Discharge Entry</li>
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
				  <h3 class="card-title"><b>PATIENT DISCHARGE ENTRY</b></h3>
              </div>
			<!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="post" action="patientdis_input.php">
				  <?php
		$curdt = date( 'Y-m-d', time ());
		$curtime=date("H:i",time());		
		$cmonth=date('M',time());
		date_default_timezone_set('Asia/Kolkata');

		//code to delete all the old entries till date...!
		$prevdt=date('Y-m-d',strtotime("-1 days"));		  
		$qr1=mysqli_query($con,"select * from patientdis_entry where dt<'$curdt' and billstatus='Cleared'");
		while($res1=mysqli_fetch_array($qr1)){
			$pname=$res1['pname'];
			$qr2=mysqli_query($con,"select code from patient_ac where pname='$pname'");
			while($res2=mysqli_fetch_array($qr2)){
			$ptcode=$res2['code'];
			$prefix=substr($ptcode,0,2);
			if($prefix=='RT'){
				$del2="delete from roomtransfer_entry where code='$ptcode' and `dt`<'$curdt'";
				mysqli_query($con,$del2);
			}
			else{
				$del1="delete from patient_entry where code='$ptcode' and `dt`<'$curdt'";
				mysqli_query($con,$del1);
			}
				$del3="delete from patientdis_entry where pname='$pname' and `dt`<'$curdt'";
				mysqli_query($con,$del3);
				$del4="delete from patient_ac where code='$ptcode' and `dt`<'$curdt'";
				mysqli_query($con,$del4);
		}}
		//code to autogenerate no..!				  
		$query = mysqli_query($con,"SELECT MAX(cast(code as decimal)) as code1 FROM patientdis_entry");
		$results = mysqli_fetch_array($query);
		$code = $results['code1']+1;
		
				  
		if(isset($_GET['room'])){
			$roomcode=$_GET['room'];
			//echo "select rtflag from patient_ac where roomno='$roomcode' and MID(code,1,2)='RT' order by cast(substr(`code`,3) as decimal) desc";
			$check=mysqli_query($con,"select rtflag from patient_ac where roomno='$roomcode' and MID(code,1,2)='RT' order by cast(substr(`code`,4) as decimal) desc");
			$ans=mysqli_fetch_array($check);
			$rtflag=$ans[0];
			if($rtflag=='Yes'){
				$sql2=mysqli_query($con,"select * from roomtransfer_entry where newroom='$roomcode' order by cast(substr(`code`,4) as decimal) desc");
				$row2=mysqli_fetch_array($sql2);
				$pcode=$row2['pname'];
				$q2=mysqli_query($con,"select pname from patiant_mst where code='$pcode'");
					$r2=mysqli_fetch_array($q2);
					$pname=$r2[0];
				
				$q1=mysqli_query($con,"select roomno,cat from room_mst where code='$roomcode'");
				$r1=mysqli_fetch_array($q1);
				$roomno=$r1[0];
				$cat=$r1[1];
				$q3=mysqli_query($con,"select terrif from roomcatgry_mst where code='$cat'");
				$r3=mysqli_fetch_array($q3);
				$terrif=$r3[0];
				// ADMIT-DT&TIME should be taken from the patient admit entry..! // changed on 09-06-23
				$sql2=mysqli_query($con,"select * from patient_entry where pname='$pcode' order by cast(`code` as decimal) desc");
				$res2=mysqli_fetch_array($sql2);
				$attendorname=$res2['attedname'];
				$admitdt=$res2['dt'];
				$admittime=$res2['time'];
				
				//$terrif=$r1['terrif'];
			}
			else{
			$sql=mysqli_query($con,"select * from patient_entry where roomno='$roomcode' order by cast(`code` as decimal) desc");
			$res=mysqli_fetch_array($sql);
			$pcode=$res['pname'];
					$q2=mysqli_query($con,"select pname from patiant_mst where code='$pcode'");
					$r2=mysqli_fetch_array($q2);
					$pname=$r2[0];
			$attendorname=$res['attedname'];
			$admitdt=$res['dt'];
			$q1=mysqli_query($con,"select roomno from room_mst where code='$roomcode'");
			$r1=mysqli_fetch_array($q1);
			$roomno=$r1[0];
			$terrif=$res['terrif'];
			$admittime=$res['time'];
			}
			
		}
		if(isset($_GET['edit'])){
					$code=$_GET['edit'];
					//echo $code;
					$update= true;
					$qry="SELECT * FROM `patientdis_entry` WHERE `code` = '$code'";
					//echo $qry;
	
						$result=mysqli_query($con,$qry);
									$row=mysqli_fetch_array($result);
										$code1=$row['code'];
										$dt=$row['dt'];
										$time=$row['time'];
										$attednamedis=$row['attednamedis'];
										$pcode=$row['pname'];
										$q2=mysqli_query($con,"select pname from patiant_mst where code='$pcode'");
										$r2=mysqli_fetch_array($q2);
										$pname=$r2[0];
										$admitdt=$row['admitdt'];
										$admittime=$row['admittime'];
										$attednamead=$row['attednamead'];
										$discdt=$row['discdt'];
										$totday =$row['totday'];
										$roomcode=$row['roomno'];
										$q1=mysqli_query($con,"select roomno from room_mst where code='$roomcode'");
										$r1=mysqli_fetch_array($q1);
										$roomno=$r1[0];
										$terrif=$row['terrif'];
										$bllamtrs=$row['bllamtrs'];
										$billstatus=$row['billstatus'];
									}
				  		?>
	
            <div class="card-body">
				
                 <div class="row form-group">
                  <div class="col col-md-3">
                    <label for="hf-password" class=" form-control-label">Code</label>
                  </div>
                  <div class="col-12 col-md-4">
                   <input type="text" id="code" name="code" value="<?php if((isset($_GET['edit']))||(isset($_GET['view']))){ echo $code1;} else{ echo $code;} ?>" placeholder="code" class="form-control" readonly>
                 </div>
				</div>
			 <div class="row form-group">
                <div class="col col-md-3">
                  <label for="hf-password" class=" form-control-label">Date</label>
                </div>
                <div class="col-12 col-md-9">
                  <input type="date" id="dt" name="dt"  class="form-control" value="<?php if(isset($_GET['edit'])){echo $dt;}else{echo $curdt;} ?>" class="form-control" <?php if(isset($_GET['edit'])){echo "readonly";} ?>>
                </div>
				 
              </div>
			<div class="row form-group">
                <div class="col col-md-3">
                  <label for="hf-password" class=" form-control-label">Patient Name</label>
                </div>
                <div class="col-12 col-md-9">
                 <input type="text" id="pname" name="pname" value="<?php if(isset($_GET['edit'])){echo $pname;}else{echo $pname;} ?>" class="form-control">

               </div>
             </div> 
			<div class="row form-group">
            <div class="col col-md-3">
              <label for="hf-password" class=" form-control-label">NURSING STAFF Name(Admit)</label>
            </div>
            <div class="col-12 col-md-9">
              <input type="text" name="attednamead" id="attednamead" value="<?php if(isset($_GET['edit'])){echo $attednamead;}else{echo $attendorname;} ?>" class="form-control" >  
            </div>
         	 </div>
              <div class="row form-group">
                <div class="col col-md-3">
                  <label for="hf-password" class=" form-control-label">NURSING STAFF Name(Discharge)</label>
                </div>
                <div class="col-12 col-md-9">
                  <input type="text" id="attednamedis" name="attednamedis" value="<?php if(isset($_GET['edit'])){echo $attednamedis;}else{echo $username;} ?>" class="form-control" readonly>

                </div>
              </div>
                                       

             <div class="row form-group">
              <div class="col col-md-3">
                <label for="hf-password" class=" form-control-label">Admit Date</label>
              </div>
              <div class="col-12 col-md-4">
                <input type="date" id="admitdt" name="admitdt" value="<?php if(isset($_GET['edit'])){echo $admitdt;}else{echo $admitdt;} ?>" class="form-control" readonly>

             </div>
				 <div class="col col-md-2">
                <label for="hf-password" class=" form-control-label">Admit Time</label>
              </div>
              <div class="col-12 col-md-3">
                <input type="time" id="admittime" name="admittime" value="<?php if(isset($_GET['edit'])){echo $admittime;}else{echo $admittime;} ?>" class="form-control" readonly>

             </div>
           </div>                           

           
          <div class="row form-group">
            <div class="col col-md-3">
              <label for="hf-password" class=" form-control-label">Disc. Date</label>
            </div>
            <div class="col-12 col-md-4">
             <input type="date" name="discdt" id="discdt" value="<?php if(isset($_GET['edit'])){echo $discdt;}else{echo $curdt;} ?>" class="form-control" <?php if(isset($_GET['edit'])){echo "readonly";} ?>> 
           </div>
			  <div class="col col-md-2">
                  <label for="hf-password" class=" form-control-label">Disc. Time</label>
                </div>
                <div class="col-12 col-md-3">
                  <input type="time" id="time" name="time"  class="form-control" value="<?php if(isset($_GET['edit'])){echo $time;}else{echo $curtime;} ?>" class="form-control" <?php if(isset($_GET['edit'])){echo "readonly";} ?>>
                </div>
         </div>
	<?php
		if($admitdt==""){$date1=date_create($admitdt);}
		elseif(($admitdt<>"0000-00-00")||($admitdt<>"")){
			$admitdt=date("Y-m-d",strtotime($admitdt));
			$date1=date_create($admitdt);
		}
		$dt=date("Y-m-d",strtotime($curdt));
		$date2=date_create($dt);
		$diff=date_diff($date2,$date1);
		$ttldays=$diff->format("%a");
		if($ttldays=='0'){$ttldays='1';}
		$billamt=$terrif*$ttldays;
	?>
         <div class="row form-group">
          <div class="col col-md-3">
            <label for="hf-password" class=" form-control-label">Total Days</label>
          </div>
          <div class="col-12 col-md-9">
            <input type="text" name="totday" id="totday" value="<?php if(isset($_GET['edit'])){echo $totday;}else{echo $ttldays;} ?>" class="form-control">  
          </div>
        </div>
        <div class="row form-group">
          <div class="col col-md-3">
            <label for="hf-password" class=" form-control-label">Room no.</label>
          </div>
          <div class="col-12 col-md-9">
            <input type="text" name="roomno" id="roomno" value="<?php if(isset($_GET['edit'])){echo $roomno;}else{echo $roomno;} ?>" class="form-control">  
          </div>
        </div>                          

        <div class="row form-group">
          <div class="col col-md-3">
            <label for="hf-password" class=" form-control-label">Terrif</label>
          </div>
          <div class="col-12 col-md-9">
           <input type="text" name="terrif" id="terrif" value="<?php if(isset($_GET['edit'])){echo $terrif;}else{echo $terrif;} ?>" class="form-control"> 
         </div>
       </div> 
       <div class="row form-group">
        <div class="col col-md-3">
          <label for="hf-password" class=" form-control-label">Bill Amt Rs</label>
        </div>
        <div class="col-12 col-md-9">
         <input type="text" name="bllamtrs" id="bllamtrs" value="<?php if(isset($_GET['edit'])){echo $bllamtrs;}else{echo $billamt;} ?>" class="form-control"> 
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
                  <a href="salessearch.php"><button type="button" class="btn btn-danger float-right">Back</button></a>
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
$("#dischrgentry").addClass("active");
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
	$('#cust').change(function(){
		var cust=$('#cust').val();
	$.ajax({
        url: 'getcstcode.php',
        type: 'post',
        data: {cust : cust},
        dataType: 'json',
        success:function(response) {
          $('#stcode').val(response[0].stcode);
		 
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
function subAmount() {
  var tableProductLength = $("#item_table tbody tr").length;
    var ttl=0;
	var ttlcess=0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#item_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);
		var rt=$("#rate_"+count).val();
		var qty=$("#qty_"+count).val();
		if(rt==''){rt=0;}
		if(qty==''){qty=0;}
		var amt=parseFloat(qty)*parseFloat(rt);
		amt=amt.toFixed(2);
		$("#amt_"+count).val(amt);
		
		ttl=parseFloat(ttl)+parseFloat(amt);
		
		var item=$('#itemnm_'+count).val();
		if(item=='COAL'){
		var cess=parseFloat(qty)*400.00;
		ttlcess=ttlcess+cess;
		
		}
    } // /for	
$('#cess').val(ttlcess.toFixed(2));
$("#ttl").val(ttl.toFixed(2));
 var cgst=$('#cgst').val();
var sgst=$('#sgst').val();
var igst=$('#igst').val();
var netamt=$('#ttl').val();
var camt=(parseFloat(netamt)*parseFloat(cgst)/100).toFixed(2);
var samt=(parseFloat(netamt)*parseFloat(sgst)/100).toFixed(2);
var iamt=(parseFloat(netamt)*parseFloat(igst)/100).toFixed(2);
$('#camt').val(camt);
$('#samt').val(samt);
$('#iamt').val(iamt);
var gttl=parseFloat(netamt)+parseFloat(camt)+parseFloat(samt)+parseFloat(iamt)+parseFloat(ttlcess);
var round=Math.round(gttl);
var roundoff=round-gttl;
$('#gttl').val(round.toFixed(2));
$('#roundoff').val(roundoff.toFixed(2));
  }
function qtykeyup(tr_id)
  {
   // $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }

function calctcs(){
var ttl=$('#ttl').val();
var tcs=$('#tcsper').val();
if(tcs==''){tcs=0;}
var tcsamt=(parseFloat(ttl)*parseFloat(tcs)/100).toFixed(2);
$('#tcs').val(tcsamt);
//var gttl=$('#gttl').val();
var camt=$('#camt').val();
var samt=$('#samt').val();
var iamt=$('#iamt').val();
var ttlcess=$('#cess').val();
var gttl=parseFloat(ttl)+parseFloat(camt)+parseFloat(samt)+parseFloat(iamt)+parseFloat(ttlcess)+parseFloat(tcsamt);
var round=Math.round(gttl);
var roundoff=round-gttl;
$('#gttl').val(round.toFixed(2));
$('#roundoff').val(roundoff.toFixed(2));
/*gttl=parseFloat(gttl)+parseFloat(tcsamt);
var round=Math.round(gttl);
var roundoff=round-gttl;
$('#gttl').val(round.toFixed(2));
$('#roundoff').val(roundoff.toFixed(2));*/
}
	 </script>	 
<script>

	$('#girn').click(function(){
	//$('#ewaydiv').removeAttr('style');
	document.getElementById("ewaydiv").scrollIntoView({ behavior: "smooth" });
	});  
	$('#einv').click(function(){
	alert('Updating');
	$('#formfield').attr('action','girn.php');
    $('#formfield').submit();
	
});

</script>
</body>
</html>
