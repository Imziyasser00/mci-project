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
    if (!isset($_GET['pid']) || !isset($_GET['ann']) || !isset($_GET['idproc']) || !isset($_GET['resp']))
	{
		header('Location: 404.html');
	}
	else 
	{
	include_once 'bd.php';
	$pid=htmlspecialchars($_GET['pid']);
	$ann=htmlspecialchars($_GET['ann']);
	$idproc=htmlspecialchars($_GET['idproc']);
	$resp=htmlspecialchars($_GET['resp']);
	if($resp != ""){
	$result=$connexion->exec("UPDATE nonconfirmite  SET  
	nonconfirmite.cop='1' where nonconfirmite.id_point=$pid ");
	if($result!=0)   
		{
			header("Location: planaction1.php?ann=$ann&idproc=$idproc");
		
		}
	
	else{
		header("Location: 404.html");
	}
	}
	else{
		header("Location: planaction1.php?ann=$ann&idproc=$idproc&info=1");
	}
	}
	
	?>
	