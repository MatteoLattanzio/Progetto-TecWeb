<?php
	require_once "dbhandler.php";
	if (!isset($_SESSION)) {
		session_start();
	}
	if (!isset($_SESSION["username"])) {
		header("Location: login.php");
		exit();
	}
	$connessione = connessione();
	$username=$_SESSION["username"];
	$user=mysqli_fetch_array($connessione->query("SELECT * FROM utenti WHERE username='$username';"));
	$psw=$user["password"];
	$nome=$user["nome"];
	$cognome=$user["cognome"];
	if(isset($_POST["modifica"])){
		$newN=$nome;
		$newS=$cognome;
		$newP=$psw;
		if(isset($_POST["name"]) && $_POST["name"]!='')
			$newN=$_POST["name"];
		if(isset($_POST["surname"]) && $_POST["surname"]!='')
			$newS=$_POST["surname"];
		if(isset($_POST["password"]) && $_POST["password"]!='')
			$newP=$_POST["password"];
		$result=$connessione->query("UPDATE utenti SET nome='$newN',cognome='$newS',password='$newP' WHERE username='$username';");
		if($result){
			header("Location: profile.php?correct=true");
			exit();
		}else{
			header("Location: profile.php?error=".urlencode($connessione->error));
			exit();
		}
	}
?>