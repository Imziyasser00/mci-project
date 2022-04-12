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
		if(isset($_POST['time'])){
			$reps2 = $_POST['time'];
		}
		 if(isset($_POST['dateo'])){
			$reps1 = $_POST['dateo'];
		 } if(isset($_POST['reunionouverture'])){
			$reunionouverture = $_POST['reunionouverture'];
		 }
		if(isset($_POST['id_fiche'])){
			$id_fiche = $_POST['id_fiche'];
		}
		if(isset($_POST['optionsRadios'])){
			$optionsRadios = $_POST['optionsRadios'];
		}
		else{
		header("Location: ../404.html");	
		}
			
			include_once '../bd.php';
			
			// $reps2=utf8_decode($reps2);
			if($optionsRadios=="reunioncloture"){
			$optionsRadios1="presencecloture";
		}
		elseif($optionsRadios=="reunionouverture"){
			$optionsRadios1="presenceouverture";
		}
			$compfiche=$connexion->exec("UPDATE $optionsRadios  SET  date='".$reps1."' ,time='".$reps2."' where numero='".$num."'");
			$result3=$connexion->query("Delete from $optionsRadios1 where num_audit='".$num."'");
			
				while ($monchoix = array_shift($reunionouverture)){				
				
				$result4=$connexion->exec("INSERT INTO $optionsRadios1  VALUES (null, '".$num."', ".$monchoix." )");
			}
								
				
			 header("Location: ../addfiche5.php?num=$num");	
	// echo $optionsRadios;
							}
						
	}

?>