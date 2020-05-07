<?php
require_once "dbhandler.php";
	if (!isset($_SESSION)) {
		session_start();
	}


	function setLikeButton($idImg,$venditore){
		$connessione=connessione();
		$output="";	
		if(isset($_SESSION['username'])){
			$user=$_SESSION['username'];
			$tipo=$_SESSION['type'];
			if(($user!=$venditore)&&($tipo=="user")){
				$result=$connessione->query("SELECT * FROM piaciuti WHERE foto='$idImg' AND utente='$user' ;");
				
				if(!$result || mysqli_num_rows($result)==0){
					$output=	"<form id=\"buttonsContainer\">
									<button id=\"like-button\" type=\"button\" value=\"aggiungi-like\" onclick=\"like('".$idImg."')\"><i class=\"fa fa-thumbs-o-up\"></i></button>
								</form>";
				}
				else{
					$output=	"<form id=\"buttonsContainer\">
									<button id=\"like-button\" type=\"button\" value=\"rimuovi-like\" onclick=\"like(".$idImg.")\"><i class=\"fa fa-thumbs-up\"></i></button>
								</form>";
				}
			}
		}
		return $output;	
	}

	function setPreferitiButton($idImg,$venditore){
		$connessione=connessione();
		$output="";
		if(isset($_SESSION['username'])){
			$user=$_SESSION['username'];
			$tipo=$_SESSION['type'];
			if(($user!=$venditore)&&($tipo=="user")){
				$result=$connessione->query("SELECT * FROM preferiti WHERE foto='$idImg' AND utente='$user' ;");
				
				if(!$result || mysqli_num_rows($result)==0){
					$output=	"<form id=\"buttonsContainer\">
									<button id=\"preferiti-button\" type=\"button\" value=\"aggiungi-preferiti\" onclick=\"preferiti('".$idImg."')\"><i class=\"fa fa-heart-o\"></i></button>
								</form>";
				}
				else{
					$output=	"<form id=\"buttonsContainer\">
									<button id=\"preferiti-button\" type=\"button\" value=\"rimuovi-preferiti\" onclick=\"preferiti(".$idImg.")\"><i class=\"fa fa-heart\"></i></button>
								</form>";
				}
			}
		}
		return $output;
	}

	function setAcquistoButton($idImg,$venditore){
		$connessione=connessione();
		$output="";
		if(isset($_SESSION['username'])){
			$user=$_SESSION['username'];
			$tipo=$_SESSION['type'];
			if(($user!=$venditore)&&($tipo=="user")){
				$result=$connessione->query("SELECT * FROM carrello WHERE foto='$idImg' AND utente='$user';");
				if(!$result || mysqli_num_rows($result)==0){
					$output=	"<form id=\"buttonsContainer\">
									<button id=\"acquisto-button\" type=\"button\" value=\"aggiungi-carrello\" onclick=\"acquista('".$idImg."')\">Acquista</button>
								</form>";
				}else{
				$cat=$result->fetch_assoc();
				$stato=$cat['stato'];
				if($stato=="in corso"){
					$output=	"<form id=\"buttonsContainer\">
									<button id=\"acquisto-button\" type=\"button\" value=\"rimuovi-carrello\" onclick=\"acquista(".$idImg.")\">Rimuovi</button>
								</form>";
				}else
					$output= "<form id=\"buttonsContainer\">
									<button id=\"acquisto-button\" type=\"button\" disabled>Acquistato</button>
							</form>";
				}
			}
		}
		return $output;
	}
?>