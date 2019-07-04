<?php

	include 'base.php';
   unset($_SESSION["userid"]);
   unset($_SESSION["password"]);
   unset($_SESSION["valid"]);
   
   echo 'You have cleaned session';
   header('Refresh: 0; URL = index.php');
?>