<?php

	include 'base.php';
	if(isset($_SESSION['userid'])){
		unset($_SESSION["userid"]);
		unset($_SESSION["password"]);
		unset($_SESSION['is_stuff']);
		unset($_SESSION['is_admin']);
		unset($_SESSION["valid"]);

		header('Refresh: 0; URL = index.php');
	}
	else{
		header('Refresh: 0; URL = signin.php');
	}
	
?>