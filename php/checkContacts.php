<?php
require_once "dbhandler.php";
	if (!isset($_SESSION)) {
		session_start();
	}
//MESSAGE
	if(isset($_POST['invia'])){
		$nome = mysqli_real_escape_string($connessione,sanitizeString($_POST['nome']));
		$email = mysqli_real_escape_string($connessione,sanitizeString($_POST['email']));
		if(isset($_POST['oggetto']) && $_POST['oggetto']!=""){
			$oggetto = mysqli_real_escape_string($connessione,sanitizeString($_POST['oggetto']));
		}else
			$errors['oggetto']="Seleziona oggetto del messaggio";
		$mess = mysqli_real_escape_string($connessione,sanitizeString($_POST['mess']));
		$cognome = mysqli_real_escape_string($connessione,sanitizeString($_POST['cognome']));
		$data = date("Y-m-d");
		if(empty($nome)){
			$errors['nome']="Inserisci il tuo nome";
		}
		if(empty($cognome)){
			$errors['cognome']="Inserisci il tuo cognome";
		}
		if(empty($email)){
			$errors['email']="Inserisci un'email valida";
		}
		if(empty($mess)){
			$errors['mess']="Scrivi un testo per il tuo messaggio";
		}
		if(count($errors)==0){
			$result=$connessione->query("INSERT INTO messaggi (email, data, oggetto, testo, nome,cognome) 
								VALUES('$email','$data', '$oggetto', '$mess', '$nome', '$cognome')");
			header("Location: sent.php");
		}		
	}
?>