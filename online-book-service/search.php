<?php include 'base.php'; ?>

<?php startblock('header') ?>
	<title>Search : Nilkhet</title>
<?php endblock() ?>

<?php 

	$query = $category_name = $_GET['query'];
	$arr = explode(',', $query);
	$db = DB::connection();
	$res = pg_exec($db->getRefference(), "SELECT * FROM getAllBooks() WHERE 
										book ILIKE '%$arr[0]%' AND 
										category ILIKE '%$arr[1]%' AND
										author ILIKE '%$arr[2]%' AND
										publisher ILIKE '%$arr[3]%';");

	$bookList = [];
	while ($data = pg_fetch_object($res)) {
		array_push($bookList, $data);
	}
 ?>

 <div class="container-fluid mt-5">
		<p class="display-4 text-center">Result : '<?php echo $query; ?>'</p>
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