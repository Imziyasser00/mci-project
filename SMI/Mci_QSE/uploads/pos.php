<?php
$target_dir = "../Documents/Plan d'orientation strategique/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

// Check if file already exists

// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    
    $uploadOk = 2;
	header("Location: ../admin/pos.php?cs=2");	
}
// Allow certain file formats
elseif($FileType != "pdf" 
 ) {
       $uploadOk = 3;
	   header("Location: ../admin/pos.php?cs=3");	
}
else {
copy("../Documents/Plan d'orientation strategique/Plan d'orientation strategique.pdf", "../Documents/Plan d'orientation strategique/trush/Plan d'orientation strategique".time().".pdf");
$target_file = "../Documents/Plan d'orientation strategique/Plan d'orientation strategique.pdf";
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	
       $uploadOk = 1;
	   header("Location: ../admin/pos.php");	
    } else {
	$uploadOk = 4;
      header("Location: ../admin/pos.php?cs=4");	
    }
}
?>