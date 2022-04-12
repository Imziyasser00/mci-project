<?php

								include_once 'bd.php';
							
								$selectIdPoint=$connexion->query('select  * from point where type ="ecart maje"');						
									
								$nbr=$selectIdPoint->rowcount();
								if($nbr!=0){						
							
								while  ($obj_pem = $selectIdPoint->Fetch(PDO::FETCH_ASSOC))
								{
									
									// $fiche_com=$obj_comRA['id'];
									$idem=$obj_pem['id'];								
									$numaudit=$obj_pem['numero_audit'];	
									$req1_ann=$connexion->query("select ann from auditprevu where numero='".$numaudit."'");
									$nbann=$req1_ann->rowcount();
									if($nbann!=0){
										while  ($obj_ann= $req1_ann->Fetch(PDO::FETCH_ASSOC))
									{
									$annem=$obj_ann['ann'];	
									}
									}
									$req1_em=$connexion->query("select * from em where id_point='".$idem."'");
									$nbem=$req1_em->rowcount();
									
									if($nbem==0){
									$remplirEm=$connexion->exec("INSERT INTO `em` VALUES (null,".$idem.",'".$numaudit."','".$annem."','0')");
									
									}
								}
									
									
																			
										
								}
											

	
								?>