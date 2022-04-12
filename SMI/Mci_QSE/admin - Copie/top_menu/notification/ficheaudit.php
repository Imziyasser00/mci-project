
<?php 
	$idauditeur=$_SESSION['id'];
								include_once 'bd.php';
								$iFCP=0;
								
								$req1_FCP=$connexion->query("select  * from fichecreeoupas where CreeOuPas=0 and i_RA=$idauditeur");								
								
								$nbra_FCP=$req1_FCP->rowcount();
								if($nbra_FCP!=0){						
								$iFCP=0;
								while  ($obj_FCP = $req1_FCP->Fetch(PDO::FETCH_ASSOC)) 
								{
									$n1=$num_FCP=$obj_FCP['num'];
									
									$a1=$ann_FCP=$obj_FCP['annee'];
									$selectaudit=$connexion->query("select * from auditprevu where numero='$n1' and ann=$a1 ");
											$audit_FCP = $selectaudit->Fetch(PDO::FETCH_ASSOC);
											$audit_ddatep=$audit_FCP ['ddatep'];
											$audit_fdatep=$audit_FCP ['fdatep'];
											$ss1=$audit_pro=$audit_FCP ['id_sservice'];
								$selectnomsss_FCP=$connexion->query("select * from sservice where id=$ss1");
								$sservice = $selectnomsss_FCP->Fetch(PDO::FETCH_ASSOC);
								$ssnom_FCP=utf8_encode($sservice ['nom']);
											$revd_FCP=date("m/d", strtotime($audit_ddatep));	
											$revf_FCP=$audit_fdatep;
											
											$NOT_FCP[$iFCP]['lien']="Vous êtes responsable d'audit ".$ssnom_FCP." numéro ".$num_FCP. " " ;
											$NOT_FCP[$iFCP]['num']=$num_FCP;
											$NOT_FCP[$iFCP]['exp']="prévue pour ".$revd_FCP."-".$revf_FCP."" ;
								$iFCP++;		
								}
								}					
	
								?>
								