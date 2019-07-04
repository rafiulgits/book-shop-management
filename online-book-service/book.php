<?php include 'base.php'; ?>

<?php 
	$isbn = $_GET['isbn'];
	$db = DB::connection();
	$res = pg_exec($db->getRefference(), "SELECT * FROM getAllBooks() WHERE isbn=$isbn;");
	$obj = pg_fetch_object($res);
	pg_close($db->getRefference());
 ?>


 <div class="d-flex justify-content-center mt-3">
 	<div class="col-md-9 list-group-item bg-secondary text-white text-center">
 		<p class="display-4 text-center"><?php echo $obj->book; ?></p>
 		<h4 class="lead">
 			Author: <a class="text-white" href="author.php?name=<?php echo $obj->author ?>"><?php echo $obj->author; ?></a>
 		</h4>
 		<h4 class="lead">Edition: <?php echo $obj->edition; ?></h4>
 		<h4 class="lead">
 			Category: <a class="text-white" href="category.php?name=<?php echo $obj->category ?>"><?php echo $obj->category; ?></a>
 		</h4>
 		<h4 class="lead">
 			Publisher: <a class="text-white" href="publisher.php?name=<?php echo $obj->publisher ?>"><?php echo $obj->publisher; ?></a>
 		</h4>
 		<h4 class="lead">Language: <?php echo $obj->lang; ?></h4>
 		<h4 class="lead">ISBN: <?php echo $obj->isbn; ?></h4>
 		<h4 class="lead">Price: <?php echo $obj->price; ?></h4>
 		<h4 class="lead">Available: <?php echo $obj->available; ?></h4>
 	</div>
 </div>