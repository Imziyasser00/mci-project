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
	else{
	if(isset($_POST['monchoix']) and $_POST['monchoix']!=''){
			
			$diffrap = $_POST['monchoix'];
	}
	else {
			 $diffrap = '';
	  }		
	if(isset($_POST['suivant'])){
			include_once 'bd.php';
			$num=$_GET['num'];
	$num=utf8_decode($num);	
				while ($monchoix = array_shift($diffrap)){				
				$result3=$connexion->exec("INSERT INTO `mci`.`auditeefinal`  VALUES ('', '$num', $monchoix )");				
	
			}
			
		
			header("Location: addRapportdiff.php?num=$num");
	
	}
	}
	
	
?>