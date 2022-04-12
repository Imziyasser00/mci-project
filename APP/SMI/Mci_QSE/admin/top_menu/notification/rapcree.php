
<?php
	if($adp==1 || $adp==2){				
								$rap_com=$connexion->query("select audit_num from rapportcreeoupas where cop=1");						
									
								$nbrrap_com=$rap_com->rowcount();
								if($nbrrap_com!=0){						
								$icomrap=0;
								while  ($obj_comrap = $rap_com->Fetch(PDO::FETCH_ASSOC)) 
								{									
									
									$numrap=$obj_comrap ['audit_num'];
									
											$NOT_comrap[$icomrap]['lien']="Le rapport d'audit n° ".$numrap." est crée par le responsable d'audit" ;
											$NOT_comrap[$icomrap]['num']='Rapportfinal.php?num='.$numrap;
											
											
								$icomrap++;		
								}
								
								}
											
								}					
	
								?>
								