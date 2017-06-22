<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
	<a href="/e-commerce/admin/" class="navbar-brand">Admin Panel</a>
		<ul class="nav navbar-nav">
		<!-- MENU ITEMS -->
			<li><a href="index.php">My Dashboard</a></li>
			<li><a href="brands.php">Brands</a></li>
			<li><a href="categories.php">Categories</a></li>
			<li><a href="products.php">Products</a></li>
			<li><a href="archived.php">Archived</a></li>
			<?php if(has_permission('admin')): ?>
				<li><a href="users.php">Users</a></li>
			<?php endif; ?>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?=$userData['first'];?>!<span class="caret"></!span></a>
				<ul class="dropdown-menu" role="menu">
					<li><a href="change_password.php">Change Password</a></li>
					<li><a href="logout.php">Log Out</a></li>
				</ul>
			</li>
			<li><a href="../index.php">Back to Site</a></li>
		</ul>
	</div>
</nav>