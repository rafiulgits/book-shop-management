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



	const ADD_LANGUAGE = "CREATE OR REPLACE PROCEDURE addLanguage(_name varchar(10))
		LANGUAGE plpgsql AS 
		$$
		DECLARE
			_exist int := 0;
		BEGIN
			SELECT COUNT(id) FROM lang WHERE name ILIKE _name INTO _exist;
			IF _exist > 0 THEN
				RAISE NOTICE 'country already exists';
			ELSE
				INSERT INTO lang(name) VALUES(_name);
			END IF;
		END;
		$$";



	const ADD_BOOK = "CREATE OR REPLACE PROCEDURE addBook(
			name varchar(50),
			_isbn bigint,
			edition smallint,
			category_id int,
			author_id int,
			publisher_id int,
			language_id int,
			price numeric(7,2),
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

				INSERT INTO book(name,isbn,edition,category_id,author_id,publisher_id,price,stock_id,language_id)
				VALUES(name,_isbn,edition,category_id,author_id,publisher_id,price,_stock_id,language_id);
				RAISE NOTICE 'success';
			END IF;
		END;
		$$";



	const UPDATE_BOOK = "CREATE OR REPLACE PROCEDURE updateBook(
			_name varchar(50),
			_isbn bigint,
			_pre_isbn bigint,
			_edition smallint,
			_category_id int,
			_author_id int,
			_publisher_id int,
			_language_id int,
			_price numeric(7,2)
		)
	  
		LANGUAGE plpgsql AS
		$$
		DECLARE
			_exist_isbn int := 0;
			_stock_isbn int := 0;
		BEGIN
			SELECT COUNT(isbn) FROM book WHERE isbn=_pre_isbn INTO _exist_isbn;
			SELECT COUNT(isbn) FROM book WHERE isbn=_isbn INTO _stock_isbn;

			IF _exist_isbn = 0 THEN
				RAISE NOTICE 'no book exist on this ISBN';
			ELSIF _isbn != _pre_isbn AND _stock_isbn > 0 THEN
				RAISE NOTICE 'book is already added'; 
			ELSE
				UPDATE book SET name=_name WHERE isbn=_pre_isbn;
				UPDATE book SET edition=_edition WHERE isbn=_pre_isbn;
				UPDATE book SET category_id=_category_id WHERE isbn=_pre_isbn;
				UPDATE book SET author_id=_author_id WHERE isbn=_pre_isbn;
				UPDATE book SET publisher_id=_publisher_id WHERE isbn=_pre_isbn;
				UPDATE book SET language_id=_language_id WHERE isbn=_pre_isbn;
				UPDATE book SET price=_price WHERE isbn=_pre_isbn;
				UPDATE book SET isbn=_isbn WHERE isbn=_pre_isbn;
				RAISE NOTICE 'success';
			END IF;
		END;
		$$;";

	const UPDATE_AUTHOR = "CREATE or REPLACE PROCEDURE updateAuthor(
								_author_id int,
								_author_name varchar(30),
								_author_bio varchar(50) 

		) 
		LANGUAGE plpgsql AS 
		$$
			DECLARE
				_author_count int:=0;
			BEGIN
				SELECT COUNT(id) FROM author WHERE id = _author_id INTO _author_count;
				IF _author_count = 0 THEN
					RAISE NOTICE 'noo author exist on this author id';
				ELSE 
					UPDATE author SET name = _author_name WHERE id = _author_id;
					UPDATE author SET bio = _author_bio WHERE id = _author_id;
					RAISE  NOTICE 'success';
				END IF;
			END;
		$$;";

		const UPDATE_PUBLISHER = "CREATE or REPLACE PROCEDURE updatePublisher(
									_publisher_id int,
									_publisher_name varchar(30)
		)
		LANGUAGE plpgsql AS
		$$
			DECLARE _publisher_count int:=0;
			BEGIN
				SELECT COUNT(id) FROM publisher WHERE id = _publisher_id INTO _publisher_count;
				IF _publisher_count = 0 THEN
					RAISE NOTICE 'noo publisher exist on this publisher id';
				ELSE 
					UPDATE publisher set name = _publisher_name WHERE id = _publisher_id;
				END IF;
			END;
		$$;";

?>