<?php   
   session_start();
if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
  ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
    PHP_OUTPUT_HANDLER_REMOVABLE);
} else {
  ob_start(null, 0, false);
} 
$adp=$_SESSION['adp'];
if($adp!=2 and $adp!=1 and $adp!=3){
		header("Location: 404.html");
		// echo '1';
	}
	else{
if(!isset($_SESSION['nom']) || !isset($_GET['ann']) || !isset($_GET['idproc'])){
// echo '2';
	header("Location: 404.html");
}
else{
	include_once 'bd.php';
	
		$ann=$_GET['ann'];
		$idproc=$_GET['idproc'];
	
			$result=$connexion->exec("UPDATE planaction  SET  
	planaction.cop='1' where planaction.id_proc=$idproc and planaction.ann='".$ann."'");
$i=0;
		if(	$result!=0	){
			
				$confirmaudit=$connexion->query("select numero from auditprevu where  ann=$ann and id_sservice=$idproc");
							$audit = $confirmaudit->Fetch(PDO::FETCH_ASSOC);
							$num=$audit['numero'];
							
							$selectRauditee=$connexion->query('select id_utilisateur from respentaudite where respentaudite.num_audit="'.$num.'"');
							while($aRA = $selectRauditee->Fetch(PDO::FETCH_ASSOC)){							
								$r=$aRA['id_utilisateur'];								
															
									$SelectRaNom=$connexion->query("select mail from utilisateur where utilisateur.id=$r");
									
										$aRAselect = $SelectRaNom->Fetch(PDO::FETCH_ASSOC);										
											
												$mail=$aRAselect['mail'];
																							
								}
											
								$to = $mail;
								$subject = 'Plan d\'action d\'audit '.$numero;

								$txt = 'Veuillez <a href="http://192.168.2.106:8080/SMI/Mci_QSE/admin/login.php?plandaction=1">vous connecter</a> pour completer votre plan d\'action.
<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
$headers .= "Content-Type: text/html;";
mail($to,$subject,$txt,$headers);

						
		}
					header("Location: planaction1.php?ann=$ann&idproc=$idproc");
					
						}
						
	}					
						
						