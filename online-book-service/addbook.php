<?php include 'base.php'; ?>


<?php startblock('header'); ?>
	<title>Add Book</title>
<?php endblock(); ?>


<?php 

	$db = DB::connection();
	$res = pg_exec($db->getRefference(), "SELECT * FROM getAllBooks();");

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
			<form>
				<div class="form-group">
					<label for="book_name">Book Name:</label>
					<input type="text" name="book_name" class="form-control" id ="book_name" placeholder="Name">
				</div>
				<div class="form-group">
					<label for="book_isbn">Book ISBN:</label>
					<input type="numeric" name="book_isbn" class="form-control" id ="book_isbn" placeholder="ISBN">
				</div>

				<div class="form-group">
					<label for="book_edition">Book Edition:</label>
					<input type="numeric" name="book_edition" class="form-control" id="book_edition" placeholder="Enter book edition">
				</div>

				<div class="form-group">
					<label for="catagory">Catagory:</label>
					<select class="form-control" id="catagory" name="book_catagory">
					<?php for($i=0; $i<count($categoryList); $i++): ?>
	     			 	<option value="<?php echo $categoryList[$i]->id; ?>"><?php echo $categoryList[$i]->name; ?></option>
	      			<?php endfor; ?>
	    			</select>
				</div>

				<div class="form-group">
					<label for="author_name">Auther Name</label>
					<select class="form-control" id= "author_name" name="auther_name" >
					<?php for($i=0; $i<count($authorList); $i++): ?>
						<option value="<?php echo $authorList[$i]->id ?>"><?php echo $authorList[$i]->name; ?></option>
					<?php endfor; ?>
					</select>
				</div>

				<div class="form-group">
					<label for="publisher_name">Publisher Name</label>
					<select class="form-control" id= "publisher_name" name ="publisher_name">
					<?php for($i=0; $i<count($publisherList); $i++): ?>
						<option value="<?php echo $publisherList[$i]->id ?>"><?php echo $publisherList[$i]->name; ?></option>
					<?php endfor; ?>
					</select>
				</div>

				<div class="form-group">
					<label for="Language">Language:</label>
					<select class="form-control" id= "language" name ="Language">
					<?php for($i=0; $i<count($languageList); $i++): ?>
						<option value="<?php echo $languageList[$i]->id ?>"><?php echo $languageList[$i]->name; ?></option>
					<?php endfor; ?>
					</select>
				</div>

				<div class="form-group">
					<label for="price">Price:</label>
					<input type="numeric" name="price" id="price" class="form-control" placeholder="Price">
				</div>

				<div class="form-group">
					<label for="entry_copy">Entry Copy:</label>
					<input type="numeric" name="entry_copy" id="entry_copy" class="form-control" placeholder="Entry Copy">
				</div>

				<div class="form-group">
					<input hidden="trun" type="number" name="submitted_by" class="form-control" value="<?php echo $_SESSION['userid']; ?>">
				</div>

				<button class="btn btn-success mt-3">Insert</button>
			</form>
		</div>
		<br><br><br>
	</div>
</div>