<?php 
	
	const host = "localhost";
	const port = "5432";
	const user = "swe328";
	const password = "pass1234";
	const dbname = "bookservicedb";


	/*
		TABLE SQL
	*/
	const TABLE_STAFF ="CREATE TABLE  IF NOT EXISTS staff (

		name varchar(15) NOT NULL,
		address varchar(30),
		phone varchar(12) UNIQUE PRIMARY KEY
	)";


	const TABLE_STOCK ="CREATE TABLE  IF NOT EXISTS stock (

		stock_id serial PRIMARY KEY,
		entry_copy int NOT NULL,
		enpenditure int NOT NULL,
		sold_copy int NOT NULL,

		staff_id varchar(12) REFERENCES staff(phone)
	)";


	const TABLE_COUNTRY ="CREATE TABLE  IF NOT EXISTS country (

		name varchar(2) PRIMARY KEY
	)";


	const TABLE_AUTHOR ="CREATE TABLE  IF NOT EXISTS author (

		name varchar(30) NOT NULL,
		bio varchar(50),
		author_id serial PRIMARY KEY
	)";


	const TABLE_PUBLISHER ="CREATE TABLE  IF NOT EXISTS publisher (

		name varchar(30) NOT NULL,
		country_name varchar(2) REFERENCES country(name),

		PRIMARY KEY (name, country_name) 
	)";



	const TABLE_ACCOUNT ="CREATE TABLE  IF NOT EXISTS account (

		phone varchar(12) PRIMARY KEY,
		name varchar(30) NOT NULL,
		address varchar(30) NOT NULL
	)";



	const TABLE_BOOK ="CREATE TABLE  IF NOT EXISTS book (

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



	const TABLE_CATEGORY ="CREATE TABLE  IF NOT EXISTS category (

		name varchar(10) PRIMARY KEY,
		book_isbn bigint REFERENCES book(isbn)
	)";

	
	const TABLE_VOUCHER ="CREATE TABLE  IF NOT EXISTS voucher (

		voucher_id bigint PRIMARY KEY,
		total_price int NOT NULL,
		quantity smallint NOT NULL,

		account_id varchar(12) REFERENCES account(phone)

	)";



	const TABLE_SHIPPING ="CREATE TABLE  IF NOT EXISTS shipping (

		area varchar(12) NOT NULL,
		address varchar(30) NOT NULL,
		sDate DATE NOT NULL,
		sTime TIME NOT NULL,
		status boolean NOT NULL,

		voucher_id bigint REFERENCES voucher(voucher_id)
	)";

	

	const TABLE_CART = "CREATE TABLE IF NOT EXISTS cart(

		voucher_id bigint REFERENCES voucher(voucher_id),
		book_isbn bigint REFERENCES book(isbn) 
	)";

	
	function connect(){

		try {
			 return @pg_connect("host=localhost port=5432 dbname=bookservicedb user=swe328 password=pass1234");
			return con;
		} catch (Exception $e) {
			return false;	
		} 
	}	


	function migrate($con){
		/*
		migration chain
		----------------
		
		1. TABLE_STAFF
		2. TABLE_STOCK
		3. TABLE_COUNTRY
		4. TABLE_AUTHOR
		5. TABLE_PUBLISHER
		6. TABLE_ACCOUNT
		7. TABLE_BOOK
		8. TABLE_CATEGORY
		9. TABLE_VOUCHER
		10.TABLE_SHIPPING
		11.TABLE_CART

		*/

		try {
			pg_query($con, TABLE_STAFF);
			pg_query($con, TABLE_STOCK);
			pg_query($con, TABLE_COUNTRY);
			pg_query($con, TABLE_AUTHOR);
			pg_query($con, TABLE_PUBLISHER);
			pg_query($con, TABLE_ACCOUNT);
			pg_query($con, TABLE_BOOK);
			pg_query($con, TABLE_CATEGORY);
			pg_query($con, TABLE_VOUCHER);
			pg_query($con, TABLE_SHIPPING);
			pg_query($con, TABLE_CART);

			echo "database migrated<br>";
		} catch (Exception $e) {
			echo "database migrate failed<br>";
		}

	}


	function init(){
		$con = connect();
		if($con){
			migrate($con);
			return $con;
		}
		echo "unable to migrate with database<br>";
	}

?>