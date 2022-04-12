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
				$result3=$connexion->exec("INSERT INTO `mci`.`diffusionaudit`  VALUES ('', '$num', $monchoix )");
			$SelectAuditeeNom=$connexion->query("select mail from utilisateur where utilisateur.id=$monchoix");
										$auditeeselect = $SelectAuditeeNom->Fetch(PDO::FETCH_ASSOC);
										$mail=$auditeeselect['mail'];
									$to = $mail;
								$subject = "Rapport d'audit ".$num;	
			
								$txt = 'Le rapport d\'audit n° '.$num.' est créé par le responsable d\'audit.
								<br> <a href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerrapport.php?num='.$num.'">téléchargement</a>.
			<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';	
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
								$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
								mail($to,$subject,$txt,$headers);
			}
			
		 $result=$connexion->exec("UPDATE rapportcreeoupas  SET   rapportcreeoupas.cop=1 , rapportcreeoupas.date='$today'  where rapportcreeoupas.audit_num='$num'");
			header("Location: RapportFinal.php?num=$num");
	
	}
	}
	
	
?>