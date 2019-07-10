<?php include '../base.php'; ?>


<?php 

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$address = $_POST['address'];

		$arr = $_SESSION['user_cart'];
		$total = 0;
		for($i=0;$i<count($arr);$i++)
			$total = $total+$arr[$i]->getTotal();

/*		id serial PRIMARY KEY,
		total_price numeric(10,2) NOT NULL,
		name varchar(80) NOT NULL,
		phone varchar(11) NOT NULL,
		email varchar(45),
		address varchar(50) NOT NULL,
		status varchar(1) NOT NULL DEFAULT 'P'*/

		$voucher_query = "INSERT INTO voucher(total_price,name,phone,email,address)
						VALUES($total,'$name','$phone','$email','$address') RETURNING id;";

		$db = DB::connection();
		$res = pg_query($db->getRefference(), $voucher_query);
		$row = pg_fetch_row($res);
		$order_id = $row['0'];


		// creating individual cart record
/*		id serial PRIMARY KEY,
		book_isbn bigint REFERENCES book(isbn),
		book_price numeric(7,2),
		book_copy int NOT NULL,
		subtotal numeric(8,2),
		voucher_id int REFERENCES voucher(id)*/
		for($i=0; $i<count($arr); $i++){
			$isbn = $arr[$i]->getISBN();
			$price = $arr[$i]->getPrice();
			$copy = $arr[$i]->getCopy();
			$subtotal = $arr[$i]->getTotal();

			pg_query($db->getRefference(), "INSERT INTO cart(book_isbn,book_price,book_copy,subtotal,voucher_id)
				VALUES($isbn, $price, $copy, $subtotal, $order_id);");

			// stock id access
			$stock_query = "SELECT stock_id FROM book where isbn = $isbn";

			$res = pg_query($db->getRefference(),$stock_query);
			$row = pg_fetch_row($res);
			$stock_id = $row['0'];

			// update 
			$update_query = "UPDATE stock SET entry_copy = entry_copy-$copy WHERE id = $stock_id";
			pg_query($db->getRefference(),$update_query);
			$update_query = "UPDATE stock SET sold_copy = sold_copy+$copy WHERE id = $stock_id";
			pg_query($db->getRefference(),$update_query);
			
			pg_close($db->getRefference());

		}
		unset($_SESSION['user_cart']);
		header('Refresh: 0; URL = ../profile.php');
		
	}



 ?>
