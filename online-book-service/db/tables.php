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
		expenditure numeric(10,2) NOT NULL,
		sold_copy int NOT NULL DEFAULT 0,
		entry_by int REFERENCES account(id),
		entry_date date DEFAULT CURRENT_DATE,
		entry_time time DEFAULT CURRENT_TIME
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

	const TABLE_LANGUAGE ="CREATE TABLE IF NOT EXISTS lang (
		id serial PRIMARY KEY,
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
		language_id int REFERENCES lang(id),
		stock_id int REFERENCES stock(id)
	)";


	const TABLE_VOUCHER ="CREATE TABLE IF NOT EXISTS voucher (
		id serial PRIMARY KEY,
		total_price numeric(10,2) NOT NULL,
		name varchar(80) NOT NULL,
		phone varchar(11) NOT NULL,
		email varchar(45),
		address varchar(50) NOT NULL,
		status varchar(1) NOT NULL DEFAULT 'P',
		order_time time DEFAULT CURRENT_TIME,
		order_date date DEFAULT CURRENT_DATE
	)";


	const TABLE_CART = "CREATE TABLE IF NOT EXISTS cart(
		id serial PRIMARY KEY,
		book_isbn bigint REFERENCES book(isbn),
		book_price numeric(7,2),
		book_copy int NOT NULL,
		subtotal numeric(8,2),
		voucher_id int REFERENCES voucher(id)

	)";

?>