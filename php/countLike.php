<?php
require_once "dbhandler.php";
	if (!isset($_SESSION)) {
		session_start();
	}


	function countLike($idImg){
		
		$connessione=connessione();
			
		$result=$connessione->query("SELECT COUNT(utente) FROM `piaciuti` WHERE foto='$idImg'");
    	$cat=$result->fetch_assoc();
    
    	return $cat['COUNT(utente)'];
    }
?>