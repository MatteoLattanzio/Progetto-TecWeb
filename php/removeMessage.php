<?php
	$connessione=connessione();
    if (!isset($_SESSION)) {
        session_start();
    }
	if(isset($_POST['rimuovi-messaggio'])){
		$id=$_POST["id"];
		$result=$connessione->query("DELETE FROM `messaggi` WHERE id='$id'");
	}
?>