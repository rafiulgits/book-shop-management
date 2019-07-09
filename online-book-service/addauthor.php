<?php include 'base.php'; ?>

<?php startblock('header') ?>
	<title>Add Author</title>
<?php endblock() ?>


<?php 	
	$failed = false;
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$author_name = $_POST['author_name'];
		$author_bio = $_POST['author_bio'];
		$db = DB::connection();
		/*
			addAuthor(name varchar(30),bio varchar(50))

		*/
		$res = pg_query($db->getRefference(), "CALL addAuthor('$author_name'::varchar, '$author_bio'::varchar);");
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
		<h4 class="lead text-center mb-3">Add New Author</h4>
		<form method="POST">
			<?php if($failed == true): ?>
				<p class="alert alert-danger">insertion failed</p>
			<?php endif; ?>
			<label>Author Name</label>
			<input class="form-control" type="text" name="author_name" required>
			<label>Author Bio</label>
			<textarea class="form-control" name="author_bio" required></textarea>
			<br>
			<button class="btn btn-success">Insert</button>
		</form>
	</div>
</div>