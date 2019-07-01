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
?>