
<?php 
$i=0;
if($adp!=0){
	
								include_once 'bd.php';
								if($adp==1){
								$req1_EX=$connexion->query("select document.id as id,document.id_service as id_ser, document.nom as nom,document.dateAPP as app,document.DATTREV as rev, document.Etat as etat, document.type as type from document where document.Etat != 'Annule'");	
								}if($adp==2){
								$req1_EX=$connexion->query("select document.id as id,document.id_service as id_ser, document.nom as nom,document.dateAPP as app,document.DATTREV as rev, document.Etat as etat, document.type as type from document where document.Etat != 'Annule' and document.ajtpar=2");	
								}if($adp==3){
								$req1_EX=$connexion->query("select document.id as id,document.id_service as id_ser, document.nom as nom,document.dateAPP as app,document.DATTREV as rev, document.Etat as etat, document.type as type from document where document.Etat != 'Annule' and document.ajtpar=3");	
								}
								$nbra_EX=$req1_EX->rowcount();
								if($nbra_EX!=0){
								
								
								$i=0;
								while  ($obj_EX = $req1_EX->Fetch(PDO::FETCH_ASSOC)) 
								{

									
									$nom_EX=utf8_encode($obj_EX['nom']);
									$id_doc_EX=$obj_EX['id'];
									$id_ser_EX=$obj_EX['id_ser'];
									$type_EX=$obj_EX['type'];
									$reqz_EX=$connexion->query("select service.nom as nom from service where service.id=$id_ser_EX");
									$objz_EX = $reqz_EX->Fetch(PDO::FETCH_ASSOC);
									$serv_EX=utf8_encode($objz_EX['nom']);
									$date_EX=$obj_EX['app'];
									
									$rev_EX=$obj_EX['rev'];
									$NOT_EX[$i]['type']=$type_EX;
									$NOT_EX[$i]['service']=$serv_EX;
									$etat_EX=utf8_encode($obj_EX['etat']);
									$now_EX = date("Ymd");						
																
									$expire_EX = date("Ymd", strtotime($rev_EX));									
									if($expire_EX < $now_EX) {
									 $etat_EX="Périmé";
									 $rt3_EX=$connexion->quote(utf8_decode($etat_EX));	
									  $reqmod_EX=$connexion->exec("UPDATE document  SET document.Etat=$rt3_EX where document.id=$id_doc_EX ");
									  $NOT_EX[$i]['lien']=$nom_EX.' du service '.$serv_EX.' a expiré ';
									 $rev_EX=date("d/m/Y", strtotime($rev_EX));	
									  $NOT_EX[$i]['exp']='Le '.$rev_EX;
									  $NOT_EX[$i]['nom']=urldecode($nom_EX);
									  $NOT_EX[$i]['id']=$id_doc_EX;
									$t=1;
									$i++;			
									
								}
								}								
								}
								}
								
							
	
								?>
								