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

	$dateV=$connexion->quote($_POST['dateV']);
	$dateR=$connexion->quote($_POST['dateR']);
	$pid=$_GET['pid'];
	$idproc=$_GET['idproc'];
	$proposition=$connexion->quote($_POST['proposition']);	
	$remarque=$connexion->quote($_POST['remarque']);	
	$resp=$_POST['resp'];	
	$result=$connexion->exec("UPDATE nonconfirmite  SET  nonconfirmite.resp='$resp' , nonconfirmite.remarque=$remarque WHERE nonconfirmite.id_point=".$pid."");
	
	$ann=$_GET['ann'];
	$selectNCR=$connexion->query('select * from confirmitereponse where id_point='.$pid.'');
	$verifNCR=$selectNCR->rowcount();
		if($verifNCR!=0){			
	$result=$connexion->exec("UPDATE confirmitereponse  SET  
	confirmitereponse.proposition=$proposition, confirmitereponse.dateV=$dateV, confirmitereponse.dateR=$dateR WHERE confirmitereponse.id_point=".$pid."");
	
				header('Location: planaction1.php?idproc='.$idproc.'&ann='.$ann.'');
	
	}
		else {
		$result=$connexion->exec("insert into  confirmitereponse  VALUES('',$pid,$proposition,$dateR,$dateV)");	
			if($result!=0) {
				header('Location: planaction1.php?idproc='.$idproc.'&ann='.$ann.'');
			}
		}
		header('Location: planaction1.php?idproc='.$idproc.'&ann='.$ann.'');
	}
	
	?>
	