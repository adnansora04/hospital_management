<?php


//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once '../admintemplate/vendor3/autoload.php';
ob_start();
include('config.php');
session_start();

//$_SESSION['var']='print';
$username=$_SESSION['khname'];
//$username="K R ROADLINES";
$billno=$_GET['code'];


$sql="select * from `bill_entry` where billno='$billno'";

if(mysqli_query($con,$sql)){
	$data =mysqli_query($con,$sql);
	$row = mysqli_fetch_array($data);

	$billno=$row['billno'];
	$dt=$row['dt'];
	if(($dt=="")||($dt=="0000-00-00")){$dt="";}else{
		$dt = date("d-m-Y", strtotime($dt));}
									//$dt=$row['dt'];
		$custcode=$row['cust'];
		$pname=$row['pname'];
		$admitdt=$row['dtofadmiss'];
		$dischdt=$row['dtfdisc'];
		$diagnosis=$row['diagnosis'];
		$modeofpay1=$row['modefpay1'];
		$modeofpay2=$row['modefpay2'];
		$gttl=$row['ttl'];
	}
	else{echo "not working";}





	function getIndianCurrency($number)
	{
		$decimal = round($number - ($no = floor($number)), 2) * 100;
		$hundred = null;
		$digits_length = strlen($no);
		$i = 0;
		$str = array();
		$words = array(0 => '', 1 => 'One', 2 => 'Two',
			3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
			7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
			10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
			13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
			16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
			19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
			40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
			70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
		$digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
		while( $i < $digits_length ) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += $divider == 10 ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
				$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
				$str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
			} else $str[] = null;
		}
		$Rupees = implode('', array_reverse($str));
		$paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
		return ($Rupees ? 'INR ' . $Rupees . 'Only ' : '') . $paise;
	}


//echo numberTowords(500000);
//echo getIndianCurrency(50000);
	?>
	<!DOCTYPE HTML>
	<html lang="en">
	<style>
		table{

			height: 620px;
			width:580px;
			border:1px solid black;
			border-collapse:collapse;

		}

		.vertical-text {
			transform: rotate(270deg);
			transform-origin: left top 0;
		}


	</style>

	<link href="//db.onlinewebfonts.com/c/cd0381aa3322dff4babd137f03829c8c?family=Tahoma" rel="stylesheet" type="text/css"/> 
<!--<head>
	<!-- Fontfaces CSS
<link href="css/font-face.css" rel="stylesheet" media="all">
<link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
<link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
<link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

</head>-->
<head>
	<style>
		/* Page margins are defined using CSS */
		@page {
			margin: 1cm;
			margin-top:2.5cm;
			margin-bottom: 2.5cm;

			/* Header frame starts within margin-top of @page */
			@frame header {
				-pdf-frame-content: headerContent; /* headerContent is the #id of the element */
				top: 1cm;
				margin-left: 2cm;
				margin-right:2cm;
				height:1cm;
			}

			/* Footer frame starts outside margin-bottom of @page */
			@frame footer {
				-pdf-frame-content: footerContent;
				bottom: 2cm;
				margin-left: 1cm;
				margin-right: 1cm;
				height: 1cm;
			}
		}
	</style>
</head>
<body>
	<!--<link href="https://fonts.googleapis.com/css?family=Times New Roman" rel="stylesheet">-->

	<table style="margin-top: -25px">

			</table>
		
