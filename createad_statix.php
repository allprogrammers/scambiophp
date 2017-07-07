<?php

	require_once("./controllers/createad_controller.php");

?>

	<script>
 	function addcat() {
 		var cat = document.getElementById("cattoadd").value;
		if(cat !=""){
			 var node = document.createElement("option");
 			var textnode = document.createTextNode(cat);
 			node.setAttribute("value", cat);
 			node.appendChild(textnode);
 			document.getElementById("cats").appendChild(node);
		}

 	}
	</script>

    <!-- Custom styles for this template -->
    <link href="./template/createad.css" rel="stylesheet">
	<!-- Begin page content -->
    <div class="container">
		<form class="form-signin" action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">
			<div class="row">
				<div class="col-md-6">
					<h2 class="form-signin-heading">Add Product</h2>
					<label for="inputIdentifier" class="sr-only">Identifier</label>
					<input type="text" id="inputIdentifier" name="identifier" class="form-control" placeholder="Identifier" required autofocus>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<textarea class="form-control" name='description' style="height: 150px;resize: none" placeholder="Description"></textarea>
					<label for="inputPic" class="sr-only">Picture</label>
					<input type="file" id="inputPic" name="pic[]" class="form-control" multiple required>
				</div>
				<div class="col-md-6">
					<select name="cats[]" id="cats" class="form-control" style="height: 150px;" multiple>
					  <?php enlistcategories();?>
					</select>

					<div class="row" style="margin-bottom: 12px;margin-top: 10px">
						<div class="col-md-9">
							<input type="text" id="cattoadd" name="cattoadd" style="margin:0px" placeholder="New category?" class="form-control">
						</div>
						<div class="col-md-3">
							<button class="btn btn-lg btn-primary btn-block" type="button"style="margin-top: 2.5px;" onClick="addcat()">Add</button>
						</div>
					</div>
					<button class="btn btn-lg btn-primary btn-block" name="submit" type="submit" style="margin-top:10px">Upload</button>
				</div>
			</div>
		</form>
    </div> <!-- /container -->