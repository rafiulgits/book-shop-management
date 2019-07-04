<?php include 'base.php'; ?>

<?php 
	$author_name = $_GET['name'];
	$db = DB::connection();
	$res1 = pg_exec($db->getRefference(), "SELECT * FROM author WHERE name ILIKE '$author_name';");
	$author = pg_fetch_object($res1);
	$res2 = pg_exec($db->getRefference(), "SELECT * FROM getAllBooks() WHERE author ILIKE '$author_name';");
	$arr = [];
	while ($data = pg_fetch_object($res2)) {
		array_push($arr, $data);
	}
	pg_close($db->getRefference());
?>
<?php startblock('header') ?>
	<title>Author - <?php echo $author_name; ?> : Nilkhet</title>
<?php endblock() ?>


<div class="container-fluid mt-5">
	<div class="d-flex justify-content-center">
		<div class="col-md-12 bg-dark text-white">
			<p class="display-4"><?php echo $author->name; ?></p>
			<p class="blockquote-footer text-white">Author Bio</p>
			<p class="lead mb"><?php echo $author->bio; ?></p>
		</div>
	</div>
	<div class="row justify-content-center mt-3">
		<?php for($item=0; $item<count($arr); $item++): ?>
			<div class="col-md-3">
				<div class="card" style="width: 100%; height: 300px;">
					<div class="card-body">
						<h3 class="card-title"><?php echo $arr[$item]->book; ?></h3>
						<p class="card-text display-4" style="font-size: 20px;">
							<?php echo $arr[$item]->author; ?>
							<br>
							<?php echo $arr[$item]->category; ?>
							<br>
							<?php echo $arr[$item]->price; ?> TK
						</p>
						<a href="book.php?isbn=<?php echo $arr[$item]->isbn ?>" class="btn btn-primary">Details</a>
					</div>
				</div>
			</div>
		<?php endfor; ?>
	</div>
</div>

