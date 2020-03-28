<?php
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/dbhandler.php";
	
	if (!isset($_SESSION)) {
		session_start();
	}
	if (!isset($_SESSION["username"])) {
		header("Location: login.php");
		exit();
	}
	require_once "php/concludi-acquisto.php";
	
	
	
	function getImages(){
		$connessione=connessione();

		$username=$_SESSION["username"];
		$carrello=$connessione->query("SELECT * FROM carrello WHERE utente='$username' AND stato='in corso';");
		$img="<div class=\"foto\"><ul>";
		$tot=0;
		$rows=mysqli_num_rows($carrello);
		if($rows==0){
			$img.="<p>Carrello vuoto</p>";
		}else{
			while($foto=$carrello->fetch_assoc()){
				$idImg=$foto["foto"];
				if(file_exists("upload/".$idImg.'.png')){
					$url="upload/".$idImg.'.png';
				}else if(file_exists("upload/".$idImg.'.jpg')){
						$url="upload/".$idImg.'.jpg';
				}else if(file_exists("upload/".$idImg.'.jpeg')){
						$url="upload/".$idImg.'.jpeg';
				}
				$prezzoImg=$foto["prezzo"];
				$titolo=$foto["titolo"];

				$img.="<li><img class=\"imgElement\" src=\"".$url."\" alt=\"".$titolo."\"/></a>
					<div id=\"parag\">
							<p>	<strong>Prezzo: </strong>".$prezzoImg." &euro;</p>
							
					</div>
					
				</li>";
				$tot=$tot+$prezzoImg;
			}
		$img.="</ul></div><p>Totale=".$tot."€</p><form method=\"post\" ><button type=\"submit\" name=\"concludi-acquisto\">Concludi acquisto</button></form>";
		}
		
		return $img;
	}

	
	$output=file_get_contents("html/carrello.html");
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("<div class=\"foto\"/>",getImages(),$output);
	$output=str_replace("<meta/>",file_get_contents("html/meta.html"),$output);
	
	
	echo $output;