<?php
require_once "dbhandler.php";
    $connessione=connessione();
    if (!isset($_SESSION)) {
        session_start();
    }

    $idImg = $_GET["id"];
    $action = $_GET["action"];
    
    $user=$_SESSION['username'];

    $data = date("Y-m-d");
    if($action=="aggiungi-carrello")
        $result=$connessione->query("INSERT INTO `carrello` (utente, foto, data, stato) VALUES('$user','$idImg','$data', 'in corso' )");
    else
        $result=$connessione->query("DELETE FROM `carrello` WHERE foto='$idImg' AND utente='$user' ");
     
      
   
    
?>
