<?php
	require_once "php/server.php";
	$connessione=connessione();
	if(isset($_POST["add"])){
		$newC=mysqli_real_escape_string($connessione,sanitizeString($_POST['newCat']));
		if(!empty($newC)){		
			$result=$connessione->query("INSERT INTO categorie(nome) VALUES ('$newC');");
		}
		
	}
	if(isset($_POST["alter"])){
		$id=mysqli_real_escape_string($connessione,sanitizeString($_POST['id']));
		$cat=$_POST['selectCatApp'];
		$tag1=mysqli_real_escape_string($connessione,sanitizeString($_POST['tag1']));
		$tag2=mysqli_real_escape_string($connessione,sanitizeString($_POST['tag2']));
		$tag3=mysqli_real_escape_string($connessione,sanitizeString($_POST['tag3']));
		$result=$connessione->query("UPDATE foto SET categoria='$cat',tag1='$tag1',tag2='$tag2',tag3='$tag3',stato='approvata' WHERE id='$id';");
		if(!$result)
			header("Location: 404.php");
		else
			header("Location: admin.php");
	}else if(isset($_POST["no"])){
		$id=mysqli_real_escape_string($connessione,sanitizeString($_POST['id']));
		if(file_exists("upload/".$id.'.png')){
			$url="upload/".$id.'.png';
		}else if(file_exists("upload/".$id.'.jpg')){
			$url="upload/".$id.'.jpg';
		}else if(file_exists("upload/".$id.'.jpeg')){
			$url="upload/".$id.'.jpeg';
		}
		unlink($url);
		$result=$connessione->query("DELETE FROM foto WHERE id='$id';");
		if(!$result)
			header("Location: 404.php");
		else
			header("Location: admin.php");
	}else if(isset($_POST["ok"])){
		$id=mysqli_real_escape_string($connessione,sanitizeString($_POST['id']));
		$result=$connessione->query("UPDATE foto SET stato='approvata' WHERE id='$id';");
		if(!$result)
			header("Location: 404.php");
		else
			header("Location: admin.php");
	}
?>