<?php
	$connessione=connessione();
    if (!isset($_SESSION)) {
        session_start();
    }
	if(isset($_POST['rimuovi-immagine'])){
		$idImg=$_SESSION['img'];
		$user=$_SESSION['username'];
		$result=$connessione->query("DELETE FROM `carrello` WHERE foto='$idImg' AND utente='$user' ");
		$idImg="";
	}
	if(isset($_POST['svuota-carrello'])){
		$user=$_SESSION['username'];
		$result=$connessione->query("DELETE FROM `carrello` WHERE stato='in corso' AND utente='$user' ");
	}
		

?>	
