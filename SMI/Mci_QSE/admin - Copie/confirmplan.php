<?php   
   session_start();
if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
  ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
    PHP_OUTPUT_HANDLER_REMOVABLE);
} else {
  ob_start(null, 0, false);
} 
$adp=$_SESSION['adp'];
if($adp!=2 and $adp!=1){
		header("Location: 404.html");
		// echo '1';
	}
	else{
if(!isset($_SESSION['nom']) || !isset($_GET['ann'])){
// echo '2';
	header("Location: 404.html");
}
else{
	include_once 'bd.php';
	
		$ann=$_GET['ann'];
		
			$confirm=$connexion->exec("update plandaudit set plandaudit.cop='1' where plandaudit.annee=".$ann."");
$i=0;
			if(	$confirm==0	){				
					$confirm=$connexion->exec("insert into plandaudit values (null,".$ann.",'1')");
					}
				$confirmaudit=$connexion->query("select numero,id_sservice from auditprevu where  ann=".$ann."");
							while  ($audit = $confirmaudit->Fetch(PDO::FETCH_ASSOC)) {
								$numero=$audit['numero'];
								$id_sservice=$audit['id_sservice'];
								$selectnomss=$connexion->query("select nom from sservice where id=".$id_sservice."");
								$sservice = $selectnomss->Fetch(PDO::FETCH_ASSOC);
								$ssnom=utf8_encode($sservice ['nom']);
									$confirmaudita=$connexion->query("select * from auditeurprevu where  ann=".$ann." and numero_audit='".$numero."' and fonction='1'");
										$auditeur = $confirmaudita->Fetch(PDO::FETCH_ASSOC);
											$RA=$auditeur['id_auditeur'];
											
											$selidauditeur=$connexion->query("select nom, prenom from auditeur where id=".$RA."");
												$sel = $selidauditeur->Fetch(PDO::FETCH_ASSOC);
													$audnom=$sel['nom'];
														$audprenom=$sel['prenom'];
															$selutilisateur=$connexion->query("select id , mail from utilisateur where nom='".$audnom."' and prenom='".$audprenom."'");
																$selid = $selutilisateur->Fetch(PDO::FETCH_ASSOC);
																	$i_ra=$selid['id'];
																	$mail=$selid['mail'];
																		$addFiche=$connexion->exec("INSERT INTO fichecreeoupas VALUES (null,".$ann.",'".$numero."',0,".$i_ra.")");
								$to = $mail;
								$subject = "Audit ".$numero;


								$txt = 'Vous êtes responsable d\'audit n° '.$numero.' du processus '.$ssnom.' <br>veuillez <a href="http://192.168.2.106:8080/SMI/Mci_QSE/admin/login.php">vous connecter</a> pour renseigner la fiche d\'audit.
<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
mail($to,$subject,$txt,$headers);
							

							$confirmaudita=$connexion->query("select * from auditeurprevu where  ann=$ann and numero_audit='".$numero."' and fonction='2'");
							while($auditeur = $confirmaudita->Fetch(PDO::FETCH_ASSOC)){
							$A=$auditeur['id_auditeur'];
							$selidauditeur=$connexion->query("select nom, prenom from auditeur where id=".$A."");
							$sel = $selidauditeur->Fetch(PDO::FETCH_ASSOC);
													$audnom=$sel['nom'];
														$audprenom=$sel['prenom'];
															$selutilisateur=$connexion->query("select id , mail from utilisateur where nom='".$audnom."' and prenom='".$audprenom."'");
																$selid = $selutilisateur->Fetch(PDO::FETCH_ASSOC);
																	$i_ra=$selid['id'];
																	$mail=$selid['mail'];

							$to = $mail;
								$subject = "Audit ".$numero;


								$txt = 'Vous êtes auditeur d\'audit n° '.$numero.' du processus '.$ssnom.'
<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
mail($to,$subject,$txt,$headers);
}
							$confirmaudita=$connexion->query("select * from auditeurprevu where  ann=$ann and numero_audit='".$numero."' and fonction='3'");
							while($auditeur = $confirmaudita->Fetch(PDO::FETCH_ASSOC)){
							$O=$auditeur['id_auditeur'];
							$selidauditeur=$connexion->query("select nom, prenom from auditeur where id=$O");
							$sel = $selidauditeur->Fetch(PDO::FETCH_ASSOC);
													$audnom=$sel['nom'];
														$audprenom=$sel['prenom'];
															$selutilisateur=$connexion->query("select id , mail from utilisateur where nom='".$audnom."' and prenom='".$audprenom."'");
																$selid = $selutilisateur->Fetch(PDO::FETCH_ASSOC);
																	$i_ra=$selid['id'];
																	$mail=$selid['mail'];

							$to = $mail;
								$subject = "Audit ".$numero;


								$txt = 'Vous êtes observateur d\'audit n° '.$numero.' du processus '.$ssnom.'
<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
mail($to,$subject,$txt,$headers);
							}
}							
						
					 header("Location: planaudits1.php?ann=$ann");
						}
						
						
	}					
						