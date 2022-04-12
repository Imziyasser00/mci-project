
<?php
$iVEX=0; 
	if($adp!=0){
								include_once 'bd.php';
								if($adp==1){
								$req1_VEX=$connexion->query("select document.id as id,document.id_service as id_ser, document.nom as nom,document.dateAPP as app,document.DATTREV as rev, document.Etat as etat, document.type as type from document where document.Etat != 'Annule' and  document.Etat != 'Perime'");	
								}
								if($adp==2){
								$req1_VEX=$connexion->query("select document.id as id,document.id_service as id_ser, document.nom as nom,document.dateAPP as app,document.DATTREV as rev, document.Etat as etat, document.type as type from document where document.Etat != 'Annule' and  document.Etat != 'Perime' and document.ajtpar=2");	
								}
								if($adp==3){
								$req1_VEX=$connexion->query("select document.id as id,document.id_service as id_ser, document.nom as nom,document.dateAPP as app,document.DATTREV as rev, document.Etat as etat, document.type as type from document where document.Etat != 'Annule' and  document.Etat != 'Perime' and document.ajtpar=3");	
								}
								$nbra_VEX=$req1_VEX->rowcount();
								if($nbra_VEX!=0){
								
								
								$iVEX=0;
								while  ($obj_VEX = $req1_VEX->Fetch(PDO::FETCH_ASSOC)) 
								{

									
									$nom_VEX=utf8_encode($obj_VEX['nom']);
									$id_doc_VEX=$obj_VEX['id'];
									$id_ser_VEX=$obj_VEX['id_ser'];
									$type_VEX=$obj_VEX['type'];
									$reqz_VEX=$connexion->query("select service.nom as nom from service where service.id=$id_ser_VEX");
									$objz_VEX = $reqz_VEX->Fetch(PDO::FETCH_ASSOC);
									$serv_VEX=utf8_encode($objz_VEX['nom']);
									$date_VEX=$obj_VEX['app'];
									
									$rev_VEX=$obj_VEX['rev'];
									$NOT_VEX[$iVEX]['type']=$type_VEX;
									$NOT_VEX[$iVEX]['service']=$serv_VEX;
									$etat_VEX=utf8_encode($obj_VEX['etat']);
									$now_VEX = date("Ymd");						
									$now_VEX_Y = date("Y");						
									$now_VEX_M = date("m");						
									$now_VEX_D = date("d");														
									$expire_VEX = date("Ymd", strtotime($rev_VEX));	
									$expire_VEX_Y = date("Y", strtotime($rev_VEX));	
									$expire_VEX_M = date("m", strtotime($rev_VEX));	
									if($expire_VEX_Y==$now_VEX_Y){
										if($expire_VEX_M==$now_VEX_M){
										$NOT_VEX[$iVEX]['reste']=(int)$expire_VEX - (int)$now_VEX;
										 $NOT_VEX[$iVEX]['id']=$id_doc_VEX;
										}
									else{
										$NOT_VEX[$iVEX]['reste']=(int)$expire_VEX - (int)$now_VEX -70;
										 $NOT_VEX[$iVEX]['id']=$id_doc_VEX;
									}									
									if( $NOT_VEX[$iVEX]['reste'] < 31) {
									 // $etat_VEX="Périmé";
									 // $rt3_VEX=$connexion->quote(utf8_decode($etat_VEX));	
									  // $reqmod_VEX=$connexion->exec("UPDATE document  SET document.Etat=$rt3_VEX where document.id=$id_doc_VEX ");
									  $NOT_VEX[$iVEX]['lien']=$nom_VEX.' du service '.$serv_VEX.' expire';
									  $NOT_VEX[$iVEX]['exp']='dans '.$NOT_VEX[$iVEX]['reste'].' jours';
									  $NOT_VEX[$iVEX]['id']=$id_doc_VEX;
									$t=1;
									$iVEX++;			
									
								}
								}								
								}
								}
								}
								
							
	
								?>
								