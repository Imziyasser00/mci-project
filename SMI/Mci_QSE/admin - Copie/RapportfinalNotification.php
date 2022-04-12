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
	include 'bd.php';
	$adp=$_SESSION['adp'];
	$num=$_GET['num'];
	if($adp==1 || $adp==2){	

	$updateRef=$connexion->exec("UPDATE notificationaudit  SET  notificationaudit.valide='1' where num='".$num."'");
	if($updateRef!=0){
		header("Location: Rapportfinal.php?num=$num");
	}
	}
	}
?>