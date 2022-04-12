<!DOCTYPE html>
<html lang="en"> 
<?php

    session_start();

    if ($_SESSION['adp']==0){
	header("Location: 404.html");
	}
    elseif (!isset($_SESSION['nom'])) {
        header("Location: login.php");
    }
    if (!isset($_POST['valider']) || !isset($_POST['num']) || empty($_POST['ann']))
	{
		header('Location: 404.html');
	}
	if (empty($_POST['num']) || empty($_POST['ann']))
	{

		header("Location: 404.html");
	}
else{
	include_once 'bd.php';
	$num=$_GET['num'];
	$ann=$_GET['ann'];
	$cousnt = $connexion->prepare("DELETE FROM auditprevu WHERE auditprevu.numero=? and auditprevu.ann=?");
	$cousnt->execute(array($num,$ann));
	header("Location: planaudits.php");
}