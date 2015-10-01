<?php 
$connect_error = 'Sorry, we\'re experiencing connection problem.';
	mysql_connect('localhost', 'root', 'csi4102') or die($connect_error);
	mysql_select_db('login_register') or die($connect_error);
?>