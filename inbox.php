<?php
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/dbhandler.php";
	require_once "php/removeMessage.php";
	$connessione=connessione();
	if(!isset($_SESSION)){
		session_start();
	}
	if (!isset($_SESSION["username"])) {
		header("Location: login.php");
		exit();
	}
	if ($_SESSION["type"] != "admin") {
		header("Location: profile.php");
		exit();
	}
	
	function messageList(){
		global $connessione;
		$messaggi = $connessione->query("SELECT * FROM messaggi ORDER BY data DESC");
		$output = "<h1>Messaggi ricevuti</h1><div class=\"messaggi\">";
		if(mysqli_num_rows($messaggi)>0){
			while($messaggio = $messaggi->fetch_assoc()) {
				$output .= "<div class=\"messaggio\">
						<form method=\"post\">
							<input type=\"hidden\" value=\"".$messaggio["id"]."\" name=\"id\"/>
							<button class=\"removeButton\" type=\"submit\" name=\"rimuovi-messaggio\" aria-label=\"Rimuovi oggetto dal carrello\"><i class=\"fa fa-times\"></i>
							</button>
						</form>
						<strong>Data: </strong>".$messaggio["data"]."<br/>
						<strong>Categoria: </strong>".$messaggio["oggetto"]."<br/>
						<strong>Mittente: </strong>".$messaggio["cognome"]." ".$messaggio["nome"]."<br/>
						<strong>E-mail mittente: </strong>".$messaggio["email"]."<br/>
						<strong>Messaggio: </strong>".$messaggio["testo"]."<br/><br/>
					</div>";
			}
		}else
		$output.="<p>Non sono presenti messaggi</p></div>";
		$output.="</div>";
		return $output;
	}

	$output=file_get_contents("html/inbox.html");
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("<meta/>",file_get_contents("html/meta.html"),$output);
	$output=str_replace("<div messages/>",messageList(),$output);

	echo $output;
	
?>
