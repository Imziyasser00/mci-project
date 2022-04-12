<?php   
   session_start();
if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
  ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
    PHP_OUTPUT_HANDLER_REMOVABLE);
} else {
  ob_start(null, 0, false);
} 
$adp=$_SESSION['adp'];
if($adp!=2 and $adp!=1){
		header("Location: 404.html");
		// echo '1';
	}
	else{
if(!isset($_SESSION['nom']) || !isset($_GET['ann'])){
// echo '2';
	header("Location: 404.html");
}
else{
	include_once 'bd.php';
	
		$ann=$_GET['ann'];
	
			$confirm=$connexion->EXEC("UPDATE plandaudit set plandaudit.cop=0 where  plandaudit.annee=$ann");
			if($confirm!=0)   
					{
					$delfiche=$connexion->query("DELETE from fichecreeoupas  where  fichecreeoupas.annee=$ann");	
					header("Location: planaudits1.php?ann=$ann");
						}
				else{
					header("Location: 404.html");
					// echo 'lol';
					}
	}					
	}					
						