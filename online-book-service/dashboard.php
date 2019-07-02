<?php include 'base.php'; ?>

<?php startblock('header') ?>
	<title>Dashboard : Nilkhet</title>
<?php endblock() ?>


<?php startblock('content') ?>
	<?php 
		
		$db = DB::connection();
		$res = pg_exec($db->getRefference(), "SELECT * FROM getBookStocks();");
		$arr = [];
		while ($data = pg_fetch_object($res)) {
			array_push($arr, $data);
		}
		pg_close($db->getRefference());
	?>
	<div class="d-flex justify-content-center mt-3">
		<div class="col-md-11">
			<table class="table table-bordered">
				<thead>
					<th>ISBN</th>
					<th>Book</th>
					<th>Edition</th>
					<th>Price</th>
					<th>Entry</th>
					<th>Sold</th>
					<th>Expenditure</th>
					<th>Update by</th>
				</thead>
				<tbody>
					<?php for($item=0; $item<count($arr); $item++): ?>
						<tr>
							<td><?php echo $arr[$item]->isbn; ?></td>
							<td><?php echo $arr[$item]->book; ?></td>
							<td><?php echo $arr[$item]->edition; ?></td>
							<td><?php echo $arr[$item]->price; ?></td>
							<td><?php echo $arr[$item]->entry_copy; ?></td>
							<td><?php echo $arr[$item]->sold_copy; ?></td>
							<td><?php echo $arr[$item]->expenditure; ?></td>
							<td><?php echo $arr[$item]->staff_name; ?></td>
						</tr>
					<?php endfor; ?>
				</tbody>
			</table>
		</div>
	</div>
<?php endblock() ?>
