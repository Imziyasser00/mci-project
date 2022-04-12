<?php

								include 'bd.php';
								$selectionFiche=$connexion->query("select  * from fichecreeoupas where CreeOuPas=1");						
									
								$nbrFiche=$selectionFiche->rowcount();
								if($nbrFiche!=0){						
								$iEM=0;
								while  ($obj_Fiche = $selectionFiche->Fetch(PDO::FETCH_ASSOC)) 
								{
									$num=$obj_Fiche['num'];
									$irA=$obj_Fiche['i_RA'];
									$req1_comRC=$connexion->query("select cop from rapportcreeoupas where cop=1 and audit_num='$num'");
									$nbbA=$req1_comRC->rowcount();
									if($nbbA!=0){
									$selectEmaj=$connexion->query('select * from em where num_audit="'.$num.'" and etat=0');
									$nbrEmaj=$selectEmaj->rowcount();
									if($nbrEmaj!=0){
									while($obj_Emaj = $selectEmaj->Fetch(PDO::FETCH_ASSOC)){
										
									$idEM=$obj_Emaj['id_point'];	
									
								
									$NOT_EM[$iEM]['lien']="Veuillez Créer la fiche d\'écart majeur d\'audit n° ".$num."" ;
									$message=utf8_decode($NOT_EM[$iEM]['lien']);
									$NOT_EM[$iEM]['num']=$num;
									$NOT_EM[$iEM]['id']=$idEM;	
									
									
									$today = date("Y-m-d");
									$verif=$connexion->prepare("select * from NotificationFicheEcart where num=? and id_point=?");
									$verif->execute(array($num,$idEM));
									$rowcount=$verif->rowcount();
									if($rowcount==0){
									$creeNotification=$connexion->exec("INSERT INTO NotificationFicheEcart  VALUES (null,".$idEM.",".$irA.",'".$num."', '".$message."','".$today."','0','0')");	
									
																		
									}
									$iEM++;	
								}
								}				
								}
								}
								}
				