
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
		$list="<div id=\"catList\"><ul>";
		$categorie=$connessione->query("SELECT nome FROM categorie ORDER BY nome;");
		while($cat=$categorie->fetch_assoc()){
			$list.="<li>".$cat["nome"]."</li>";
		}
		$list.="</div></ul>";
		return $list;
	}
	
	function immaginiApprovazione(){
		global $connessione;
		$list="<div id=\"inApp\">";
		$result=$connessione->query("SELECT * FROM foto WHERE stato='in attesa' ORDER BY data");
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
			$list.="<div id=\"boxFormApp\">
					<div class=\"imgInApp\">
						<img src=\"".$url."\" alt=\"immagine da approvare\"/>
					</div>
					<div id=\"formApp\">
						<form class=\"formStyle\" method=\"post\" action=\"admin.php\">
                            <div class=\"modify\">
								<input type=\"hidden\" value=\"".$img["id"]."\" name=\"id\"/>
								<div class=\"inputContactwide\">
									<label for=\"titolo\">Titolo</label>
									<input type=\"text\" name=\"titolo\" value=\"".$img["titolo"]."\" readonly=\"readonly\"/>
								</div>
								<div class=\"inputContactwide\">
									<label for=\"autore\">Autore</label>
									<input type=\"text\" name=\"autore\" value=\"".$img["venditore"]."\" readonly=\"readonly\"/>
								</div>
								<div class=\"inputContactwide\">
									<label for=\"categoria\">Categoria</label>
									<input type=\"text\" name=\"categoria\" value=\"".$idC."\" readonly=\"readonly\"/>
								</div>
								<div class=\"inputContactwide\">
									<label for=\"tag1\">Tag1</label>
									<input type=\"text\" name=\"tag1\" value=\"".$img["tag1"]."\"/>
								</div>
								<div class=\"inputContactwide\">
									<label for=\"tag2\">Tag2</label>
									<input type=\"text\" name=\"tag2\" value=\"".$img["tag2"]."\"/>
								</div>
								<div class=\"inputContactwide\">
									<label for=\"tag3\">Tag3</label>
									<input type=\"text\" name=\"tag3\" value=\"".$img["tag3"]."\"/>
								</div>
							</div>
							<div class=\"adminButtons\">
								<button class=\"submitButton\" type=\"submit\" name=\"ok\">Approva</button>
								<button class=\"submitButton\" type=\"submit\" name=\"alter\" value=\"Modifica e approva\">Modifica e approva</button>
								<button class=\"submitButton\" type=\"submit\" name=\"no\" id=\"del\">Elimina</button>
							</div>
						</form>
					</div>
				</div>";
		}
		$list.="</div>";
		return $list;
	}
	
	$output=file_get_contents("html/admin.html");
	$output=str_replace("<div id=\"header\"></div>", Header::build(), $output);
	$output=str_replace("<div id=\"footer\"></div>", Footer::build(), $output);
	$output=str_replace("<meta/>",file_get_contents("html/meta.html"),$output);
	$output=str_replace("<div catList/>",listaCategorie(),$output);
	$output=str_replace("<div listImgApp/>",immaginiApprovazione(),$output);
	
	echo $output;
	
?>
	