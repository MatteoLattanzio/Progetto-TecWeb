<?php
require_once "dbhandler.php";
	if (!isset($_SESSION)) {
		session_start();
	}
//MESSAGE
	if(isset($_POST['invia'])){
		$nome = mysqli_real_escape_string($connessione,sanitizeString($_POST['nome']));
		$email = mysqli_real_escape_string($connessione,sanitizeString($_POST['email']));
		$oggetto = mysqli_real_escape_string($connessione,sanitizeString($_POST['oggetto']));
		$mess = mysqli_real_escape_string($connessione,sanitizeString($_POST['mess']));
		$cognome = mysqli_real_escape_string($connessione,sanitizeString($_POST['cognome']));
		$data = date("Y-m-d");


		if(empty($nome)){
			$errors['nome']="Nome richiesto";
		}
		if(empty($cognome)){
			$errors['cognome']="Cognome richiesto";
		}
		if(empty($email)){
			$errors['email']="Email richiesta";
		}
		if($oggetto==""){
			$errors['oggetto']="Seleziona oggetto";
		}
		if(empty($mess)){
			$errors['mess']="Inserisci un testo";
		}
		if(count($errors)==0){

			$result=$connessione->query("INSERT INTO messaggi (email, data, oggetto, testo, nome,cognome) 
                              VALUES('$email','$data', '$oggetto', '$mess', '$nome', '$cognome')");
			
		}	
		
		
	}

?>