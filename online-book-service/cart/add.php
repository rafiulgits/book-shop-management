<?php include '../base.php'; ?>

<?php

	$isbn = $_GET['isbn'];
	$price = $_GET['price'];
	$cartItem = new Item($isbn, $price);
	$list = $_SESSION['user_cart'];
	array_push($list, $isbn);
	$_SESSION['user_cart'] = $list;
 ?>