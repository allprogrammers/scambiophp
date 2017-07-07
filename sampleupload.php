<?php
	if(isset($_POST['submit'])){
		print_r($_FILES);
	}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data">
			<input type="file" multiple name="toup[]">
			<input type="submit" name="submit">
		</form>
    </body>
</html>
