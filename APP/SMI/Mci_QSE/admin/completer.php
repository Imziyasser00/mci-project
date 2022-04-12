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
		if(isset($_POST['valider'])){
	$num=$_GET['num'];	
		if(isset($_POST['reps1'])){
			$reps1 = $_POST['reps1'];
		}
		if(isset($_POST['reps2'])){
			$reps2 = $_POST['reps2'];
		}
		if(isset($_POST['id_fiche'])){
			$id_fiche = $_POST['id_fiche'];
		}
		else{
		header("Location: 404.html");	
		}
			
			include_once 'bd.php';
			
			$reps1=$connexion->quote(utf8_decode($reps1));
			$reps2=$connexion->quote(utf8_decode($reps2));
			$compfiche=$connexion->exec("INSERT INTO `fichecompet` values ('',$id_fiche ,$reps1 ,$reps2)");
			if($compfiche!=0){						
			//mail
				 
			$mail="D.sahraoui@mci-santeanimale.com";
			 $to = $mail;
			$subject = "Fiche d'audit ".$num;


			$txt = 'La fiche d\'audit n° '.$num.' est complétée par le responsable d\'audit<br>veuillez <a href="http://192.168.2.106/SMI/Mci_QSE/admin/login.php">vous connecter</a> pour commenteraire et validation.
			<br> <a href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">téléchargement</a>.
			<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';
							
			$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
			mail($to,$subject,$txt,$headers);




			
			header("Location: addfiche5.php?num=$num");
			}
			else{
				echo $id_fiche;
			}
			
	
	
							}
	}

?>