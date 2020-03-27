<?php
require_once "dbhandler.php";
	if (!isset($_SESSION)) {
		session_start();
	}


	function setLikeButton($idImg){
		
		$connessione=connessione();
		$output="";	
		if(isset($_SESSION['username'])){
			$user=$_SESSION['username'];
			$result=$connessione->query("SELECT * FROM piaciuti WHERE foto='$idImg' AND utente='$user' ;");
			
			if(mysqli_num_rows($result)==0){
				$output=	"<form>
								<button id=\"like-button\" type=\"button\" value=\"aggiungi-like\" onclick=\"like('".$idImg."')\"><i class=\"fa fa-thumbs-o-up\"></i></button>
							</form>";
			}
			else{
				$output=	"<form>
								<button id=\"like-button\" type=\"button\" value=\"rimuovi-like\" onclick=\"like(".$idImg.")\"><i class=\"fa fa-thumbs-up\"></i></button>
							</form>";
			}
		}
		return $output;	
	}
	function setPreferitiButton($idImg){
		$connessione=connessione();
		$output="";
		if(isset($_SESSION['username'])){
			$user=$_SESSION['username'];
			$result=$connessione->query("SELECT * FROM preferiti WHERE foto='$idImg' AND utente='$user' ;");
			
			if(mysqli_num_rows($result)==0){
				$output=	"<form>
								<button id=\"preferiti-button\" type=\"button\" value=\"aggiungi-preferiti\" onclick=\"preferiti('".$idImg."')\"><i class=\"fa fa-heart-o\"></i></button>
							</form>";
			}
			else{
				$output=	"<form>
								<button id=\"preferiti-button\" type=\"button\" value=\"rimuovi-preferiti\" onclick=\"preferiti(".$idImg.")\"><i class=\"fa fa-heart\"></i></button>
							</form>";
			}
		}
		return $output;
	}
?>