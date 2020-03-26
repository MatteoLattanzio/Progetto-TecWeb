<?php
require_once "dbhandler.php";
	$connessione=connessione();
	if (!isset($_SESSION)) {
		session_start();
	}

    $idImg = $_GET["id"];
    $action = $_GET["action"];
    
    $user=$_SESSION['username'];


    if($action=="like")
        $result=$connessione->query("INSERT INTO `piaciuti` (foto, utente) VALUES('$idImg','$user')");
    else
        $result=$connessione->query("DELETE FROM `piaciuti` WHERE foto='$idImg' AND utente='$user' ");
       
    $result=$connessione->query("SELECT COUNT(utente) FROM `piaciuti` WHERE foto='$idImg'");
    $cat=$result->fetch_assoc();
    
    echo $cat['COUNT(utente)'];
    
?>
