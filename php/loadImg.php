<?php
//CARICAMENTO IMMAGINE
	if(isset($_POST['carica_img'])){
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
			$result = $connessione->query("SELECT id FROM `categorie` WHERE nome = '$categoria' ;");
			
			$ris=mysqli_fetch_assoc($result);
			$idcategoria=$ris['id'];
			
			//TO DO QUI BISOGNA METTERE $user= $_SESSION['usernameU'];
			$user= "user";
			$connessione->query("INSERT INTO foto (titolo, venditore, prezzo, stato, categoria, data, tag1, tag2, tag3) 
				  VALUES('$titolo', '$user', '$prezzo', 'in attesa', '$idcategoria', '$data', '$tag1', '$tag2', '$tag3');");
			
			$result = $connessione->query("SELECT id FROM `foto` WHERE venditore='$user' ORDER BY ID DESC LIMIT 1; ");
			
			$ris=mysqli_fetch_assoc($result);
			$name = $ris['id'].'.' . pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
			if(isset($name)){
				if(!empty($name)){      
					$location = 'upload/';      
					if(move_uploaded_file($temp_name, $location.$name)){
					  //echo 'File uploaded successfully';
					}
					else{
						$idfoto=$ris['id'];
						$connessione->query("DELETE FROM foto WHERE id='$idfoto';");
					}
				}       
			}  
			//header("Location: area_riservata_utente.php");
		}
	}
?>