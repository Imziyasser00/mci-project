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
    if (!isset($_POST['valider']) || !isset($_POST['id'])  || !isset($_POST['fonction']) || !isset($_POST['back']))
	{
		header('Location: 404.html');
	}
	$r3=0;
	$r4=0;	
	if(isset($_POST['valider'])){
	include_once 'bd.php';
	$id=($_POST['id']);
	$r2=($_POST['fonction']);
	if(isset($_POST['Q'])){
	$r3=($_POST['Q']);
	}
	if(isset($_POST['B'])){
	$r4=($_POST['B']);
	}
	$result=$connexion->exec("UPDATE auditeur  SET auditeur.fonction='$r2', auditeur.qse=$r3, auditeur.bpf=$r4  where auditeur.id=$id ");
	
				header('Location: modauditeur.php');
	}
	if(isset($_POST['back'])){
		header('Location: modauditeur.php');
	}
	
?>