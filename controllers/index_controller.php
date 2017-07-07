<?php

	class LoggedLoader{
		function render($pagename,$page_title){
			$page_title = "$page_title - Scambio";
			require_once("./template/headersimple.php");
			if(isset($_SESSION['error'])){
				$error=$_SESSION['error'];
				echo "<div class='container'><h1>$error</h1></div>";
				unset($_SESSION['error']);
				//session_destroy();
			}else{
				require_once("$pagename"."_statix.php");
			}
			require_once("./template/footersimple.php");
			exit();
		}
		function viewad_page(){
			$this->render("viewad","Search Goods");
		}
		function createad_page(){
			$this->render("createad","Add Product");
		}
		function profile_page(){
			$this->render("profile","Profile");
		}
		function logout_method(){
			session_destroy();
			header("location: index.php?view=home");
		}
		function productdetails_page(){
			$this->render("productdetails","Product Details");
		}
		function notverified_page(){
			$this->render("verify","Verification");
		}
	}

	class SimpleLoader{
		function render($pagename,$page_title){
			$page_title = "$page_title - Scambio";
			require_once("./template/headersimple.php");
			if(isset($_SESSION['error'])){
				$error=$_SESSION['error'];
				echo "<div class='container'><h1>$error</h1></div>";
				session_destroy();
			}else{
				require_once("$pagename"."_statix.php");
			}
			require_once("./template/footersimple.php");
			exit();
		}
		function home_page(){
			require_once("./home2_statix.php");
			exit();
		}
		function login_page(){
			$this->render("login","Login");
		}
		function register_page(){
			$this->render("register","Register");
		}
		function viewad_page(){
			$this->render("viewad","Search goods");
		}
		function productdetails_page(){
			$this->render("productdetails","Product Details");
		}
		
	}

?>