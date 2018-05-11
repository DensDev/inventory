<?php

	$server = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'barang';
	mysql_connect($server, $user, $pass); 
	mysql_select_db($db) or die ("Connect Failed !! : ".mysql_error()); 

?>