<?php
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/dbhandler.php";
	$connessione=connessione();
	if(!isset($_SESSION))
		session_start();
	if(!isset($_GET["user"])){
		header("Location: 404.php");
		exit();
	}
	if(isset($_SESSION["username"]) && $_SESSION["username"]==$_GET["user"]){
		header("Location: profile.php");
		exit();
	}
	$user=$_GET["user"];
	$imgUser=$connessione->query("SELECT * FROM foto JOIN utenti ON venditore=username WHERE venditore='$user' AND stato='approvata';");
	$detUser=$connessione->query("SELECT * FROM utenti WHERE username='$user';");
	if(!$imgUser || !$detUser){
		header("Location: 404.php");
		exit();
	}
	if(mysqli_num_rows($detUser)!=1){
		header("Location: 404.php");
		exit();
	}
	$utente=$detUser->fetch_assoc();
	$nomeU=$utente["nome"];
	$cognomeU=$utente["cognome"];
	$emailU=$utente["email"];
	
	function getImages(){
		global $imgUser;
		$img="<div class=\"userImg\"><ul>";
		while($foto=$imgUser->fetch_assoc()){
			$idImg=$foto["id"];
			if(file_exists("upload/".$idImg.'.png')){
				$url="upload/".$idImg.'.png';
			}else if(file_exists("upload/".$idImg.'.jpg')){
					$url="upload/".$idImg.'.jpg';
			}else if(file_exists("upload/".$idImg.'.jpeg')){
					$url="upload/".$idImg.'.jpeg';
			}
			$titleImg=$foto['titolo'];
			$priceImg=$foto['prezzo'];
			$img.="<li>
						<a href=\"imgDet.php?img=".urlencode($idImg)."\">
							<img class=\"imgElement\" src=\"".$url."\" alt=\"".$titleImg."\"/>
						</a>
						<div id=\"parag\">
							<p> <strong>Titolo: </strong>".$titleImg."</p>	
							<p>	<strong>Prezzo: </strong>".$priceImg." &euro;</p>						
						</div>
					</li>";
		}
		$img.="</ul></div>";
		return $img;
	}
	
	$output=file_get_contents("html/user.html");
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("<div class=\"userImg\"/>",getImages(),$output);
	$output=str_replace("<meta/>",file_get_contents("html/meta.html"),$output);
	$output=str_replace("%user%",$user,$output);
	$output=str_replace("%nome%",$nomeU,$output);
	$output=str_replace("%cognome%",$cognomeU,$output);
	$output=str_replace("%email%",$emailU,$output);
	
	echo $output;