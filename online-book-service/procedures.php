<?php 

	const CREATE_ACCOUNT ="CREATE OR REPLACE PROCEDURE createAccount(
			name varchar(80),
			_phone varchar(11),
			_email varchar(45),
			gender varchar(1),
			is_stuff bool,
			is_admin bool,
			address varchar(30),
			password varchar(32)
		)
		LANGUAGE plpgsql AS 
		$$
		DECLARE
			exist int := 0;
		BEGIN
			SELECT COUNT(id) FROM account WHERE phone ILIKE _phone OR email ILIKE _email INTO exist;
			IF exist > 0 THEN
				RAISE NOTICE 'some information already taken';
			ELSE
				INSERT INTO account(name,phone,email,gender,is_stuff,is_admin,address,password)
				VALUES (name,_phone,_email,gender,is_stuff,is_admin,address,password);
			END IF;
		END;
		$$";

	const ADD_AUTHOR = "CREATE OR REPLACE PROCEDURE addAuthor(name varchar(30),bio varchar(50))
		LANGUAGE SQL
		AS $$
			INSERT INTO author(name, bio) VALUES(name, bio)
		$$";

	const ADD_COUNTRY = "CREATE OR REPLACE PROCEDURE addCountry(_name varchar(2))
		LANGUAGE plpgsql AS 
		$$
		DECLARE
			_exist int := 0;
		BEGIN
			SELECT COUNT(id) FROM country WHERE name ILIKE _name INTO _exist;
			IF _exist > 0 THEN
				RAISE NOTICE 'country already exists';
			ELSE
				INSERT INTO country(name) VALUES(_name);
			END IF;
		END;
		$$";

	const ADD_PUBLISHER = "CREATE OR REPLACE PROCEDURE addPublisher(name varchar(30),country_id int)
		LANGUAGE SQL
		AS $$
			INSERT INTO publisher(name, country_id) VALUES(name, country_id);
		$$";

	const ADD_CATEGORY = "CREATE OR REPLACE PROCEDURE addCategory(_name varchar(15))
		LANGUAGE plpgsql AS
		$$
		DECLARE
			_exist int := 0;
		BEGIN
			SELECT COUNT(id) FROM category WHERE name ILIKE _name INTO _exist;
			IF _exist > 0 THEN
				RAISE NOTICE 'category already taken';
			ELSE
				INSERT INTO category(name) VALUES(_name);
			END IF;
		END;
		$$";


	const ADD_BOOK = "CREATE OR REPLACE PROCEDURE addBook(
			name varchar(50),
			lang varchar(2),
			price numeric(7,2),
			edition smallint,
			_isbn bigint,
			category_id int,
			author_id int,
			publisher_id int,
			entry_copy int,
			entry_by int
		)
	  
		LANGUAGE plpgsql AS
		$$
		DECLARE
			_exist_isbn int := 0;
			_stock_id int := -1;
		BEGIN
			SELECT COUNT(isbn) FROM book WHERE isbn=_isbn INTO _exist_isbn;
			IF _exist_isbn > 0 THEN
				RAISE NOTICE 'book already added';
			ELSE
				INSERT INTO stock(entry_copy,expenditure,entry_by) 
				VALUES(entry_copy,price*entry_copy,entry_by) RETURNING ID INTO _stock_id;

				INSERT INTO book(name,language,price,edition,isbn,category_id,publisher_id,author_id,stock_id)
				VALUES(name,lang,price,edition,_isbn,category_id,publisher_id,author_id,_stock_id);
			END IF;
		END;
		$$";



	function createProcudures($con){
		try {
			pg_query($con, CREATE_ACCOUNT);
			pg_query($con, ADD_COUNTRY);
			pg_query($con, ADD_AUTHOR);
			pg_query($con, ADD_PUBLISHER);
			pg_query($con, ADD_CATEGORY);
			pg_query($con, ADD_BOOK);
			// pg_query($con, TABLE_VOUCHER);
			// pg_query($con, TABLE_SHIPPING);
			// pg_query($con, TABLE_CART);

			echo "procedures created<br>";
		} catch (Exception $e) {
			echo "failed<br>";
		}
	}

	// const ADD_BOOK = "CREATE OR REPLACE PROCEDURE addBook(
	// 		name varchar(50),
	// 		language varchar(2),
	// 		price numeric(7,2),
	// 		edition smallint, 
	// 		isbn bigint, 
	// 		category_id int,
	// 		author_id int,
	// 		publisher_id int,
	// 		entry_copy int,
	// 		account_id int
	// 	)

	// 	LANGUAGE SQL
	// 	AS $$
	// 		INSERT INTO stock(entry_copy, expenditure, staff_id) 
	// 		VALUES (entry_copy, 1000, staff_id) RETURNING id;

	// 		SELECT

	// 	$$";

?>