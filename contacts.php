<?php
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/dbhandler.php";
	require_once "php/server.php";

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

	function paramMemory($output){
		if(isset($_POST['nome']))
			$output=str_replace("%nome%",$_POST['nome'],$output);
		if(isset($_POST['cognome']))
			$output=str_replace("%cognome%",$_POST['cognome'],$output);
		if(isset($_POST['email']))
			$output=str_replace("%email%",$_POST['email'],$output);
		if(strlen($_POST['mess'])>0)
			$output=str_replace("%mess%",$_POST['mess'],$output);
		else
			$output=str_replace("%mess%","",$output);
		return $output;
	}

	$output=file_get_contents("html/contacts.html");
	$output=str_replace("<meta/>", file_get_contents("html/meta.html"), $output);
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("href=\"contacts.php\"", "", $output);
	$output=paramMemory($output);
	$output=str_replace("%email%",$email,$output);
	$output=str_replace("%nome%",$nome,$output);
	$output=str_replace("%cognome%",$cognome,$output);
	$output=str_replace("<h2 error/>",getErrorMessage($errors),$output);

	echo $output;

?>
