
<?php
	if($adp==1 || $adp==2){				
								$req1_com=$connexion->query("select  * from fichecreeoupas where CreeOuPas=1");						
									
								$nbra_com=$req1_com->rowcount();
								if($nbra_com!=0){						
								$icom=0;
								while  ($obj_com = $req1_com->Fetch(PDO::FETCH_ASSOC)) 
								{									
									$numcom=$obj_com['num'];
									$verifvalidation=$connexion->prepare('select * from fichecomqse where vop=1 and id_fiche=?');
									
									$selectidfichecom=$connexion->query("select id from fichdaudit where audit_num='$numcom'");
										$objt_com = $selectidfichecom->Fetch(PDO::FETCH_ASSOC);
										$nbb=$selectidfichecom->rowcount();
											if($nbb!=0){
											$fiche_com=$objt_com['id'];	
											}
									$verifvalidation->execute(array($fiche_com));
										$nbb=$verifvalidation->rowcount();
											if($nbb==0){
									
											$NOT_com[$icom]['lien']="La fiche d'audit n° ".$numcom." est crée par le responsable d'audit" ;
											$NOT_com[$icom]['num']=$numcom;
											
								$icom++;		
								}
								}
								}
											
								}					
	
								?>
								