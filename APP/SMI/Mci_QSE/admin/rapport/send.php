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
     
    if (!isset($_SESSION['nom']) and !isset($_GET['num']) and !isset($_POST['mail'])) {
        header("Location: ../404.html");
    }
    else {
		
	$num=$_GET['num'];	
	$mail=$_POST['mail'];	
	
			
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
			
				
									
									$to = $mail;
								$subject = "Rapport d'audit ".$num;	
			
								$txt = 'Le rapport d\'audit n� '.$num.' du Processus '.$sservicenom.' est cr�� par le 

responsable d\'audit.
								<br> <a 

href="http://192.168.2.106/SMI/Mci_QSE/admin/pdf/reg/gerrapport.php?num='.$num.'">t�l�chargement</a>.
			<br><br>Merci de ne pas r�pondre � ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Sant� Animale ';	
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
								$headers .= "Content-Type: text/html;";
								mail($to,$subject,$txt,$headers);
	
							}
				header("Location: ../RapportFinal.php?num=$num");	
							

	

?>