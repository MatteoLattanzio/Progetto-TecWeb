<?php
$errors= array();

	// connect to the database
	$db = mysqli_connect('localhost', 'root', '', 'photo');
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	 
	//login

	if (isset($_POST['Login'])){
      	$username = stripslashes($_REQUEST['username']);
	  	$username = mysqli_real_escape_string($db,$username);
	  	$password = stripslashes($_REQUEST['password']);
	  	$password = mysqli_real_escape_string($db,$password);
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
	        echo $ris;
	        $tipo=$ris['Tipo'];
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
?>
