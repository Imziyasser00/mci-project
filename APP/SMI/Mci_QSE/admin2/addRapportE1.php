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
			include_once 'bd.php';
			$num=$_GET['num'];
	$num=utf8_decode($num);
	
	foreach ( $pf as $tab ) 
	{ 
		$tab=str_replace('’', '\'', $tab); 
		$tab=$connexion->quote(utf8_decode($tab));
		
		
		$creePoint=$connexion->exec("INSERT INTO `point` values ('','ecart mineur','$num',$tab)");
		$cleerPoint=$connexion->exec("DELETE FROM `point` WHERE commentaire=''");
	}
	
		
			header("Location: addRapportEM.php?num=$num");
	
	}
	}
	
?>