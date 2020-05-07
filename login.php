<?php
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/dbhandler.php";
	require_once "php/server.php";
	require_once "php/checkLogin.php";
	require_once "php/checkRegistrazione.php";
	
	$connessione=connessione();
	if(!isset($_SESSION))
		session_start();
	if(isset($_SESSION["username"]) && $_SESSION["type"]=="user"){
		header("Location: profile.php");
		exit();
	}else if(isset($_SESSION["username"]) && $_SESSION["type"]=="admin"){
		header("Location: admin.php");
		exit();
	}

	function paramMemory($output){
		if(isset($_POST['nome']))
			$output=str_replace("%nameVal%",$_POST['nome'],$output);
		else
			$output=str_replace("%nameVal%","",$output);

		if(isset($_POST['cognome']))
			$output=str_replace("%surnameVal%",$_POST['cognome'],$output);
		else
			$output=str_replace("%surnameVal%","",$output);

		if(isset($_POST['indirizzo']))
			$output=str_replace("%addVal%",$_POST['indirizzo'],$output);
		else
			$output=str_replace("%addVal%","",$output);

		if(isset($_POST['email']))
			$output=str_replace("%mailVal%",$_POST['email'],$output);
		else
			$output=str_replace("%mailVal%","",$output);

		if(isset($_POST['username']))
			$output=str_replace("%userVal%",$_POST['username'],$output);
		else
			$output=str_replace("%userVal%","",$output);

		if(isset($_POST['usernameLog']))
			$output=str_replace("%userLogVal%",$_POST['usernameLog'],$output);
		else
			$output=str_replace("%userLogVal%","",$output);
			
		return $output;
	}
	
	$output=file_get_contents("html/login.html");
	$output=str_replace("<meta/>",file_get_contents("html/meta.html"),$output);
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=paramMemory($output);
	$output=str_replace("%err%",getErrorLogin($errors),$output);
	$output=str_replace("%err2%",getErrorReg($errors),$output);
	
	echo $output;
?>
