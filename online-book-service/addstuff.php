<?php include 'base.php'; ?>
<?php startblock('header') ?>
	<title>Add Stuff User</title>
<?php endblock() ?>


<?php 
	
	// access checking
	if(isset($_SESSION['userid'])){
		if($_SESSION['is_stuff'] == 't'){
			if($_SESSION['is_admin'] == 'f'){
				header('Location: error.php');
			}
		}
		else{
			header('Location: error.php');
		}
	}
	else{
		header('Location: error.php');
	}

	$failed = false;

	/*	
	createAccount arguments:
	-------------------------
		name varchar(80),
		_phone varchar(11),
		_email varchar(45),
		gender varchar(1),
		is_stuff bool,
		is_admin bool,
		address varchar(30),
		password varchar(32)
	*/
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$gender = $_POST['gender'];
		$address = $_POST['address'];
		$password = $_POST['password'];
		$hashed_password = md5($password);

		$db = DB::connection();
		pg_query($db->getRefference(), 
					"CALL createAccount(
							'$name'::varchar,
							'$phone'::varchar,
							'$email'::varchar,
							'$gender'::varchar,
							true::bool,
							false::bool,
							'$address'::varchar,
							'$hashed_password'::varchar
						);");


		$res = pg_query($db->getRefference(), "SELECT id, is_admin, is_stuff
												FROM account WHERE
												phone ='$phone' AND 
												password ='$hashed_password' AND
												email ILIKE '$email';");
		$user = pg_fetch_object($res);
		pg_close($db->getRefference());
		
		if($user){
			$_SESSION['valid'] = true;
	 		$_SESSION['timeout'] = time();
	 		$_SESSION['userid'] = $user->id;
	 		$_SESSION['is_stuff'] = $user->is_stuff;
	 		$_SESSION['is_admin'] = $user->is_admin;
	 		header('Location: dashboard.php');
		}
		else{
			$failed = true;
		}
	}
 ?>

<div class="d-flex justify-content-center mt-4">
	<div class="col-md-5 list-group-item">
		<h4 class="lead text-center">New Stuff Form</h4>
		<form method="POST">
			<?php if($failed == true): ?>
				<p class="alert alert-danger">creation failed</p>
			<?php endif; ?>
			<label>Name</label>
			<input type="text" class="form-control mb-2" name="name" required>
			<label>Phone</label>
			<input type="text" class="form-control mb-2" name="phone" required>
			<label>Email</label>
			<input type="email" class="form-control mb-2" name="email" required>
			<div class="form-group mb-2">
				<label for="Language">Gender</label>
				<select class="form-control" name="gender" required>
					<option value="F">Female</option>
					<option value="M">Male</option>
					<option value="O">Other</option>
				</select>
			</div>
			<label>Address</label>
			<textarea class="form-control mb-2" name="address" required></textarea>
			<label>Password</label>
			<input type="password" class="form-control" name="password">
			<br>
			<button class="btn btn-success">Add</button>
		</form>
	</div>
</div>
<br>