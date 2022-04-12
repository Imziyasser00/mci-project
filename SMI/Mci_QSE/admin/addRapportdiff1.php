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
			$today = date("Y-m-d");
			$num=$_GET['num'];
	$num=utf8_decode($num);	
				while ($monchoix = array_shift($diffrap)){				
				$result3=$connexion->exec("INSERT INTO `mci`.`diffusionaudit`  VALUES (null, '".$num."', ".$monchoix." )");
		
			}
			
		 $result=$connexion->exec("UPDATE rapportcreeoupas  SET   rapportcreeoupas.cop=1 , rapportcreeoupas.date='$today'  where rapportcreeoupas.audit_num='$num'");
		 if($result3!=0 and $result!=0){
			 $message="Le rapport d\'audit n° ".$num." est crée par le responsable d\'audit";
			 $creeNotification=$connexion->exec("INSERT INTO `mci`.`notificationaudit`  VALUES (null,'".$num."', ".$message.",'".$today."','0')");
			header("Location: RapportFinal.php?num=$num");
			
		}
		else{
			header("Location: addRapportdiff.php?num=$num");
		}
	}
	}
	
	
?>