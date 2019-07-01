<!DOCTYPE html>
<html>
<head>
  <title>Add Book</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
	<body>
		<div class="container">
			<h2>Adding Book information</h2>
			<form>
				<div class="form-group">
					<label for="book_isbn">Book ISBN:</label>
					<input type="numeric" name="book_isbn" class="form-control" id ="book_isbn" placeholder="Enter Book_isbn number">
				</div>

				<div class="form-group">
					<label for="book_edition">Book Edition:</label>
					<input type="numeric" name="book_edition" class="form-control" id="book_edition" placeholder="Enter book edition">
				</div>

				<div class="form-group">
					<label for="catagory">Catagory:</label>
					<select multiple class="form-control" id="catagory" name="book_catagory">
	     			 	<option>Horror</option>
	      				<option>Sci-fi</option>
	      				<option>Detective</option>
	     				<option>Adventures</option>
	      				<option>Romantic</option>
	    			</select>
				</div>

				<div class="form-group">
					<label for="author_name">Auther Name</label>
					<select class="form-control" id= "author_name" name="auther_name" >
						<option>Robindronath</option>
	      				<option>Saratchandra</option>
	      				<option>Humayun</option>
	     				<option>Jafor iqbal</option>
	      				<option>Agatha Cristi</option>
					</select>
				</div>

				<div class="form-group">
					<label for="publisher_name">Publisher Name</label>
					<select class="form-control" id= "publisher_name" name ="publisher_name">
						<option>Robindronath</option>
	      				<option>Saratchandra</option>
	      				<option>Humayun</option>
	     				<option>Jafor iqbal</option>
	      				<option>Agatha Cristi</option>
					</select>
				</div>

				<div class="form-group">
					<label for="Language">Language:</label>
					<input type="text" name="language" id="language" class="form-control" placeholder="Language">
				</div>

				<div class="form-group">
					<label for="price">Price:</label>
					<input type="numeric" name="price" id="price" class="form-control" placeholder="Price">
				</div>

				<div class="form-group">
					<label for="entry_copy">Entry Copy:</label>
					<input type="numeric" name="entry_copy" id="entry_copy" class="form-control" placeholder="entry_copy">
				</div>

				<div class="form-group">
					<label for="submitted_by">Submitted By:</label>
					<input type="numeric" name="submitted_by" id="submitted_by" class="form-control" placeholder="submitted_by">
				</div>
				
			</form>
		</div>
		<button type="button" class="btn btn-primary" name ="submit_book">Submit</button>

	</body>
</html>