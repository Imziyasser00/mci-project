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
        header("Location: 404.html");
    }
    else {
		if(isset($_POST['suivant'])){
	$num=$_GET['num'];	
		if(isset($_POST['objectif']) and $_POST['objectif']!=''){
			$objectif = $_POST['objectif'];
		}
		else{
			header("Location: addfiche.php?num=$num&message=1");
		}
		if(isset($_POST['lieu']) and $_POST['lieu']!=''){
			$lieu = $_POST['lieu'];
		}
		else{
			header("Location: addfiche.php?num=$num&message=1");
		}
		if(isset($_POST['date']) and $_POST['date']!=''){
			$date = $_POST['date'];
		}
		else{
			header("Location: addfiche.php?num=$num&message=1");
		}
		if(isset($_POST['idr']) and $_POST['idr']!=''){
			$idr = $_POST['idr'];
		}
		else{
			header("Location: addfiche.php?num=$num&message=2");
		}
		if(isset($_POST['auditee']) and $_POST['auditee']!=''){
			$auditee = $_POST['auditee'];
		}
		else{
			header("Location: addfiche.php?num=$num&message=3");
		}
		if(isset($_POST['id_RA']) and $_POST['id_RA']!=''){
			$id_RA = $_POST['id_RA'];
		}
		else{
			header("Location: addfiche.php?num=$num&message=4");
		}
		if(isset($_POST['id_ss']) and $_POST['id_ss']!=''){
			$id_ss = $_POST['id_ss'];
		}
		else{
			header("Location: addfiche.php?num=$num&message=5");
		}
			include_once 'bd.php';
			
			$idr=utf8_decode($idr);
			$lieu=utf8_decode($lieu);
			$objectif = $_POST['objectif'];
			
			foreach ( $objectif as $tab ) 
		{ 
		$tab=$connexion->quote(utf8_decode($tab));	
		$creeObjectif=$connexion->exec("INSERT INTO `Objectifaudit` values ('',$tab,'$num')");
		$cleerObjectif=$connexion->exec("DELETE FROM `Objectifaudit` WHERE objectif=''");
		}
			$creefiche=$connexion->prepare("INSERT INTO `fichdaudit` values ('',?,? ,?,?,?,?)");
			$creefiche->execute(array($id_RA,$id_ss,$date,$lieu,$idr,$num));
		
			if($creefiche!=0){
				while ($monchoix = array_shift($auditee)){				
				$result3=$connexion->exec("INSERT INTO `mci`.`auditee`  VALUES ('', '$num', $monchoix )");
	
			}
			$reponsable = $_POST['reponsable'];
			$creeREA=$connexion->exec("INSERT INTO `respentaudite` values ('',$reponsable ,'$num')");
			header("Location: addfiche1.php?num=$num");
			}
			else{
				echo $id_RA;
			}
			
	
	
	}
	}

?>