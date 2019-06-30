<?php 

const getAllBooks = "CREATE OR REPLACE FUNCTION getAllBooks()
RETURNS TABLE(isbn bigint, book varchar,price numeric,author varchar,publisher varchar,category varchar,available int)
LANGUAGE plpgsql AS $$
BEGIN
	RETURN QUERY 
	SELECT book.isbn,book.name,book.price,author.name,publisher.name,category.name,stock.entry_copy-stock.sold_copy
	FROM book 
	INNER JOIN author ON book.author_id=author.id
	INNER JOIN publisher ON book.publisher_id=publisher.id
	INNER JOIN category ON book.category_id=category.id
	INNER JOIN stock ON book.stock_id=stock.id;
END;
$$";
// -- // SELECT * FROM getAllBooks();



const getAllCategories = "CREATE OR REPLACE FUNCTION getCategories()
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
// -- // SELECT * FROM getCategories();


const getBookStocks ="CREATE OR REPLACE FUNCTION getBookStocks()
RETURNS TABLE(isbn bigint,book varchar,edition smallint,price numeric,
			stock_id int, entry_copy int, sold_copy int, expenditure numeric,
			staff_id int, staff_name varchar)
LANGUAGE plpgsql AS $$
BEGIN
	RETURN QUERY 
	SELECT 
		book.isbn,book.name,book.edition,book.price,
		stock.id,stock.entry_copy,stock.sold_copy,stock.enpenditure,
		account.id,account.name
	FROM stock 
	INNER JOIN book ON stock.id=book.stock_id
	INNER JOIN account ON account.id=stock.entry_by;
END;
$$";
// -- // SELECT * FROM getBookStocks();
?>