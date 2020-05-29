<?php
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/dbhandler.php";
	$connessione=connessione();
	if (!isset($_SESSION)) {
		session_start();
	}
	if(!isset($_GET["photo"])){
		header("Location: 404.php");
		exit();
	}
	
	$output='';
	$id=mysqli_real_escape_string($connessione,urldecode($_GET["photo"]));
	if(!$immagini=$connessione->query("SELECT * FROM foto WHERE categoria='$id' AND stato='approvata' ORDER BY data DESC;")){
		header("Location: 404.php");
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
			if(file_exists("upload/".$idImg.'.png')){
				$url="upload/".$idImg.'.png';
			}else if(file_exists("upload/".$idImg.'.jpg')){
					$url="upload/".$idImg.'.jpg';
			}else if(file_exists("upload/".$idImg.'.jpeg')){
					$url="upload/".$idImg.'.jpeg';
			}
			if(isset($url)){
				$titolo=$immagine["titolo"];
				$autore=$immagine["venditore"];
				$img.="<div class=\"listImg\"><p><span title=\"titolo\">".$titolo."</span> di <span title=\"autore\">".$autore."</span></p>
					<a href=\"imgDet.php?img=".urlencode($idImg)."\">
						<img class=\"transiction\" src=\"".$url."\" alt=\"link per visualizzare informazioni dell'immagine ".$titolo."\"/>
					</a></div>";
			}
		}
		return $img;
	}
	
	$output=file_get_contents("html/catGallery.html");
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("<div class=\"listImg\"/>",getImages(),$output);
	$output=str_replace("<meta/>",file_get_contents("html/meta.html"),$output);
	$output=str_replace("%cat%",$nomeC,$output);
	
	echo $output;
?>