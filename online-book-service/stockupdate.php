<?php include 'base.php'; ?>

<?php startblock('header') ?>
<title>Stock Update</title>
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

	$isbn = $_GET['isbn'];
	$stock_query = "SELECT stock_id,price FROM book where isbn = $isbn";
	$db = DB::connection();

	$res = pg_query($db->getRefference(),$stock_query);
	$row = pg_fetch_row($res);
	$stock_id = $row['0'];
	$price = $row['1'];

	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		$new_stock = $_POST['new_stock'];
		$new_ex = $new_stock*$price;

		$update_query = "UPDATE stock SET entry_copy = entry_copy+$new_stock WHERE id = $stock_id";
		pg_query($db->getRefference(),$update_query);

		$update_query = "UPDATE stock SET expenditure = expenditure+$new_ex WHERE id = $stock_id";
		pg_query($db->getRefference(),$update_query);
		
		pg_close($db->getRefference());
		header('Refresh: 0; URL = dashboard.php#book-table');

	}
 ?>

 <div class="d-flex justify-content-center mt-4">
	<div class="col-md-6 list-group-item">
		<h4 class="lead text-center mb-3">Update Stock</h4>
		<form method="POST">
			<label>Entry Copy</label>
			<input class="form-control" type="number" name="new_stock" required>
			<br>
			<button class="btn btn-success">Update</button>
		</form>
	</div>
</div>