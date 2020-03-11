<?php
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/dbhandler.php";
	require_once "php/server.php";
	$connessione=connessione();
	if(!isset($_SESSION))
		session_start();
	
	$output=file_get_contents("html/registrazione.html");
	$output=str_replace("<meta/>",file_get_contents("html/meta.html"),$output);
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("%err%",getErrorReg($errors),$output);
	
	echo $output;
?>
