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
			$total=$connessione->query("SELECT COUNT(*) AS tot FROM foto WHERE categoria='$idCat' AND stato='approvata';");
			$totale=$total->fetch_assoc();
			$totale=$totale['tot'];
			$count=0;
			while(!isset($url) && $count<$totale){
				$query="SELECT * FROM foto WHERE categoria='$idCat' AND stato='approvata' ORDER BY data DESC LIMIT ".($count+1)." OFFSET ".$count.";";
				$trovate=$connessione->query($query);
				if($trovate){
					$trovate=$trovate->fetch_assoc();
					$idImg=$trovate["id"];
					if(file_exists("upload/".$idImg.'.png')){
						$url="upload/".$idImg.'.png';
					}else if(file_exists("upload/".$idImg.'.jpg')){
						$url="upload/".$idImg.'.jpg';
					}else if(file_exists("upload/".$idImg.'.jpeg')){
						$url="upload/".$idImg.'.jpeg';
					}
					if(isset($url)){
						$output.="<div class=\"catImg\"><p>".$nomeCat."</p>
							<a href=\"catGallery.php?photo=".urlencode($idCat)."\">
								<img class=\"transiction\" src=\"".$url."\" alt=\"link per vedere immagini relative a ".$nomeCat." \"/>
							</a></div>";
					}else
						$count=$count+1;
				}else
					$count=$totale;
			}
			unset($url);
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
