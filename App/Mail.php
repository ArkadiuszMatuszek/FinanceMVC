<?php
/*##########Script Information#########
  # Purpose: Send mail Using PHPMailer#
  #          & Gmail SMTP Server 	  #
  # Created: 24-11-2019 			  #
  #	Author : Hafiz Haider			  #
  # Version: 1.0					  #
  # Website: www.BroExperts.com 	  #
  #####################################*/

namespace App;

	

//Include required PHPMailer files
	require 'PHPMailer.php';
	require 'SMTP.php';
	require 'Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	


class Mail{
	
	public static function send($to, $subject, $text, $html){
//Create instance of PHPMailer
	$mail = new PHPMailer();
//Set mailer to use smtp
	$mail->isSMTP();
//Define smtp host
	$mail->Host = "cl*.netmark.pl";
//Enable smtp authentication
	$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
	$mail->SMTPSecure = "tls";
//Port to connect smtp
	$mail->Port = "465";
//Set gmail username
	$mail->Username = "arkadi11@cl12.netmark.pl";
//Set gmail password
	$mail->Password = "onetpoczta1";
//Email subject
	//$mail->Subject = "Test email using PHPMailer";
	$mail->Subject = $subject;
	
//Set sender email
	$mail->setFrom('Sender Email who will send email');
//Enable HTML
	$mail->isHTML(true);
//Attachment
	$mail->addAttachment('img/attachment.png');
//Email body
	//$mail->Body = "<h1>This is HTML h1 Heading</h1></br><p>This is html paragraph</p>";
	$mail->Body = $html;
	$mail->AltBody = $text;
//Add recipient
	//$mail->addAddress('arkadiusz.matuszek.programista@gmail.com');
	$mail->addAddress($to);
//Finally send email
	if ( $mail->send() ) {
		echo "Email Sent..!";
	}else{
		echo "Message could not be sent. Mailer Error: "[$mail->ErrorInfo];
	}
//Closing smtp connection
	$mail->smtpClose();

	}
}