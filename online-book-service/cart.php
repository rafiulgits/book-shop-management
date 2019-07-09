<?php include 'base.php'; ?>

<?php startblock('header') ?>
	<title>Cart</title>
<?php endblock() ?>


<?php 
	echo count($_SESSION['user_cart']);

 ?>