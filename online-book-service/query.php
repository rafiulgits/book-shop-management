<?php

// search with category name
select isbn, name, edition, price from book where category_id = 
(select id from category where name ilike 'arts' limit 1);

// join author name with book information
select book.isbn, book.name, book.edition, book.price, author.name
from book inner join author on book.author_id=author.id;

// book info with author name filter by category name
select book.isbn, book.name, book.edition, book.price, author.name
from book inner join author on book.author_id=author.id
where book.category_id=(select id from category where name ilike 'arts' limit 1);

// book stock information
select book.isbn, book.name, book.edition, book.edition, stock.entry_copy, stock.sold_copy
from book inner join stock on book.stock_id = stock.id;

// book stock information customize with remaining copy
select book.isbn, book.name, book.edition,stock.entry_copy-stock.sold_copy as remain
from book inner join stock on book.stock_id = stock.id;


// book informations from multiple table using multiple join
select book.name,book.price,author.name,publisher.name
from book 
inner join author on book.author_id=author.id
inner join publisher on book.publisher_id=publisher.id;


// book information from multiple table filter by multiple keyword
select book.name,book.price,author.name,publisher.name
from book 
inner join author on book.author_id=author.id
inner join publisher on book.publisher_id=publisher.id
where 
	book.publisher_id=(select id from publisher where name ilike '%jono%' limit 1)
	and
	book.author_id=(select id from author where name ilike '%stark%');


// search book by price range
select book.name,book.price,author.name,publisher.name
from book 
inner join author on book.author_id=author.id
inner join publisher on book.publisher_id=publisher.id
where book.price>100 and book.price<=150;


// update book price with current price percentage (10% example)
update book
set price=(price-(price*0.10))
where price > 120;

?>