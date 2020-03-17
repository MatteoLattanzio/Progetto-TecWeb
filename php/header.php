<?php

class Header{
	public static function build(){
		if (!isset($_SESSION)) {
			session_start();
		}
		$output=file_get_contents("html/header.html");
		$output=str_replace("<div id=\"navbar\"></div>",Header::navbar(),$output);
		return $output;
	}
	
	public static function navbar(){
		$nav=array('Home' => 'home.php','Galleria' => 'gallery.php', 'Vendi' => 'nuova_foto.php','Contatti' => 'contacts.php');
		
		if(isset($_SESSION["username"]) && $_SESSION["type"]=="user") {
			$nav['Profilo']='profile.php';
		}else if(isset($_SESSION["username"]) && $_SESSION["type"] == "admin") {
			$nav['Gestione']='admin.php';
		}else{
			$nav['Accedi']='login.php';
		}
		if(isset($_SESSION["username"])){
			$nav['Esci']='logout.php';
		}
		$output="<div id=\"navbar\"><ul>";
		foreach($nav as $element => $link){
			$output.="<li><a ";
			if(basename($_SERVER['PHP_SELF']) == $link)
				$output.="id=\"current\" >".$element."</a></li>";
			else
				$output.="href=\"".$link."\">".$element."</a></li>";
		}//foreach
		$output.="</ul></div>";
		return $output;
	}
}
