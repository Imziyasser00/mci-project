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
		// if(isset($_POST['reps2'])){
			// $reps2 = $_POST['reps2'];
		// }
		if(isset($_POST['id_fiche'])){
			$id_fiche = $_POST['id_fiche'];
		}
		else{
		header("Location: 404.html");	
		}
			
			include_once '../bd.php';
			
			// $reps2=utf8_decode($reps2);
			$reps1=$connexion->quote(utf8_decode($reps1));
			$result3=$connexion->prepare("Delete from fichecomqse where id_fiche=?");
			$result3->execute(array($id_fiche));
			$compfiche=$connexion->exec("INSERT INTO `fichecomqse` values (null,$id_fiche ,$reps1,1)");
			$today = date("Y-m-d");
			$creerapport=$connexion->exec("INSERT INTO `rapportcreeoupas` values (null,'".$num."' ,'0','".$today."')");
			if($compfiche!=0){						
			//mail auditeur + observateur
			$confirmaudita=$connexion->query("select * from auditeurprevu where numero_audit='".$num."' and fonction!='1'");
							while($auditeur = $confirmaudita->Fetch(PDO::FETCH_ASSOC)){
							$A=$auditeur['id_auditeur'];
							$selidauditeur=$connexion->query("select nom, prenom from auditeur where id=$A");
							$sel = $selidauditeur->Fetch(PDO::FETCH_ASSOC);
													$audnom=$sel['nom'];
														$audprenom=$sel['prenom'];
															$selutilisateur=$connexion->query("select id , mail from utilisateur where nom='".$audnom."' and prenom='".$audprenom."'");
																$selid = $selutilisateur->Fetch(PDO::FETCH_ASSOC);
																	$i_ra=$selid['id'];
																	$mail=$selid['mail'];

							$to = $mail;
								$subject = "Fiche d'Audit ".$num;


								$txt = 'La fiche d\'audit n° '.$num.' a été validée par le responsable Management Q.S.E.
								<br> <a href="http://192.168.2.106:8080/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">téléchargement</a>.
			<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';	
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
								$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
								mail($to,$subject,$txt,$headers);
								}
						//mail responsable
			$confirmaudita=$connexion->query("select * from auditeurprevu where numero_audit='".$num."' and fonction='1'");
							while($auditeur = $confirmaudita->Fetch(PDO::FETCH_ASSOC)){
							$O=$auditeur['id_auditeur'];
							$selidauditeur=$connexion->query("select nom, prenom from auditeur where id=$O");
							$sel = $selidauditeur->Fetch(PDO::FETCH_ASSOC);
													$audnom=$sel['nom'];
														$audprenom=$sel['prenom'];
															$selutilisateur=$connexion->query("select id , mail from utilisateur where nom='".$audnom."' and prenom='".$audprenom."'");
																$selid = $selutilisateur->Fetch(PDO::FETCH_ASSOC);
																	$i_ra=$selid['id'];
																	$mail=$selid['mail'];

							$to = $mail;
								$subject = "Fiche d'audit ".$num;


								$txt = 'La fiche d\'audit n° '.$num.' a été validée par le responsable Management Q.S.E.
								<br> <a href="http://192.168.2.106:8080/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">téléchargement</a>.
							<br>veuillez <a href="http://192.168.2.106:8080/SMI/Mci_QSE/admin/login.php">vous connecter</a> pour rédiger le rapport d\'audit.
			<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';	
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
								$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
								mail($to,$subject,$txt,$headers);
			
			}
			//auditée
			$selectauditee=$connexion->query('select id_utilisateur from auditee where num_audit="'.$num.'"');
							$tab=$selectauditee->rowcount();	
								while($auditees1 = $selectauditee->Fetch(PDO::FETCH_ASSOC)){
														
							$auditees['id_utilisateur']=$auditees1['id_utilisateur'];
								$rau=$auditees['id_utilisateur'];								
									$SelectAuditeeNom=$connexion->query("select mail from utilisateur where utilisateur.id=$rau.");
										$auditeeselect = $SelectAuditeeNom->Fetch(PDO::FETCH_ASSOC);
										$mail=$auditeeselect['mail'];
									$to = $mail;
								$subject = "Fiche d'audit ".$num;


								$txt = 'La fiche d\'audit n° '.$num.' a été validée par le responsable Management Q.S.E.
								<br> <a href="http://192.168.2.106:8080/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">téléchargement</a>.
			<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';	
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
								$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
								mail($to,$subject,$txt,$headers);
										
																	
								}
		
		header("Location:../addfiche5.php?num=$num");
	
							
			
	}
	
								else{
				echo $id_fiche;
			}
	}
	}

?>