<?php
	require_once "dbhandler.php";
	if(!isset($_SESSION)){
		session_start();
	}
	$connessione=connessione();
	
	if(isset($_POST["submit"])){
		if(!empty($_POST["search"])){
			$value=$_POST["search"];
			$type=$_POST["searchType"];
			if($type=="user"){
				$sql="SELECT * FROM utenti WHERE username='$value' OR email='$value';";
				$result=$connessione->query($sql);
				if(mysqli_num_rows($result) == 0)
					$notFound=true;
				else{
					$result=$result->fetch_assoc();
					$user=$result["username"];
					header("Location: user.php?user=$user");
				}
			}else if($type=="imm"){
				$result=$connessione->query("SELECT titolo,id FROM foto;");
				$found=array();
				while($titolo=$result->fetch_assoc()){
					if(!(stripos($titolo["titolo"],$value,0)===false)){
						$id=$titolo["id"];
						$found[$id]=$id;
					}
				}
				getImgSubGallery($found);
			}else{
				$result=$connessione->query("SELECT * FROM categorie");
				while($cat=$result->fetch_assoc()){
					if(strcasecmp($value, $cat["nome"])==0)
						header("Location: catGallery.php?photo=".$cat["id"]);
				}
				$resultTag=$connessione->query("SELECT id, tag1, tag2, tag3 FROM foto;");
				$found=array();
				while($test=$resultTag->fetch_assoc()){
					if(!(stripos($test["tag1"],$value,0)===false && strpos($test["tag2"],$value,0)===false && strpos($test["tag3"],$value,0)===false)){
						$id=$test["id"];
						$found[$id]=$id;
					}
				}
				getImgSubGallery($found);
			}
		}else
			$notFound=true;
	}
	
	function getImgSubGallery($found){
		if(empty($found)){
			global $notFound;
			$notFound=true;
		}else{
			global $connessione;
			$img='';
			foreach($found as $idImg => $id){
				$result=$connessione->query("SELECT * FROM foto WHERE id='$id';");
				$foto=$result->fetch_assoc();
				$titolo=$foto["titolo"];
				if(file_exists("upload/".$id.'.png')){
					$url="upload/".$id.'.png';
				}else if(file_exists("upload/".$idImg.'.jpg')){
					$url="upload/".$id.'.jpg';
				}else if(file_exists("upload/".$idImg.'.jpeg')){
					$url="upload/".$id.'.jpeg';
				}
				$img.="<div class=\"listImg\"><p><span class=\"titolo\">".$titolo."</span></p>
				<a href=\"imgDet.php?img=".urlencode($id)."\">
					<img class=\"transiction\" src=\"".$url."\" alt=\"".$titolo."\"/>
				</a></div>";
			}
			return $img;
		}
	}
	
	function notFound(){
		global $notFound;
		return $notFound;
	}
?>