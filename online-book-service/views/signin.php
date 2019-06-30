<?php include 'base.php' ?>

<?php startblock('header') ?>
	<title>sign in - Nilkhet</title>
<?php endblock() ?>

<?php startblock('content') ?>
	

	<?php 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
  		$email = $_POST["email"];
	  	echo $email;
	}
	?>

	
	<div class="d-flex justify-content-center">
		<div class="col-md-5 mt-5 list-group-item">
			<form method="POST">
				<label>Email</label>
				<input class="form-control" type="email" name="email" required>
				<label>Password</label>
				<input class="form-control" type="password" name="password" required>
				<button class="btn btn-success mt-2">Sign in</button>
			</form>
		</div>
	</div>
<?php endblock() ?>