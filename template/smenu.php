            <li id="profile"><a href="index.php?view=dashboard">Dashboard</a></li>
			<li id="createad"><a href="index.php?view=createad">Add Product</a></li>
            <li id="viewad"><a href="index.php?view=viewad">Explore</a></li>
			<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo ucwords($_SESSION['name'])?> <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="index.php?view=messages">Messages</a></li>
				<li role="separator" class="divider"></li>
				<li><a href="index.php?view=logout">Logout</a></li>
			</ul>
			</li>