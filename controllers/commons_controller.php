<?php

	function getCats(){
		require_once("./controllers/connection_controller.php");
		$dhandler = new datahandler();
		$getcats = "SELECT catid,name FROM categories";
		$result=$dhandler->proque($getcats);
		if(!$result){
			$_SESSION['error']="Connection problem";
			header("location: index.php?view=createad");
		}
		$list=array();
		for($i=0;$i<$result->num_rows;$i++){
			$result->data_seek($i);
			$row = $result->fetch_assoc();
			$item = $row['name'];
			$catid = $row['catid'];
			$list[$catid]=$item;
		}
		return $list;
	}
	
	function checkboxPrinter(){
		$cats=getCats();
		foreach($cats as $key=>$value){
			echo "<div class='checkbox'><label><input type='checkbox' name='categories[]' value='$key";
			$value = ucwords($value);
			echo "'> $value</label></div>";
		}
	}
	function productsPrinter(){
		if(isset($_POST['submit'])){
			
		}else{
			require_once("./controllers/connection_controller.php");
			$dhandler = new datahandler();
			$getcats = "SELECT product.productid, product.by, product.name, product.hash, product.description FROM product INNER JOIN users ON users.userid = product.by";
			$result=$dhandler->proque($getcats);
			if(!$result){
				$_SESSION['error']="Connection problem";
				header("location: index.php?view=myads");
			}
			$characters ='abcdefghijklmnopqrstuvwxyz';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < 10; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			$key = "$randomString";
			$_SESSION['enckey']=$key;
			for($i=0;$i<$result->num_rows;$i++){
				$result->data_seek($i);
				$row=$result->fetch_assoc();
				//print_r($row);
				extract($row);
				$text = "$hash 0.jpg";
				require_once("./controllers/rsa_controller.php");
				$enc = urlencode(enc($text, $key));
				echo "<div class='col-lg-4'><img class='img-circle' src='./template/imageviewer.php?image=$enc' alt='Product image' width='140' height='140'><h2>$name</h2><p>$description</p><p><a class='btn btn-default' href='index.php?view=productdetails&productid=$productid' role='button'>View details &raquo;</a></p></div>";
			}
			//print_r($_SESSION);
		}
	}
?>