<?php   
   session_start();
if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
  ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
    PHP_OUTPUT_HANDLER_REMOVABLE);
} else {
  ob_start(null, 0, false);
} 
$adp=$_SESSION['adp'];
if($adp!=2 and $adp!=1 and $adp!=3){
		header("Location: 404.html");
		// echo '1';
	}
	else{
if(!isset($_SESSION['nom']) || !isset($_GET['ann']) || !isset($_GET['idproc'])){
// echo '2';
	header("Location: 404.html");
}
else{
	include_once 'bd.php';
	
		$ann=$_GET['ann'];
		$idproc=$_GET['idproc'];
	
			$result=$connexion->exec("UPDATE planaction  SET  
	planaction.rop='1' where planaction.id_proc=$idproc and planaction.ann='".$ann."'");
$i=0;
										
						
					 header("Location: planaction1.php?ann=$ann&idproc=$idproc");
					
						}
						
	}					
						
						