<?php include 'base.php'; ?>

<?php startblock('header') ?>
	<title>Dashboard : Nilkhet</title>
<?php endblock() ?>


<?php startblock('content') ?>
	<?php 
		$db = DB::connection();
		$res = pg_exec($db->getRefference(), "SELECT * FROM getBookStocks();");
		$arr = [];
		while ($data = pg_fetch_object($res)) {
			array_push($arr, $data);
		}

		$res = pg_exec($db->getRefference(), "SELECT * FROM getCategories();");
		$categoryList = [];
		while ($data = pg_fetch_object($res)) {
			array_push($categoryList, $data);
		}

		$res = pg_exec($db->getRefference(), "SELECT * FROM getAuthors();");
		$authorList = [];
		while ($data = pg_fetch_object($res)) {
			array_push($authorList, $data);
		}

		$res = pg_exec($db->getRefference(), "SELECT * FROM getPublishers();");
		$publisherList = [];
		while ($data = pg_fetch_object($res)) {
			array_push($publisherList, $data);
		}

		$res = pg_exec($db->getRefference(), "SELECT * FROM getCountries();");
		$countryList = [];
		while ($data = pg_fetch_object($res)) {
			array_push($countryList, $data);
		}

		$res = pg_exec($db->getRefference(), "SELECT * FROM getLanguages();");
		$languageList = [];
		while ($data = pg_fetch_object($res)) {
			array_push($languageList, $data);
		}


		pg_close($db->getRefference());
	?>

	<div class="container-fluid mt-3">
		<div class="row justify-content-center">
			<div class="col-md-3">
				<div class="list-group">
					<h6 class="list-group-item bg-success text-white">Categories</h6>
					<?php for($item=0; $item<count($categoryList); $item++): ?>
					<a href="category.php?name=<?php echo $categoryList[$item]->name ?>" class="list-group-item"><?php echo $categoryList[$item]->name; ?> 
						(<?php echo $categoryList[$item]->available; ?>)</a>
					<?php endfor; ?>
					<a href="addcategory.php" class="list-group-item list-group-item-primary">Add Category</a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="list-group">
					<h6 class="list-group-item bg-success text-white">Authors</h6>
					<?php for($item=0; $item<count($authorList); $item++): ?>
					<a href="author.php?name=<?php echo $authorList[$item]->name ?>" class="list-group-item"><?php echo $authorList[$item]->name; ?> 
						(<?php echo $authorList[$item]->available; ?>)</a>
					<?php endfor; ?>
					<a href="addauthor.php" class="list-group-item list-group-item-primary">Add Author</a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="list-group">
					<h6 class="list-group-item bg-success text-white">Publishers</h6>
					<?php for($item=0; $item<count($publisherList); $item++): ?>
					<a href="publisher.php?name=<?php echo $publisherList[$item]->name ?>" class="list-group-item"><?php echo $publisherList[$item]->name; ?> 
						(<?php echo $publisherList[$item]->available; ?>)</a>
					<?php endfor; ?>
					<a href="addpublisher.php" class="list-group-item list-group-item-primary">Add Publisher</a>
				</div>
			</div>
			<div class="col-md-3">
				<div class="list-group">
					<h6 class="list-group-item bg-success text-white">Languages</h6>
					<?php for($item=0; $item<count($languageList); $item++): ?>
					<a href="publisher.php?name=<?php echo $languageList[$item]->name ?>" class="list-group-item"><?php echo $languageList[$item]->name; ?> 
						(<?php echo $languageList[$item]->available; ?>)</a>
					<?php endfor; ?>
					<a href="addpublisher.php" class="list-group-item list-group-item-primary">Add Language</a>
				</div>
			</div>
		</div>
	</div>
	<br><br>

	<div class="d-flex justify-content-center mt-3">
		<div class="col-md-11">
			<p class="display-4 text-center">Book Stock Table</p>
			<div class = "d-flax justify-content-center text-center">
				<a class="btn btn-primary" href="addbook.php">Add new Book</a>
			</div>
			<table class="table table-bordered bg-dark text-white">
				<thead>
					<th>ISBN</th>
					<th>Book</th>
					<th>Edition</th>
					<th>Price</th>
					<th>Entry</th>
					<th>Sold</th>
					<th>Expenditure</th>
					<th>Update by</th>
				</thead>
				<tbody>
					<?php for($item=0; $item<count($arr); $item++): ?>
						<tr>
							<td><?php echo $arr[$item]->isbn; ?></td>
							<td><a href="updatebook.php?isbn=<?php echo  $arr[$item]->isbn ?>"><?php echo $arr[$item]->book; ?></a> </td>
							<td><?php echo $arr[$item]->edition; ?></td>
							<td><?php echo $arr[$item]->price; ?></td>
							<td><?php echo $arr[$item]->entry_copy; ?><a class="float-right " href="#">add</a></td>
							<td><?php echo $arr[$item]->sold_copy; ?> </td>
							<td><?php echo $arr[$item]->expenditure; ?></td>
							<td><?php echo $arr[$item]->staff_name; ?></td>
						</tr>
					<?php endfor; ?>
				</tbody>
			</table>
		</div>
	</div>
<?php endblock() ?>
