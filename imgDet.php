<?php
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/dbhandler.php";
	$connessione=connessione();
	if (!isset($_SESSION)) {
		session_start();
	}
	if(!isset($_GET["img"])){
		header("Location: 404.php");
		exit();
	}
	$idImg=mysqli_real_escape_string($connessione, urldecode($_GET["img"]));
	$sql="SELECT * FROM foto WHERE id='$idImg';";
	if(!$result=$connessione->query($sql)){
		header("Location: 404.php");
		exit();
	}
	if(mysqli_num_rows($result)!=1){
		header("Location: 404.php");
		exit();
	}
	$immagine=$result->fetch_assoc();
	$titolo=$immagine["titolo"];
	$venditore=$immagine["venditore"];
	$prezzo=$immagine["prezzo"];
	$idCat=$immagine["categoria"];
	$data=$immagine["data"];
	if(isset($immagine["tag1"]))
		$tag1=$immagine["tag1"];
	if(isset($immagine["tag2"]))
		$tag2=$immagine["tag2"];
	if(isset($immagine["tag3"]))
		$tag3=$immagine["tag3"];
	if($tag1.$tag2.$tag3 != '')
		$tag=$tag1." &nbsp; ".$tag2." &nbsp; ".$tag3;
	else
		$tag="Nessun tag specificato";
	$result=$connessione->query("SELECT nome FROM categorie WHERE id='$idCat';");
	$cat=$result->fetch_assoc();
	$categoria=$cat["nome"];
	if(file_exists("upload/".$idImg.'.png')){
		$url="upload/".$idImg.'.png';
	}else if(file_exists("upload/".$idImg.'.jpg')){
		$url="upload/".$idImg.'.jpg';
	}else if(file_exists("upload/".$idImg.'.jpeg')){
		$url="upload/".$idImg.'.jpeg';
	}
	
	$output=file_get_contents("html/imgDet.html");
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("<meta/>",file_get_contents("html/meta.html"),$output);
	$output=str_replace("%titolo%",$titolo,$output);
	$output=str_replace("%vend%",$venditore,$output);
	$output=str_replace("%prezzo%",$prezzo,$output);
	$output=str_replace("%cat%",$categoria,$output);
	$output=str_replace("%data%",$data,$output);
	$output=str_replace("%tag%",$tag,$output);
	$output=str_replace("%idCat%",$idCat,$output);
	$output=str_replace("%idImg%",$idImg,$output);
	$output=str_replace("%url%",$url,$output);

	echo $output;
?>