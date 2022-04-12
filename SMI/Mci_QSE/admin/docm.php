
<?php
if (isset($_POST['non'])){	
	include_once 'bd.php';
	$etat=$_POST['etat'];
	$app=$_POST['app'];
	$date = date_create($_POST['app']);
	$doc_id=$_GET['doc_id'];
	$nbq=$connexion->query("select * from document where document.id=$doc_id");
	$objq = $nbq->Fetch(PDO::FETCH_ASSOC);
	$id_ser=$objq['id_service'];
	$type=$objq['type'];
	$filelien=$objq['lien'];
	$name=$objq['nom'];
	$set=$connexion->query("select * from service where service.id=$id_ser");
	$objs = $set->Fetch(PDO::FETCH_ASSOC);
	$ser=$objs['nom'];
	if($_POST['revi']=="5ans")
	{
	date_add($date, date_interval_create_from_date_string('5 years'));
	$ravi=date_format($date, 'Y-m-d');
	}
	else {
	date_add($date, date_interval_create_from_date_string('3 years'));
	$ravi=date_format($date, 'Y-m-d');
	}
if($_FILES["fileToUpload"]["size"]!=0){
	$target_dir = "../Documents/".$ser."/".$type."/";
	$file_name= basename($_FILES["fileToUpload"]["name"]);
	$file=$_FILES["fileToUpload"]["name"];
	$filetemp=$_FILES["fileToUpload"]["tmp_name"];
	$target_file = $target_dir . basename($file);
	$target_file = "../Documents/".$ser."/".$type."/".$file_name;
	$uploadOk = 1;
	$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
if ($_FILES["fileToUpload"]["size"] > 5000000) { 
	echo '<script language="javascript" type="text/javascript">
       alert("Un ou plusieurs champs sont vides");</script>';	
	}
	if( $FileType != "pdf" && $FileType != "PDF") {      
	   echo '<script language="javascript" type="text/javascript">
       alert("Seuls les fichiers de type PDF sont autorisés");</script>';	
	}
	else {
		$target_file = "../Documents/".$ser."/".$type."/".utf8_decode($file_name);
		$to="../Documents/".$ser."/".$type."/Archive/".$name."modif".time()."";
	copy($filelien,$to);	
	if (move_uploaded_file($filetemp, $target_file)) {			
			include_once 'bd.php';
			$req1=$connexion->query("SELECT id from service WHERE service.nom='$ser'");
			$nbr=$req1->rowcount();			
			$obj = $req1->Fetch(PDO::FETCH_ASSOC);
			$r2=$obj['id'];
			$r1=utf8_decode($file_name);
			$r2=$target_file;
			$r3=$connexion->quote(utf8_decode($etat));	
		
			$result=$connexion->exec("UPDATE document  SET  document.nom='$r1', document.lien='$r2', document.Etat=$r3, document.dateAPP='$app', document.DATTREV='$ravi' where document.id=$doc_id ");
			if($result!=0)   {
				
				unlink($filelien);
				//header("Location: anx.php?file=$str&ser=$ser&type=$type");
				$str=urlencode($name);
				header("Location: nmbrasso.php?id=$doc_id");
			}
			else {
							
					echo 'ko';	
			}			}
		else{
		echo 'noon';
			}
		}
}
else {
	include_once 'bd.php';
	$r3=$connexion->quote(utf8_decode($etat));	
	$result=$connexion->exec("UPDATE document  SET  document.Etat=$r3, document.dateAPP='$app', document.DATTREV='$ravi' where document.id=$doc_id ");
		if($result!=0) {
				$str=urlencode(utf8_encode($name));					
				
				header("Location: nmbrasso.php?id=$doc_id");
				
				//header('location: docdoc.php?service='.$ser.'&type='.$type.'&ts=1');
			}
			else {
						$str=urlencode(utf8_encode($name));		
					header("Location: nmbrasso.php?id=$doc_id");
			}
	}
}
if (isset($_POST['valider'])){
	
	include_once 'bd.php';
	$etat=$_POST['etat'];
	$app=$_POST['app'];
	$date = date_create($_POST['app']);
	$doc_id=$_GET['doc_id'];
	$nbq=$connexion->query("select * from document where document.id=$doc_id");
	$objq = $nbq->Fetch(PDO::FETCH_ASSOC);
	$id_ser=$objq['id_service'];
	$type=$objq['type'];
	$filelien=$objq['lien'];
	$name=$objq['nom'];
	$set=$connexion->query("select * from service where service.id=$id_ser");
	$objs = $set->Fetch(PDO::FETCH_ASSOC);
	$ser=$objs['nom'];
	if($_POST['revi']=="5ans")
	{
	date_add($date, date_interval_create_from_date_string('5 years'));
	$ravi=date_format($date, 'Y-m-d');
	}
	else {
	date_add($date, date_interval_create_from_date_string('3 years'));
	$ravi=date_format($date, 'Y-m-d');
	}
if($_FILES["fileToUpload"]["size"]!=0){
	$target_dir = "../Documents/".$ser."/".$type."/";
	$file_name= basename($_FILES["fileToUpload"]["name"]);
	$file=$_FILES["fileToUpload"]["name"];
	$filetemp=$_FILES["fileToUpload"]["tmp_name"];
	$target_file = $target_dir . basename($file);
	$target_file = "../Documents/".$ser."/".$type."/".$file_name;
	$uploadOk = 1;
	$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
if ($_FILES["fileToUpload"]["size"] > 5000000) { 
	echo '<script language="javascript" type="text/javascript">
       alert("Un ou plusieurs champs sont vides");</script>';	
	}
	if( $FileType != "pdf" && $FileType != "PDF") {      
	   echo '<script language="javascript" type="text/javascript">
       alert("Seuls les fichiers de type PDF sont autorisés");</script>';	
	}
	else {
		$target_file = "../Documents/".$ser."/".$type."/".utf8_decode($file_name);
		$to="../Documents/".$ser."/".$type."/Archive/".$name."modif".time()."";
	copy($filelien,$to);	
	if (move_uploaded_file($filetemp, $target_file)) {			
			include_once 'bd.php';
			$req1=$connexion->query("SELECT id from service WHERE service.nom='$ser'");
			$nbr=$req1->rowcount();			
			$obj = $req1->Fetch(PDO::FETCH_ASSOC);
			$r2=$obj['id'];
			$r1=utf8_decode($file_name);
			$r2=$target_file;
			$r3=$connexion->quote(utf8_decode($etat));	
			
		
			$result=$connexion->exec("UPDATE document  SET  document.nom='$r1', document.lien='$r2', document.Etat=$r3, document.dateAPP='$app', document.DATTREV='$ravi' where document.id=$doc_id ");
			if($result!=0)   {
				
				unlink($filelien);
				//header("Location: anx.php?file=$str&ser=$ser&type=$type");
				
				$str=urlencode($name);
				header("location: docdoc.php?type=$type&service=$ser");
				
			}
			else {
							
					echo 'ko';	
			}			}
		else{
		echo 'noon';
			}
		}
}
else {
	include_once 'bd.php';
	$set=$connexion->query("select * from service where service.id=$id_ser");
	$objs = $set->Fetch(PDO::FETCH_ASSOC);
	$ser=$objs['nom'];
	$r3=$connexion->quote(utf8_decode($etat));
	$r8=$etat;		
	$result=$connexion->exec("UPDATE document  SET  document.Etat=$r3, document.dateAPP='$app', document.DATTREV='$ravi' where document.id=$doc_id ");
		if($result!=0) {
				$str=urlencode(utf8_encode($name));					
				if ($r8!="Annulé"){
				header("location: docdoc.php?type=$type&service=$ser");
				
				}
				else{
				header('location: Archivage.php');
				}
			}
			else {
					if ($r8!="Annulé"){
					$str=urlencode($name);
					// echo $r8;					
					header("location: docdoc.php?type=$type&service=$ser");
					}
				else{
				header('location: Archivage.php');
				}
			}
	}
	}