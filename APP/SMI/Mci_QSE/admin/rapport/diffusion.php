﻿<!DOCTYPE html>
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
			//dif
	$selectdiff=$connexion->query('select id_utilisateur ,num_audit  from diffusionaudit where 

diffusionaudit.num_audit="'.$num.'"');
				while($diffaudits = $selectdiff->Fetch(PDO::FETCH_ASSOC)){
				$diffaudit['id_utilisateur']=$diffaudits['id_utilisateur'];
				$monchoix=$diffaudit['id_utilisateur'];	
				$SelectAuditeeNom=$connexion->query("select mail from utilisateur where 

utilisateur.id=$monchoix");
				$auditeeselect = $SelectAuditeeNom->Fetch(PDO::FETCH_ASSOC);
										$mail=$auditeeselect['mail'];
									$to = $mail;
								$subject = "Rapport d'audit ".$num;	
			
								$txt = 'Le rapport d\'audit n° '.$num.' du Processus '.$sservicenom.' est créé par le 

responsable d\'audit.
								<br> <a 

href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerrapport.php?num='.$num.'">téléchargement</a>.
			<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';	
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
								$headers .= "Content-Type: text/html;";
								mail($to,$subject,$txt,$headers);
	
							}
				
			//diffusion pour ghazal responsable  sous service 1 2 5 6 7 8 9 10 11
	if($r2==1 || $r2==2 || $r2==5  || $r2==6 || $r2==7 || $r2==8 || $r2==9 || $r2==10 || $r2==11){
		$mail='f.ghzal@mci-santeanimale.com';
									$to = $mail;
								$subject = "Rapport d'audit ".$num;	
			
								$txt = 'Le rapport d\'audit n° '.$num.' du Processus '.$sservicenom.' est créé par le 

responsable d\'audit.
								<br> <a 

href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerrapport.php?num='.$num.'">téléchargement</a>.
			<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';	
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
								$headers .= "Content-Type: text/html;";
								mail($to,$subject,$txt,$headers);
	}
	//redirection
header("Location: ../RapportFinal.php?num=$num");	
	}

?>