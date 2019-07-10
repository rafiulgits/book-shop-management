<?php include 'base.php'; ?>

<?php startblock('header') ?>
	<title>Cart</title>
	<script type="text/javascript">
		function doCheckout(){
			$.get("cart/checkout.php");
			return false;
		}
	</script>
<?php endblock() ?>


<?php
	$arr = $_SESSION['user_cart'];
	$total = 0;

	// $r = substr(sha1(rand()), 0, 10);
	// echo strtoupper($r);
	// handle order.php post method
 ?>


<div class="d-flex justify-content-center">
	<div class="col-md-8 mt-4">
		<h3 class="display-4 text-center mb-3">Book Cart</h3>
		<table class="table table-bordered bg-dark text-white">
			<thead>
				<th>ISBN</th><th>Price</th><th>Copy</th><th>Sub-Total</th>
			</thead>
			<tbody>
				<?php for($i=0; $i<count($arr); $i++): ?>
					<tr>
						<td><a href="book.php?isbn=<?php echo $arr[$i]->getISBN(); ?>"><?php echo $arr[$i]->getISBN(); ?></a></td>
						<td><?php echo $arr[$i]->getPrice(); ?></td>
						<td><?php echo $arr[$i]->getCopy(); ?></td>
						<td><?php echo $arr[$i]->getTotal(); ?></td>
						<?php $total = $total+$arr[$i]->getTotal(); ?>
					</tr>
				<?php endfor; ?>
			</tbody>
		</table>
		<h4 class="list-group-item text-right">Total: <?php echo $total; ?> TK</h4>
		<a href="order.php" class="btn btn-success btn-lg float-right">Checkout</a>
	</div>
</div>