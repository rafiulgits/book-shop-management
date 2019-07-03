<?php include 'base.php'; ?>

<?php 
	$category_name = $_GET['name'];
	$db = DB::connection();
	$res1 = pg_exec($db->getRefference(), "SELECT * FROM category WHERE name ILIKE '$category_name';");
	$category = pg_fetch_object($res1);
	$res2 = pg_exec($db->getRefference(), "SELECT * FROM getAllBooks() WHERE category ILIKE '$category_name';");
	$arr = [];
	while ($data = pg_fetch_object($res2)) {
		array_push($arr, $data);
	}
	pg_close($db->getRefference());
?>

<?php startblock('header') ?>
	<title>Category - <?php echo $category_name; ?> : Nilkhet</title>
<?php endblock() ?>

<?php startblock('content') ?>
	<div class="container-fluid mt-5">
		<p class="display-4 text-center">Category: <?php echo $category->name; ?></p>
		<div class="row justify-content-center">
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
<?php endblock() ?>

