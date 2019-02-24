<?php 
	
	$host = "localhost";
	$port = "5432";
	$user = "swe328";
	$password = "pass1234";
	$dbname = "bookservicedb";

	echo "Hello I am connected";
	echo "<br>"; // next line

	$con = pg_connect("host=$host dbname=$dbname port=$port 
		user=$user password=$password") or die("unable to connect with database");


	if ($con){
		echo "database connected";
		echo "<br>"; //next line


		//--------------------------------------

		$sql ="CREATE TABLE  IF NOT EXISTS staff (

			name varchar(15) NOT NULL,
			address varchar(30),
			phone varchar(12) UNIQUE PRIMARY KEY)";



		$res = pg_query($con, $sql);
		echo "Staff table created";
		//------------------------------------------
		$sql ="CREATE TABLE  IF NOT EXISTS country (

			name varchar(2) PRIMARY KEY)";


		$res = pg_query($con, $sql);
		echo "Country table created";

		//------------------------------------------

		$sql ="CREATE TABLE  IF NOT EXISTS author (

			name varchar(30) NOT NULL,
			bio varchar(50),
			author_id serial PRIMARY KEY)";


		$res = pg_query($con, $sql);
		echo "author table created";
		//----------------------------------------

		$sql ="CREATE TABLE  IF NOT EXISTS publisher (

			name varchar(30) NOT NULL,
			country_name varchar(2),

			FOREIGN KEY country_name REFERENCES country(name)
			PRIMARY KEY (name, country) )";


		$res = pg_query($con, $sql);
		echo "publisher table created";
		//--------------------------------------------
		$sql ="CREATE TABLE  IF NOT EXISTS user (

			name varchar(30) NOT NULL,
			address varchar(30) NOT NULL,
			phone varchar(12) PRIMARY KEY)";


		$res = pg_query($con, $sql);
		echo "user table created";
		//-----------------------------------------------
		$sql ="CREATE TABLE  IF NOT EXISTS stock (

			entry_copy int NOT NULL,
			enpenditure int NOT NULL,
			sold_copy int NOT NULL,
			stock_id serial PRIMARY KEY)";

		$res = pg_query($con, $sql);
		echo "stock table created";
		//-------------------------------------------------

		$sql ="CREATE TABLE  IF NOT EXISTS book (

			name varchar(50) NOT NULL,
			language varchar(2),
			price numeric(4,2),
			edition smallint NOT NULL,
			isbn bigint UNIQUE PRIMARY KEY,

			author_id int,
			FOREIGN KEY (author_id) REFERENCES author(author_id),

			publisher_name varchar(30),
			publisher_country varchar(2),

			FOREIGN KEY(publisher_name, publisher_country) REFERENCES publisher(name, country),

			
			stock_id int,
			FOREIGN KEY (stock_id) REFERENCES stock(stock_id)

		)";



		$res = pg_query($con, $sql);
		echo "Book table created";

		//-----------------------------------------------
		$sql ="CREATE TABLE  IF NOT EXISTS category (

			name varchar(10) PRIMARY KEY
			book_isbn varchar(13),

			FOREIGN KEY(book_isbn) REFERENCES book(isbn))";



		$res = pg_query($con, $sql);
		echo "Category table created";
		//-------------------------------------------


		/*$sql ="CREATE TABLE  IF NOT EXISTS shipping (
			area varchar(12) NOT NULL,
			address varchar(30) NOT NULL,
			date_time 
			)";


		$res = pg_query($con, $sql);
		echo "shipping table created";*/

		//---------------------------------------------------

		/*$sql ="CREATE TABLE  IF NOT EXISTS voucher (

			total_price int NOT NULL,
			quantity smallint NOT NULL,)";

		$res = pg_query($con, $sql);
		echo "vpucher table created";*/


		pg_close($con); // close the connection

	} else{
		echo "unable to connect with database";
	}

?>