<?php include 'base.php'; ?>
<?php startblock('header'); ?>
<title>Stuff List</title>
<?php endblock(); ?>



<?php 

	$db = DB::connection();
	$res = pg_query($db->getRefference(), "SELECT * FROM account WHERE is_stuff = true AND is_admin=false;");

	$list = [];
	while($data = pg_fetch_object($res)){
		array_push($list, $data);
	}
 ?>


 <div class="d-flex justify-content-center mt-3">
 	<div class="col-md-8">
 		<h4 class="text-center mt-2 mb-2">Stuff List</h4>
 		<table class="table table-bordered bg-dark text-white">
 			<thead>
 				<th>Name</th>
 				<th>Phone</th>
 				<th>Email</th>
 				<th>Address</th>
 			</thead>
 			<tbody>
 				<?php for($i=0; $i<count($list); $i++ ): ?>
 					<tr>
 						<td><?php echo $list[$i]->name; ?></td>
 						<td><?php echo $list[$i]->phone; ?></td>
 						<td><?php echo $list[$i]->email; ?></td>
 						<td><?php echo $list[$i]->address; ?></td>
 					</tr>
 				<?php endfor; ?>
 			</tbody>
 		</table>
 	</div>
 </div>