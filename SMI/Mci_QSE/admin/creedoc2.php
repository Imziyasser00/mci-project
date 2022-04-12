<!DOCTYPE html>
<html lang="fr"> 
<?php

    session_start();
if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
  ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
    PHP_OUTPUT_HANDLER_REMOVABLE);
} else {
  ob_start(null, 0, false);
} 
    $adp=$_SESSION['adp'];
    if (!isset($_SESSION['nom']) ) {
        header("Location: 404.html");
    }
    else {
if (isset($_POST['revi'])){
	
	include_once 'bd.php';
	$doc_id=$_GET['doc_id'];
	$req1=$connexion->query("select docprovisoire.id as id,docprovisoire.id_service as id_ser, docprovisoire.nom as nom,docprovisoire.type as type,docprovisoire.cop as cop from docprovisoire where id=$doc_id");
		$nbra=$req1->rowcount();
								if($nbra!=0){
	
	$obj_exp = $req1->Fetch(PDO::FETCH_ASSOC);
								
	$ser=$obj_exp['id_ser'];
	$reqz_exp=$connexion->query("select service.nom as nom from service where service.id=$ser");
	$objz_exp = $reqz_exp->Fetch(PDO::FETCH_ASSOC);
	$ser=utf8_encode($objz_exp['nom']);
	$type=$obj_exp['type'];
	$nom=utf8_encode($obj_exp['nom']);	
	$cop=$obj_exp['cop'];	
	$etat="En cours d'application";
	$etat=$connexion->quote($etat);
	$date = date_create($_POST['app']);
	$app = $_POST['app'];
	echo "$nom";
	if($_POST['revi']=="5ans")
	{
	date_add($date, date_interval_create_from_date_string('5 years'));
	$ravi=date_format($date, 'Y-m-d');
	}
	elseif($_POST['revi']=="3ans") {
	date_add($date, date_interval_create_from_date_string('3 years'));
	$ravi=date_format($date, 'Y-m-d');
	}
	elseif($_POST['revi']=="1000ans") {
	 $testd = new DateTime('10/10/2099');
	 $ravi=date_format($testd, 'Y-m-d');
	}
	
	$target_dir = "../Documents/".$ser."/".$type."/";
	$file_name= $nom.".pdf";;
	$file=$_FILES["fileToUpload"]["name"];
	$filetemp=$_FILES["fileToUpload"]["tmp_name"];
	$target_file = $target_dir . basename($file);
	$target_file = "../Documents/".$ser."/".$type."/".$file_name."";
	$uploadOk = 1;
	
	$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$file_name2=$connexion->quote($file_name);
	$tst=$connexion->query("SELECT id from document WHERE document.nom=$file_name2");
	$nbr=$tst->rowcount();	
			if($nbr!=0){
					echo '<script language="javascript" type="text/javascript">
       alert("le fichier déjà existant s\'il ne s\'agit pas du même fichier penser à le renommer avant de l\'ajouter");</script>';		
							}	
		else{

		$target_file = "../Documents/".$ser."/".$type."/".$file_name;
		
		if (move_uploaded_file($filetemp, $target_file)) {			
			include_once 'bd.php';
			
			$target_file =$connexion->quote($target_file);
			$file_names=utf8_encode($file_name);
		
			$file_name=$connexion->quote($file_name);
			
			$req1=$connexion->query("SELECT id from service WHERE service.nom='$ser'");
			$nbr=$req1->rowcount();			
			$obj = $req1->Fetch(PDO::FETCH_ASSOC);
			$r2=$obj['id'];
			
			
			$result=$connexion->exec("INSERT INTO Document VALUES(null,'$r2',$file_name,'$type','$FileType',$target_file,$etat,'$app','$ravi',$adp)");
			if($result!=0){
				$confirm=$connexion->EXEC("UPDATE docprovisoire set docprovisoire.cop=1 where  docprovisoire.id=$doc_id");
				$str=urlencode($file_names);
				$nda=$_POST['doca'];
						if($nda!=0){
							header("Location: anx2.php?file=$str&ser=$ser&type=$type&doca=$nda");
									}
								else{
					$str=urlencode($file_names);
					header("location: diffusion.php?file=$str&ser=$ser&type=$type&doca=$nda");
									}
							}
			
			else {
					echo '<script language="javascript" type="text/javascript">
       alert("ERROR");</script>';	
				}
									
		}
		}
			
			
			}
	}
	}