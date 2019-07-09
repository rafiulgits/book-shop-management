<?php include '../base.php'; ?>

<?php

	$isbn = $_GET['isbn'];
	$price = $_GET['price'];
	if(!isset($_SESSION['user_cart'])){
		$_SESSION['user_cart'] = [];
	}
	$list = $_SESSION['user_cart'];
	$found = false;

	for($i=0; $i<count($list); $i++){
		if($isbn == $list[$i]->getISBN()){
			$list[$i]->addCopy();
			$found = true;
			break;
		}
	}

	if($found == false){
		$cartItem = new Item($isbn, $price);
		array_push($list, $cartItem);
	}
	
	$_SESSION['user_cart'] = $list;
 ?>