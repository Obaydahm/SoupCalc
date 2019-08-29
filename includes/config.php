<?php
	$dbc = new mysqli("localhost","root","","soup");
	$dbc->set_charset('utf8');
	session_start();
	date_default_timezone_set('Europe/Copenhagen');
?>
