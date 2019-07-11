<?php require_once 'static/lib/php/template.php' ?>
<?php require_once 'db/database.php'; ?>
<?php require_once 'cart/item.php' ?>
<?php 

// start session
	session_start();
	if(!isset($_SESSION['user_cart'])){
		$_SESSION['user_cart'] = [];
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="static/lib/css/bootstrap.min.css">
	<script type="text/javascript" src="static/lib/js/jquery.min.js"></script>
	<script type="text/javascript" src="static/lib/js/popper.min.js"></script>
	<script type="text/javascript" src="static/lib/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		body, html {
			background-color: #DAF7A6;
		}
	</style>

	<?php startblock('header') ?>
	<?php endblock() ?>

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #DAF7A6;">
		<a class="navbar-brand" href="index.php">Nilkhet</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
				</li>

				 <?php if(isset($_SESSION['userid'])): ?>
				 	<?php if($_SESSION['is_stuff']): ?>
				 	<li class="nav-item">
						<a class="nav-link" href="dashboard.php">Dashboard</a>
					</li>
				 	<?php endif; ?>
				 	<li class="nav-item">
						<a class="nav-link" href="profile.php">Profile</a>
					</li>
				 	<li class="nav-item">
						<a class="nav-link" href="signout.php">Sign out</a>
					</li>
					
				 <?php else: ?>
				 	<li class="nav-item">
						<a class="nav-link" href="signin.php">Sign in</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="signup.php">Sign up</a>
					</li>
				
				 <?php endif; ?>
				 <li class ="nav-item">
					<a class = "nav-link" href="cart.php">Cart <i class="fa fa-cart-plus"></i></a>
				</li>

				
				
			</ul>
		</div>
		<form class="form-inline" action="./search.php">
			<input class="form-control mr-sm-2" style="width: 300px;" type="text" placeholder="Book,Category,Author,Publisher" name="query">
			<button class="btn btn-outline-success" type="submit">Search</button>
		</form>
	</nav>
	<div id='base_content'>
		<?php startblock('content') ?>
		<?php endblock() ?>
	</div>
</body>
</html>