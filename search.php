<?php
	require_once "php/dbhandler.php";
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/checkSearch.php";
	$connessione=connessione();
	if(notFound())
		$output=file_get_contents("html/badSearch.html");
	else{
		$output=file_get_contents("html/goodSearch.html");
		$output=str_replace("<div result/>",getImgSubGallery($found),$output);
	}
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("<meta/>",file_get_contents("html/meta.html"),$output);
	$output=str_replace("%value%",$value,$output);
	
	echo $output;
?>