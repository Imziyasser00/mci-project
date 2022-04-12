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
    
    if (!isset($_SESSION['nom']) || !isset($_GET['num'])) {
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
		
		if(isset($_POST['presenceouverture']) and $_POST['presenceouverture']!=''){
			$presenceouverture = $_POST['presenceouverture'];
		}
		else{
			header("Location: addfiche.php?num=$num&message=3");
		}
		
		
			include_once 'bd.php';
			
			$creefiche=$connexion->exec("INSERT INTO `reunionouverture` values ('' ,'$date' ,'$time','$num')");
			if($creefiche!=0){
				while ($monchoix = array_shift($presenceouverture)){				
				$result3=$connexion->exec("INSERT INTO `presenceouverture`  VALUES ('', '$num', $monchoix )");
	
			}
			 header("Location: addfiche3.php?num=$num");
			// echo $date;
			}
			else{
				echo $id_RA;
			}
			
	
					}
		if(isset($_POST['back'])){
			$num=$_GET['num'];	
			include_once 'bd.php';
			$back=$connexion->query("Delete from fichdaudit where fichdaudit.audit_num ='$num'");
			$back=$connexion->query("Delete from auditee where auditee.num_audit ='$num'");
			 header("Location: addfiche.php?num=$num");
		}
	
	
	}

?>