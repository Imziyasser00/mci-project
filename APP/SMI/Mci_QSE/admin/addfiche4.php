<!DOCTYPE html>
<html lang="fr"> 
<meta charset="utf-8"/>
<?php

    session_start();
if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
  ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
    PHP_OUTPUT_HANDLER_REMOVABLE);
} else {
  ob_start(null, 0, false);
} 
    
    if (!isset($_GET['num'])) {
        header("Location: 404.html");
    }
    else {
		if(isset($_POST['suivant'])){
	$num=$_GET['num'];	
		if(isset($_POST['time']) and $_POST['time']!=''){
			$time = $_POST['time'];
		}
		else{
			header("Location: addfiche.php?num=$num&message=1");
		}
		if(isset($_POST['dateo']) and $_POST['dateo']!=''){
			$date = $_POST['dateo'];
		}
		else{
			header("Location: addfiche.php?num=$num&message=1");
		}
		
		if(isset($_POST['reunioncloture']) and $_POST['reunioncloture']!=''){
			$reunioncloture = $_POST['reunioncloture'];
		}
		else{
			header("Location: addfiche.php?num=$num&message=3");
		}
		
		
			include_once 'bd.php';
			
			$creefiche=$connexion->exec("INSERT INTO `reunioncloture` values ('' ,'$date' ,'$time','$num')");
			if($creefiche!=0){
				while ($monchoix = array_shift($reunioncloture)){				
				$result3=$connexion->exec("INSERT INTO `presencecloture`  VALUES ('', '$num', $monchoix )");
				//$cousnt = $connexion->query("DELETE FROM utilisateur WHERE utilisateur.id=$id");
	
			}
			 header("Location: addfiche5.php?num=$num");
			 $result=$connexion->exec("UPDATE fichecreeoupas  SET   fichecreeoupas.CreeOuPas=1  where fichecreeoupas.num='$num'");
			// echo $date;
			}
			else{
				echo $id_RA;
			}
			
	
					}
		if(isset($_POST['back'])){
			$num=$_GET['num'];	
			include_once 'bd.php';
			$back=$connexion->query("Delete from presenceouverture where presenceouverture.num_audit ='$num'");
			$back=$connexion->query("Delete from reunionouverture where reunionouverture.numero ='$num'");
			 header("Location: addfiche1.php?num=$num");
		}
	
	
	}

?>