<?php
require_once "dbhandler.php";
	$connessione=connessione();
	if (!isset($_SESSION)) {
		session_start();
	}

    $idImg = $_GET["id"];
    $action = $_GET["action"];
    
    $user=$_SESSION['username'];


    if($action=="aggiungi-preferiti")
        $result=$connessione->query("INSERT INTO `preferiti` (foto, utente) VALUES('$idImg','$user')");
    else
        $result=$connessione->query("DELETE FROM `preferiti` WHERE foto='$idImg' AND utente='$user' ");
       
    
    
?>
