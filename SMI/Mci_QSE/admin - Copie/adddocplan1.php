<!DOCTYPE html>
<html lang="fr"> 
<?php

    session_start();
if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
  ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
    PHP_OUTPUT_HANDLER_REMOVABLE);
} else {
  ob_start(null, 0, false);
} 
    $adp=$_SESSION['adp'];
    if (!isset($_SESSION['nom'])) {
        header("Location: 404.html");
    }
    else {
		if(isset($_POST['valider'])){
		if(isset($_POST['nom']) and $_POST['nom']!=''){
			$nom = $_POST['nom'];
		}
		else{
			header("Location: adddocplan.php?message=1");
		}
		
		if(isset($_POST['type']) and $_POST['type']!=''){
			$type = $_POST['type'];
		}if(isset($_POST['datepre']) ){
			$datepre = $_POST['datepre'];
		}
		else{
			header("Location: adddocplan.php?num=$num&message=4");
		}
		if(isset($_POST['ser']) and $_POST['ser']!=''){
			$ser = $_POST['ser'];
		}
		else{
			header("Location: adddocplan.php?num=$num&message=5");
		}
			include_once 'bd.php';
			
		$nom=$connexion->quote(utf8_decode($nom));	
		$creeDoc=$connexion->exec("INSERT INTO `docprovisoire` values (null,$nom,'".$type."',$ser,0,$adp,'".$datepre."')");
		// redirection vers le planning des document en cours de création ! 
		header("Location: lplanningC.php");

	}
	}

?>