<?php
	session_start();
	if(isset($_GET['image']) && isset($_SESSION['enckey'])){
		require_once("../controllers/rsa_controller.php");
		$key = $_SESSION['enckey'];
		$image=$_GET['image'];
		$dec=rawurldecode(dec($image,$key));
		//echo "../model/H9WWz37fqXJf0QlbCIK0/".$dec;
		// Create a blank image and add some text
		$im = imagecreatefromjpeg("../model/H9WWz37fqXJf0QlbCIK0/".$dec);
		//$text_color = imagecolorallocate($im, 233, 14, 91);
		//imagestring($im, 1, 5, 5,  'A Simple Text String', $text_color);

		// Set the content type header - in this case image/jpeg
		header('Content-Type: image/jpeg');

		// Output the image
		imagejpeg($im);

		// Free up memory
		imagedestroy($im);
	}

?>