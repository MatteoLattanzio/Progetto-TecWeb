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
		$list="<select name=\"selectCategoria\" id=\"Categoria\"><option value=\"\" disabled selected>Scegli una categoria</option>";
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
	
	function paramMemory($output){
		if(isset($_POST['titolo']))
			$output=str_replace("%titleVal%",$_POST['titolo'],$output);
		else
			$output=str_replace("%titleVal%","",$output);

		if(isset($_POST['prezzo']))
			$output=str_replace("%priceVal%",$_POST['prezzo'],$output);
		else
			$output=str_replace("%priceVal%","",$output);

		if(isset($_POST['tag1']))
			$output=str_replace("%tag1Val%",$_POST['tag1'],$output);
		else
			$output=str_replace("%tag1Val%","",$output);

		if(isset($_POST['tag2']))
			$output=str_replace("%tag2Val%",$_POST['tag2'],$output);
		else
			$output=str_replace("%tag2Val%","",$output);

		if(isset($_POST['tag3']))
			$output=str_replace("%tag3Val%",$_POST['tag3'],$output);
		else
			$output=str_replace("%tag3Val%","",$output);
			return $output;
	}

	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("<select  categorie/>",getCategory(),$output);
	$output=str_replace("<meta/>",file_get_contents("html/meta.html"),$output);
	$output=paramMemory($output);
	$output=str_replace("<h2 error/>",getErrorLoad($errors),$output);
	
	echo $output;
	
?>