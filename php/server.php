<?php
	require_once "php/dbhandler.php";
	$connessione=connessione();
	$errors=array();

//LOGIN
	if(isset($_POST['Login'])){
		$username = mysqli_real_escape_string($connessione,sanitizeString($_POST['username']));
		$password = mysqli_real_escape_string($connessione,sanitizeString($_POST['password']));
		if(empty($username)){
			$errors['usernameL']="Username richiesto";
		}
		if(empty($password)){
			$errors['passwordL']="Password richiesta";
		}
		if(count($errors)==0){
			$result=$connessione->query("SELECT * FROM `utenti` WHERE Username='$username' and Password='$password';");
			$rows=mysqli_num_rows($result);
			$ris=mysqli_fetch_assoc($result);
			if($rows==0)
				$errors['noUser']="Username o password errati";
			else if($rows==1){
				$tipo=$ris['tipo'];
				if(!isset($_SESSION))
					session_start();
				$_SESSION['username']=$username;
				if($tipo=='admin'){
					$_SESSION['type']='admin';
					header("Location: admin.php");
				}else
					$_SESSION['type']='user';
				header("Location: user.php");
			}
		}
	}//login


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
				header("Location: profile.php");
			}
		}
	}//registrazione
	
	function sanitizeString($string){
		return filter_var(trim($string), FILTER_SANITIZE_STRING);
	}
	
	function getErrorLogin($errors){
		$temp="<h2 class=\"error\">";
		if(isset($errors['usernameL']))
			return $temp.=$errors['usernameL']."</h2>";
		if(isset($errors['passwordL']))
			return $temp.=$errors['passwordL']."</h2>";
		if(isset($errors['noUser']))
			return $temp.=$errors['noUser'];
	}

	function getErrorReg($errors){
		$temp="<h2 class=\"error\">";
		if(isset($errors['nome']))
			return $temp.=$errors['nome']."</h2>";
		if(isset($errors['cognome']))
			return $temp.=$errors['cognome']."</h2>";
		if(isset($errors['data']))
			return $temp.=$errors['data']."</h2>";
		if(isset($errors['indirizzo']))
			return $temp.=$errors['indirizzo']."</h2>";
		if(isset($errors['email']))
			return $temp.=$errors['email']."</h2>";
		if(isset($errors['username']))
			return $temp.=$errors['username']."</h2>";
		if(isset($errors['password']))
			return $temp.=$errors['password']."</h2>";
	}
?>