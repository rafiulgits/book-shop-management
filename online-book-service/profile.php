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