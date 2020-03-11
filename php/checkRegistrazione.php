<?php
//REGISTRAZIONE DEGLI UTENTI
	if(isset($_POST['registrazione'])){
		$nome=mysqli_real_escape_string($connessione,sanitizeString($_POST['nome']));
		$cognome=mysqli_real_escape_string($connessione,sanitizeString($_POST['cognome']));
		$username=mysqli_real_escape_string($connessione,sanitizeString($_POST['username']));
		$data=mysqli_real_escape_string($connessione,sanitizeString($_POST['data']));
		$indirizzo=mysqli_real_escape_string($connessione,sanitizeString($_POST['indirizzo']));
		$email=mysqli_real_escape_string($connessione,sanitizeString($_POST['email']));
		$password=mysqli_real_escape_string($connessione,sanitizeString($_POST['password']));
		$password_2=mysqli_real_escape_string($connessione,sanitizeString($_POST['passwordR']));
		if(empty($nome)){
			$errors['nome']="Nome richiesto";
		}
		if(empty($cognome)){
			$errors['cognome']="Cognome richiesto";
		}
		if(empty($data)){
			$errors['data']="Data di nascita richiesta";
		}
		if(empty($indirizzo)){
			$errors['indirizzo']="Indirizzo richiesto";
		}
		if(empty($password)){
			$errors['password']="Password richiesta";
		}
		if(empty($password_2)){
			$errors['password2']="Conferma password";
		}
		if($password != $password_2){
			$errors['password']="Le password non corrispondono";
		}
		if(strpos($email,'@') == false){
			$errors['email']="Fornire una mail valida";
		}
		if(strlen($password)<4){
			$errors['password']="La password deve contenere almeno 4 caratteri";
		}
		if(empty($username)){
			$errors['username']="Username richiesto";
		}
		else{
			$result=$connessione->query("SELECT * FROM `utenti` WHERE Username='$username';");
			$rows=mysqli_num_rows($result);
			if($rows>0){
				$errors['username']="Username non disponibile";
			}else if($password==$password_2){
				$query="INSERT INTO `utenti` (nome, cognome, data, indirizzo, username, password, email, tipo) 
					VALUES('$nome','$cognome', '$data', '$indirizzo', '$username', '$password', '$email', 'user')";
				$connessione->query($query);
				$_SESSION['username']=$username;
				$_SESSION['type']='user';	            
				//header("Location: profile.php");
			}
		}
	}//registrazione
?>