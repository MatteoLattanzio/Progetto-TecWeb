<?php
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/dbhandler.php";
	$connessione=connessione();
	if(!isset($_GET["photo"])){
		header("Location: home.php");
		exit();
	}
	
	$output='';
	$id=mysqli_real_escape_string($connessione,urldecode($_GET["photo"]));
	if(!$immagini=$connessione->query("SELECT * FROM foto WHERE categoria='$id';")){
		header("Location: home.php");
		exit();
	}
	$c=$connessione->query("SELECT nome FROM categorie WHERE id='$id';");
	$nomeC=$c->fetch_assoc();
	$nomeC=$nomeC["nome"];
	
	function getImages(){
		global $immagini;
		$img='';
		while($immagine=$immagini->fetch_assoc()){
			$idImg=$immagine["id"];
			$url="upload/".$idImg.".jpg";
			$titolo=$immagine["titolo"];
			$autore=$immagine["venditore"];
			$img.="<div class=\"listImg\"><p><span name=\"titolo\">".$titolo."</span> di <span name=\"autore\">".$autore."</span></p>
				<a href=\"imgDet.php?img=".urlencode($idImg)."\">
					<img class=\"transiction\" src=\"upload/".$idImg.".jpg\" alt=\"".$titolo."\"/>
				</a></div>";
		}
		return $img;
	}
	
	$output=file_get_contents("html/catGallery.html");
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("<div class=\"listImg\"/>",getImages(),$output);
	$output=str_replace("<meta/>",file_get_contents("html/meta.html"),$output);
	$output=str_replace("<title></title>","<title>".$nomeC." - PhotoStock</title>",$output);
	$output=str_replace("<meta name=\"title\"/>","<meta name=\"title\" content=\"".$nomeC." - PhotoStock\"/>",$output);
	$output=str_replace("<h1/>","<h1>".$nomeC."</h1>",$output);	
	$output=str_replace("%cat%",$nomeC,$output);
	
	echo $output;
?>