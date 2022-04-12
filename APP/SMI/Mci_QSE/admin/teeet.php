<?php	
include_once 'bd.php';
	$co=$connexion->query('select * from point where type!="ref" and type!="champ"  and type!="fort" and numero_audit="17/16"');
								while($cor= $co->Fetch(PDO::FETCH_ASSOC)){
								
								$idPoint=$cor['id'];
								$numero=$cor['numero_audit'];
						
								$selectNC=$connexion->query("select * from nonconfirmite where id_point=".$idPoint."");
								$verif=$selectNC->rowcount();
								if($verif==0){
									$correction=$connexion->exec("INSERT INTO nonconfirmite VALUES('',$idPoint,'$numero','','','','0')");
								}
								}
								?>