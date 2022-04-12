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
	if($adp!=1 and $adp!=2){
		header("Location: 404.html");
	}
    if (!isset($_SESSION['nom']) || !isset($_GET['id_fiche']) || !isset($_GET['num'])) {
        header("Location: 404.html");
    }
	$id_fiche=$_GET['id_fiche'];
	$num=$_GET['num'];
	include_once '../bd.php';
	$ann=$connexion->exec("UPDATE fichecomqse  SET  fichecomqse.vop=0 where id_fiche=$id_fiche ");
	if($ann!=0){						
				
			header("Location:../addfiche5.php?num=$num");
			}
			else{
				echo $id_fiche;
			}
	
	
	
?> 