<?php 

	/**
	 * 
	 */
	class Item
	{
		private $book_isbn;
		private $book_price;
		private $copy;

		public function Item($book_isbn,$book_price){
			$this->book_isbn = $book_isbn;
			$this->book_price = $book_price;
			$this->copy = 1;
		}
		public function getBookISBN(){
			return $this->book_isbn;
		}
		public function getTotal(){
			return $this->book_price*$this->copy;
		}
		public function addCopy(){
			$this->copy = $this->copy+1;
		}
		public function removeCopy(){
			if($this->copy==0)
				return;
			$this->copy = $this->copy - 1;
		}
	}
 ?>