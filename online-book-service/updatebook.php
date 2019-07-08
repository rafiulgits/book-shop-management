<?php include 'base.php'; ?>

<?php 
	$isbn = $_GET['isbn'];
	$db = DB::connection();

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

		/*
		Update book arguments:

			_name varchar(50),
			_isbn bigint,
			_pre_isbn bigint,
			_edition smallint,
			_category_id int,
			_author_id int,
			_publisher_id int,
			_language_id int,
			_price numeric(7,2)
		*/

		$res = pg_exec($db->getRefference(), "CALL updateBook(
			'$book_name'::varchar,
			$book_isbn::bigint,
			$isbn::bigint,
			$book_edition::smallint,
			$category_id,
			$author_id,
			$publisher_id,
			$language_id,
			$book_price::numeric
		);");
		if($res){
			header('Refresh: 0; URL = dashboard.php');
		}
		else{
			$failed = true;
		}
	}


	$res = pg_exec($db->getRefference(), "SELECT * FROM getAllBooks() WHERE isbn=$isbn;");
	$obj = pg_fetch_object($res);

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
					<input type="text" name="book_name" value="<?php echo $obj->book ?>" class="form-control" id ="book_name" placeholder="Name">
				</div>
				<div class="form-group">
					<label for="book_isbn">Book ISBN:</label>
					<input type="numeric" name="book_isbn" value="<?php echo $obj->isbn ?>" class="form-control" id ="book_isbn" placeholder="ISBN">
				</div>

				<div class="form-group">
					<label for="book_edition">Book Edition:</label>
					<input type="numeric" name="book_edition" value="<?php echo $obj->edition ?>"class="form-control" id="book_edition" placeholder="Enter book edition">
				</div>

				<div class="form-group">
					<label for="catagory">Catagory:</label>
					<select class="form-control" id="catagory" name="category_id">
					<?php for($i=0; $i<count($categoryList); $i++): ?>
	     			 	<option value="<?php echo $categoryList[$i]->id; ?>"><?php echo $categoryList[$i]->name; ?></option>
	      			<?php endfor; ?>
	    			</select>
				</div>

				<div class="form-group">
					<label for="author_name">Auther Name</label>
					<select class="form-control" id= "author_name" name="author_id" >
					<?php for($i=0; $i<count($authorList); $i++): ?>
						<option value="<?php echo $authorList[$i]->id ?>"><?php echo $authorList[$i]->name; ?></option>
					<?php endfor; ?>
					</select>
				</div>

				<div class="form-group">
					<label for="publisher_name">Publisher Name</label>
					<select class="form-control" id= "publisher_name" name ="publisher_id">
					<?php for($i=0; $i<count($publisherList); $i++): ?>
						<option value="<?php echo $publisherList[$i]->id ?>"><?php echo $publisherList[$i]->name; ?></option>
					<?php endfor; ?>
					</select>
				</div>

				<div class="form-group">
					<label for="Language">Language:</label>
					<select class="form-control" id= "language" name ="language_id">
					<?php for($i=0; $i<count($languageList); $i++): ?>
						<option value="<?php echo $languageList[$i]->id ?>"><?php echo $languageList[$i]->name; ?></option>
					<?php endfor; ?>
					</select>
				</div>

				<div class="form-group">
					<label for="price">Price:</label>
					<input type="number" name="book_price" value="<?php echo $obj->price ?>"id="price" class="form-control" placeholder="Price">
				</div>

				<button class="btn btn-success mt-3">Update</button>
			</form>
		</div>
		<br><br><br>
	</div>
</div>