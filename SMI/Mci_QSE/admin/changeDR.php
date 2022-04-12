<?php 
include 'bd.php';
$selectDoc=$connexion->query("select  * from document where ajtpar=3");						
									
								$nbrFiche=$selectDoc->rowcount();
								$i=0;
								if($nbrFiche!=0){
								
								while($documents = $selectDoc->Fetch(PDO::FETCH_ASSOC)) 
								{
								
								$date=date_create($documents['dateAPP']);
								date_add($date, date_interval_create_from_date_string('5 years'));
								$dateRev=date_format($date, 'Y-m-d');
								$dateCreation=$documents['dateAPP'];
								$docId=$documents['id'];
								//echo $i.' Date de creation :'.$dateCreation.' Date de révision : '.$dateRev.'<br>';
								//$i++;
								$updateDocDR=$connexion->exec("UPDATE document  SET  
								document.DATTREV='$dateRev' where
								document.id=$docId");
								}
								}
								else{
									echo 'no';
								}
							
?>