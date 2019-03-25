# :page_with_curl: SWE328
#### Database management project with PHP web development framework and PostgreSQL database
***
<h1 align="center">
 <a href=https://github.com/rafiulgits/swe328/wiki>Wikis</a>

</h1>

***
### Requirement:
 * [XAMPP](https://www.apachefriends.org/download.html)
 * [PostgreSQL](https://www.enterprisedb.com/downloads/postgres-postgresql-downloads)
 
***
### setup:
copy the repository in `xampp/htdoc/swe328`

open `xampp/htdoc/php/php.ini-development` the file in a text editor and jump line `912` and `914` (in my case) this will seem like this

```
;extension=php_openssl.dll
;extension=php_pdo_firebird.dll
;extension=php_pdo_mysql.dll
;extension=php_pdo_oci.dll
;extension=php_pdo_odbc.dll
;extension=php_pdo_pgsql.dll
;extension=php_pdo_sqlite.dll
;extension=php_pgsql.dll
;extension=php_shmop.dll
```

remove the `;` from `extension=php_pdo_pgsql.dill` and `extension=php_pgsql.dll` . For windows the extension will be `.dll` and for linux this will be `.so` 

open xampp and start Apache. Now php can connect will PostgreSQL with its functions.
***

#### Open postgresql terminal and login with default postgresql account and create a new role with password and permission

```
CREATE ROLE anonymous;
ALTER ROLE projectdb WITH PASSWORD 'pass1234';
ALTER ROLE projectdb WITH LOGIN;
ALTER ROLE projectdb WITH CREATEDB;
```

close the terminal and reopen it and login with this new created role and create a new database and checkout the owner
```
CREATE DATABASE projectdb;
\l
```
[Find out more command in wiki](https://github.com/rafiulgits/swe328/wiki)
