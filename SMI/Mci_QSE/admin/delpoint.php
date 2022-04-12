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
    if (!isset($_GET['pid']) || !isset($_GET['idproc']) || !isset($_GET['ann']))
	{
		header('Location: 404.html');
	}
	else 
	{
	include_once 'bd.php';
	$idPoint=$_GET['pid'];
	$ann=$_GET['ann'];
	$idproc=$_GET['idproc'];
	$result = $connexion->query("DELETE FROM nonconfirmite WHERE nonconfirmite.id_Point=".$idPoint."");

				header('Location: planaction1.php?idproc='.$idproc.'&ann='.$ann.'');

	}
	
	?>
	