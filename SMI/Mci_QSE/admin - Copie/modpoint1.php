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
	$idproc=$_GET['idproc'];
	$ann=$_GET['ann'];
		 if (isset($_POST['valider'])) {
	include_once 'bd.php';
	$acap=htmlspecialchars($_POST['acap']);
	$remarque=htmlspecialchars($_POST['remarque']);
	$resp=htmlspecialchars($_POST['resp']);
	$pid=$_GET['pid'];
	
	
	$result=$connexion->exec("UPDATE nonconfirmite  SET  
	nonconfirmite.acap='$acap', nonconfirmite.remarque='$remarque', nonconfirmite.resp='$resp' WHERE nonconfirmite.id_point=$pid");
	if($result!=0)   
		{
				header('Location: planaction1.php?idproc='.$idproc.'&ann='.$ann.'');
		
		}
	else{
		header('Location: planaction1.php?idproc='.$idproc.'&ann='.$ann.'');
	}
										}
		if (isset($_POST['annuler'])) {
			header('Location: planaction1.php?idproc='.$idproc.'&ann='.$ann.'');
		}			
		}
	
	?>
	