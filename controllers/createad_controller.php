<?php
	
	function enlistcategories(){
		require_once("./controllers/commons_controller.php");
		$catslist = getCats();
		foreach($catslist as $value){
			echo "<option value='$value'>".ucwords($value)."</option>";
		}
	}

	if(isset($_POST['submit'])){
		require_once("./controllers/products.php");
		$phandler = new producthandler();
		if($phandler->addProduct($_POST,$_FILES)){
			header("location: index.php?view=viewad");
		}else{
			header("location: index.php?view=createad");
		}
	}
?>