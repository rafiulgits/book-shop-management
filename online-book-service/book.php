<?php include 'base.php'; ?>

<?php 
	$isbn = $_GET['isbn'];
	$db = DB::connection();
	$res = pg_exec($db->getRefference(), "SELECT * FROM getAllBooks() WHERE isbn=$isbn;");
	$obj = pg_fetch_object($res);
 ?>


 <div class="d-flex justify-content-center mt-3">
 	<div class="col-md-9 list-group-item bg-secondary text-white text-center">
 		<p class="display-4 text-center"><?php echo $obj->book; ?></p>
 		<h4 class="lead">Author: <?php echo $obj->author; ?></h4>
 		<h4 class="lead">Edition: <?php echo $obj->author; ?></h4>
 		<h4 class="lead">Category: <?php echo $obj->category; ?></h4>
 		<h4 class="lead">Publisher: <?php echo $obj->publisher; ?></h4>
 		<h4 class="lead">Language: <?php echo $obj->lang; ?></h4>
 		<h4 class="lead">ISBN: <?php echo $obj->isbn; ?></h4>
 		<h4 class="lead">Price: <?php echo $obj->price; ?></h4>
 		<h4 class="lead">Available: <?php echo $obj->available; ?></h4>
 	</div>
 </div>