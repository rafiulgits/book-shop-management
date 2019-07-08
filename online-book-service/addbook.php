<?php include 'base.php'; ?>


<?php startblock('header'); ?>
	<title>Add Book</title>
<?php endblock(); ?>


<?php 

	$db = DB::connection();
	$res = pg_exec($db->getRefference(), "SELECT * FROM getAllBooks();");
	$failed = false;

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$book_name = $_POST['book_name'];
		$book_isbn = $_POST['book_isbn'];
		$book_edition = $_POST['book_edition'];
		$book_price = $_POST['book_price'];
		$category_id = $_POST['category_id'];
		$author_id = $_POST['author_id'];
		$publisher_id = $_POST['publisher_id'];
		$language_id = $_POST['language_id'];
		$entry_copy = $_POST['entry_copy'];
		$submitted_by = $_POST['submitted_by'];

		/*
		Add new book arguments:

			name varchar(50),
			_isbn bigint,
			edition smallint,
			category_id int,
			author_id int,
			publisher_id int,
			language_id int,
			price numeric(7,2),
			entry_copy int,
			entry_by int
		*/

		$res = pg_exec($db->getRefference(), "CALL addBook(
			'$book_name'::varchar,
			$book_isbn::bigint,
			$book_edition::smallint,
			$category_id,
			$author_id,
			$publisher_id,
			$language_id,
			$book_price::numeric,
			$entry_copy,
			$submitted_by
		);");
		if($res){
			header('Refresh: 0; URL = dashboard.php');
		}
		else{
			$failed = true;
		}
	}



	$res = pg_exec($db->getRefference(), "SELECT * FROM getCategories() LIMIT 10;");
	$categoryList = [];
	while ($data = pg_fetch_object($res)) {
		array_push($categoryList, $data);
	}

	$res = pg_exec($db->getRefference(), "SELECT * FROM getAuthors() LIMIT 10;");
	$authorList = [];
	while ($data = pg_fetch_object($res)) {
		array_push($authorList, $data);
	}

	$res = pg_exec($db->getRefference(), "SELECT * FROM getPublishers() LIMIT 10;");
	$publisherList = [];
	while ($data = pg_fetch_object($res)) {
		array_push($publisherList, $data);
	}
	$res = pg_exec($db->getRefference(), "SELECT * FROM getLanguages();");
	$languageList = [];
	while ($data = pg_fetch_object($res)) {
		array_push($languageList, $data);
	}

	pg_close($db->getRefference());

 ?>
		


<div class="d-flex justify-content-center">
	<div class="col-md-8">
		<div class="list-group-item mt-4">
			<p class="lead text-center mb-4">Add New Book</p>
			<form method="POST">
				<?php if($failed == true): ?>
					<p class="alert alert-danger">insertion failed</p>
				<?php endif; ?>
				<div class="form-group">
					<label for="book_name">Book Name:</label>
					<input type="text" name="book_name" class="form-control" id ="book_name" placeholder="Name" required>
				</div>
				<div class="form-group">
					<label for="book_isbn">Book ISBN:</label>
					<input type="number" name="book_isbn" class="form-control" id ="book_isbn" placeholder="ISBN" required>
				</div>

				<div class="form-group">
					<label for="book_edition">Book Edition:</label>
					<input type="number" name="book_edition" class="form-control" id="book_edition" placeholder="Enter book edition" required>
				</div>

				<div class="form-group">
					<label for="catagory">Catagory:</label>
					<select class="form-control" id="catagory" name="category_id" required>
					<?php for($i=0; $i<count($categoryList); $i++): ?>
	     			 	<option value="<?php echo $categoryList[$i]->id; ?>"><?php echo $categoryList[$i]->name; ?></option>
	      			<?php endfor; ?>
	    			</select>
				</div>

				<div class="form-group">
					<label for="author_name">Auther Name</label>
					<select class="form-control" id= "author_name" name="author_id" required>
					<?php for($i=0; $i<count($authorList); $i++): ?>
						<option value="<?php echo $authorList[$i]->id ?>"><?php echo $authorList[$i]->name; ?></option>
					<?php endfor; ?>
					</select>
				</div>

				<div class="form-group">
					<label for="publisher_name">Publisher Name</label>
					<select class="form-control" id= "publisher_name" name ="publisher_id" required>
					<?php for($i=0; $i<count($publisherList); $i++): ?>
						<option value="<?php echo $publisherList[$i]->id ?>"><?php echo $publisherList[$i]->name; ?></option>
					<?php endfor; ?>
					</select>
				</div>

				<div class="form-group">
					<label for="Language">Language:</label>
					<select class="form-control" id= "language" name ="language_id" required>
					<?php for($i=0; $i<count($languageList); $i++): ?>
						<option value="<?php echo $languageList[$i]->id ?>"><?php echo $languageList[$i]->name; ?></option>
					<?php endfor; ?>
					</select>
				</div>

				<div class="form-group">
					<label for="price">Price:</label>
					<input type="numeric" name="book_price" id="price" class="form-control" placeholder="Price" required>
				</div>

				<div class="form-group">
					<label for="entry_copy">Entry Copy:</label>
					<input type="numeric" name="entry_copy" id="entry_copy" class="form-control" placeholder="Entry Copy" required>
				</div>

				<div class="form-group">
					<input hidden="trun" type="number" name="submitted_by" required class="form-control" value="<?php echo $_SESSION['userid']; ?>">
				</div>

				<button class="btn btn-success mt-3">Insert</button>
			</form>
		</div>
		<br><br><br>
	</div>
</div>