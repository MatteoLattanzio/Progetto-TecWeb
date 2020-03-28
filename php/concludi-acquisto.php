<?php
	if(isset($_POST['concludi-acquisto'])){
		$connessione=connessione();
		$username=$_SESSION['username'];
	    $data = date("Y-m-d");

		$carrello=$connessione->query("SELECT * FROM carrello WHERE utente='$username' AND stato='in corso';");
		while($foto=$carrello->fetch_assoc()){
			$stato=$foto["stato"];
			$id=$foto["foto"];
			$result=$connessione->query("UPDATE `carrello` SET stato='concluso', data='$data' WHERE foto='$id' AND utente='$username'; ");
		}
	}
		

?>