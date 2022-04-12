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
				$result3=$connexion->exec("INSERT INTO `mci`.`presencecloture`  VALUES ('', '$num', $monchoix )");
				//$cousnt = $connexion->query("DELETE FROM utilisateur WHERE utilisateur.id=$id");
	
			}
			 header("Location: addfiche5.php?num=$num");
			 $result=$connexion->exec("UPDATE fichecreeoupas  SET   fichecreeoupas.CreeOuPas=1  where fichecreeoupas.num='$num'");

			 
			  //mail responsable
			$mail="D.sahraoui@mci-santeanimale.com";
			 $to = $mail;
			$subject = "Fiche d'audit ".$num;


			$txt = 'la fiche d\'audit n° '.$num.'  est créée par le responsable d\'audit<br> <a href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">téléchargez la!</a>.
<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';
			$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
			mail($to,$subject,$txt,$headers);
			 
			 // mail auditeur
			 	$confirmaudita=$connexion->query("select * from auditeurprevu where numero_audit='$num' and fonction!='1'");
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


								$txt = 'la fiche d\'audit n° '.$num.'  est créée par le responsable d\'audit<br> <a href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">téléchargez la!</a>.
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
									$SelectAuditeeNom=$connexion->query("select mail from utilisateur where utilisateur.id=$rau");
										$auditeeselect = $SelectAuditeeNom->Fetch(PDO::FETCH_ASSOC);
										$mail=$auditeeselect['mail'];
									$to = $mail;
								$subject = "Fiche d'audit ".$num;


								$txt = 'la fiche d\'audit n° '.$num.'  est créée par le responsable d\'audit<br> <a href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">téléchargez la!</a>.
<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
								$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
								mail($to,$subject,$txt,$headers);
										
																	
								}
				 
			 
			 
			 
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