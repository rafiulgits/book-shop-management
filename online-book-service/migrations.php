<?php 
	
	const host = "localhost";
	const port = "5432";
	const user = "swe328";
	const password = "pass1234";
	const dbname = "bookservicedb";


	/*
		TABLE SQL
	*/

	const TABLE_ACCOUNT ="CREATE TABLE IF NOT EXISTS account (
		id serial PRIMARY KEY,
		name varchar(80) NOT NULL,
		phone varchar(11) NOT NULL UNIQUE,
		email varchar(45) NOT NULL UNIQUE,
		gender varchar(1) NOT NULL,
		password varchar(32) NOT NULL,
		is_stuff bool NOT NULL DEFAULT FALSE,
		is_admin bool NOT NULL DEFAULT FALSE,
		address varchar(50)
	)";

	const TABLE_STOCK ="CREATE TABLE  IF NOT EXISTS stock (
		id serial PRIMARY KEY,
		entry_copy int NOT NULL,
		enpenditure numeric(10,2) NOT NULL,
		sold_copy int NOT NULL DEFAULT 0,
		entry_by int REFERENCES account(id)
	)";

	const TABLE_COUNTRY ="CREATE TABLE  IF NOT EXISTS country (
		id serial PRIMARY KEY,
		name varchar(2) NOT NULL UNIQUE
	)";

	const TABLE_AUTHOR ="CREATE TABLE  IF NOT EXISTS author (
		id serial PRIMARY KEY,
		name varchar(30) NOT NULL,
		bio varchar(50)
	)";

	const TABLE_PUBLISHER ="CREATE TABLE  IF NOT EXISTS publisher (
		id serial PRIMARY KEY,
		name varchar(30) NOT NULL,
		country_id int NOT NULL REFERENCES country(id)
	)";

	const TABLE_CATEGORY ="CREATE TABLE  IF NOT EXISTS category (
		id serial PRIMARY KEY,
		name varchar(15) NOT NULL UNIQUE
	)";

	const TABLE_LANGUAGE ="CREATE TABLE IF NOT EXISTS language (
		id smallint PRIMARY KEY,
		name varchar(10) NOT NULL UNIQUE
	)";

	const TABLE_BOOK ="CREATE TABLE  IF NOT EXISTS book (
		name varchar(50) NOT NULL,
		price numeric(7,2) NOT NULL,
		isbn bigint PRIMARY KEY,
		edition smallint NOT NULL,
		category_id int REFERENCES category(id),
		author_id int REFERENCES author(id),
		publisher_id int REFERENCES publisher(id),
		language_id smallint REFERENCES language(id),
		stock_id int REFERENCES stock(id)
	)";

	const TABLE_VOUCHER ="CREATE TABLE  IF NOT EXISTS voucher (
		voucher_id bigint PRIMARY KEY,
		total_price int NOT NULL,
		quantity smallint NOT NULL,
		account_id varchar(12) REFERENCES account(phone)
	)";

	const TABLE_CART = "CREATE TABLE IF NOT EXISTS cart(
		voucher_id bigint REFERENCES voucher(voucher_id),
		book_isbn bigint REFERENCES book(isbn) 
	)";

	const TABLE_SHIPPING ="CREATE TABLE  IF NOT EXISTS shipping (
		area varchar(12) NOT NULL,
		address varchar(30) NOT NULL,
		sDate DATE NOT NULL,
		sTime TIME NOT NULL,
		status boolean NOT NULL,
		voucher_id bigint REFERENCES voucher(voucher_id)
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
		
		1. TABLE_ACCOUNT
		2. TABLE_STOCK
		3. TABLE_COUNTRY
		4. TABLE_AUTHOR
		5. TABLE_PUBLISHER
		6. TABLE_CATEGORY
		7. TABLE_LANGUAGE
		8. TABLE_BOOK
		9. TABLE_VOUCHER
		10.TABLE_CART
		11.TABLE_SHIPPING

		*/

		try {
			pg_query($con, TABLE_ACCOUNT);
			pg_query($con, TABLE_STOCK);
			pg_query($con, TABLE_COUNTRY);
			pg_query($con, TABLE_AUTHOR);
			pg_query($con, TABLE_PUBLISHER);
			pg_query($con, TABLE_CATEGORY);
			pg_query($con, TABLE_LANGUAGE);
			pg_query($con, TABLE_BOOK);
			// pg_query($con, TABLE_VOUCHER);
			// pg_query($con, TABLE_SHIPPING);
			// pg_query($con, TABLE_CART);

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