<!DOCTYPE html>
<html lang="fr"> 
<?php

    session_start();

    if (!isset($_SESSION['nom']) || !isset($_GET['id'])) {
        header("Location: 404.html");
    }
    else {
		$prenom = $_SESSION['prenom'];
	$id = $_SESSION['id'];
		$openfrom=1; 
	$nom = $_SESSION['nom'];

	$service = $_SESSION['ids'];
	$adp=$_SESSION['adp'];
	include_once 'bd.php';
	$servname=$connexion->query("select nom from service where service.id=$service");
	$objser = $servname->Fetch(PDO::FETCH_ASSOC);
	$Sname=$objser['nom'];
	$Id_em=$_GET['id'];
	$idN=$_GET['idN'];
	
	$verif1=$_POST['verif1'];
	$verif2=$_POST['verif2'];
	$verif3=$_POST['verif3'];
	$num=$_POST['num'];
	$mailAuditeur=$_POST['mailAuditeur'];
	$mail2=$_POST['mail2'];
	$mail3="D.sahraoui@mci-santeanimale.com";
	//$mail2="h.elbaggar@mci-santeanimale.com";
	//$mailAuditeur="";
	//$mail3="h.elbaggar@mci-santeanimale.com";
	echo 'idfiche : '.$Id_em.'<br>';
	if(isset($_POST['enregistrer'])){
				if(isset($_POST['AutresText']))
{	
$AutresText=$_POST['AutresText'];
$AutresText=utf8_decode($_POST['AutresText']);
$delTEx = $connexion->exec('DELETE FROM libText WHERE id_em="'.$Id_em.'"');
$remplirTex=$connexion->exec('INSERT INTO `libText` VALUES (null,"'.$Id_em.'","'.$AutresText.'")');
}
			if(isset($_POST['effdate']))
{	
$effdate=$_POST['effdate'];
$effdate=utf8_decode($_POST['effdate']);
$delTEx = $connexion->exec('DELETE FROM effdate WHERE id_em="'.$Id_em.'"');
$remplirTex=$connexion->exec('INSERT INTO `effdate` VALUES (null,"'.$Id_em.'","'.$effdate.'")');
}
if(isset($_POST['CauseText']))
{	
$CauseText=$_POST['CauseText'];
$CauseText=utf8_decode($_POST['CauseText']);
$delTEx = $connexion->exec('DELETE FROM CauseText WHERE id_em="'.$Id_em.'"');
$remplirTex=$connexion->exec('INSERT INTO `CauseText` VALUES (null,"'.$Id_em.'","'.$CauseText.'")');
}
if(isset($_POST['repAction']))
{	
$repAction=$_POST['repAction'];
$repAction=utf8_decode($_POST['repAction']);
$delTEx = $connexion->exec('DELETE FROM represp WHERE id_em="'.$Id_em.'"');
$remplirTex=$connexion->exec('INSERT INTO `represp` VALUES (null,"'.$Id_em.'","'.$repAction.'")');
}
if(isset($_POST['refaction']))
{	
$refaction=$_POST['refaction'];
$refaction=utf8_decode($_POST['refaction']);
$delTEx = $connexion->exec('DELETE FROM refaction WHERE id_em="'.$Id_em.'"');
$remplirTex=$connexion->exec('INSERT INTO `refaction` VALUES (null,"'.$Id_em.'","'.$refaction.'")');
}
if(isset($_POST['dateAction']))
{	
$dateAction=$_POST['dateAction'];
$dateAction=utf8_decode($_POST['dateAction']);
$delTEx = $connexion->exec('DELETE FROM dateAction WHERE id_em="'.$Id_em.'"');
$remplirTex=$connexion->exec('INSERT INTO `dateAction` VALUES (null,"'.$Id_em.'","'.$dateAction.'")');
}
if(isset($_POST['listAcTION']))
{	
$listAcTION=$_POST['listAcTION'];
$listAcTION=utf8_decode($_POST['listAcTION']);
$delTEx = $connexion->exec('DELETE FROM listAcTION WHERE id_em="'.$Id_em.'"');
$remplirTex=$connexion->exec('INSERT INTO `listAcTION` VALUES (null,"'.$Id_em.'","'.$listAcTION.'")');
}
if(isset($_POST['verifText']))
{	
$verifText=$_POST['verifText'];
$verifText=utf8_decode($_POST['verifText']);
$delTEx = $connexion->exec('DELETE FROM verifText WHERE id_em="'.$Id_em.'"');
$remplirTex=$connexion->exec('INSERT INTO `verifText` VALUES (null,"'.$Id_em.'","'.$verifText.'")');
}


else{
	$delEx = $connexion->exec('Update FROM ecartm1 WHERE Id_em="'.$Id_em.'" and `check`="lapplication"');
}
if($verif1 == ""){
	//Si l'utilisateur est le responsable d'audit on modifie la valeur du champ valide dans la table notificationficheecart en 1 	
	$message="Veuillez Completer la fiche d\'écart majeur d\'audit n° ".$num."" ;
	$message=utf8_decode($message);
		$updateNotification=$connexion->exec("UPDATE notificationficheecart  SET  notificationficheecart.valide='1' where num='".$num."' and id='".$idN."'");	
if(isset($_POST['lapplication']) && 
   $_POST['lapplication'] == 'lapplication') 
{		
	$val= $_POST['lapplication'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="lapplication"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="lapplication"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","lapplication","0")');
	
	} 
if(isset($_POST['documentation']) && 
   $_POST['documentation'] == 'documentation') 
{		
	$val= $_POST['documentation'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="documentation"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="documentation"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","documentation","0")');
	
	}  
if(isset($_POST['Seuil']) && 
   $_POST['Seuil'] == 'Seuil') 
{		
	$val= $_POST['Seuil'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="Seuil"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="Seuil"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","Seuil","0")');
	
	}  
if(isset($_POST['Audit']) && 
   $_POST['Audit'] == 'Audit') 
{		
	$val= $_POST['Audit'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="Audit"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="Audit"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","Audit","0")');
	
	}  
if(isset($_POST['Autres']) && 
   $_POST['Autres'] == 'Autres') 
{		
	$val= $_POST['Autres'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="Autres"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="Autres"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","Autres","0")');
	}

if(isset($_POST['BIO']) && 
   $_POST['BIO'] == 'BIO') 
{		
	$val= $_POST['BIO'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="BIO"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="BIO"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","BIO","0")');
	
	}  
if(isset($_POST['BPF']) && 
   $_POST['BPF'] == 'BPF') 
{		
	$val= $_POST['BPF'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="BPF"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="BPF"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","BPF","0")');
	
	}  
if(isset($_POST['QSE']) && 
   $_POST['QSE'] == 'QSE') 
{		
	$val= $_POST['QSE'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="QSE"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}

   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="QSE"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","QSE","0")');
	
	}  
		}
if($verif2 == ""){
$message="Veuillez valider la fiche d\'écart majeur d\'audit n° ".$num."" ;
	$message=utf8_decode($message);
		$updateNotification=$connexion->exec("UPDATE notificationficheecart  SET  notificationficheecart.valide='2' where num='".$num."' and message='".$message."' and id='".$idN."'");	
if(isset($_POST['CORRECTION']) && 
   $_POST['CORRECTION'] == 'CORRECTION') 
{		
	$val= $_POST['CORRECTION'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="CORRECTION"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="CORRECTION"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","CORRECTION","0")');
	
	}
if(isset($_POST['ACTIONS']) && 
   $_POST['ACTIONS'] == 'ACTIONS') 
{		
	$val= $_POST['ACTIONS'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="ACTIONS"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="ACTIONS"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","ACTIONS","0")');
	
	}  	
if(isset($_POST['CHANGEMENTNON']) && 
   $_POST['CHANGEMENTNON'] == 'CHANGEMENTNON') 
{		
	$val= $_POST['CHANGEMENTNON'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="CHANGEMENTNON"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="CHANGEMENTNON"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","CHANGEMENTNON","0")');
	
	}  	
if(isset($_POST['CHANGEMENTOUI']) && 
   $_POST['CHANGEMENTOUI'] == 'CHANGEMENTOUI') 
{		
	$val= $_POST['CHANGEMENTOUI'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="CHANGEMENTOUI"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="CHANGEMENTOUI"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","CHANGEMENTOUI","0")');
}
}  
if($verif3 == ""){	
	
if(isset($_POST['Vdocumentaire']) && 
   $_POST['Vdocumentaire'] == 'Vdocumentaire') 
{		
	$val= $_POST['Vdocumentaire'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="Vdocumentaire"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="Vdocumentaire"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","Vdocumentaire","0")');
	
	}  		}  	
if(isset($_POST['Vdocumentaire']) && 
   $_POST['Vdocumentaire'] == 'Vdocumentaire') 
{		
	$val= $_POST['Vdocumentaire'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="Vdocumentaire"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="Vdocumentaire"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","Vdocumentaire","0")');
	
	}  	
if(isset($_POST['AuditC']) && 
   $_POST['AuditC'] == 'AuditC') 
{		
	$val= $_POST['AuditC'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="AuditC"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="AuditC"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","AuditC","0")');
	
	}  	

if(isset($_POST['NApplication']) && 
   $_POST['NApplication'] == 'NApplication') 
{		
	$val= $_POST['NApplication'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="NApplication"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="NApplication"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","NApplication","0")');
	
	}  	
if(isset($_POST['NDocumentation']) && 
   $_POST['NDocumentation'] == 'NDocumentation') 
{		
	$val= $_POST['NDocumentation'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="NDocumentation"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="NDocumentation"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","NDocumentation","0")');
	
	}  	
if(isset($_POST['NDocApp']) && 
   $_POST['NDocApp'] == 'NDocApp') 
{		
	$val= $_POST['NDocApp'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="NDocApp"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="NDocApp"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","NDocApp","0")');
	
	}  	
if(isset($_POST['Efficace']) && 
   $_POST['Efficace'] == 'Efficace') 
{		
	$val= $_POST['Efficace'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="Efficace"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="Efficace"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","Efficace","0")');
	
	}  	
if(isset($_POST['NEfficace']) && 
   $_POST['NEfficace'] == 'NEfficace') 
{		
	$val= $_POST['NEfficace'];
	$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="NEfficace"');	
	$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","'.$val.'","1")');
  
 
}
   else{
$delEx = $connexion->exec('DELETE FROM ecartm1 WHERE `Id_em`="'.$Id_em.'" and `check`="NEfficace"');	   
$remplir=$connexion->exec('INSERT INTO `ecartm1` VALUES (null,"'.$Id_em.'","NEfficace","0")');
	
	}
	    	


header("Location: ficheEcart1.php?id=$Id_em&v=$verif2&idN=$idN");
}
if(isset($_POST['diffusion'])){
	if($verif1 == ""){
																	
								$to1 = $mail3;
								$to = $mail2;
								$subject = 'Fiche d\'écart majeur d\'audit n° '.$num;

								$subject = utf8_decode($subject );
								$txt = 'la fiche d\'écrat majeur d\'audit n° '.$num.' a été créée ou modifiée par le responsable d\'audit <br>veuillez <a href="http://192.168.2.106:8080/SMI/Mci_QSE/admin/login.php">vous connecter</a> pour completer ou consulter la fiche d\'écart majeur.
<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';
								$txt=utf8_decode($txt);
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
mail($to,$subject,$txt,$headers);
mail($to1,$subject,$txt,$headers);
	}
	if($verif2 == ""){
	$to1 = $mail3;
	$to = $mailAuditeur;
	$subject = 'Fiche d\'écart majeur d\'audit n° '.$num;
	$subject = utf8_decode($subject );


								$txt = 'la fiche d\'écrat majeur d\'audit n° '.$num.' a été  modifié par le responsable de l\'entitée auditée"  <br>veuillez <a href="http://192.168.2.106:8080/SMI/Mci_QSE/admin/login.php">vous connecter</a> pour compléter ou consulter la fiche d\'écart majeur.
<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';
								$txt=utf8_decode($txt);
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
mail($to,$subject,$txt,$headers);
mail($to1,$subject,$txt,$headers);
	}
	if($verif3 == ""){	
	$message="Fiche d\'écart clôturée" ;
	$message=utf8_decode($message);
		$updateNotification=$connexion->exec("UPDATE notificationficheecart  SET  notificationficheecart.valide='3' where num='".$num."' and message='".$message."' and id='".$idN."'");	
	$to1 = $mailAuditeur;
	$to = $mail2;
	$subject = 'Fiche d\'écart majeur d\'audit n° '.$num;
	$subject = utf8_decode($subject );

								$txt = 'la fiche d\'écrat majeur d\'audit n° '.$num.' a été Valider par le responsable QSE"  <br>veuillez <a href="http://192.168.2.106:8080/SMI/Mci_QSE/admin/login.php">vous connecter</a> pour compléter ou consulter la fiche d\'écart majeur.
<br><br>Merci de ne pas répondre à ce courriel!<br><br>SMI Q.S.E.<br>M.C.I Santé Animale ';
								$txt=utf8_decode($txt);
								$headers =  "From: noreply@mci-santeanimale.com" . "\r\n";
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
mail($to,$subject,$txt,$headers);
mail($to1,$subject,$txt,$headers);
	}
	$abc="";
	if(isset($_GET['idN'])){$abc="&idN=".$idN;}
	$abc="Location: ficheEcart1.php?id=$Id_em&v=$verif2".$abc;
header($abc);
}
}
?>
</html>