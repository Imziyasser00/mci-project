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
		else{
		header("Location: ../404.html");	
		}
			
			include_once '../bd.php';
			
			$reps1=$connexion->quote(utf8_decode($reps1));
			$updateRef=$connexion->exec("UPDATE point  SET  point.commentaire=$reps1 where numero_audit='".$num."' and type ='ref'");
			
			if($updateRef!=0){						
				
			header("Location: ../RapportFinal.php?num=$num");
			}
			else{
				echo $num;
			}
			
	
	
							}
	}

?>