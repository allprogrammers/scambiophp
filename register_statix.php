<?php

	require_once("./controllers/register_controller.php");

?>
    <!-- Custom styles for this template -->
    <link href="./template/signin.css" rel="stylesheet">
	<!-- Begin page content -->
    <div class="container">

      <form class="form-signin" action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
        <h2 class="form-signin-heading">Register</h2>
		<label for="inputName" class="sr-only">Name</label>
        <input type="text" id="inputName" name="name" class="form-control" placeholder=" Full Name" required autofocus>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder=" Email address" required>
		<label for="inputPhoneno" class="sr-only">Phone Number</label>
        <input type="text" id="inputPhoneno" name="phoneno" class="form-control" placeholder=" Phone No" required>
		<label for="selectGender" class="sr-only">Gender</label>
        <select id="SelectGender" name="gender" class="form-control">
			<option value="" disabled selected hidden>Gender</option>
			<option value="male">Male</option>
			<option value="female">Female</option>
			<option value="Other">Other</option>
		</select>
		<label for="dob" class="sr-only">Date of Birth</label>
		<input type="date" id="dob" name="dob" class="form-control" placeholder=" DOB (DD/MM/YYYY)">
		<label for="inputCity" class="sr-only">City</label>
		<input type="text" id="inputCity" name="city" class="form-control" placeholder=" City" required>
		<label for="inputCountry" class="sr-only">Country</label>
		<input type="text" id="inputCountry" name="country" class="form-control" placeholder=" Country" required>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder=" Password" required>
		<label for="inputConfirmPassword" class="sr-only">Password</label>
        <input type="password" id="inputConfirmPassword" name="confpassword" class="form-control" placeholder=" Confirm Password" required><br>
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->
