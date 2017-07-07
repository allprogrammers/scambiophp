<?php

	require_once("./controllers/verification_controller.php");

?>
    <!-- Custom styles for this template -->
    <link href="./template/signin.css" rel="stylesheet">

    <!-- Begin page content -->
    <div class="container">
		<form class="form-signin" action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
			<div class="row" style="margin-top: 10px">
				<h2 class="form-signin-heading">Verification</h2>
				<label for="inputVerikey" class="sr-only">Verification Key</label>
				<input type="text" id="inputVerikey" name="verikey" class="form-control" placeholder="Verification Key" autofocus>
			</div>
			<div class="row" style="margin-top: 10px">
				<div class="col-md-6" style="padding: 0px">
					<button class="btn btn-lg btn-primary btn-block" name="resend" type="submit">Resend</button>
				</div>
				<div class="col-md-6" style="padding: 0px">
					<button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Submit</button>
				</div>
			</div>
		</form>
    </div>