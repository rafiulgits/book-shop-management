CREATE TABLE IF NOT EXISTS wiki (
	id SERIAL PRIMARY KEY,
	title VARCHAR(30) NOT NULL,
	body TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS draft (
	id SERIAL PRIMARY KEY,
	wiki_id INT REFERENCES wiki(id) NOT NULL,
	old_body TEXT NOT NULL,
	new_body TEXT NOT NULL
);


INSERT INTO wiki(title, body) VALUES ('about_bd', 'About Bangladesh Wiki : INSERTED');
INSERT INTO wiki(title, body) VALUES ('about_dhk', 'About Dhaka Wiki : INSERTED');
INSERT INTO wiki(title, body) VALUES ('about_syl', 'About Sylhet Wiki : INSERTED');


CREATE OR REPLACE FUNCTION request()
	RETURNS TRIGGER 
	LANGUAGE plpgsql AS

	$BODY$
	BEGIN
		IF NEW.body<>OLD.body THEN
			INSERT INTO draft(wiki_id, old_body, new_body) VALUES(OLD.id, OLD.body, NEW.body);
		END IF;
		RETURN NEW;
	END;
	$BODY$;


CREATE TRIGGER drafting
	BEFORE UPDATE ON wiki
	FOR EACH ROW
	EXECUTE PROCEDURE request();


UPDATE wiki SET body = 'Bangladesh is a small country with huge population' WHERE id=1;
SELECT * FROM draft;