<?php 

const GET_ALL_BOOKS = "CREATE OR REPLACE FUNCTION getAllBooks()
RETURNS TABLE(isbn bigint, book varchar, edition smallint, author varchar,publisher varchar,category varchar, price numeric, lang varchar, available int)
LANGUAGE plpgsql AS $$
BEGIN
	RETURN QUERY 
	SELECT book.isbn,book.name,book.edition,author.name,publisher.name,category.name,book.price,lang.name,stock.entry_copy-stock.sold_copy
	FROM book 
	INNER JOIN author ON book.author_id=author.id
	INNER JOIN publisher ON book.publisher_id=publisher.id
	INNER JOIN category ON book.category_id=category.id
	INNER JOIN stock ON book.stock_id=stock.id
	INNER JOIN lang ON book.language_id=lang.id;
END;
$$";


const GET_ALL_CATEGORIES = "CREATE OR REPLACE FUNCTION getCategories()
RETURNS TABLE(id int, name varchar, available bigint)
LANGUAGE plpgsql AS $$
BEGIN
	RETURN QUERY
	SELECT category.id, category.name, count(book.category_id)
	FROM category 
	LEFT JOIN book ON category.id=book.category_id
	GROUP BY category.id;
END;
$$";

const GET_ALL_COUNTRIES = "CREATE OR REPLACE FUNCTION getCountries()
RETURNS TABLE(id int, name varchar)
LANGUAGE plpgsql AS $$
BEGIN
	RETURN QUERY
	SELECT country.id, country.name
	FROM country;
END;
$$";

const GET_ALL_LANGUAGES = "CREATE OR REPLACE FUNCTION getLanguages()
RETURNS TABLE(id int, name varchar, available bigint)
LANGUAGE plpgsql AS $$
BEGIN
	RETURN QUERY
	SELECT lang.id, lang.name, count(book.language_id)
	FROM lang
	LEFT JOIN book ON lang.id=book.language_id
	GROUP BY lang.id;
END;
$$";


const GET_ALL_PUBLISHERS = "CREATE OR REPLACE FUNCTION getPublishers()
RETURNS TABLE(id int, name varchar, available bigint)
LANGUAGE plpgsql AS $$
BEGIN
	RETURN QUERY
	SELECT publisher.id, publisher.name, count(book.publisher_id)
	FROM publisher
	LEFT JOIN book ON publisher.id=book.publisher_id
	GROUP BY publisher.id;
END;
$$";


const GET_ALL_AUTHORS = "CREATE OR REPLACE FUNCTION getAuthors()
RETURNS TABLE(id int, name varchar, available bigint)
LANGUAGE plpgsql AS $$
BEGIN
	RETURN QUERY
	SELECT author.id, author.name, count(book.author_id)
	FROM author
	LEFT JOIN book ON author.id=book.author_id
	GROUP BY author.id;
END;
$$";


const GET_BOOK_STOCKS ="CREATE OR REPLACE FUNCTION getBookStocks()
RETURNS TABLE(isbn bigint,book varchar,edition smallint,price numeric,
			stock_id int, entry_copy int, sold_copy int, expenditure numeric,
			staff_id int, staff_name varchar, entry_date date, entry_time time)
LANGUAGE plpgsql AS $$
BEGIN
	RETURN QUERY 
	SELECT 
		book.isbn,book.name,book.edition,book.price,
		stock.id,stock.entry_copy,stock.sold_copy,stock.expenditure,
		account.id,account.name,stock.entry_date,stock.entry_time
	FROM stock 
	INNER JOIN book ON stock.id=book.stock_id
	INNER JOIN account ON account.id=stock.entry_by;
END;
$$";


?>