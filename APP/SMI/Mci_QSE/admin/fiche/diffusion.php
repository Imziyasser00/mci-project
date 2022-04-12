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
  function sservice($nom)
							{
								if($nom=="Controle in-Vivo"){
									return "Contr�le in-Vivo";
								}
								elseif($nom=="Controle Physico-Chimique"){
									return "Contr�le Physico-Chimique";
								}
								elseif($nom=="Controle Microbiologique"){
									return "Contr�le Microbiologique";
								}
								elseif($nom=="Controle in-vitro"){
									return "Contr�le in-vitro";
								}
								elseif($nom=="Controle Qualite"){
									return "Contr�le Qualit�";
								}
								elseif($nom=="Assurance Qualite"){
									return "Assurance Qualit�";
								}
								elseif($nom=="Systeme d information"){
									return "Syst�me d'information";
								}
								elseif($nom=="Comptabilite et Finance"){
									return "Comptabilit� et Finance";
								}
								elseif($nom=="Services Generaux"){
									return "Services G�n�raux";
								}
								elseif($nom=="Methodes et validations"){
									return "M�thodes et validations";
								}
								elseif($nom=="Homologation & Affaires reglementaires"){
									return "Homologation & Affaires r�glementaires";
								}
								elseif($nom=="Recherche et developpement"){
									return "Recherche et d�veloppement";
								}
								else{
									return $nom;
								}
							} 							
  
    if (!isset($_SESSION['nom']) || !isset($_GET['num'])) {
        header("Location: ../404.html");
    }
    else {
	$num=$_GET['num'];	
	
			
			include_once '../bd.php';
			//service
			$req1=$connexion->query("select id_sservice from auditprevu where numero='$num' ");	
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																		$r2=$obj['id_sservice'];
																			$Selectsservice=$connexion->query("select nom from sservice where id=$r2");
																					$sservice = $Selectsservice->Fetch(PDO::FETCH_ASSOC);
																						$sservicenom=sservice($sservice['nom']);
																	}
																	}
  //mail responsable
			$mail="D.sahraoui@mci-santeanimale.com";
			 $to = $mail;
			$subject = "Fiche d'audit ".$num;


			$txt = 'la fiche d\'audit n� '.$num.' du Processus '.$sservicenom.' est cr��e par le responsable d\'audit<br> <a href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">t�l�chargez la!</a>.
<br><br>Merci de ne pas r�pondre � ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Sant� Animale ';
			$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
            $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
			mail($to,$subject,$txt,$headers);
			 
			 // mail auditeur
			 	$confirmaudita=$connexion->query("select * from auditeurprevu where numero_audit='$num'");
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


								$txt = 'la fiche d\'audit n� '.$num.' du Processus '.$sservicenom.' est cr��e par le responsable d\'audit<br> <a href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">t�l�chargez la!</a>.
<br><br>Merci de ne pas r�pondre � ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Sant� Animale ';
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
mail($to,$subject,$txt,$headers);
							}
			 
				 	//audit�e
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


								$txt = 'la fiche d\'audit n� '.$num.' du Processus '.$sservicenom.'  est cr��e par le responsable d\'audit<br> <a href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">t�l�chargez la!</a>.
<br><br>Merci de ne pas r�pondre � ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Sant� Animale ';
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
								$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
								mail($to,$subject,$txt,$headers);
										
																	
								}
					//pr�sence souhait� cloture
			$selectclosouhait=$connexion->query('select id, id_utilisateur ,num_audit  from presencecloture where presencecloture.num_audit="'.$num.'" order by id');
								// on stock les auditeurs dans une chaine de caract�re .
						
								while($souhaites = $selectclosouhait->Fetch(PDO::FETCH_ASSOC)){
														
							$souhaite['id_utilisateur']=$souhaites['id_utilisateur'];
								$r5=$souhaite['id_utilisateur'];								
									$SelectCloNom=$connexion->query("select mail from utilisateur where utilisateur.id=$r5");
										$cloeselect = $SelectCloNom->Fetch(PDO::FETCH_ASSOC);
										$mail=$cloeselect['mail'];
									$to = $mail;
								$subject = "Fiche d'audit ".$num;


								$txt = 'la fiche d\'audit n� '.$num.' du Processus '.$sservicenom.'  est cr��e par le responsable d\'audit<br> <a href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">t�l�chargez la!</a>.
<br><br>Merci de ne pas r�pondre � ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Sant� Animale ';
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
								$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
								mail($to,$subject,$txt,$headers);
											
								}
					//pr�sence souhait� ouverture
						$selectousouhait=$connexion->query('select id, id_utilisateur ,num_audit  from presenceouverture where presenceouverture.num_audit="'.$num.'" order by id');
								// on stock les auditeurs dans une chaine de caract�re .
							
								while($souhaites = $selectousouhait->Fetch(PDO::FETCH_ASSOC)){
														
							$souhaite['id_utilisateur']=$souhaites['id_utilisateur'];
								$r5=$souhaite['id_utilisateur'];								
									$SelectOuNom=$connexion->query("select mail from utilisateur where utilisateur.id=$r5");
										$ouselect = $SelectOuNom->Fetch(PDO::FETCH_ASSOC);
										$mail=$ouselect['mail'];
									$to = $mail;
								$subject = "Fiche d'audit ".$num;


								$txt = 'la fiche d\'audit n� '.$num.' du Processus '.$sservicenom.'  est cr��e par le responsable d\'audit<br> <a href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">t�l�chargez la!</a>.
<br><br>Merci de ne pas r�pondre � ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Sant� Animale ';
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
								$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
								mail($to,$subject,$txt,$headers);
											
								}
				 
			 
					header("Location: ../addfiche5.php?num=$num");			 
							
	}

?>