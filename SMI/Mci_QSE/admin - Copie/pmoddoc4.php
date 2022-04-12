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
    if (!isset($_GET['doc_id']))
	{
		header('Location: 404.html');
	}
	else 
	{
	include_once 'bd.php';
	$dater='';
	$datef='';
	$datep='';
	$programme='';
	$etat='';
	$statut='';
	$remarque='';
	if(isset($_POST['dater']) ){
	$dater=$connexion->quote($_POST['dater']);
	}
	if(isset($_POST['datef']) ){
	$datef=$connexion->quote($_POST['datef']);
	}
	if(isset($_POST['datep']) ){
	$datep=$connexion->quote($_POST['datep']);
	}
	if(isset($_POST['programme']) ){
	$programme=$connexion->quote($_POST['programme']);
	}
	if(isset($_POST['etat']) ){
	$etat=$connexion->quote($_POST['etat']);
	}
	if(isset($_POST['statut']) ){
	$statut=$connexion->quote($_POST['statut']);
	}
	if(isset($_POST['remarque']) ){
	$remarque=$connexion->quote($_POST['remarque']);
	}
	$doc_id=$_GET['doc_id'];
	
	$selectNCR=$connexion->query("select * from planning where id_doc='".$doc_id."'");
	$verifNCR=$selectNCR->rowcount();
		if($verifNCR!=0){
	$result=$connexion->exec("UPDATE planning  SET 
	planning.dateP=$datep ,
	planning.dateR=$dater ,
	planning.progamme=$programme ,
	planning.dateF=$datef ,	
	planning.statut=$statut ,	
	planning.remarque=$remarque 	
	WHERE planning.id_doc='".$doc_id."'");
				header('Location: lplanning.php');
	
	}
		else {
		$result=$connexion->exec("insert into  planning  VALUES(null,$doc_id,$programme,$datep,$dater,$datef,$statut,$remarque)");	
			if($result!=0) {
				header('Location: lplanning.php');
			}
		}
		header('Location: lplanning.php');
		
	}
	
	?>
	