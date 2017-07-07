<?php
	if(isset($_POST['submit'])){
		require_once("./controllers/user.php");
		$handleuser = new usermodel();
		if($handleuser->verifyUser($_POST)){
			header("location: index.php?view=profile");
		}else{
			header("location: index.php?view=login");
		}
	}
?>