<?php
	if(isset($_POST['submit'])){
		require_once("./controllers/user.php");
		$handleuser = new usermodel();
		if($handleuser->addUser($_POST)){
			header("location: index.php?view=login");
		}else{
			header("location: index.php?view=register");
		}
	}
?>