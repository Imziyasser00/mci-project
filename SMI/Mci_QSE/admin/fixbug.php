<?php
session_start();
 if (!isset($_SESSION['nom'])) {
        header("Location: 404.html");
    }
$adp=$_SESSION['adp'];
include_once '../bd.php';
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
									$etat_EX=utf8_encode($obj_EX['etat']);
									$id_doc_EX=$obj_EX['id'];
									if($etat_EX=="Périmé") {
										$rt3_EX="En cours d\'application";
										$reqmod_EX=$connexion->exec("UPDATE document  SET document.Etat='En cours d\'application' where document.id=$id_doc_EX ");
										if($reqmod_EX){
										echo "1";	
									}
									else{
										echo "0 <br>";
										
									}
									
								}
								}
								
								}
										
?>