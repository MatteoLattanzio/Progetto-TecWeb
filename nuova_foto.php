<?php
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/dbhandler.php";
	require_once "php/server.php";
	require_once "php/loadImg.php";
	
	$connessione=connessione();
	if(!isset($_SESSION)){
		session_start();
	}
	
	function getCategory(){
		global $connessione;
		$list="<select name=\"selectCategoria\">";
		$result=$connessione->query("SELECT * FROM categorie;");
		while($cat=$result->fetch_assoc()){
			$list.="<option name=\"".$cat["nome"]."\" value=\"".$cat["id"]."\">".$cat["nome"]."</option>";
		}
		$list.="</select>";
		return $list;
	}
	
	if(isset($_SESSION['username'])){
		$output=file_get_contents("html/nuova_foto.html");
	}else{
		$output=file_get_contents("html/vendi_sample.html");
	}
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("<select  categorie/>",getCategory(),$output);
	$output=str_replace("<meta/>",file_get_contents("html/meta.html"),$output);
	$output=str_replace("<h2 error/>",getErrorLoad($errors),$output);
	
	echo $output;
	
?>