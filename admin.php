<?php
	require_once "php/header.php";
	require_once "php/footer.php";
	require_once "php/dbhandler.php";
	require_once "php/checkAdmin.php";
	
	$connessione=connessione();
	if (!isset($_SESSION)) {
		session_start();
	}
	if (!isset($_SESSION["username"])) {
		header("Location: login.php");
		exit();
	}
	if ($_SESSION["type"] != "admin") {
		header("Location: profile.php");
		exit();
	}
	
	function listaCategorie(){
		global $connessione;
		$list="<div id=\"catList\">
		<p>Lista categorie: </p><ul>";
		$categorie=$connessione->query("SELECT nome FROM categorie ORDER BY nome;");
		while($cat=$categorie->fetch_assoc()){
			$list.="<li>".$cat["nome"]."</li>";
		}
		$list.="</ul></div>";
		return $list;
	}
	
	function immaginiApprovazione(){
		global $connessione;
		$list="<div id=\"inApp\">";
		$result=$connessione->query("SELECT * FROM foto WHERE stato='in attesa' ORDER BY data");
		$count=0;
		if(mysqli_num_rows($result)==0)
				$list.="<p>Non ci sono immagini da approvare.</p>";
		else{
			while($img=$result->fetch_assoc()){
				$idC=$img["categoria"];
				$find=$connessione->query("SELECT nome from categorie WHERE id='$idC'");
				$res=$find->fetch_assoc();
				$idC=$res["nome"];
				$idImg=$img["id"];
				if(file_exists("upload/".$idImg.'.png')){
					$url="upload/".$idImg.'.png';
				}else if(file_exists("upload/".$idImg.'.jpg')){
						$url="upload/".$idImg.'.jpg';
				}else if(file_exists("upload/".$idImg.'.jpeg')){
						$url="upload/".$idImg.'.jpeg';
				}
				if(isset($url)){
					$count++;
					$list.="<div class=\"boxFormApp\">
								<div class=\"imgInApp\">
									<img src=\"".$url."\" alt=\"immagine da approvare\"/>
								</div>
								<div class=\"formApp\">
									<form method=\"post\" action=\"admin.php\">
										<fieldset>
											<input type=\"hidden\" value=\"".$img["id"]."\" name=\"id\"/>
											<div class=\"inputContactwide\">
												<label>Titolo
												<input class=\"input\" type=\"text\" name=\"titolo\" value=\"".$img["titolo"]."\" readonly=\"readonly\"/></label>
											</div>
											<div class=\"inputContactwide\">
												<label>Autore
												<input class=\"autore\" type=\"text\" name=\"autore\" value=\"".$img["venditore"]."\" readonly=\"readonly\"/></label>
											</div>
											<div class=\"inputContactwide\">
												<label>Categoria
												<input class=\"categoria\" type=\"text\" name=\"categoria\" value=\"".$idC."\" readonly=\"readonly\"/></label>
											</div>
											<div class=\"inputContactwide\">
												<label>Tag1
												<input class=\"tag1\" type=\"text\" name=\"tag1\" value=\"".$img["tag1"]."\"/></label>
											</div>
											<div class=\"inputContactwide\">
												<label>Tag2
												<input class=\"tag2\" type=\"text\" name=\"tag2\" value=\"".$img["tag2"]."\"/></label>
											</div>
											<div class=\"inputContactwide\">
												<label>Tag3
												<input class=\"tag3\" type=\"text\" name=\"tag3\" value=\"".$img["tag3"]."\"/></label>
											</div>
										<div class=\"adminButtons\">
											<button class=\"submitButton\" type=\"submit\" name=\"ok\">Approva</button>
											<button class=\"submitButton\" type=\"submit\" name=\"alter\" value=\"Modifica e approva\">Modifica e approva</button>
											<button class=\"submitButton\" type=\"submit\" name=\"no\" value=\"del\">Elimina</button>
										</div>
										</fieldset>
									</form>
								</div>
							</div>";
							unset($url);
				}
			}
			if($count==0)
				$list.="<p>Non ci sono immagini da approvare.</p>";
		}
		$list.="</div>";
		return $list;
	}

	function money(){
		global $connessione;
		$result=$connessione->query("SELECT SUM(prezzo) AS money FROM carrello INNER JOIN Foto ON carrello.foto=foto.id WHERE carrello.stato='concluso';");
		if($result){
			$tot=$result->fetch_assoc();
			return 5*$tot['money']/100;
		}
	}
	
	$output=file_get_contents("html/admin.html");
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("<meta/>",file_get_contents("html/meta.html"),$output);
	$output=str_replace("%tot%",money(),$output);
	$output=str_replace("<div catList/>",listaCategorie(),$output);
	$output=str_replace("<div listImgApp/>",immaginiApprovazione(),$output);
	
	echo $output;
	
?>
	
