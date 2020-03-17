<?php
//MESSAGE
	if(isset($_POST['invia'])){
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$oggetto = $_POST['oggetto'];
		$mess = $_POST['mess'];
		$cognome = $_POST['cognome'];
		$data = date('m/d/Y');


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
		
			$result=$connessione->query("INSERT INTO messaggi (email, data, oggetto, testo, nome,cognome) 
                              VALUES('$email','$data', '$oggetto', '$mess', '$nome', '$cognome')");
			$query="INSERT INTO messaggi (email, data, oggetto, testo, nome,cognome) 
			VALUES('$email','$data', '$oggetto', '$mess', '$nome', '$cognome')";
			echo $query;
			
		
		
	}

?>