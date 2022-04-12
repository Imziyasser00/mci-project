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
    if (!isset($_GET['ann']) || !isset($_GET['idproc']) || !isset($_GET['num']))
	{
		header('Location: 404.html');
	}
	else 
	{
	include_once 'bd.php';

	$ann=htmlspecialchars($_GET['ann']);
	$idproc=htmlspecialchars($_GET['idproc']);
	$num=htmlspecialchars($_GET['num']);
	
	if($num != ""){
		$result=$connexion->exec("UPDATE nonconfirmite  SET  
	nonconfirmite.cop='1' where nonconfirmite.num_audit='".$num."' ");
	
			header("Location: planaction1.php?ann=$ann&idproc=$idproc");
		
	
	}
	else{
	header('Location: 404.html');
	}
	}
	
	?>
	