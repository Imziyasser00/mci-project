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
    if (!isset($_SESSION['nom'])) {
        header("Location: login.php");
    }
    else {
		$service = $_SESSION['ids'];
		if (!isset($_GET['service']) || !isset($_GET['type'])){
			
	header("Location: ../404.html");
		}
	else {
		include_once 'bd.php';
	$serv=$_GET['service'];	
	$type=$_GET['type'];	
	$adp=$_SESSION['adp'];

		header("location: documents.php?type=$type&service=$serv");


	}
	}
	?>
</html>
