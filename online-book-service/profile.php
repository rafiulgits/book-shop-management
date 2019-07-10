<?php include 'base.php'; ?>

<?php startblock('header');  ?>
	<title>Profile</title>
<?php endblock() ?>

<?php 
	$id = $_SESSION['userid'];
	$db = DB::connection();
	$res = pg_query($db->getRefference(), "SELECT name,phone,email,gender,address
											FROM account WHERE id=$id;");
	$user = pg_fetch_object($res);
	$res = pg_query($db->getRefference(), "SELECT id, status, order_time, order_date FROM voucher WHERE email ILIKE '$user->email';");
	$orderList = [];
	while($data = pg_fetch_object($res)){
		array_push($orderList, $data);
	}
	pg_close($db->getRefference());
	$map = array('P' => 'Pending', 'A' => 'Accepted', 'D' => 'Delivered');
 ?>


 <div class="d-flex justify-content-center">
 	<div class="col-md-6 mt-5">
 		<div class="list-group">
 			<h6 class="list-group-item text-center text-white bg-dark">Profile</h6>
 			<h4 class="lead list-group-item">Name: <?php echo $user->name; ?> </h4>
 			<h4 class="lead list-group-item">Phone: <?php echo $user->phone; ?> </h4>
 			<h4 class="lead list-group-item">Email: <?php echo $user->email; ?> </h4>
 			<h4 class="lead list-group-item">Address: <?php echo $user->address; ?> </h4>
 		</div>
 	</div>
 </div>

<div class="d-flex justify-content-center">
	<div class="col-md-6 mt-4">
		<br>
		<h4 class="lead text-center">Orders</h4>
		<table class="table table-bordered bg-dark text-white">
			<thead>
				<th>ID</th><th>Time</th><th>Date</th><th>status</th>
			</thead>
			<tbody>
				<?php for($i=0; $i<count($orderList); $i++): ?>
					<tr>
						<td><?php echo $orderList[$i]->id; ?></td>
						<td><?php echo $orderList[$i]->order_time; ?></td>
						<td><?php echo $orderList[$i]->order_date; ?></td>
						<td><?php echo $map[$orderList[$i]->status]; ?></td>
					</tr>
				<?php endfor; ?>
			</tbody>
		</table>
	</div>
</div>