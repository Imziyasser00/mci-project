<?php


		$idauditeur=$_SESSION['id'];
							
								$req1_comRA=$connexion->query("select  num from fichecreeoupas where CreeOuPas=1 and i_RA=$idauditeur");						
									
								$nbra_comRA=$req1_comRA->rowcount();
								if($nbra_comRA!=0){						
								$iEM=0;
								while  ($obj_comRA = $req1_comRA->Fetch(PDO::FETCH_ASSOC)) 
								{
									
									// $fiche_com=$obj_comRA['id'];
									$num_comRC=$obj_comRA['num'];
									$req1_comRC=$connexion->query("select cop from rapportcreeoupas where cop=1 and audit_num='$num_comRC'");
									$nbbA=$req1_comRC->rowcount();
									if($nbbA!=0){
									$selectEmaj=$connexion->query('select * from point where type ="ecart maje" and numero_audit="'.$num_comRC.'"');
									$nEmaj=$selectEmaj->rowcount();
									if($nEmaj!=0){
									while($Emaj = $selectEmaj->Fetch(PDO::FETCH_ASSOC)){
									$comEM=$Emaj['commentaire'];	
									$idEM=$Emaj['id'];	
									if(strlen(($comEM))!= "5"){
									$NOT_EM[$iEM]['lien']="Veuillez Créer la fiche d'écart majeur d'audit n° ".$comEM."" ;
											$NOT_EM[$iEM]['id']=$idEM;	
											$NOT_EM[$iEM]['commentaire']=$comEM;	
											$iEM++;	
									}
									}
									}
									
																			
										
								}
								}				
								}
						$req1_comRA=$connexion->query("select  num from fichecreeoupas where CreeOuPas=1");						
									
								$nbra_comRA=$req1_comRA->rowcount();
								if($nbra_comRA!=0){						
								$iEMa=0;
								while  ($obj_comRA = $req1_comRA->Fetch(PDO::FETCH_ASSOC)) 
								{
									
									// $fiche_com=$obj_comRA['id'];
									$num_comRC=$obj_comRA['num'];
									$req1_comRC=$connexion->query("select cop from rapportcreeoupas where cop=1 and audit_num='$num_comRC'");
									$nbbA=$req1_comRC->rowcount();
									if($nbbA!=0){
									$selectEmaja=$connexion->query('select * from point where type ="ecart maje" and numero_audit="'.$num_comRC.'"');
									$nEmaja=$selectEmaja->rowcount();
									if($nEmaja!=0){
										$selectRauditee=$connexion->query('select id_utilisateur from respentaudite where respentaudite.num_audit="'.$num_comRC.'" and id_utilisateur="'.$idauditeur.'"');
										$nbra_comR=$selectRauditee->rowcount();
										if($nbra_comR!=0){	
									while($Emaja = $selectEmaja->Fetch(PDO::FETCH_ASSOC)){
									$comEMa=$Emaja['commentaire'];	
									$idEMa=$Emaja['id'];	
									if(strlen($comEMa)!= "5" ){
									$NOT_EMa[$iEMa]['lien']="Veuillez Créer la fiche d'écart majeur d'audit n° ".$comEMa."" ;
											$NOT_EMa[$iEMa]['id']=$idEMa;	
											$NOT_EMa[$iEMa]['commentaire']=$comEMa;	
											$iEMa++;	
									}
									}
										}
									}
									
																			
										
								}
								}				
								}								
							$req1_comRA=$connexion->query("select  num from fichecreeoupas where CreeOuPas=1");						
									
								$nbra_comRA=$req1_comRA->rowcount();
								if($nbra_comRA!=0){						
								$iEMD=0;
								while  ($obj_comRA = $req1_comRA->Fetch(PDO::FETCH_ASSOC)) 
								{
									
									// $fiche_com=$obj_comRA['id'];
									$num_comRC=$obj_comRA['num'];
									$req1_comRC=$connexion->query("select cop from rapportcreeoupas where cop=1 and audit_num='$num_comRC'");
									$nbbA=$req1_comRC->rowcount();
									if($nbbA!=0){
									$selectEmajd=$connexion->query('select * from point where type ="ecart maje" and numero_audit="'.$num_comRC.'"');
									$nEmaja=$selectEmajd->rowcount();
									if($nEmaja!=0){
										//$selectRauditee=$connexion->query('select id_utilisateur from respentaudite where respentaudite.num_audit="'.$num_comRC.'" and id_utilisateur="'.$idauditeur.'"');
										//$nbra_comR=$selectRauditee->rowcount();
										if($idauditeur==28){	
									while($Emajd = $selectEmajd->Fetch(PDO::FETCH_ASSOC)){
									$comEMd=$Emajd['commentaire'];	
									$idEMd=$Emajd['id'];	
									if(strlen(($comEMd))!= "5"){
									$NOT_EMd[$iEMD]['lien']="Veuillez Valider la fiche d'écart majeur d'audit n° ".$comEMd."" ;
											$NOT_EMd[$iEMD]['id']=$idEMd;	
											$NOT_EMd[$iEMD]['commentaire']=$comEMd;	
											$iEMD++;	
									}
									}
										}
									}
									
																			
										
								}
								}				
								}							
	
								?>