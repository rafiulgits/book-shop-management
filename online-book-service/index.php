<?php 
	include 'base.php';

	$db = DB::connection();
	echo "We are connected<br>";


	// $res = pg_exec($db->getRefference(), 'SELECT * FROM getAllBooks();');

	// while ($data = pg_fetch_object($res)) {
	// 	echo "ISBN: ". $data->isbn . "<br>";
	// 	echo "Book: ". $data->book . "<br>";
	// 	echo "Author: ". $data->author . "<br>";
	// 	echo "Category: ". $data->category . "<br>";
	// 	echo "Publisher: ". $data->publisher . "<br>";
	// 	echo "Price: ". $data->price . "<br>";
	// 	echo "Available: ". $data->available . "<br>";
	// 	echo "<br>";
	// }
	
	// pg_close($db->getRefference());
?>