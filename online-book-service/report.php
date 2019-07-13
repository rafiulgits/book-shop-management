<?php include 'base.php'; ?>
<?php startblock('header') ?>
	<title>Report : Nilkhet</title>
<?php endblock() ?>



<?php 
	// access checking
	if(isset($_SESSION['is_stuff'])){
		if($_SESSION['is_stuff'] != 't'){
			header('Location: error.php');
		}
	}
	else{
		header('Location: error.php');
	}

	$query = "SELECT * FROM voucher;";
	$filtered = false;

	if(isset($_GET['from_date']) && isset($_GET['to_date'])){
 		$from_date = $_GET['from_date'];
 		$to_date = $_GET['to_date'];

 		if(isset($_GET['status'])){
 			$status = $_GET['status'];
 		}
 		else{
 			$status = '';
 		}

 		if($to_date == ''){
 			if($status == '')
 				$query = "SELECT * FROM voucher WHERE order_date BETWEEN '$from_date'::date AND CURRENT_DATE;";
 			else
 				$query = "SELECT * FROM voucher WHERE order_date BETWEEN '$from_date'::date AND CURRENT_DATE AND status='$status';";

 			$to_date = date("m-d");
 		}
 		else{
 			if($status == '')
 			 	$query = "SELECT * FROM voucher WHERE order_date BETWEEN '$from_date'::date AND '$to_date'::date;";
 			 else
 			 	$query = "SELECT * FROM voucher WHERE order_date BETWEEN '$from_date'::date AND '$to_date'::date AND status='$status';";
 		}
	}

	$db = DB::connection();
	
	$res = pg_exec($db->getRefference(),$query);
	$orderList = [];
	while($data = pg_fetch_object($res)){
		array_push($orderList, $data);
	}

	pg_close($db->getRefference());

	$map = array('P' => 'Pending', 'A' => 'Accepted', 'D' => 'Delivered');

	$total = 0;
?>

<div class="d-flex justify-content-center mt-3">
		<div class="col-md-7" id="order-table">
			<p class="display-4 text-center">Order Table</p>
			<form>
				<input class="form-control" type="date" name="from_date" required>
				<input class="form-control" type="date" name="to_date">
				<select class="custom-select" name="status">
					<option value="A">Accepted</option>
					<option value="P">Pending</option>
					<option value="D">Deliverd</option>
				</select>
				<button class="btn btn-success" >Filter</button>
			</form>
			<br><br>

			<table class="table table-bordered bg-dark text-white">
				<thead>
					<th>ID</th>
					<th>Total</th>
					<th>Time</th>
					<th>Date</th>
					<th>Status</th>
				</thead>
				<tbody>
					<?php for($item=0; $item<count($orderList); $item++): ?>
						<tr>
							<td><a href="updateorder.php?id=<?php echo  $orderList[$item]->id ?>"><?php echo $orderList[$item]->id; ?></a></td>
							<td><?php echo $orderList[$item]->total_price; ?> TK</td>
							<td><?php echo $orderList[$item]->order_time; ?></td>
							<td><?php echo $orderList[$item]->order_date; ?></td>
							<td><?php echo $map[$orderList[$item]->status]; ?></td>
							<?php $total = $total + $orderList[$item]->total_price;?>
						</tr>
					<?php endfor; ?>
					<tr><td></td><td>Total: <?php echo $total; ?> TK</td></tr>
				</tbody>
			</table>
		</div>
	</div>


