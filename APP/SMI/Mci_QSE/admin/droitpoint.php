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

	$dateV=htmlspecialchars($_POST['dateV']);
	$pid=$_GET['pid'];
	$idproc=$_GET['idproc'];
	$ann=$_GET['ann'];
	$selectNCR=$connexion->query('select * from pointDroit where id_point='.$pid.'');
	$verifNCR=$selectNCR->rowcount();
		if($verifNCR!=0){			
	$result=$connexion->exec("UPDATE pointDroit  SET  
	pointDroit.droit='0' WHERE pointDroit.id_point=".$pid."");
	
				header('Location: planaction1.php?idproc='.$idproc.'&ann='.$ann.'');
	
	}
		else {
		$result=$connexion->exec("insert into  pointDroit  VALUES('',$pid,'1')");	
			if($result!=0) {
				header('Location: planaction1.php?idproc='.$idproc.'&ann='.$ann.'');
			}
		}
		
	}
	
	?>
	