<?php
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/dbhandler.php";
	require_once "php/alterProfile.php";
	
	if (!isset($_SESSION)) {
		session_start();
	}
	if (!isset($_SESSION["username"])) {
		header("Location: login.php");
		exit();
	}
	if ($_SESSION["type"] == "admin") {
		header("Location: admin.php");
		exit();
	}
	$connessione=connessione();
	$username=$_SESSION["username"];
	$result=$connessione->query("SELECT * FROM utenti WHERE username='$username';");
	$imgUser=$connessione->query("SELECT * FROM foto JOIN utenti ON venditore=username WHERE venditore='$username';");
	if(!$result || !$imgUser || mysqli_num_rows($result)!=1){
		header("Location: 404.php");
		exit();
	}
	$utente=$result->fetch_assoc();
	$nome=$utente["nome"];
	$cognome=$utente["cognome"];
	$email=$utente["email"];

	
	function getImages(){
		global $imgUser;
		$img="<div class=\"foto\"><ul>";
		$rows=mysqli_num_rows($imgUser);
		if($rows==0){
			$img.="<p>Non hai venduto alcuna foto. <a href=\"nuova_foto.php\">Vendi</a></p>";
		}else{
			while($foto=$imgUser->fetch_assoc()){
				$idImg=$foto["id"];
				if(file_exists("upload/".$idImg.'.png')){
					$url="upload/".$idImg.'.png';
				}else if(file_exists("upload/".$idImg.'.jpg')){
						$url="upload/".$idImg.'.jpg';
				}else if(file_exists("upload/".$idImg.'.jpeg')){
						$url="upload/".$idImg.'.jpeg';
				}
				$titoloImg=$foto["titolo"];
				$prezzoImg=$foto["prezzo"];
				$statoImg=$foto["stato"];
				//QUANTITA' VENDUTE
				//MI PIACE RICEVUTI
				//VOLTE IN CUI E' STATA MESSA TRA I PREFERITI
				$img.="<li>";
				if($foto['stato']=='approvata')
					$img.="<a href=\"imgDet.php?img=".urlencode($idImg)."\">";

				$img.="<img class=\"imgElement\" src=\"".$url."\" alt=\"immagine ".$foto["titolo"]."\"/>";
				if($foto['stato']=='approvata')
					$img.="</a>";
				$img.="<div id=\"parag\">
							<p><strong>Titolo: </strong>".$titoloImg."</p>
							<p>	<strong>Prezzo: </strong>".$prezzoImg." &euro;</p>
							<p>	<strong>Stato: </strong>".$statoImg."</p>
					</div>
					
				</li>";
			}
		}
		$img.="</ul></div>";
		return $img;
	}

	function getWishList(){
		$connessione=connessione();
		$username=$_SESSION['username'];
		$wishList=$connessione->query("SELECT * FROM preferiti WHERE utente='$username' ");
		$img="<div class=\"foto\"><ul>";
		$rows=0;
		if($wishList)
			$rows=mysqli_num_rows($wishList);
		if($rows==0){
			$img.="<p>La tua lista desideri è vuota. Esplora la <a href=\"gallery.php\">galleria</a> per aggiungere foto ai preferiti</p>";
		}else{
			while($row=$wishList->fetch_assoc()){
				$idImg=$row["foto"];
				if(file_exists("upload/".$idImg.'.png')){
					$url="upload/".$idImg.'.png';
				}else if(file_exists("upload/".$idImg.'.jpg')){
						$url="upload/".$idImg.'.jpg';
				}else if(file_exists("upload/".$idImg.'.jpeg')){
						$url="upload/".$idImg.'.jpeg';
				}
				$result=$connessione->query("SELECT * FROM foto WHERE id='$idImg'");
				$dettagli=$result->fetch_assoc();

				$titoloImg=$dettagli["titolo"];
				$prezzoImg=$dettagli["prezzo"];
				
				$img.="<li><a href=\"imgDet.php?img=".urlencode($idImg)."\">
								<img class=\"imgElement\" src=\"".$url."\" alt=\"immagine ".$titoloImg."\"/>
							</a>
							<div id=\"parag\">
									<p><strong>Titolo: </strong>".$titoloImg."</p>
									<p>	<strong>Prezzo: </strong>".$prezzoImg." &euro;</p>
							</div>
						</li>";
			}
		}
		$img.="</ul></div>";
		return $img;
	}

	function getBuyed(){
		$connessione=connessione();
		$username=$_SESSION['username'];
		$buyed=$connessione->query("SELECT * FROM carrello JOIN foto ON carrello.foto=foto.id WHERE utente='$username' AND carrello.stato='concluso';");
		$img="<div class=\"foto acquistate\"><ul>";
		$rows=0;
		if($buyed)
			$rows=mysqli_num_rows($buyed);
		if($rows==0){
			$img.="<p>Da qui potrai accedere ai tuoi acquisti completati. Esplora la <a href=\"gallery.php\">galleria</a> per acquistare.</p>";
		}else{
			while($row=$buyed->fetch_assoc()){
				$idImg=$row["foto"];
				if(file_exists("upload/".$idImg.'.png')){
					$url="upload/".$idImg.'.png';
					$urlFull="upload/".$idImg.'_original.png';
				}else if(file_exists("upload/".$idImg.'.jpg')){
						$url="upload/".$idImg.'.jpg';
						$urlFull="upload/".$idImg.'_original.jpg';
				}else if(file_exists("upload/".$idImg.'.jpeg')){
						$url="upload/".$idImg.'.jpeg';
						$urlFull="upload/".$idImg.'_original.jpeg';
				}
				$result=$connessione->query("SELECT * FROM foto WHERE id='$idImg'");
				$dettagli=$result->fetch_assoc();
				$titoloImg=$dettagli["titolo"];
				$prezzoImg=$dettagli["prezzo"];
				$img.="<li><a href=\"".$urlFull."\" target=\"_blank\">
								<img class=\"imgElement\" src=\"".$url."\" alt=\"immagine ".$titoloImg."\"/>
							</a>
							<div id=\"parag\">
									<p><strong>Titolo: </strong>".$titoloImg."</p>
									<p>	<strong>Prezzo: </strong>".$prezzoImg." &euro;</p>
							</div>
						</li>";
			}
		}
		$img.="</ul></div>";
		return $img;
	}
	
	$output=file_get_contents("html/profile.html");
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("<div class=\"foto\"/>",getImages(),$output);
	$output=str_replace("<meta/>",file_get_contents("html/meta.html"),$output);
	$output=str_replace("<div class=\"foto\"/>",getImages(),$output);
	$output=str_replace("<div class=\"foto acquistate\"/>",getBuyed(),$output);
	$output=str_replace("<div class=\"foto preferiti\"/>",getWishList(),$output);

	$output=str_replace("%username%",$username,$output);
	$output=str_replace("%nome%",$nome,$output);
	$output=str_replace("%cognome%",$cognome,$output);
	$output=str_replace("%email%",$email,$output);
	if(isset($_GET["correct"]))
		$output=str_replace("<h3 done/>","Modifiche effettuate correttamente",$output);
	else
		$output=str_replace("<h3 done/>",'',$output);
	
	echo $output;