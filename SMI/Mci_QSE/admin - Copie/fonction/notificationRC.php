
<?php
								include"../bd.php";
								$rap_com=$connexion->query("select audit_num from rapportcreeoupas where cop=1");						
									
								$nbrrap_com=$rap_com->rowcount();
								if($nbrrap_com!=0){						
								$icomrap=0;
								while  ($obj_comrap = $rap_com->Fetch(PDO::FETCH_ASSOC)) 
								{									
									
									$numrap=$obj_comrap ['audit_num'];
									
											$NOT_comrap[$icomrap]['lien']="Le rapport d\'audit n° ".$numrap." est crée par le responsable d\'audit" ;
											$NOT_comrap[$icomrap]['num']='Rapportfinal.php?num='.$numrap;
								$today = date("Y-m-d");			
								$message=$NOT_comrap[$icomrap]['lien'];
								$verif=$connexion->prepare("select * from notificationaudit where num=?");
								$verif->execute(array($numrap));
								$rowcount=$verif->rowcount();
								if($rowcount==0){
								$creeNotification=$connexion->exec("INSERT INTO notificationaudit  VALUES (null,'".$numrap."', '".utf8_decode($message)."','".$today."','0')");
								echo $today.'</br>';
								$icomrap++;
								}
								else{
									echo $numrap .'existe déja';
								}
								}
								
								}
											
	
								?>
								