<!DOCTYPE html>
<html lang="fr"> 
<?php

    session_start();
if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
  ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
    PHP_OUTPUT_HANDLER_REMOVABLE);
} 
else {
  ob_start(null, 0, false);
} 
    
    if (!isset($_SESSION['nom']) || !isset($_GET['num'])) {
        header("Location: 404.html");
    }
    else {
		if(isset($_POST['suivant'])){
			$pf = $_POST['pf'];	
			$pf1 = $_POST['pf1'];	
			include_once 'bd.php';
			$num=$_GET['num'];
	$num=utf8_decode($num);
		$pf=str_replace('’', '\'', $pf); 
		$tab=$connexion->quote(utf8_decode($pf));
		$tab1=$connexion->quote(utf8_decode($pf1));
		
		
		$creePoint=$connexion->exec("INSERT INTO `point` values (null,'ref','$num',$tab)");
		$creePoint1=$connexion->exec("INSERT INTO `point` values (null,'champ','$num',$tab1)");
	
		
			header("Location: addRapportPF0.php?num=$num");
	
	}
	}
	
?>