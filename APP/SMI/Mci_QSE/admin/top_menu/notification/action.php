
<?php

include_once 'bd.php';
		$idauditeur=$_SESSION['id'];
		$idauditeurreqa=$connexion->query("select id_sservice from utilisateur where id=$idauditeur");
	$idauditeurobjsera = $idauditeurreqa->Fetch(PDO::FETCH_ASSOC);
	$plan_id_proc=$idauditeurobjsera['id_sservice'];
		
								$req1_plan=$connexion->query("select  * from planaction where cop=1 and rop=0 and id_proc=$plan_id_proc");						
									
								$nbra_plan=$req1_plan->rowcount();
								if($nbra_plan!=0){						
								$icomAction=0;
								$obj_plan = $req1_plan->Fetch(PDO::FETCH_ASSOC);
								$plan_ann=$obj_plan['ann'];								
									$confirmaudit=$connexion->query("select numero from auditprevu where  ann=$plan_ann and id_sservice=$plan_id_proc");
									$audit = $confirmaudit->Fetch(PDO::FETCH_ASSOC);
									$numer=$audit['numero'];
									$selectRauditee=$connexion->query("select id_utilisateur from respentaudite where respentaudite.num_audit='".$numer."' and respentaudite.id_utilisateur=$idauditeur");
										$nbba=$selectRauditee->rowcount();
											if($nbba!=0){
											$Action=$obj_plan['id'];									
								
											$NOT_ActionLien="Veuillez compléter le plan d'action d'audit n° ".$numer."" ;
											$NOT_ActionNum=$numer;
											$icomAction++;	
										}
								}						
							
															

								?>