<?php include 'base.php'; ?>

<?php startblock('header'); ?>
	<title>Order</title>
<?php endblock(); ?>

<?php 
	$db = DB::connection();
	if(isset($_SESSION['userid'])){
		$id = $_SESSION['userid'];
		$res = pg_query($db->getRefference(), "SELECT name,phone,email,address FROM account WHERE id=$id;");
		$user = pg_fetch_object($res);
	}
 ?>

<div class="d-flex justify-content-center mt-4">
	<div class="col-md-6 list-group-item">
		<h4 class="lead text-center">Order</h4>
		<?php if(!isset($_SESSION['userid'])): ?>
			<form method="POST" action="cart/checkout.php">
				<label>Name</label>
				<input type="text" name="name" class="form-control mb-3" required>
				<label>Phone</label>
				<input type="text" name="phone" class="form-control mb-3" required>
				<label>Email</label>
				<input type="email" name="email" class="form-control mb-3" required>
				<label>Address</label>
				<textarea name="address" class="form-control mb-3"></textarea>
				<button class="btn btn-success">Place order</button>
			</form>
		<?php else: ?>
			<form method="POST" action="cart/checkout.php">
				<label>Name</label>
				<input type="text" name="name" class="form-control mb-3" 
					value="<?php echo $user->name; ?>" required>
				<label>Phone</label>
				<input type="text" name="phone" class="form-control mb-3"
					value="<?php echo $user->phone; ?>" required>
				<label>Email</label>
				<input type="email" name="email" class="form-control mb-3" 
				 	value="<?php echo $user->email; ?>" required>
				<label>Address</label>
				<textarea name="address" class="form-control mb-3"><?php echo $user->address; ?></textarea>
				<button class="btn btn-success">Place order</button>
			</form>
		<?php endif; ?>
	</div>
</div>