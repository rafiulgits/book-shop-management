<?php 

	require_once 'tables.php';
	require_once 'procedures.php';
	require_once 'functions.php';
/**
* 
*/

class DB {

	private $_ref;
	private static $_instance = NULL;

	private  function DB(){
		try {
			$this->_ref = @pg_connect("host=localhost port=5432 dbname=bookservicedb user=swe328 password=pass1234");
			$this->migrateTable();
			$this->migrateProcedure();
			$this->migrateFunction();
		} catch (Exception $e) {
			$this->_ref = NULL;
		}
	}

	private function migrateTable(){
		/*
		migration chain
		----------------
		
		1. TABLE_ACCOUNT
		2. TABLE_STOCK
		3. TABLE_COUNTRY
		4. TABLE_AUTHOR
		5. TABLE_PUBLISHER
		6. TABLE_CATEGORY
		7. TABLE_LANGUAGE
		8. TABLE_BOOK
		9. TABLE_ORDER
		10.TABLE_CART
		*/

		try {
			pg_query($this->_ref, TABLE_ACCOUNT);
			pg_query($this->_ref, TABLE_STOCK);
			pg_query($this->_ref, TABLE_COUNTRY);
			pg_query($this->_ref, TABLE_AUTHOR);
			pg_query($this->_ref, TABLE_PUBLISHER);
			pg_query($this->_ref, TABLE_CATEGORY);
			pg_query($this->_ref, TABLE_LANGUAGE);
			pg_query($this->_ref, TABLE_BOOK);
			pg_query($this->_ref, TABLE_VOUCHER);
		    pg_query($this->_ref, TABLE_CART);


		} catch (Exception $e) {
			echo "failed to migrated with tables <br>";
		}
	}

	private function migrateProcedure(){
		try {
			pg_query($this->_ref, CREATE_ACCOUNT);
			pg_query($this->_ref, ADD_COUNTRY);
			pg_query($this->_ref, ADD_AUTHOR);
			pg_query($this->_ref, ADD_PUBLISHER);
			pg_query($this->_ref, ADD_CATEGORY);
			pg_query($this->_ref, ADD_LANGUAGE);
			pg_query($this->_ref, ADD_BOOK);
			pg_query($this->_ref, UPDATE_BOOK);
			pg_query($this->_ref, UPDATE_AUTHOR);
			pg_query($this->_ref, UPDATE_PUBLISHER);

		} catch (Exception $e) {
			echo "failed to migrated with procedures <br>";
		}
	}

	private function migrateFunction(){
		try {
			pg_query($this->_ref, GET_ALL_BOOKS);
			pg_query($this->_ref, GET_ALL_CATEGORIES);
			pg_query($this->_ref, GET_ALL_COUNTRIES);
			pg_query($this->_ref, GET_ALL_LANGUAGES);
			pg_query($this->_ref, GET_ALL_PUBLISHERS);
			pg_query($this->_ref, GET_ALL_AUTHORS);
			pg_query($this->_ref, GET_BOOK_STOCKS);

		} catch (Exception $e){
			echo "failed to migrated with functions <br>";
		}
	}

	public static function connection(){
		if(self::$_instance == NULL){
			self::$_instance = new DB();
		}
		return self::$_instance;
	}

	public function getRefference(){
		return $this->_ref;
	}
}


 ?>