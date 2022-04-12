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
    
    if (!isset($_SESSION['nom']) || !isset($_GET['num'])) {
        header("Location: ../404.html");
    }
    else {
		if(isset($_POST['valider'])){
	$num=$_GET['num'];	
		if(isset($_POST['pointA'])){
			$reps1 = $_POST['pointA'];
		}
		else{
		header("Location: ../404.html");	
		}
			
			include_once '../bd.php';
			
		$pointA = $_POST['pointA'];		
		$doubleoint=$connexion->exec('DELETE FROM `point` WHERE numero_audit="'.$num.'" and type ="ameliorati"');
			foreach ( $pointA as $tab ) 
		{ 
		$tab=str_replace('’', '\'', $tab); 
		$tab=$connexion->quote(utf8_decode($tab));
		
		$creePoint=$connexion->exec("INSERT INTO `point` values ('','ameliorati','$num',$tab)");
		$cleerPoint=$connexion->exec("DELETE FROM `point` WHERE commentaire=''");
		}	
			
			if($creePoint!=0){						
				
			header("Location: ../RapportFinal.php?num=$num");
			}
			else{
				header("Location: ../404.html");
			}
			
	
	
							}
	}

?>