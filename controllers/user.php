<?php

	class usermodel{
		private function generateRandomString($length = 10) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return md5($randomString);
		}   
		private function validateDetails($data,$type,$con){
			$cleandata['fumy']="";
			if($type){
				$datas = array("name","dob","email","confpassword","password","city","country","phoneno","gender");
				foreach($datas as $key){
					if(isset($data[$key])){
						$cleandata[$key]=htmlspecialchars($data[$key]);
					}else{
						$_SESSION['error']="Required field missing";
						return 0;
					}
				}
				if($cleandata['password']!=$cleandata['confpassword']){
					$_SESSION['error']="Passwords do not match";
					return 0;
				}
				list($dd,$mm,$yyyy) = explode('/',$data['dob']);
				if (!checkdate($mm,$dd,$yyyy)) {
					$_SESSION['error']="Date formate invalid";
					return 0;
				}
				if(!filter_var($cleandata['email'], FILTER_VALIDATE_EMAIL)) {
					 $_SESSION['error']="Email format invalid";
					 return 0;
				}
				return $cleandata;
			}else{
				$datas = ["email","password"];
				foreach($datas as $key){
					if(isset($data[$key])){
						$cleandata[$key]=htmlspecialchars($data[$key]);
					}else{
						$_SESSION['error']="Required field missing";
						return 0;
					}
				}
				return $cleandata;
			}
		}
		function is_logged_in(){
			if(isset($_SESSION['userid'])){
				return 1;
			}
			return 0;
		}
		function is_verified(){
			require_once("./controllers/connection_controller.php");
			$dhandler = new datahandler();
			if(!$dhandler){
				$_SESSION['error']="Connection Problem";
				return 0;
			}
			$userid = $_SESSION["userid"];
			$veriquery = "SELECT email,verikey,veristatus FROM users WHERE userid=$userid";
			$result= $dhandler->proque($veriquery);
			if(!$result){
				$_SESSION['error']="Connection Problem";
				return 0;
			}
			$result->data_seek(0);
			$row=$result->fetch_assoc();
			if($row['veristatus']){
				return 1;
			}else{
				$_SESSION['email']=$row['email'];
				$_SESSION['verikey']=$row['verikey'];
				return 0;
			}
		}
		function addUser($data){
			require_once("./controllers/connection_controller.php");
			
			$dhandler = new datahandler();
			if(!$dhandler){
				$_SESSION['error']="Connection Problem";
				return 0;
			}
			$data = $this->validateDetails($data,1);
			if(!$data){
				return 0;
			}
			extract($data);
			
			//check for user existing with given email OR phoneno
			$existsquery = "SELECT userid FROM users WHERE email='$email' OR phoneno = '$phoneno'";
			$result=$dhandler->proque($existsquery);
			if($result){
				if($result->num_rows){
					$_SESSION['error']="User already exists";
					return 0;
				}
			}else{
				$_SESSION['error']="Connection Problem";
				return 0;
			}
			//add user
			$verikey = $this->generateRandomString();
			$password=md5($password);
			$addquery = "INSERT INTO users VALUE(NULL,";
			$addquery.="'$name',";
			$addquery.="'$email',";
			$addquery.="'$gender',";
			$addquery.="'$dob',";
			$addquery.="'$password',";
			$addquery.="'$phoneno',";
			$addquery.="'$city',";
			$addquery.="'$country',";
			$addquery.="'$verikey',";
			$addquery.="'0')";
			$result=$dhandler->proque($addquery);
			if(!$result){
				$_SESSION['error']="Connection Problem";
				return 0;
			}
			return 1;
		}


		function verifyUser($data){
			$data = $this->validateDetails($data,0);
			if(!$data){
				return 0;
			}
			require_once("./controllers/connection_controller.php");
			extract($data);
			$dhandler = new datahandler();
			if(!$dhandler){
				$_SESSION['error']="Connection Problem";
				return 0;
			}
			$password=md5($password);
			$credquery = "SELECT userid,name FROM users WHERE email='$email' AND hashpass='$password'";
			$result=$dhandler->proque($credquery);
			if($result){
				if($result->num_rows!=1){
					$_SESSION['error']=$credquery."Invalid credentials".$result->num_rows;
					return 0;
				}
			}else{
				$_SESSION['error']="Connection problem";
				return 0;
			}
			$result->data_seek(0);
			$row = $result->fetch_assoc();
			$_SESSION["userid"]=$row['userid'];
			$_SESSION["name"]=$row['name'];
			return 1;
		}
	}

?>