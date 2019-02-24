<?php 
	
	$host = "localhost";
	$port = "5432";
	$user = "swe328";
	$password = "pass1234";
	$dbname = "bookservicedb";

	echo "Hello I am connected<br>";

	$con = pg_connect("host=$host dbname=$dbname port=$port 
		user=$user password=$password") or die("unable to connect with database");


	if ($con){
		echo "database connected<br>";


		//--------------------------------------

		$sql ="CREATE TABLE  IF NOT EXISTS staff (

			name varchar(15) NOT NULL,
			address varchar(30),
			phone varchar(12) UNIQUE PRIMARY KEY)";



		$res = pg_query($con, $sql);
		echo "Staff table created"; 
		echo "<br>";
		//------------------------------------------
		$sql ="CREATE TABLE  IF NOT EXISTS country (

			name varchar(2) PRIMARY KEY)";


		$res = pg_query($con, $sql);
		echo "Country table created"; 
		echo "<br>";

		//------------------------------------------

		$sql ="CREATE TABLE  IF NOT EXISTS author (

			name varchar(30) NOT NULL,
			bio varchar(50),
			author_id serial PRIMARY KEY)";


		$res = pg_query($con, $sql);
		echo "author table created"; 
		echo "<br>";
		//----------------------------------------

		$sql ="CREATE TABLE  IF NOT EXISTS publisher (

			name varchar(30) NOT NULL,
			country_name varchar(2) REFERENCES country(name),

			PRIMARY KEY (name, country_name) 
		)";


		$res = pg_query($con, $sql);
		echo "publisher table created"; 
		echo "<br>";
		//--------------------------------------------
		$sql ="CREATE TABLE  IF NOT EXISTS account (

			phone varchar(12) PRIMARY KEY,
			name varchar(30) NOT NULL,
			address varchar(30) NOT NULL
		)";

		$res = pg_query($con, $sql);
		echo "user table created"; 
		echo "<br>";
		//-----------------------------------------------
		$sql ="CREATE TABLE  IF NOT EXISTS stock (

			entry_copy int NOT NULL,
			enpenditure int NOT NULL,
			sold_copy int NOT NULL,
			stock_id serial PRIMARY KEY)";

		$res = pg_query($con, $sql);
		echo "stock table created"; 
		echo "<br>";
		//-------------------------------------------------

		$sql ="CREATE TABLE  IF NOT EXISTS book (

			name varchar(50) NOT NULL,
			language varchar(2),
			price numeric(4,2),
			edition smallint NOT NULL,
			isbn bigint PRIMARY KEY,

			author_id int REFERENCES author(author_id),

			publisher_name varchar(30) NOT NULL,
			publisher_country varchar(2) NOT NULL,

			FOREIGN KEY (publisher_name, publisher_country) REFERENCES publisher(name, country_name),
			
			stock_id int REFERENCES stock(stock_id)

		)";

		$res = pg_query($con, $sql);
		echo "Book table created"; 
		echo "<br>";

		//-----------------------------------------------
		$sql ="CREATE TABLE  IF NOT EXISTS category (

			name varchar(10) PRIMARY KEY,
			book_isbn bigint REFERENCES book(isbn)
		)";


		$res = pg_query($con, $sql);
		echo "Category table created"; 
		echo "<br>";
		//---------------------------------------------------

		$sql ="CREATE TABLE  IF NOT EXISTS voucher (
			id bigint PRIMARY KEY,
			total_price int NOT NULL,
			quantity smallint NOT NULL

		)";

		$res = pg_query($con, $sql);

		echo "voucher table created"; 
		echo "<br>";


		//--------------------------------------------

		$sql = "CREATE TABLE IF NOT EXISTS cart(

			voucher_id bigint REFERENCES voucher(id),
			book_isbn bigint REFERENCES book(isbn) 
		)";
		
		$res = pg_query($con, $sql);

		echo "cart table created"; 
		echo "<br>";
		
		//-------------------------------------------	

		$sql ="CREATE TABLE  IF NOT EXISTS shipping (
			area varchar(12) NOT NULL,
			address varchar(30) NOT NULL,
			sDate DATE NOT NULL,
			sTime TIME NOT NULL,
			status boolean NOT NULL
		)";


		$res = pg_query($con, $sql);
		echo "shipping table created"; 
		echo "<br>";

		


		pg_close($con); // close the connection

	} else{
		echo "unable to connect with database";
	}

?>