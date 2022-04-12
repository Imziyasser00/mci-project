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
	include_once 'bd.php';
    if (!isset($_SESSION['nom'])) {
        header("Location: 404.html");
    }
    else {
		if(isset($_POST['valider'])){
		if(isset($_POST['iddoc'])){
			$iddoc = $_POST['iddoc'];
			$re=$connexion->query("SELECT * from document where id=$iddoc");
			while($ose2 = $re->Fetch(PDO::FETCH_ASSOC)){
														$nom=$ose2['nom'];
														$string = $nom;
														$patterns = array();
														$patterns[0] = '/.pdf/';
														$replacements = array();
														$replacements[0] = '';
														$nom= preg_replace($patterns, $replacements, $string);														
														$type=$ose2['type'];														
														$ser=$ose2['id_service'];
		}
		}

		else{
			header("Location: revdoc.php?num=$num&message=5");
		}
			include_once 'bd.php';
			
		$nom=$connexion->quote(utf8_decode($nom));	
		$creeDoc=$connexion->exec("INSERT INTO `docprovisoire` values (null,$nom,'".$type."',$ser,2,$adp)");
		// redirection vers le planning des document en cours de création ! 
		header("Location: lplanning.php");
		// echo $nom;

	}
	}

?>