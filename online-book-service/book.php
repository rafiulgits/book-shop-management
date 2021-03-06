<?php include 'base.php'; ?>

<?php 
	$isbn = $_GET['isbn'];
	$db = DB::connection();
	$res = pg_exec($db->getRefference(), "SELECT * FROM getAllBooks() WHERE isbn=$isbn;");
	$obj = pg_fetch_object($res);
	pg_close($db->getRefference());
 ?>
<?php startblock('header') ?>
	<title><?php echo $obj->book; ?></title>
	<script type="text/javascript">
		function addToCart(isbn, price){
			alert('added');
			$.get("cart/add.php?isbn="+isbn+"&price="+price);
			return false;
		}
	</script>
	<style type="text/css">
		.bg-style {
			background-image: url('static/res/notebook.svg');
			background-repeat: no-repeat;
			background-size: cover;
		}
	</style>
<?php endblock() ?>




 <div class="d-flex justify-content-center mt-3">
 	<div class="col-md-9 bg-style text-white text-center">
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
 		<br>
 		<br>
 		<?php if($obj->available > 0): ?>
	 		<button class="btn btn-primary mb-4" onclick="addToCart(<?php echo $obj->isbn; ?>, <?php echo $obj->price; ?>)">
	 			Add to Cart
	 		</button>
	 	<?php endif; ?>
 	</div>
 </div>