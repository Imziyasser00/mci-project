<!DOCTYPE html>
<html lang="en"> 
<?php

    session_start();

    if (!isset($_SESSION['nom'])) {
        header("Location: login.php");
    }

   else{
	
	include_once 'bd.php';
		$idauditeur=$_SESSION['id'];
		
		$plan_ann=$_POST['anne'];
		$idproc=$_POST['idproc'];
		if($idauditeur!="82" and $idauditeur!="47" and $idauditeur!="69" and $idauditeur!="63"){								
									$confirmaudit=$connexion->query("select numero from auditprevu where  ann=$plan_ann and id_sservice=$idproc");
									$audit = $confirmaudit->Fetch(PDO::FETCH_ASSOC);
									$num=$audit['numero'];
									
										$nbba=$confirmaudit->rowcount();
											if($nbba!=0){
												
									header('Location: completerPlan.php?num='.$num.'&an='.$plan_ann.'');

										}
	
							
								

	
	
	
else
								{
									header('Location: index.php?erreur=1');


								}
									}
		else{
			header('Location: planActionResp.php?resp='.$idauditeur.'&an='.$plan_ann.'');
		}
}
	
	?>
	