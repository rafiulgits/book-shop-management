<?php
   include 'base.php';

   unset($_SESSION["userid"]);
   unset($_SESSION["password"]);
   unset($_SESSION["valid"]);
   
   echo 'You have cleaned session';
   // header('Refresh: 2; URL = signin.php');
?>