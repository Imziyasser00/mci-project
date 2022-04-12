<?php 
session_start();

    if ($_SESSION['adp']==0){
	header("Location: 404.html");
	}
	 elseif (!isset($_SESSION['nom'])) {
        header("Location: login.php");
    }
if(!isset($_GET['id'])){
	header("Location: 404.html");
}
else{
	include_once 'bd.php';
	$id=$_GET['id'];
	$cousnt = $connexion->query("DELETE FROM utilisateur WHERE utilisateur.id=$id");
	header("Location: showusers.php");
}
?>
	