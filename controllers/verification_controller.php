<?php

	if(isset($_POST['submit'])){
		if($_POST['verikey']==$_SESSION['verikey']){
			require_once("./controllers/connection_controller.php");
			$dhandler = new datahandler();
			$userid=$_SESSION['userid'];
			$upquery = "UPDATE users SET veristatus=1 WHERE userid=$userid";
			$result=$dhandler->proque($upquery);
			if(!$result){
				$_SESSION["error"]="Connection problem";
				header("location: ./index.php?view=verify");
			}
			header("location: ./index.php");
		}else{
			$_SESSION['error']="Invalid verification key";
			header("location: ./index.php?view=verify");
		}
	}elseif(isset($_POST['resend'])){
		require_once("./controllers/PHPMailerAutoload.php");
		$verikey=$_SESSION['verikey'];
		$email = $_SESSION['email'];
		$name=$_SESSION['name'];
		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'email@gmail.com';                 // SMTP username
		$mail->Password = 'emailgmailpass';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom('aslambhaipk712@gmail.com', 'Aslam Bhai');
		$mail->addAddress($email, $name);     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		$mail->addReplyTo('aslambhaipk712@gmail.com', 'Aslam Bhai');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Verification Key';
		$mail->Body    = "Your verification key is $verikey";
		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
	}

?>