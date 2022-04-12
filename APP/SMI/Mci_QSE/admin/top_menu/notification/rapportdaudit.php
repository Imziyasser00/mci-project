
<?php



	$idauditeur=$_SESSION['id'];
								include_once 'bd.php';
								$iRA=0;
	function getIdAuditeur($id1){
	try
			{
			$connexion = new PDO('mysql:host=localhost;dbname=mci', 'root', '');
				}
			catch(Exception $e)
				{
				die('Erreur : '.$e->getMessage());
				}
	$cnx=$connexion->prepare('select id from auditeur where id_utilisateur=?');
   $cnx->execute(array($id1));
   $objaa = $cnx->Fetch(PDO::FETCH_ASSOC);
   $a=$objaa['id'];
   return $a;
}				
$idRA=getIdAuditeur($idauditeur);
IF ($idRA!=''){			
								$req1_RA=$connexion->query("select  id_fiche from fichecomqse where vop=1");						
									
								$nbra_RA=$req1_RA->rowcount();
								if($nbra_RA!=0){						
								$iRA=0;
								while  ($obj_RA = $req1_RA->Fetch(PDO::FETCH_ASSOC)) 
								{
									
									$fiche=$obj_RA['id_fiche'];
									$selectRA=$connexion->query("select * from fichdaudit where id='$fiche' and id_RA=$idRA ");
										$nbbb=$selectRA->rowcount();
										if($nbbb!=0){
											$aud_RA = $selectRA->Fetch(PDO::FETCH_ASSOC);
											$audit_num=$aud_RA ['audit_num'];
											$req1_RApport=$connexion->query("select  id from rapportcreeoupas where cop=1 and audit_num='".$audit_num."'");
											$nbra_RApport=$req1_RApport->rowcount();
												
											if($nbra_RApport==0){												
											$NOT_RA[$iRA]['lien']="La fiche d'audit est validé par l'Administrateur veuillez rédiger Le rapport d'audit ".$audit_num."" ;
											$NOT_RA[$iRA]['num']=$audit_num;
											$iRA++;
											}											
											
									
								}
								}
								}					
								}					
												
	
								?>
								