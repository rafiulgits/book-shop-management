CREATE TABLE IF NOT EXISTS contact (
	id SERIAL NOT NULL PRIMARY KEY,
	firstName VARCHAR(30) NOT NULL,
	lastName VARCHAR(30) NOT NULL,
	city VARCHAR(20) NOT NULL,
	age INT NOT NULL
);


CREATE TABLE IF NOT EXISTS phonebook (
	countryCode VARCHAR(3) NOT NULL,
	phone BIGINT NOT NULL PRIMARY KEY,
	contact_id INT REFERENCES contact(id)
);


INSERT INTO contact(firstName, lastName, city, age) VALUES ('Rafiul', 'Islam', 'Sylhet', 21);
INSERT INTO contact(firstName, lastName, city, age) VALUES ('Anik', 'Ahmed', 'Sylhet', 21);
INSERT INTO contact(firstName, lastName, city, age) VALUES ('Shariful', 'Islam', 'Dubai', 32);
INSERT INTO contact(firstName, lastName, city, age) VALUES ('Pritom', 'Kumar', 'Dhaka', 17);
INSERT INTO contact(firstName, lastName, city, age) VALUES ('Arif', 'Mohammad', 'Brahmanbaria', 24);
INSERT INTO contact(firstName, lastName, city, age) VALUES ('Nayeem', 'Ahmed', 'Chattagram', 23);
INSERT INTO contact(firstName, lastName, city, age) VALUES ('Shihab', 'Uddin', 'Dhaka', 21);
INSERT INTO contact(firstName, lastName, city, age) VALUES ('Ali Akram', 'Mahin', 'Sylhet', 22);


INSERT INTO phonebook VALUES ('880', 1777777777, 1);
INSERT INTO phonebook VALUES ('880', 1733333333, 1);
INSERT INTO phonebook VALUES ('880', 1711111111, 2);
INSERT INTO phonebook VALUES ('880', 1611111111, 2);
INSERT INTO phonebook VALUES ('971', 555444222, 3);
INSERT INTO phonebook VALUES ('880', 1788888888, 4);
INSERT INTO phonebook VALUES ('880', 1722222222, 5);
INSERT INTO phonebook VALUES ('880', 1622222222, 5);
INSERT INTO phonebook VALUES ('880', 1521212121, 6);
INSERT INTO phonebook VALUES ('880', 1821212121, 6);
INSERT INTO phonebook VALUES ('880', 1521404040, 7);
INSERT INTO phonebook VALUES ('880', 1729292929, 7);
INSERT INTO phonebook VALUES ('880', 1782828282, 8);


-- DISTINCT, COUNT
SELECT DISTINCT city FROM contact;
SELECT COUNT(DISTINCT city) FROM contact;


-- WHERE, ILIKE, AND, OR, NOT, IN, BETWEEN
SELECT firstName, lastName FROM contact WHERE city = 'Sylhet';
SELECT firstName, lastName FROM contact WHERE city ILIKE 'sylHeT';
SELECT CONCAT(firstName, ' ', lastName) "Name" FROM contact WHERE city ILIKE 'SyLHeT';
SELECT CONCAT(firstName, ' ', lastName) "Name" FROM contact WHERE age<18 AND (city ILIKE 'dHakA' OR city ILIKE 'SyLHeT');
SELECT CONCAT(firstName, ' ', lastName) "Name" FROM contact WHERE city NOT ILIKE 'SyLHeT';
SELECT CONCAT(firstName, ' ', lastName) "Name", age FROM contact ORDER BY age ASC;
SELECT CONCAT(firstName, ' ', lastName) "Name", city FROM contact WHERE city IN ('Sylhet', 'Dhaka');
SELECT CONCAT(firstName, ' ', lastName) "Name", age FROM contact WHERE age BETWEEN 18 AND 28 ORDER BY age ASC;

-- MAX, MIN, AVG, SUM
SELECT MAX(age) FROM contact;
SELECT MIN(age) FROM contact;
SELECT AVG(age) FROM contact;
SELECT SUM(age) FROM contact;

-- UNION
SELECT id FROM contact UNION SELECT contact_id FROM phonebook;
SELECT id FROM contact UNION ALL SELECT contact_id FROM phonebook;


-- GROUP BY (FREQUENCY), HAVING
SELECT age, COUNT(age) "Frequent" FROM contact GROUP BY age ORDER BY "Frequent" DESC;
SELECT age, COUNT(age) "Frequent" FROM contact GROUP BY age ORDER BY "Frequent" DESC, age ASC;
SELECT city, COUNT(city) "Living" FROM contact GROUP BY city ORDER BY "Living" DESC;
SELECT city, COUNT(city) "Living" FROM contact GROUP BY city HAVING COUNT(city)>=2 ORDER BY "Living" DESC;

-- INNER JOIN
SELECT CONCAT(contact.firstName, ' ', contact.lastName) "Name", CONCAT(phonebook.countryCode,' ', phonebook.phone) "Number" 
FROM contact INNER JOIN phonebook ON contact.id=phonebook.contact_id;

SELECT CONCAT(contact.firstName, ' ', contact.lastName) "Name", COUNT(contact.id) "Total Number" 
FROM contact INNER JOIN phonebook ON contact.id=phonebook.contact_id
GROUP BY "Name" ORDER BY "Total Number" DESC;

SELECT contact.id, CONCAT(contact.firstName, ' ', contact.lastName) "Name", COUNT(contact.id) "Total Number" 
FROM contact INNER JOIN phonebook ON contact.id=phonebook.contact_id 
GROUP BY "Name", contact.id ORDER BY contact.id ASC, "Total Number" DESC;
