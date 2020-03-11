<?php

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
				header("Location: profile.php");
			}
		}
	}//login

?>