<?php

require 'PHPMailerAutoload.php';

      //$mail = new PHPMailer(true);    

   $mail = new PHPMailer;

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
$mail->Port = 465;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'info@mksoftservice.com';                // SMTP username
$mail->Password = 'Vrushti#25316';                  // SMTP password
$mail->SMTPSecure = 'ssl'; 
//$mail->Port = 465;
//$mail->SMTPSecure = 'ssl';                           // Enable encryption, 'ssl' also accepted
if(isset($_POST['submit'])){
//$mail->From = 'from@example.com';
$mail->From =$_POST['email'];
// = 'deepak';
$name = $_POST['name'];
$mail->FromName = $_POST['name'];
$msg=$_POST['msg'];

$mail->AddAddress('kuldeep@mksoftservice.com', $name);  // Add a recipient
//$to='info@mksoftservice.com';

$mail->IsHTML(true);                                  // Set email format to HTML

/*$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <strong>in bold!</strong>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';*/
    $mail->Subject = 'Here is the subject';
    $mail->Body= "Name :".$name."\n"."Wrote the following :"."\n\n".$msg;

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';

	
		
		//
		//$phone=$_POST['phone'];
		/*$msg=$_POST['msg'];

		//$to='info@mksoftservice.com'; // Receiver Email ID, Replace with your email ID
		$subject='Form Submission';
		$message="Name :".$name."\n"."Wrote the following :"."\n\n".$msg;
		$headers="From: ".$email;

		if(mail($to, $subject, $message, $headers)){
			echo "<h1>Sent Successfully! Thank you"." ".$name.", We will contact you shortly!</h1>";
		}
		else{
			echo "Something went wrong!";
		}*/
	}






   