<table border="1" style="margin-top:10px;">

		<tr>
			<td style="width:180px;text-align:center;font-weight:bold;font-size:15px;border-right:none;border-bottom: none;" >
				<img src="img/logo.jpg" style="height:100px;width:120px;"></td>

				<td  style="width:520px;font-size:15px;font-weight:bold;text-align:right;padding-top:10px;line-height:30px;border-bottom: none;"><span>Dr. Nitin B. Thakkar &nbsp;</span><br>
					<span style="font-size:12px;font-weight:medium;line-height:0px;padding-bottom:px;padding-right:20px;">M.B.,D.Ped &nbsp;<br></span>
					<hr style="border: 1px solid black;position: relative;display: flex;justify-content: right;size: 10px">
                    <span style="font-size:12px;font-weight:medium;line-height:18px;margin-top: -50px">132, Sector 1/A, Opp. Ghanshyam Enterprise,Gandhidham(kutch). 370 201 &nbsp;<br>
                    

                    Reception Mob, ;- +91 95101 68842, 99798 81095 &nbsp;<br></span>

				</td>
			</tr>
			</table>


			<table  border="1"	>
			
				<tr>
					<td style="line-height:0px;width:261px;text-align:left;padding-top: 0px;padding-bottom: 0px;border-top: none;border-bottom: none;">
                        <hr>
						
					</td>
					<td style="line-height: 22px;width:170px;text-align:center;font-size:12px;padding-top:2px;padding-bottom: 2px;font-weight: bold">	 CASH MEMO / RECEIPT
					</td>
						<td style="border-top: none;border-bottom: none;border-left:none;line-height: 0px;width:261px;text-align:left;padding-top:0px;padding-bottom: 0px;">
							<hr>
				</td>
				</tr>
		</table>
			<table  border="1" >
				<tr>
					<td style="line-height: 23px;width:322px;border:1px;text-align:left;font-size:12px;font-weight: bold;padding-left: 9px;border-top: none;margin-bottom: 2px;border-bottom: none;border-right: none;">
						
						No. : <?php echo $billno; ?>
					
						
					</td>
					<td style="line-height: 23px;width:346px;border:1px;text-align:right;font-size:12px;font-weight: bold;border-top: none;padding-left:9px;margin-bottom: 2px;border-bottom: none;">
						Date : <span style=" text-decoration: underline;font-size: 12px;font-weight: bold;"><?php echo $dt; ?> &nbsp;</span>
					</td>
				</tr>
			</table>
			<table  border="1">
				<tr>
					<td style="line-height: 0px;width:110px;border:1px;text-align:left;font-size:12px;font-weight: bold;padding-left: 9px;border-top: none;margin-bottom: 2px;border-bottom: none;padding-top: 50px;border-right: none;">
					Patient's Name  :						
					</td>
					<td style="line-height: 0px;width:533px;border:1px;text-align:left;font-size:13px;font-weight: bold;padding-left: 9px;border-top: none;margin-bottom: 2px;padding-top: 50px;border-right: none;">
					<?php echo $pname; ?>						
					</td>
					<td style="line-height: 23px;width:4px;border:1px;text-align:left;font-size:12px;font-weight: bold;padding-left: 9px;border-top: none;margin-bottom: 2px;border-bottom: none;padding-top: 50px">
									
					</td>
				</tr>
</table>

			<table  border="1"	>
					<tr>
					<td style="line-height: 0px;width:105px;border:1px;text-align:left;font-size:12px;font-weight: bold;padding-left: 9px;border-top: none;margin-bottom: 2px;border-bottom: none;padding-top: 10px;border-right: none;">
					Date of Admission :						
					</td>
					<td style="line-height: 0px;width:197px;border:1px;text-align:left;font-size:13px;font-weight: bold;padding-left: 9px;border-top: none;margin-bottom: 2px;padding-top: 10px;border-right: none;">
					<?php echo $admitdt; ?>						
					</td>
					<td style="line-height: 0px;width:105px;border:1px;text-align:left;font-size:12px;font-weight: bold;padding-left: 9px;border-top: none;margin-bottom: 2px;border-bottom: none;padding-top: 10px;border-right: none;">
					Date of Discharge :						
					</td>
					<td style="line-height: 0px;width:197px;border:1px;text-align:left;font-size:13px;font-weight: bold;padding-left: 9px;border-top: none;margin-bottom: 2px;padding-top: 10px;border-right: none;">
					<?php echo $dischdt; ?>						
					</td>
					<td style="line-height: 0px;width:1px;border:1px;text-align:left;font-size:13px;font-weight: bold;padding-left: 9px;border-top: none;margin-bottom: 2px;padding-top: 0px;border-bottom: none;">
										
					</td>
				</tr>
			</table>

<table  border="1">
				<tr>
					<td style="line-height: 0px;width:107px;border:1px;text-align:left;font-size:12px;font-weight: bold;padding-left: 9px;border-top: none;margin-bottom: 2px;border-bottom: none;padding-top: 10px;border-right: none;">
					Diagnosis : 						
					</td>
					<td style="line-height: 0px;width:537px;border:1px;text-align:left;font-size:13px;font-weight: bold;padding-left: 9px;border-top: none;margin-bottom: 2px;padding-top: 10px;border-right: none;">
					<?php echo $diagnosis; ?>						
					</td>
					<td style="line-height: 23px;width:3px;border:1px;text-align:left;font-size:12px;font-weight: bold;padding-left: 9px;border-top: none;margin-bottom: 2px;border-bottom: none;padding-top: 10px">
									
					</td>
				</tr>
					<tr>
					<td style="line-height: 0px;width:107px;border:1px;text-align:left;font-size:12px;font-weight: bold;padding-left: 9px;border-top: none;margin-bottom: 2px;border-bottom: none;padding-top: 10px;border-right: none;">
											
					</td>
					<td style="line-height: 0px;width:537px;border:1px;text-align:left;font-size:13px;font-weight: bold;padding-left: 9px;border-top: none;margin-bottom: 2px;padding-top: 10px;border-right: none;border-bottom: none;">
									
					</td>
					<td style="line-height: 23px;width:3px;border:1px;text-align:left;font-size:12px;font-weight: bold;padding-left: 9px;border-top: none;margin-bottom: 2px;border-bottom: none;padding-top: 10px">
									
					</td>
				</tr>
