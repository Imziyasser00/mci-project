
<?php
	if($adp==1 || $adp==2){				
								$rap_com=$connexion->query("select * from notificationaudit where valide=0");						
									
								$nbrrap_com=$rap_com->rowcount();
								if($nbrrap_com!=0){						
								$icomrap=0;
								while  ($obj_comrap = $rap_com->Fetch(PDO::FETCH_ASSOC)) 
								{									
									
									$numrap=$obj_comrap ['num'];
									$message=utf8_encode($obj_comrap ['message']);
											$NOT_comrap[$icomrap]['lien']=$message ;
											$NOT_comrap[$icomrap]['num']='RapportfinalNotification.php?num='.$numrap;
											
											
								$icomrap++;		
								}
								
								}
											
								}					
	
								?>
								