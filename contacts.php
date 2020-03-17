<?php
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/dbhandler.php";
	$connessione=connessione();

	require_once "php/checkContacts.php";

	if (!isset($_SESSION)) {
		session_start();
	}
	$email="";
	$nome="";
	$cognome="";
	if(isset($_SESSION["username"])){
		$username=$_SESSION["username"];
		$connessione=connessione();
		$result=$connessione->query("SELECT * FROM utenti WHERE username='$username';");
		$utente=$result->fetch_assoc();
		$email=$utente["email"];
		$nome=$utente["nome"];
		$cognome=$utente["cognome"];
	
	}

	$output=file_get_contents("html/contacts.html");
	$output=str_replace("<meta/>", file_get_contents("html/meta.html"), $output);
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("href=\"contacts.php\"", "", $output);
	$output=str_replace("%email%",$email,$output);
	$output=str_replace("%nome%",$nome,$output);
	$output=str_replace("%cognome%",$cognome,$output);



	echo $output;

?>