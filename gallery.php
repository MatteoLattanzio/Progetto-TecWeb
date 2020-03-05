<?php
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/dbhandler.php";
	$connessione=connessione();
	if(!isset($_SESSION))
		session_start();
	
	function listaCategorie(){
		global $connessione;
		$output='';
		if(!$categorie = $connessione->query("SELECT DISTINCT C.id AS catId, nome FROM categorie AS C JOIN foto AS F on C.id=F.categoria WHERE F.stato='approvata' ORDER BY nome;")){
			header("Location: 404.php");
			exit();
		}
		while($categoria=$categorie->fetch_assoc()){
			$idCat=$categoria["catId"];
			$nomeCat=$categoria["nome"];
			$trovate=$connessione->query("SELECT * FROM foto WHERE categoria='$idCat' ORDER BY data DESC LIMIT 1;");
			$trovate=$trovate->fetch_assoc();
			$idImg=$trovate["id"];
			if(file_exists("upload/".$idImg.'.png')){
				$url="upload/".$idImg.'.png';
			}else if(file_exists("upload/".$idImg.'.jpg')){
				$url="upload/".$idImg.'.jpg';
			}else if(file_exists("upload/".$idImg.'.jpeg')){
				$url="upload/".$idImg.'.jpeg';
			}
			$output.="<div class=\"catImg\"><p>".$nomeCat."</p>
				<a href=\"catGallery.php?photo=".urlencode($idCat)."\">
					<img class=\"transiction\" src=\"".$url."\" alt=\"".$nomeCat."\"/>
				</a></div>";
		}
		return $output;
	}
	
	$output=file_get_contents("html/gallery.html");
	$output=str_replace("<meta/>", file_get_contents("html/meta.html"), $output);
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("<div class=\"catImg\"/>",listaCategorie(),$output);
	
	echo $output;
?>