<?php include 'base.php'; ?>

<?php startblock('header') ?>
	<title>Nilkhet : Online Book Service</title>
	<style type="text/css">
		.bg-green {
			background-color: #008000;
		}
	</style>
<?php endblock() ?>


<?php startblock('content') ?>
	<?php 
		
		$db = DB::connection();
		$res = pg_exec($db->getRefference(), "SELECT * FROM getAllBooks();");
		$bookList = [];
		while ($data = pg_fetch_object($res)) {
			array_push($bookList, $data);
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

		pg_close($db->getRefference());
	?>
	<div class="container-fluid mt-3">
		<div class="row justify-content-center">
			<div class="col-md-3">
				<div class="list-group">
					<h4 class="list-group-item bg-green text-white">Categories</h4>
					<?php for($item=0; $item<count($categoryList); $item++): ?>
					<a href="category.php?name=<?php echo $categoryList[$item]->name ?>" class="list-group-item"><?php echo $categoryList[$item]->name; ?> 
						(<?php echo $categoryList[$item]->available; ?>)</a>
					<?php endfor; ?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="list-group">
					<h4 class="list-group-item bg-green text-white">Authors</h4>
					<?php for($item=0; $item<count($authorList); $item++): ?>
					<a href="author.php?name=<?php echo $authorList[$item]->name ?>" class="list-group-item"><?php echo $authorList[$item]->name; ?> 
						(<?php echo $authorList[$item]->available; ?>)</a>
					<?php endfor; ?>
				</div>
			</div>
			<div class="col-md-3">
				<div class="list-group">
					<h4 class="list-group-item bg-green text-white">Publishers</h4>
					<?php for($item=0; $item<count($publisherList); $item++): ?>
					<a href="publisher.php?name=<?php echo $publisherList[$item]->name ?>" class="list-group-item"><?php echo $publisherList[$item]->name; ?> 
						(<?php echo $publisherList[$item]->available; ?>)</a>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</div>
	<br><br>
	<div class="container-fluid mt-5">
		<p class="display-4 text-center">Books Show Case</p>
		<div class="row justify-content-center">
			<?php for($item=0; $item<count($bookList); $item++): ?>
				<div class="col-md-3">
					<div class="card" style="width: 100%; height: 300px;">
						<div class="card-body">
							<h3 class="card-title"><?php echo $bookList[$item]->book; ?></h3>
							<p class="card-text display-4" style="font-size: 20px;">
								<?php echo $bookList[$item]->author; ?>
								<br>
								<?php echo $bookList[$item]->category; ?>
								<br>
								<?php echo $bookList[$item]->price; ?> TK
							</p>
							<a href="book.php?isbn=<?php echo $bookList[$item]->isbn ?>" class="btn btn-primary">Details</a>
						</div>
					</div>
				</div>
			<?php endfor; ?>
		</div>
	</div>
	<br><br>

<?php endblock(); ?>
