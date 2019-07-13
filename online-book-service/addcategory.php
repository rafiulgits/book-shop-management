<?php include 'base.php'; ?>

<?php startblock('header') ?>
	<title>Add Category</title>
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
		$category_name = $_POST['category_name'];
		$db = DB::connection();
		/*
				addCategory(_name varchar(15))
		*/
		$res = pg_query($db->getRefference(),"CALL addCategory('$category_name'::varchar);");
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
		<h4 class="lead text-center mb-3">Add New Category</h4>
		<form method="POST">
			<?php if($failed == true): ?>
				<p class="alert alert-danger">insertion failed</p>
			<?php endif; ?>
			<label>Category Name</label>
			<input class="form-control" type="text" name="category_name" required>
			<br>
			<button class="btn btn-success">Insert</button>
		</form>
	</div>
</div>
