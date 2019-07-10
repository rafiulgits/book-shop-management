<?php include 'base.php'; ?>

<?php startblock('header') ?>
	<title>Update Order</title>
<?php endblock(); ?>


<?php 

	$order_id = $_GET['id'];
	$db = DB::connection();

	$res = pg_query($db->getRefference(), "SELECT status,name,phone,email,address FROM voucher WHERE id=$order_id;");
	$voucher = pg_fetch_object($res);

	$res = pg_query($db->getRefference(), "SELECT id,book_isbn,book_price,book_copy,subtotal 
											FROM cart WHERE voucher_id=$order_id;");
	$cartList = [];
	while($data = pg_fetch_object($res)){
		array_push($cartList, $data);
	}

	$map = array('P' => 'Pending', 'A' => 'Accepted', 'D' => 'Delivered');

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$status = $_POST['status'];
		pg_query($db->getRefference(), "UPDATE voucher SET status='$status' WHERE id=$order_id;");
		header('Refresh: 0; URL = dashboard.php#order-table');
	}

	pg_close($db->getRefference());
 ?>

<div class="d-flex justify-content-center mt-4">
	<div class="col-md-8">
		<div class="list-group">
			<h5 class="list-group-item list-group-item-dark">Order Information</h5>
			<h5 class="list-group-item">Name : <?php echo $voucher->name; ?></h5>
			<h5 class="list-group-item">Phone : <?php echo $voucher->phone; ?></h5>
			<h5 class="list-group-item">Email : <?php echo $voucher->email; ?></h5>
			<h5 class="list-group-item">Address : <?php echo $voucher->address; ?></h5>
			<h5 class="list-group-item list-group-item-primary">Status: <?php echo $map[$voucher->status]; ?></h5>
		</div>
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
		<?php if($voucher->status != 'D'): ?>
			<div></div>
				<form class="form-inline" method="POST">
					<div class="form-group">
						<select class="custom-select" name="status">
							<?php if($voucher->status == 'P'): ?>
								<option value="A">Accepted</option>
								<option value="D">Delivered</option>
							<?php else: ?>
								<option value="D">Delivered</option>
							<?php endif; ?>
						</select>
					</div>
					<button class="btn btn-primary">Update</button>
				</form>
			</div>
		<?php endif; ?>
	</div>
</div>