<?php include 'base.php'; ?>

<?php startblock('header') ?>
	<title>Add Language</title>
<?php endblock() ?>

<?php
	// access checking
	if(isset($_SESSION['is_stuff'])){
		if($_SESSION['is_stuff'] != 't'){
			header('Location: error.php');
		}
	}
	else{
		header('Location: error.php');
	}
	
	$failed = false;
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$language_name = $_POST['language_name'];
		$db = DB::connection();
		/*
				addLanguage(_name varchar(10))
		*/
		$res = pg_query($db->getRefference(),"CALL addLanguage('$language_name'::varchar);");
		pg_close($db->getRefference());
		if($res){
			header('Refresh: 0; URL = dashboard.php');
		}
		else{
			$failed = true;
		}
	}
	
 ?>

<div class="d-flex justify-content-center mt-4">
	<div class="col-md-6 list-group-item">
		<h4 class="lead text-center mb-3">Add New Language</h4>
		<form method="POST">
			<?php if($failed == true): ?>
				<p class="alert alert-danger">insertion failed</p>
			<?php endif; ?>
			<label>Language Name</label>
			<input class="form-control" type="text" name="language_name" required>
			<br>
			<button class="btn btn-success">Insert</button>
		</form>
	</div>
</div>