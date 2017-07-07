<?php

	require_once("./controllers/login_controller.php");

?>
    <!-- Custom styles for this template -->
    <link href="./template/signin.css" rel="stylesheet">
	<!-- Begin page content -->
    <div class="container">

      <form class="form-signin" action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
        <h2 class="form-signin-heading">Login</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->
