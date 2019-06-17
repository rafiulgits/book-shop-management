<?php 
	
	include './migrations.php';
	include './procedures.php';

	$connection = init();
	createProcudures($connection);
?>