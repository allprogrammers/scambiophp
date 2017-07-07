<?php

	class producthandler{
		private function validateDetails($data,$files,$con){
			echo "<h1>Called</h1>";
			$working = array("identifier","description");
			foreach($working as $value){
				if(isset($data[$value])){
					$cleandata[$value]=$con->getcon()->real_escape_string(htmlspecialchars($data[$value]));
				}else{
					$_SESSION['error']="Required field missing";
					return 0;
				}
			}
			echo "<h1>Called and worked</h1>";
			$cleandata["cats"]=array();
			foreach($data['cats'] as $value){
				$cleandata["cats"][]=$con->getcon()->real_escape_string(htmlspecialchars($value));
			}
			foreach($files["pic"]["error"] as $value){
				if($value){
					$_SESSION['error']="There was a problem upload the files";
					return 0;
				}
			}
			if(count($files["pic"]["name"])<3){
				$_SESSION['error']="At least three picture";
				return 0;
			}
			echo "<h1>Called and worked</h1>";
			return $cleandata;
		}

		private function generateRandomString($length = 10) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return md5($randomString);
		}

		private function uploadpictures($data,$files){
			$n = count($files['pic']['name']);
			$name = $this->generateRandomString();
			$a = $_SESSION['userid'];
			$b = $_SESSION['name'];
			$c = $data['identifier'];
			$fname="$a $name $b $c";
			$_SESSION['filehash']=$fname;
			
			for ($i=0;$i<$n;$i++){
				$target_dir = "./model/H9WWz37fqXJf0QlbCIK0/";
				$filename = "$a $name $b $c $i".".jpg";
				$target_file = $target_dir . basename($files["pic"]["name"][$i]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$target_file = $target_dir . basename($filename);
				// Check if image file is a actual image or fake image
				$check = getimagesize($files["pic"]["tmp_name"][$i]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$_SESSION['error']="Not all files are images";
					return 0;
				}
				// Check if file already exists
				if (file_exists($target_file)) {
					$_SESSION['error']="Try again";
					return 0;
				}
				// Check file size
				if ($files["pic"]["size"][$i] > 5*1048576) {
					$_SESSION['error']="File too large";
					return 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
					$_SESSION['error']="File extension not valid";
					return 0;
				}

				if (!move_uploaded_file($files["pic"]["tmp_name"][$i], $target_file)) {
					$_SESSION['error']= "Sorry, there was an error uploading your file.";
					return 0;
				}
			}
			return 1;
		}

		private function addCat($cat){
			require_once("./controllers/connection_controller.php");
			$dhandler = new datahandler();
			$addcats = "INSERT INTO categories VALUE(NULL,'$cat')";
			$result=$dhandler->proque($addcats);
			if(!$result){
				$_SESSION['error']="Connection problemcat";
				return 0;
			}
			$dhandler->conclose();
			return 1;
		}

		private function addProdDetails($data){
			require_once("./controllers/connection_controller.php");
			$dhandler = new datahandler();
			$ident = $data['identifier'];
			$description = $data['description'];
			$loggeduser = $_SESSION['userid'];
			$hash = $_SESSION['filehash'];
			$addcats = "INSERT INTO product VALUE(NULL,'$loggeduser','$ident','$hash','$description')";
			$result=$dhandler->proque($addcats);
			if(!$result){
				$_SESSION['error']="Connection problemprod $addcats";
				return 0;
			}
			return 1;
		}

		private function updateProdCat($data,$existingcats){
			require_once("./controllers/connection_controller.php");
			$dhandler = new datahandler();
			$productidfound = $_SESSION['insertid'];
			foreach($data['cats'] as $value){
				$catidfound = array_search($value,$existingcats);
				if($catidfound){
					$sothequery="INSERT INTO prodcat VALUE(NULL,'$catidfound','$productidfound')";
					$result=$dhandler->proque($sothequery);
					if(!$result){
						$_SESSION['error']="Connection problemprodcat $sothequery";
						return 0;
					}
				}else{
					$_SESSION['error']="Phishy";
					return 0;
				}
			}
			$dhandler->conclose();
			return 1;
		}

		function addProduct($data,$files){
			//print_r($data);
			require_once("./controllers/connection_controller.php");
			$test = new datahandler();
			$data=$this->validateDetails($data,$files,$test);
			$test->conclose();
			if(!$data){
				return 0;
			}
			//upload pictures
			if(!$this->uploadpictures($data,$files)){
				//$_SESSION['error']="There was a problem uploading the pictures";
				return 0;
			}
			// check if new category add new category
			require_once("./controllers/commons_controller.php");
			$existingcats = getCats();
			foreach($data["cats"] as $value){
				$check = in_array($value,$existingcats);
				if(!$check){
					echo "added one";
					if(!$this->addCat($value)){
						$_SESSION['error']="Connection problem";
						return 0;
					}
					
				}
			}
			// add item to db
			if(!$this->addProdDetails($data)){
				return 0;
			}
			//echo "<h1>works</h1>";
			$existingcats = getCats();
			//update prodcat db
			if(!$this->updateProdCat($data,$existingcats)){
				return 0;
			}
			return 1;
		}

	}

?>