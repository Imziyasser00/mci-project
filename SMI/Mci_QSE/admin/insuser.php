<!DOCTYPE html>
<html lang="en"> 
<?php

    session_start();

    if ($_SESSION['adp']==0){
	header("Location: 404.html");
	}
    elseif (!isset($_SESSION['nom'])) {
        header("Location: ../../../login.php");
    }
    if (!isset($_POST['valider']) || !isset($_POST['nom']) || empty($_POST['sservice']) || !isset($_POST['prenom']) || !isset($_POST['ser']) || !isset($_POST['login']) || !isset($_POST['mdp']))
	{
		header('Location: 404.html');
	}
	if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['sservice']) || empty($_POST['ser']) || empty($_POST['login']) || empty($_POST['mdp']) || empty($_POST['mail']))
	{

		header("Location: showusers.php?cs=2");
	}
	else 
	{
	include_once 'bd.php';
	$r1=htmlspecialchars($_POST['login']);
	$r2=htmlspecialchars($_POST['mdp']);
	$r3=htmlspecialchars($_POST['nom']);
	$r4=htmlspecialchars($_POST['prenom']);
	$r5=htmlspecialchars($_POST['ser']);
	$mail=htmlspecialchars($_POST['mail']);
	
	// $getServiceID=$connexion->prepare('select id from service where nom=?');
	// $getServiceID->execute(array($r5));
	// $idservervice = $getServiceID->Fetch(PDO::FETCH_ASSOC);
	// $r5=$idservervice['id'];
	$r6=htmlspecialchars($_POST['sservice']);
	$r7=htmlspecialchars($_POST['fonction']);
	
	$req1=$connexion->query("SELECT * from utilisateur WHERE utilisateur.username='$r1' union SELECT * from utilisateur WHERE utilisateur.nom='$r3' union SELECT * from utilisateur WHERE utilisateur.prenom='$r4'");
	$nbr=$req1->rowcount();
	if($nbr==0){
	$result=$connexion->exec("INSERT INTO utilisateur VALUES(null,'$r5','$r6','$r1','$r2','$r3','$r4','$r7','$mail',0)");
	if($result!=0)   
		{		
		header("Location: showusers.php?cs=1");
		}
	else{
		echo 'Location: 404.html';
	}
	}
	else{
	header("Location: showusers.php?cs=3");		
	}
	}
	
	?>
	