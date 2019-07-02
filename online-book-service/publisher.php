<?php include 'base.php'; ?>

<?php 
	$publisher_name = $_GET['name'];
	$db = DB::connection();
	$res1 = pg_exec($db->getRefference(), "SELECT * FROM publisher WHERE name ILIKE '$publisher_name';");
	$publisher = pg_fetch_object($res1);
	$res2 = pg_exec($db->getRefference(), "SELECT * FROM getAllBooks() WHERE publisher ILIKE '$publisher_name';");
	$arr = [];
	while ($data = pg_fetch_object($res2)) {
		array_push($arr, $data);
	}
	pg_close($db->getRefference());
?>


<h5>All Books of publisher: <?php echo $publisher->name; ?></h5>

<div class="container-fluid mt-3">
	<div class="row">
		<?php for($item=0; $item<count($arr); $item++): ?>
			<div class="col-md-3">
				<div class="card" style="width: 100%; height: 300px;">
					<div class="card-body">
						<h3 class="card-title"><?php echo $arr[$item]->book; ?></h3>
						<p class="card-text display-4" style="font-size: 25px;">
							<?php echo $arr[$item]->author; ?>
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

