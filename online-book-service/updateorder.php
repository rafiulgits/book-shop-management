<?php include 'base.php'; ?>

<?php startblock('header') ?>
	<title>Update Order</title>
<?php endblock(); ?>


<?php 

	$order_id = $_GET['id'];
	$db = DB::connection();

	$res = pg_query($db->getRefference(), "SELECT status FROM voucher WHERE id=$order_id;");
	$voucher = pg_fetch_object($res);

	$res = pg_query($db->getRefference(), "SELECT id,book_isbn,book_price,book_copy,subtotal 
											FROM cart WHERE voucher_id=$order_id;");
	$cartList = [];
	while($data = pg_fetch_object($res)){
		array_push($cartList, $data);
	}
 ?>

<div class="d-flex justify-content-center mt-4">
	<div class="col-md-8">
		<h4 class="lead text-center"><?php echo $voucher->status; ?></h4>
		<table class="table table-bordered bg-dark text-white">
			<thead>
				<th>Book ISBN</th><th>Price</th><th>Copy</th><th>Subtotal</th>
			</thead>
			<tbody>
				<?php for($i=0; $i<count($cartList); $i++): ?>
					<tr>
						<td><?php echo $cartList[$i]->book_isbn; ?></td>
						<td><?php echo $cartList[$i]->book_price; ?></td>
						<td><?php echo $cartList[$i]->book_copy; ?></td>
						<td><?php echo $cartList[$i]->subtotal; ?></td>
					</tr>
				<?php endfor; ?>
			</tbody>
		</table>
	</div>
</div>