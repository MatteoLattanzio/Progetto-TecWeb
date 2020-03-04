<?php
	$errors= array();
	$db = mysqli_connect('localhost', 'root', '', 'photo');
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	 
	//LOGIN

	if (isset($_POST['Login'])){
	  	$username = mysqli_real_escape_string($db,$_POST['username']);
	  	$password = mysqli_real_escape_string($db,$_POST['password']);
	  	if (empty($username)) {
	    	$errors['username']="Username richiesto";
	  	}
	  	if (empty($password)) {
	    	$errors['password']="Password richiesta";
	  	}
	  	if (count($errors) == 0) {
	        $query = "SELECT * FROM `utenti` WHERE Username='$username' and Password='$password'";
	        $result = mysqli_query($db,$query) or die(mysql_error());
	        $rows = mysqli_num_rows($result);
			$ris=mysqli_fetch_assoc($result);
	        $tipo=$ris['tipo'];
	      	if($rows==1){    
	        	$_SESSION['isLogged']= true;
	            if($tipo=='admin'){
	            	$_SESSION['usernameA']=$username;
	              	// header("Location: area_riservata_admin.php");
	            }
	            else {
	            	$_SESSION['usernameU']=$username;
	              	// header("Location: area_riservata_utente.php");
	            }      
	      	}
	    }
    }

    //REGISTRAZIONE DEGLI UTENTI
	if (isset($_POST['registrazione'])) {
	  // receive all input values from the form
		$nome = mysqli_real_escape_string($db, $_POST['nome']);
		$cognome = mysqli_real_escape_string($db, $_POST['cognome']);
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$data = mysqli_real_escape_string($db, $_POST['data']);
		$indirizzo = mysqli_real_escape_string($db, $_POST['indirizzo']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		$password_2 = mysqli_real_escape_string($db, $_POST['passwordR']);
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

	        $controllo = "SELECT * FROM `utenti` WHERE Username='$username' ";
	        $result = mysqli_query($db,$controllo) or die(mysql_error());
	        $rows = mysqli_num_rows($result);
	        if($rows==1){
	            $errors['username']="Username non disponibile";
	    	}
	    	elseif($password==$password_2){
		          $query = "INSERT INTO `utenti` ( nome, cognome, data, indirizzo, username, password, email, tipo) 
		                  VALUES('$nome','$cognome', '$data', '$indirizzo', '$username', '$password', '$email', 'user')";
		          
		            mysqli_query($db, $query) or die(mysql_error());
		            $_SESSION['usernameU']=$username;
		            $_SESSION['isLoggedU']=true;	            
		            //header("Location: area_riservata_utente.php");
			}
	  	}
	}

	//CARICAMENTO IMMAGINE
	if (isset($_POST['carica_img'])) {
		$titolo = $_POST['titolo']; 
		$categoria = $_POST['selectCategoria'];
		$prezzo = $_POST['prezzo'];
		$tag1 = $_POST['tag1'];
		$tag2 = $_POST['tag2'];
		$tag3 = $_POST['tag3'];
		$temp_name  = $_FILES['file']['tmp_name'];
		$data = date('m/d/Y');
		if(empty($titolo)){
			$errors['titolo']="Titolo richiesto";
		}
		if(empty($tag1)){
			$tag1="no";
		}
		if(empty($tag2)){
			$tag2="no";
		}
		if(empty($tag3)){
			$tag3="no";
		}
		if(empty($prezzo)){
			$errors['prezzo']="Prezzo richiesto";
		}
		if($categoria=='Seleziona'){
			$errors['categoria']="Categoria richiesta";
		} 
		else{
			$query = "SELECT id FROM `categorie` WHERE nome = '$categoria' ";
			$result = mysqli_query($db, $query);
			$ris=mysqli_fetch_assoc($result);
			$idcategoria=$ris['id'];
			
			//TO DO QUI BISOGNA METTERE $user= $_SESSION['usernameU'];
			$user= "user";
			$query = "INSERT INTO foto (titolo, venditore, prezzo, stato, categoria, data, tag1, tag2, tag3) 
			      VALUES('$titolo', '$user', '$prezzo', 'in attesa', '$idcategoria', '$data', '$tag1', '$tag2', '$tag3')";
			echo $query;

			mysqli_query($db, $query);
			$query = "SELECT id FROM `foto` WHERE venditore='$user' ORDER BY ID DESC LIMIT 1 ";
			$result= mysqli_query($db, $query);
			$ris=mysqli_fetch_assoc($result);
			$name = $ris['id'].'.' . pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
			if(isset($name)){
				if(!empty($name)){      
					$location = 'upload/';      
					if(move_uploaded_file($temp_name, $location.$name)){
					  echo 'File uploaded successfully';
					}
				}       
			}  
			//header("Location: area_riservata_utente.php");
	    }
	}
	function getTitoloError($errors){
		if(isset($errors['titolo'])){
			echo $errors['titolo'];
		}
	}
	function getPrezzoError($errors){
		if(isset($errors['prezzo'])){
			echo $errors['prezzo'];
		}
	}
	function getCategoriaError($errors){
		if(isset($errors['categoria'])){
			echo $errors['categoria'];
		}
	}
	function getNomeError($errors){
		if(isset($errors['nome'])){
			echo $errors['nome'];
		}
	}
	function getCognomeError($errors){
		if(isset($errors['cognome'])){
			echo $errors['cognome'];
		}
	}
	function getDataError($errors){
		if(isset($errors['data'])){
			echo $errors['data'];
		}
	}
	function getIndirizzoError($errors){
		if(isset($errors['indirizzo'])){
			echo $errors['indirizzo'];
		}
	}
	function getEmailError($errors){
		if(isset($errors['email'])){
			echo $errors['email'];
		}
	}
    function getUsernameError($errors){
  		if(isset($errors['username'])){
      		echo $errors['username'];
    	}
	} 

	function getPasswordError($errors){
		if(isset($errors['password'])){
			echo $errors['password'];
		}
	} 
?>
