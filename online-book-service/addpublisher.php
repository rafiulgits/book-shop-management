<?php include 'base.php'; ?>

<?php startblock('header') ?>
	<title>Add Publisher</title>
<?php endblock() ?>

<?php 


	$db = DB::connection();
	$failed = false;	

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$publisher_name = $_POST['publisher_name'];
		$country_id = $_POST['country_id'];
		$db = DB::connection();
		/*
				addPublisher(name varchar(30),country_id int)
		*/
		$check = pg_query($db->getRefference(), "CALL addPublisher('$publisher_name'::varchar, $country_id::int);");
		if($check){
			header('Refresh: 0; URL = dashboard.php');
		}
		else{
			$failed = true;
		}

	}

	$res = pg_exec($db->getRefference(), "SELECT * FROM getcountries();");
	$countryList = [];
	while ($data = pg_fetch_object($res)) {
		array_push($countryList, $data);
	}
	pg_close($db->getRefference());

 ?>



<div class="d-flex justify-content-center">
	<div class="col-md-6 list-group-item mt-5">
		<h4 class="lead text-center mb-3">Add Publisher</h4>
		<form method="POST">
			<?php if($failed == true): ?>
				<p class="alert alert-danger">insertion failed</p>
			<?php endif; ?>
			<label>Publisher Name</label>
			<input class="form-control" type="text" name="publisher_name" required>
			<div class="form-group">
				<label>Country</label>
				<select class="form-control" name ="country_id" required>
				<?php for($i=0; $i<count($countryList); $i++): ?>
					<option value="<?php echo $countryList[$i]->id ?>"><?php echo $countryList[$i]->name; ?></option>
				<?php endfor; ?>
				</select>
			</div>
			<button class="btn btn-success">Insert</button>
		</form>
	</div>
</div>

