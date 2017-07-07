<?php
	$view="";
	session_start();
	require_once("./controllers/user.php");
	$handleuser = new usermodel();
	if(isset($_GET['view'])){
		$view = $_GET['view'];
	}
	require_once("./controllers/index_controller.php");
	if($handleuser->is_logged_in()){
		$director = new LoggedLoader();
		$_SESSION['onemorecheck']=1;
		if($handleuser->is_verified()){
			switch($view){
				case "logout":
					$director->logout_method();
					break;
				case "createad":
					$director->createad_page();
					break;
				case "viewad":
					$director->viewad_page();
					break;
				case "dashboard":
					$director->dashboard_page();
					break;
				case "productdetails":
					$director->productdetails_page();
					break;
				default:
					header("location: index.php?view=createad");
			}
		}else{
			switch($view){
				case "logout":
					$director->logout_method();
					break;
				case "verify":
					$director->notverified_page();
					break;
				default:
					header('location: ./index.php?view=verify');
			}
		}
	}else{
		$director = new SimpleLoader();
		switch($view){
			case "register":
				$director->register_page();
				break;
			case "login":
				$director->login_page();
				break;
			case "viewad":
				$director->viewad_page();
				break;
			case "home":
				$director->home_page();
				break;
			case "productdetails":
				$director->productdetails_page();
				break;
			default:
				header("location: index.php?view=home");
				break;
		}
	}
?>