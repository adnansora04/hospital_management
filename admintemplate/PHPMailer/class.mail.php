<?php
/*
UserCake Version: 2.0.2
http://usercake.com
*/

class userCakeMail {
	//UserCake uses a text based system with hooks to replace various strs in txt email templates
	public $contents = NULL;
	
	//Function used for replacing hooks in our templates
	public function newTemplateMsg($template,$additionalHooks)
	{
		global $mail_templates_dir,$debug_mode;
		
		$this->contents = file_get_contents($mail_templates_dir.$template);
		
		//Check to see we can access the file / it has some contents
		if(!$this->contents || empty($this->contents))
		{
			return false;
		}
		else
		{
			//Replace default hooks
			$this->contents = replaceDefaultHook($this->contents);
			
			//Replace defined / custom hooks
			$this->contents = str_replace($additionalHooks["searchStrs"],$additionalHooks["subjectStrs"],$this->contents);
			
			return true;
		}
	}
	
	public function sendMail($email,$subject,$msg = NULL)
	{
		global $websiteName,$emailAddress;
		
		$header = "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/plain; charset=iso-8859-1\r\n";
		$header .= "From: ". $websiteName . " <" . $emailAddress . ">\r\n";
		
		//Check to see if we sending a template email.
		if($msg == NULL)
			$msg = $this->contents; 
		
		$message = $msg;
		
		$message = wordwrap($message, 70);
		
		return pmail($email,$subject,$message,$header);
	}
}
function pmail($email, $subject, $message, $header){
	$mail = new PHPMailer;

	$mail->isSMTP();               // Set mailer to use SMTP
	$mail->Host = 'mail.adong.in'; //'smtp.gmail.com';
	// Specify main and backup SMTP servers
	$mail->SMTPAuth = true;            // Enable SMTP authentication
	$mail->Username = 'no-reply@adong.in';          // SMTP username
	$mail->Password = 'no-replyVikas'; // SMTP password
	$mail->SMTPSecure = 'tls';         // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                 // TCP port to connect to

	$mail->setFrom('no-reply@adong.in', 'Adong.in');
	$mail->addReplyTo('info@adong.in', 'Adong.in');
	$mail->addAddress($email);

	$mail->isHTML(true);  // Set email format to HTML

	$bodyContent = '<h1>How to Send Email using PHP in Localhost by CodexWorld</h1>';
	$bodyContent .= '<p>This is the HTML email sent from localhost using PHP script by <b>CodexWorld</b></p>';

	$mail->Subject = $subject;
	$mail->Body    = $message;

	if(!$mail->send()) {
		return false;
	} else {
		return true;
	}
}
?>