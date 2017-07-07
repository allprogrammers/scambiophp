    <!-- Custom styles for this template -->
    <link href="./template/viewad.css" rel="stylesheet">
    <!-- Begin page content -->
    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">
		<hr>
		<div class="col-md-4">
			<div class="row">
				<form class="form-signin" action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post">
					<div class="col-md-8">
						<input type="text" id="inputKeyword" name="keyword" class="form-control" placeholder="Keyword" required autofocus><br>
						<?php

							require_once("./controllers/commons_controller.php");
							checkboxPrinter();
						?>
					</div>
					<div class="col-md-4">
						<button class="btn btn-lg btn-primary btn-block" style="line-height:0.5" name="submit" type="submit">Search</button>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-8">
			<!-- Three columns of text below the carousel -->
					<?php

						productsPrinter();

					?>
		</div>

	</div><!-- /.container -->