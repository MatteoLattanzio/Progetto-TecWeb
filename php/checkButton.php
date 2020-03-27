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
								<button id=\"like-button\" type=\"button\" value=\"like\" onclick=\"like('".$idImg."')\">Like</button>
							</form>";
			}
			else{
				$output=	"<form>
								<button id=\"like-button\" type=\"button\" onclick=\"like(".$idImg.")\">noLike</button>
							</form>";
			}
		}
		return $output;	
	}
?>