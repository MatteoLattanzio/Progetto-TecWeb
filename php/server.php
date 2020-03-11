<?php
	require_once "php/dbhandler.php";
	$connessione=connessione();
	$errors=array();

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