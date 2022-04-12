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
    if (!isset($_POST['valider']) || !isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['ser']) || !isset($_POST['login']) || !isset($_POST['mdp']))
	{
		header('Location: 404.html');
	}
	if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['ser']) || empty($_POST['login']) || empty($_POST['mdp']) || empty($_POST['mail']))
	{

		header('Location: 404.html');
	}
	else 
	{
	include_once 'bd.php';
	$r1=htmlspecialchars($_POST['login']);
	$r2=htmlspecialchars($_POST['mdp']);
	$r3=htmlspecialchars($_POST['nom']);
	$r4=htmlspecialchars($_POST['prenom']);
	$r5=htmlspecialchars($_POST['ser']);
	$r6=htmlspecialchars($_POST['sservice']);
	$r7=htmlspecialchars($_POST['Fonction']);
	$mail=htmlspecialchars($_POST['mail']);
	$id=($_POST['id']);
	$result=$connexion->exec("UPDATE utilisateur  SET  
	utilisateur.username='$r1', utilisateur.mdp='$r2', utilisateur.nom='$r3',
	utilisateur.prenom='$r4', utilisateur.id_service=$r5, 
	utilisateur.id_sservice=$r6, utilisateur.fonction='$r7', utilisateur.mail='$mail' where utilisateur.id=$id ");
	if($result!=0)   
		{
			echo "<h3> Modification avec succée </h3>" ;
		
		}
	
	else{
		echo $r7 ;
	}
	}
	
	?>
	