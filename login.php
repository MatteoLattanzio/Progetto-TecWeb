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
	
	$output=file_get_contents("html/login.html");
	$output=str_replace("<meta/>",file_get_contents("html/meta.html"),$output);
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("%err%",getErrorLogin($errors),$output);
	$output=str_replace("%err2%",getErrorReg($errors),$output);
	
	echo $output;
?>
