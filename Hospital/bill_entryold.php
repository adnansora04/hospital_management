<?php
	session_start(); 
	if ($_SESSION['khname']==''){header("Location:login.php");}else{
		$username=$_SESSION['khname'];
		$type=$_SESSION['khtype'];
		include('header.php');
		include('sidemenu.php');
		include('config.php');
	}
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
							<h1>Bill Entry</h1>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="index.php" style="color:#007cbc">Home</a></li>
								<li class="breadcrumb-item">Bill Entry</li>
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
									<h3 class="card-title"><b>Bill Entry</b></h3>
								</div>
								<!-- /.card-header -->
								<!-- form start -->
								<form class="form-horizontal" method="post" action="bill_entry_input.php">
									<?php
									$curdt = date( 'Y-m-d', time ());
									$ctime=date("h:i:s A",time());		
									$cmonth=date('M',time());

									$query=mysqli_query($con,"SELECT MAX(cast(substr(billno,5) as decimal)) as code1 from bill_entry");
									$results = mysqli_fetch_array($query);
									$code = $results['code1']+1;
									$clen=strlen($code);
									$ad='';
									if($clen=='2'){$ad='0';}
									if($clen=='1'){$ad='000';}
									$code='B/'.$ad.$code;
									date_default_timezone_set('Asia/Kolkata');
									if(isset($_GET['bill'])){
										$dcode=$_GET['bill'];
										$sql=mysqli_query($con,"SELECT * from patientdis_entry where code='$dcode'");
										$res=mysqli_fetch_array($sql);
										$admitdt=$res['admitdt'];
										$dischdt=$res['discdt'];
										$pname=$res['pname'];
									}
									if(isset($_GET['edit'])){
										$code=$_GET['edit'];
						//echo $code;
										$update= true;
										$qry="SELECT * FROM `bill_entry` WHERE `billno` = '$code'";
						//echo $qry;

										$result=mysqli_query($con,$qry);
                                        $row=mysqli_fetch_array($result);

										$code1=$row['billno'];
										$dt=$row['dt'];
										$billtype=$row['billtype'];
										$dtofadmiss=$row['dtofadmiss'];
										$dtfdisc=$row['dtfdisc'];
										$pname=$row['pname'];
										$diagnosis=$row['diagnosis'];

										$ttl=$row['ttl'];
										$modefpay1=$row['modefpay1'];
										$modefpay2=$row['modefpay2'];

										$particular=$row['particular'];
										$rate=$row['rate'];
										$days=$row['days'];
										$gttl=$row['gttl'];
										$type=$row['type'];
										

									}	 

									?>

									<div class="card-body">
										<input type="hidden" name="dcode" id="dcode" value="<?php echo $dcode; ?>">
										<div class="row form-group">
											<div class="col col-md-3">
												<label for="hf-password" class=" form-control-label">Bill No</label>
											</div>
											<div class="col-12 col-md-4">
												<input type="text" id="billno" name="billno" value="<?php if((isset($_GET['edit']))||(isset($_GET['view']))){ echo $code1;} else{ echo $code;} ?>" class="form-control" readonly>

											</div>
										</div>

										<div class="row form-group">
											<div class="col col-md-3">
												<label for="hf-password" class=" form-control-label">Date</label>
											</div>
											<div class="col-12 col-md-9">
												<input type="date" id="dt" name="dt"  class="form-control" value="<?php if(isset($_GET['edit'])){echo $dt;}else{echo $curdt;} ?>" autofocus>
											</div>
										</div>

										<div class="row form-group">
											<div class="col col-md-3">
												<label for="hf-password" class=" form-control-label">Bill Type</label>
											</div>
											<div class="col-12 col-md-9">
												<select id="billtype" name="billtype"  class="select2" style="width:100%">
													<?php if(isset($_GET['edit'])){?><option value="<?php echo $billtype; ?>"><?php echo $billtype; ?></option><?php } ?>
													<option value="">~~SELECT~~</option>
													<option>IPD</option>
													<option>Balsakha</option>
												</select>

											</div>
										</div>

										<div class="row form-group">
											<div class="col col-md-3">
												<label for="hf-password" class=" form-control-label">Date of Admission</label>
											</div>
											<div class="col-12 col-md-9">
												<input type="date" id="dtofadmiss" name="dtofadmiss"  class="form-control" value="<?php if(isset($_GET['edit'])){echo $dtofadmiss;}else{echo $admitdt;} ?>" style="width:100%">
											</div>
										</div>

										<div class="row form-group">
											<div class="col col-md-3">
												<label for="hf-password" class=" form-control-label">Date of Disc.</label>
											</div>
											<div class="col-12 col-md-9">
												<input type="date" id="dtfdisc" name="dtfdisc"  class="form-control" value="<?php if(isset($_GET['edit'])){echo $dtfdisc;}else{echo $dischdt;} ?>" style="width:100%">
											</div>
										</div>
										<div class="row form-group">
											<div class="col col-md-3">
												<label for="hf-password" class=" form-control-label">Patient Name</label>
											</div>
											<div class="col-12 col-md-9">
												<input type="text" id="pname" name="pname"  class="form-control" value="<?php if(isset($_GET['edit'])){echo $pname;}else{echo $pname;} ?>" style="width:100%">

											</div>
										</div>

										<div class="row form-group">
											<div class="col col-md-3">
												<label for="hf-password" class=" form-control-label">Diagnosis </label>
											</div>
											<div class="col-12 col-md-9">
												<input type="text" name="diagnosis" id="diagnosis" value="<?php if(isset($_GET['edit'])){echo $diagnosis;} ?>" class="form-control">  
											</div>
										</div>
										<input type="hidden" name="stcode" id="stcode" value="<?php if(isset($_GET['edit'])){echo $stcode;} ?>" class="form-control">
									</div>
									<div class="col-md-12">
					<div class="card">
              			<div class="card-header" style="background-color:#007cbc;color:white">
				  			<h3 class="card-title"><b>TREATMENT DETAILS</b></h3>
              			</div>
						<div class="card-body">
					
				<table border=1 id="item_table">
                  <thead>
                    <tr>
                      	<th style="width:60px">Sr No.</th>
                      	<th style="width:280px">Perticular</th>
						<th style="width:140px">Rate</th>
						<th style="width:100px">Days</th>
						<th style="width:150px">Total</th>
						<th style="width:200px">Type</th>
						<th style="width:20px"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button>						</th>
                    </tr>
                  </thead>
				 <tbody>
					  <?php if(isset($_GET['edit'])){
			$billno=$_GET['edit'];
			$sql="select * FROM `bill_child` where billno='$billno'";
			if(mysqli_query($con,$sql)){
				$data=mysqli_query($con,$sql);
				$x = 1;
				while($row=mysqli_fetch_array($data)){ $treatment=$row['perticular']; ?>
                       <tr id="row_<?php echo $x; ?>">
						   <td><?php echo $x; ?></td>
                         <td>
                          <select class="select2" data-row-id="row_<?php echo $x; ?>" id="perticular_<?php echo $x; ?>" name="perticular[]" style="width:100%;" onchange="gettreatmentData(<?php echo $x; ?>)">
							  <option value="">~~SELECT~~</option>
                              <?php $sql="select code,treatment from treatment_mst";
								$res= mysqli_query($con,$sql);
								while($row1= mysqli_fetch_array($res))
                       											{
                      										?>
               <option value="<?php echo $row1[0]; ?>"<?php if($treatment==$row1[0]) { echo "selected='selected'"; } ?> ><?php echo $row1[1]; ?> </option>
                      										<?php
                      											}
                      										?>
							</select>
                          </td>
						 <td style="width:140px"><input type="text" name="rate[]"  id="rate_<?php echo $x; ?>" value="<?php echo $row['rate']; ?>" class="form-control"></td>
						 <td style="width:60px"><input type="text" name="days[]" onkeyup="dayskeyup(<?php echo $x; ?>)" id="days_<?php echo $x; ?>" value="<?php echo $row['days']; ?>" class="form-control"></td>
						 <td style="width:150px"><input type="text" name="ttl[]"  id="ttl_<?php echo $x; ?>" value="<?php echo $row['ttl']; ?>" class="form-control"></td>
						 <td style="width:150px"><input type="text" name="type[]"  id="type_<?php echo $x; ?>" value="<?php echo $row['type']; ?>" class="form-control"></td>
						 <td><button type="button" class="btn btn-default" onclick="removeRow(<?php echo $x; ?>)"><i class="fa fa-minus"></i></button></td>
                    </tr>
                       <?php $x++; ?>
                     <?php } ?>
                   <?php } } ?>
				</tbody>
				</table>
			</div></div></div>
								
	<div class="row">
		<div class="col-md-12">
			<div class="card-body">
				<div class="row form-group">
					<div class="col col-md-3">
						<label for="hf-password" class=" form-control-label">Mode of Pay1</label>
					</div>
					<div class="col-12 col-md-4">
						<select id="modefpay1" name="modefpay1"  class="select2" style="width:100%">
							<?php if(isset($_GET['edit'])){?><option value="<?php echo $modefpay1; ?>"><?php echo $modefpay1; ?></option><?php } ?>
							<option value="">~~SELECT~~</option>
							<option>Cash</option>
						    <option>Debit</option>
							<option>Card</option>
							<option>NEFT</option>
							<option>CHQ</option>
							<option>Online Transfer</option>
						</select>
					</div>
					<div class="col col-md-1" style="margin-left:70px">
						<label for="hf-password" class=" form-control-label">Total</label>
					</div>
					<div class="col-12 col-md-3" >
						<input type="text" id="gttl" name="gttl" value="<?php if(isset($_GET['edit'])){echo $gttl;} ?>"  class="form-control" >
					</div>
				</div>
				<div class="row form-group">
					<div class="col col-md-3">
						<label for="hf-password" class=" form-control-label">Mode of Pay2</label>
					</div>
					<div class="col-12 col-md-4">
						<select id="modefpay2" name="modefpay2"  class="select2" style="width:100%">
							<?php if(isset($_GET['edit'])){?><option value="<?php echo $modefpay2; ?>"><?php echo $modefpay2; ?></option><?php } ?>
							<option value="">~~SELECT~~</option>
							<option>Cash</option>
						    <option>Debit</option>
							<option>Card</option>
							<option>NEFT</option>
							<option>CHQ</option>
							<option>Online Transfer</option>
						</select>
					</div>
				</div>
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
													<a href="bill_report.php"><button type="button" class="btn btn-danger float-right">Back</button></a>
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
					$("#salesentry").addClass("active");
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
			$.ajax({
					url: 'gettreatmentmst.php',
					type: 'post',
					dataType: 'json',
					success:function(response) {

						var html = '<tr id="row_'+row_id+'">'+
						'<td style="width: 10px">'+row_id+'</td>'+
						'<td style="width:250px">'+ 
						'<select  class="select2 form-control perticular" id="perticular_'+row_id+'" name="perticular[]" style="width:100%;" onchange="gettreatmentData('+row_id+')">'+
						'<option value="">~~SELECT~~</option>';
						$.each(response, function(index, value) {
							html += '<option value="'+value.code+'">'+value.perticular+'</option>'; 
						});

						html += '</select>'+
						'</td>'+ 
						'<td style="width:140px"><input type="text" name="rate[]"  id="rate_'+row_id+'" class="form-control"></td>'+
						'<td style="width:60px"><input type="text" name="days[]" onkeyup="dayskeyup('+row_id+')" id="days_'+row_id+'" class="form-control"></td>'+
						'<td style="width:150px"><input type="text" name="ttl[]"  id="ttl_'+row_id+'" class="form-control"></td>'+
						'<td style="width:150px"><input type="text" name="type[]"  id="type_'+row_id+'" class="form-control"></td>'+
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
			
			return false;
		});

		function removeRow(tr_id)
		{
			$("#item_table tbody tr#row_"+tr_id).remove();
			subAmount();
		}
		function gettreatmentData(row_id)
		{
			var perticular = $("#perticular_"+row_id).val();    
			if(perticular == "") {
				$("#rate_"+row_id).val("");
				$("#type_"+row_id).val("");
			} else {
				$.ajax({
					url: 'gettreatmentdata.php',
					type: 'post',
					data: {perticular : perticular},
					dataType: 'json',
					success:function(response) {
						$("#rate_"+row_id).val(response[0].rate);
						$("#type_"+row_id).val(response[0].type);
						
	         } // /success
	      }); // /ajax function to fetch the product data 
			}
		}
		function subAmount() {
			var tableProductLength = $("#item_table tbody tr").length;
			var ttl=0;
			for(x = 0; x < tableProductLength; x++) {
				var tr = $("#item_table tbody tr")[x];
				var count = $(tr).attr('id');
				count = count.substring(4);
				var rt=$("#rate_"+count).val();
				var days=$("#days_"+count).val();
				if(rt==''){rt=0;}
				if(days==''){days=0;}
				var typ=$('#type_'+count).val();
				var amt=0;
				if(typ=='Per Day'){
			    amt=parseFloat(days)*parseFloat(rt);
				amt=amt.toFixed(2);
				}
				else{
				amt=1*parseFloat(rt);
				amt=amt.toFixed(2);
				}
				$("#ttl_"+count).val(amt);
				ttl=parseFloat(ttl)+parseFloat(amt);
		} // /for	
	    $("#gttl").val(ttl.toFixed(2));
	    
	}
	function dayskeyup(tr_id)
	{
	   // $("#product_info_table tbody tr#row_"+tr_id).remove();
	   subAmount();
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
