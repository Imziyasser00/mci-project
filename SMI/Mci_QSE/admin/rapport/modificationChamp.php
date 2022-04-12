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
		if(isset($_POST['champ'])){
			$champ = $_POST['champ'];
		}
		else{
		header("Location: ../404.html");	
		}
			
			include_once '../bd.php';
			
			$champ=$connexion->quote(utf8_decode($champ));
			$updateRef=$connexion->exec("UPDATE point  SET  point.commentaire='".$champ."' where numero_audit='".$num."' and type ='champ'");
			
			if($updateRef!=0){						
				
			header("Location: ../RapportFinal.php?num=$num");
			}
			else{
			$updateRef=$connexion->exec("INSERT INTO  point  VALUES(null,'champ','".$num."',".$champ.")");
				header("Location: ../RapportFinal.php?num=$num");
				//echo $champ;
			}
			
	
	
							}
	}

?>