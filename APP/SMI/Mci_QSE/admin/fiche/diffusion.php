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
									return "Contrôle in-Vivo";
								}
								elseif($nom=="Controle Physico-Chimique"){
									return "Contrôle Physico-Chimique";
								}
								elseif($nom=="Controle Microbiologique"){
									return "Contrôle Microbiologique";
								}
								elseif($nom=="Controle in-vitro"){
									return "Contrôle in-vitro";
								}
								elseif($nom=="Controle Qualite"){
									return "Contrôle Qualité";
								}
								elseif($nom=="Assurance Qualite"){
									return "Assurance Qualité";
								}
								elseif($nom=="Systeme d information"){
									return "Système d'information";
								}
								elseif($nom=="Comptabilite et Finance"){
									return "Comptabilité et Finance";
								}
								elseif($nom=="Services Generaux"){
									return "Services Généraux";
								}
								elseif($nom=="Methodes et validations"){
									return "Méthodes et validations";
								}
								elseif($nom=="Homologation & Affaires reglementaires"){
									return "Homologation & Affaires réglementaires";
								}
								elseif($nom=="Recherche et developpement"){
									return "Recherche et développement";
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


			$txt = 'la fiche d\'audit n° '.$num.' du Processus '.$sservicenom.' est créée par le responsable d\'audit<br> <a href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">téléchargez la!</a>.
<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';
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


								$txt = 'la fiche d\'audit n° '.$num.' du Processus '.$sservicenom.' est créée par le responsable d\'audit<br> <a href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">téléchargez la!</a>.
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


								$txt = 'la fiche d\'audit n° '.$num.' du Processus '.$sservicenom.'  est créée par le responsable d\'audit<br> <a href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">téléchargez la!</a>.
<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
								$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
								mail($to,$subject,$txt,$headers);
										
																	
								}
					//présence souhaité cloture
			$selectclosouhait=$connexion->query('select id, id_utilisateur ,num_audit  from presencecloture where presencecloture.num_audit="'.$num.'" order by id');
								// on stock les auditeurs dans une chaine de caractère .
						
								while($souhaites = $selectclosouhait->Fetch(PDO::FETCH_ASSOC)){
														
							$souhaite['id_utilisateur']=$souhaites['id_utilisateur'];
								$r5=$souhaite['id_utilisateur'];								
									$SelectCloNom=$connexion->query("select mail from utilisateur where utilisateur.id=$r5");
										$cloeselect = $SelectCloNom->Fetch(PDO::FETCH_ASSOC);
										$mail=$cloeselect['mail'];
									$to = $mail;
								$subject = "Fiche d'audit ".$num;


								$txt = 'la fiche d\'audit n° '.$num.' du Processus '.$sservicenom.'  est créée par le responsable d\'audit<br> <a href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">téléchargez la!</a>.
<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
								$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
								mail($to,$subject,$txt,$headers);
											
								}
					//présence souhaité ouverture
						$selectousouhait=$connexion->query('select id, id_utilisateur ,num_audit  from presenceouverture where presenceouverture.num_audit="'.$num.'" order by id');
								// on stock les auditeurs dans une chaine de caractère .
							
								while($souhaites = $selectousouhait->Fetch(PDO::FETCH_ASSOC)){
														
							$souhaite['id_utilisateur']=$souhaites['id_utilisateur'];
								$r5=$souhaite['id_utilisateur'];								
									$SelectOuNom=$connexion->query("select mail from utilisateur where utilisateur.id=$r5");
										$ouselect = $SelectOuNom->Fetch(PDO::FETCH_ASSOC);
										$mail=$ouselect['mail'];
									$to = $mail;
								$subject = "Fiche d'audit ".$num;


								$txt = 'la fiche d\'audit n° '.$num.' du Processus '.$sservicenom.'  est créée par le responsable d\'audit<br> <a href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerfiche.php?num='.$num.'">téléchargez la!</a>.
<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
								$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
								mail($to,$subject,$txt,$headers);
											
								}
				 
			 
					header("Location: ../addfiche5.php?num=$num");			 
							
	}

?>