</table>



			<table>
				<tr>
					<td style="height:20px;width:40px;border:1px;background-color:#b7d7e8;font-weight:bold;text-align:center;font-size: 12px">Srno</td>
					<td style="width:277px;border:1px;text-align:center;font-size:11px;background-color:#b7d7e8;font-weight:bold"> Particulars</td>
					<td style="width:110px;border:1px;text-align:center;font-size:11px;background-color:#b7d7e8;font-weight:bold">Rate</td>
					<td style="width:100px;border:1px;text-align:center;font-size:11px;background-color:#b7d7e8;font-weight:bold;line-height: 14px">Days</td>
					<td style="width:150px;border:1px;text-align:center;font-size:11px;background-color:#b7d7e8;font-weight:bold">Amount</td>
					</tr>
		
					<?php
						$height="300";
						$srno=0;
						$qr1=mysqli_query($con,"select * from bill_child where billno='$billno'");
						while($r1=mysqli_fetch_array($qr1)){
								$srno=$srno+1;
					?>
				<tr>
					<td style="width:40px;border:1px;text-align:center;font-size: 12px;border-bottom: none;"><?php echo $srno; ?></td>
					<td style="width:277px;border:1px;text-align:left;font-size:11px;border-bottom: none;">
						<?php $perticular=$r1['perticular'];
							  $q2=mysqli_query($con,"select treatment from treatment_mst where code='$perticular'");
							  $r2=mysqli_fetch_array($q2);
							  echo $r2[0];
						?>
					</td>
					<td style="width:110px;border:1px;text-align:center;font-size:11px;border-bottom: none;"><?php echo $r1['rate']; ?></td>
					<td style="width:100px;border:1px;text-align:center;font-size:11px;line-height: 14px;border-bottom: none;"><?php echo $r1['days']; ?></td>
					<td style="width:150px;border:1px;text-align:center;font-size:11px;border-bottom: none;"><?php echo $r1['ttl']; ?></td>
				</tr>
	            <?php 
					$height=$height-12;	} ?>   
				<tr>
					<td style="width:40px;border:1px;text-align:center;font-size: 12px;border-bottom: none;height:<?php echo $height; ?>"></td>
					<td style="width:277px;border:1px;text-align:center;font-size:11px;border-bottom: none;"></td>
					<td style="width:110px;border:1px;text-align:center;font-size:11px;border-bottom: none;"></td>
					<td style="width:100px;border:1px;text-align:center;font-size:11px;line-height: 14px;border-bottom: none;"></td>
					<td style="width:150px;border:1px;text-align:center;font-size:11px;border-bottom: none;"></td>
				</tr>
				</table>
				<table>
				<tr>
				
					<td style="width:170px;border:1px;text-align:center;font-size:10px;padding-top: 5px;padding-bottom: 5px">
						<b>Mode1</b>:- <?php echo $modeofpay1; ?> &nbsp;&nbsp;
					</td>
					<td style="width:170px;border:1px;text-align:center;font-size:10px;padding-top: 5px;padding-bottom: 5px">
						<b>Mode2</b>:- <?php echo $modeofpay2; ?> &nbsp;&nbsp;
					</td>
					
					<td style="width:195px;border:1px;text-align:center;font-size:10px;font-weight: bold;">TOTAL</td>
					<td style="width:149px;border:1px;text-align:center;font-size:10px;"><?php echo $gttl; ?></td>
					</tr>
			</table>

			<table  border="1" style="height: 50px;">
				<tr>
					<td style="line-height: 0px;width:331px;border:1px;text-align:left;font-size:12px;padding-bottom:5px;padding-top:10px;padding-left: 9px;border-top: none;">
						
						Rupees (In Words) <?php echo getIndianCurrency($gttl); ?>
						
						
					</td>
					<td style="line-height: 0px;width:351px;border:1px;text-align:center;font-size:12px;font-weight: bold;border-top: none;border-bottom: none;">
						For, Killol Hospital
						
					</td>
				</tr>
			</table>
			
				<table  border="1">
				<tr>
					<td style="line-height: 0px;width:331px;border:1px;text-align:left;font-size:12px;padding-bottom:5px;padding-top:10px;padding-left: 9px;border-top: none;height: 80px">
						
						
						
						
					</td>
					<td style="line-height: 0px;width:351px;border:1px;text-align:center;font-size:12px;font-weight: bold;border-top: none;">

						Autho. sign
						
					</td>
				</tr>
			</table>

		






		</body>

		</html>

		<?php 

		use Spipu\Html2Pdf\Html2Pdf;
		use Spipu\Html2Pdf\Exception\Html2PdfException;
		use Spipu\Html2Pdf\Exception\ExceptionFormatter;


		$content = ob_get_clean();
//for($i=1; $i>=4; $i++){
		try {
			$html2pdf = new Html2Pdf('P', 'A4', 'fr',10,10,10,10);
			$html2pdf->setDefaultFont('Arial');
			$html2pdf->writeHTML($content);
	//

			$html2pdf->output("Invoice.pdf");
	//
//header('location:lrentry.php');
		} catch (Html2PdfException $e) {
			$html2pdf->clean();

			$formatter = new ExceptionFormatter($e);
			echo $formatter->getHtmlMessage();
			exit;
		}
//}
		?>
