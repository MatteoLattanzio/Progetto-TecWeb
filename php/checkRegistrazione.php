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
			$errors['nome']="Inserisci il tuo nome";
		}
		if(empty($cognome)){
			$errors['cognome']="Inserisci il tuo cognome";
		}
		if(empty($data)){
			$errors['data']="Inserisci la tua data di nascita";
		}
		if(empty($indirizzo)){
			$errors['indirizzo']="Inserisci il tuo indirizzo";
		}
		if(empty($password)){
			$errors['password']="Scegli una password";
		}
		if(empty($password_2)){
			$errors['password2']="Conferma la password";
		}
		if($password != $password_2){
			$errors['password']="Le password non corrispondono";
		}
		if(strpos($email,'@') == false){
			$errors['email']="Fornisci una mail valida";
		}
		if(strlen($password)<6){
			$errors['password']="La password deve contenere almeno 6 caratteri";
		}
		if(empty($username)){
			$errors['username']="Scegli uno username";
		}
		if(count($errors)==0){
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
				setcookie('done',true);
				if(isset($_SESSION["currPage"]))
					header("Location: ".$_SESSION["currPage"]);
				else	            
					header("Location: profile.php");
			}
		}
	}//registrazione
?>