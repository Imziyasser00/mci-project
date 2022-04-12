<?php


		$idauditeur=$_SESSION['id'];
		$adp=$_SESSION['adp'];
								$reqAll=$connexion->query("select  * from NotificationFicheEcart where etat=0");
								$nbrAll=$reqAll->rowcount();
								if($nbrAll!=0){					
								$iEM=0;
								while  ($obj_comRAll = $reqAll->Fetch(PDO::FETCH_ASSOC)) 
								{
									$numAll=$obj_comRAll['num'];
									$idNotification=$obj_comRAll['id'];
									$valide=$obj_comRAll['valide'];
									$i_RA=$obj_comRAll['i_RA'];
									$idEM=$obj_comRAll['id_point'];
									$messageAll=$obj_comRAll['message'];
								if($valide=='0' and $i_RA==$idauditeur){

										
								
									$NOT_EM[$iEM]['lien']=utf8_encode($messageAll);
									$NOT_EM[$iEM]['num']=$numAll;
									$NOT_EM[$iEM]['idN']=$idNotification;
											$NOT_EM[$iEM]['id']=$idEM;	
										
											$iEM++;	
									
									}
								$reqRA=$connexion->query("select  * from respentaudite where num_audit='".$numAll."'");
								while($obj_RA = $reqRA->Fetch(PDO::FETCH_ASSOC))
								{
									$i_R=$obj_RA['id_utilisateur'];
								}
							
								if($valide=='1' and $i_R==$idauditeur){
									$NOT_EM[$iEM]['lien']=utf8_encode($messageAll);
									$NOT_EM[$iEM]['num']=$numAll;
									$NOT_EM[$iEM]['idN']=$idNotification;
											$NOT_EM[$iEM]['id']=$idEM;	
										
											$iEM++;	
								}
								if($valide=='2' and $adp=='2'){
									$NOT_EM[$iEM]['lien']=utf8_encode($messageAll);
									$NOT_EM[$iEM]['num']=$numAll;
									$NOT_EM[$iEM]['idN']=$idNotification;
											$NOT_EM[$iEM]['id']=$idEM;	
										
											$iEM++;	
								}
								}
								}
								
								?>