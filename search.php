<?php
	require_once "php/dbhandler.php";
	require_once "php/checkSearch.php";
	$connessione = connessione();
	$word=search();
	
	function risultatiRicerca(){
		global $connessione;
		global $word;
		$output='';
		if($word!=''){
			$categorie = $connessione->query("SELECT nome FROM categorie WHERE nome='$word';");
		}else if (!$categorie = $connessione->query("SELECT nome FROM categorie ORDER BY nome;")) {
			header("Location: notfound.php");
			exit();
		}
		if(mysqli_num_rows($categorie) == 0)
				$output .= "<div class=\"noRes\"><p>Spiacente, nessun risultato!</p></div>";
		while ($categoria = $categorie->fetch_assoc()) {
			$nome = $categoria["nome"];
			$output .= "<div class=\"categoria\">
				 <p>" . $nome . "</p>
			 </div>";
		}
		return $output;
		
	}
	
	$output = file_get_contents("html/search.html");
	$output = str_replace("value=\"\"","value=\"".$word."\"",$output);
	$output = str_replace("<div class=\"search_result\"/>", risultatiRicerca(), $output);
	
	echo $output;
?>