<?php
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/dbhandler.php";
	require_once "php/loadImg.php";
	
	$connessione=connessione();
	if(!isset($_SESSION))
		session_start();

	if(isset($_SESSION['username'])){
		$output=file_get_contents("html/vendi.html");
	}
	else{
		$output=file_get_contents("html/vendi_sample.html");

	}
	$output=str_replace("<meta/>", file_get_contents("html/meta.html"), $output);
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);

	echo $output;
?>