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
		if(isset($_POST['reps1'])){
			$reps1 = $_POST['reps1'];
		}
		// if(isset($_POST['reps2'])){
			// $reps2 = $_POST['reps2'];
		// }
		if(isset($_POST['id_fiche'])){
			$id_fiche = $_POST['id_fiche'];
		}
		else{
		header("Location: ../404.html");	
		}
			
			include_once '../bd.php';
			
		$objectif = $_POST['objectif'];	
	$doubleObjectif=$connexion->exec("DELETE FROM `Objectifaudit` WHERE num_audit='".$num."'");				
			foreach ( $objectif as $tab ) 
		{ 
		$tab=str_replace('’', '\'', $tab); 
		$tab=$connexion->quote(utf8_decode($tab));	
		
		$creeObjectif=$connexion->exec("INSERT INTO `Objectifaudit` values ('',$tab,'$num')");
		$cleerObjectif=$connexion->exec("DELETE FROM `Objectifaudit` WHERE objectif=''");
		}	
			
			if($creeObjectif!=0){						
				
			header("Location: ../addfiche5.php?num=$num");
			}
			else{
				echo $id_fiche;
			}
			
	
	
							}
	}

?>