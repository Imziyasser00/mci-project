<!DOCTYPE html>
<html lang="en"> 
<?php

    session_start();


   if (!isset($_SESSION['nom'])) {
        header("Location: login.php");
    }
    if (!isset($_GET['pid']) || !isset($_GET['num']) || !isset($_GET['an']) || !isset($_GET['idproc']))
	{
		header('Location: 404.html');
	}
	else 
	{
	include_once 'bd.php';
	$proposition=htmlspecialchars($_POST['proposition']);
	$proposition=str_replace('’', '\'', $proposition);
	$proposition=$connexion->quote($proposition);	
	$dateR=htmlspecialchars($_POST['dateR']);
	
	$pid=$_GET['pid'];
	$num=$_GET['num'];
	$an=$_GET['an'];
	$idproc=$_GET['idproc'];
	$selectNCR=$connexion->query('select * from confirmitereponse where id_point='.$pid.'');
	$verifNCR=$selectNCR->rowcount();
		if($verifNCR!=0){			
	$result=$connexion->exec("UPDATE confirmitereponse  SET  
	confirmitereponse.proposition=$proposition, confirmitereponse.dateR='$dateR' WHERE confirmitereponse.id_point=".$pid."");
	
				header('Location: completerPlan.php?num='.$num.'&an='.$an.'&idproc='.$idproc.'');
	
	}	
		else {
		$result=$connexion->exec("insert into  confirmitereponse  VALUES(null,$pid,$proposition,'$dateR','')");	
			if($result!=0) {
				header('Location: completerPlan.php?num='.$num.'&an='.$an.'&idproc='.$idproc.'');
			}
		}
		
	}
	
	?>
	