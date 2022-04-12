
<?php
date_default_timezone_set('UTC');
$var=$_POST['var'];
$serv=$_POST['serv'];
$type=$_POST['type'];
$target_dir = "../../../Documents/".$_POST['serv']."/".$type."/";
$file_name=basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;


$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

// Check if file already exists

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    
    $uploadOk = 2;
	header("Location: ../Documents.php?cs=2&service=".$_POST['serv']."&type=".$type."");	
}
// Allow certain file formats
elseif($FileType != "pdf" &&$FileType != "PDF" && $FileType != "JPG" && $FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" && $FileType != "pjpeg"  &&  $FileType != "x-png"
 ) {
       $uploadOk = 3;
	   header("Location: ../Documents.php?cs=3&service=".$_POST['serv']."&type=".$type."");	
}
else {
	$today = date("F j, Y, g i a"); 
	$file="../../../Documents/".$_POST['serv']."/".$type."/".$var."";
	$to="../../../Documents/".$_POST['serv']."/".$type."/Archive/".$var." ".$today.".".$FileType."";

    copy($file,$to);
$target_file = "../../Documents/".$_POST['serv']."/".$type."/".$file_name;
$target_fileq = "../../../Documents/".$_POST['serv']."/".$type."/".$file_name."";
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_fileq)) {
	
       $uploadOk = 1;
	   include_once 'bd.php';
	   $req1=$connexion->query("SELECT id from document WHERE document.nom='$var'");
	   if($nbr==0){
		   $obj = $req1->Fetch(PDO::FETCH_ASSOC);
		$r2=$obj['id'];
		$result=$connexion->query("UPDATE Document SET document.nom=$file_name document.lien=$target_file where document.id=$r2");	
		if($result!=0)   
		{
	   header("Location: ../Documents.php?cs=1&service=".$_POST['serv']."&type=".$type."");	
    } else {
	$uploadOk = 4;
      header("Location: ../Documents.php?cs=4&service=".$_POST['serv']."&type=".$type."");	
    }
}
	}
}
?>