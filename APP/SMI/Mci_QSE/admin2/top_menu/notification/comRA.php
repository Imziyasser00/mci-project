
<?php


		$idauditeur=$_SESSION['id'];
								$req1_comRA=$connexion->query("select  num from fichecreeoupas where CreeOuPas=1 and i_RA=$idauditeur");						
									
								$nbra_comRA=$req1_comRA->rowcount();
								if($nbra_comRA!=0){						
								$icomRA=0;
								while  ($obj_comRA = $req1_comRA->Fetch(PDO::FETCH_ASSOC)) 
								{
									
									// $fiche_com=$obj_comRA['id'];
									$num_com=$obj_comRA['num'];
									$selectidfichecomRA=$connexion->query("select id from fichdaudit where audit_num='$num_com'");
										$objt_comRA = $selectidfichecomRA->Fetch(PDO::FETCH_ASSOC);
										$nbb=$selectidfichecomRA->rowcount();
											if($nbb!=0){
											$fiche_com=$objt_comRA['id'];									
									 $vercomRA=$connexion->prepare("select id from fichecompet where id_fiche=?");
										$vercomRA->execute(array($fiche_com));										
										$nbbv=$vercomRA->rowcount();										
										 if($nbbv==0){	
											$NOT_comRA[$icomRA]['lien']="Veuillez compléter la fiche d'audit n° ".$num_com."" ;
											$NOT_comRA[$icomRA]['num']=$num_com;	
											$icomRA++;												
										}											
										
								}
								}
								}
								
											
												
												
	
								?>
								