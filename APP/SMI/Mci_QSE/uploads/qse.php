<?php
$target_dir = "../Documents/Politique QSE/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

// Check if file already exists

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    
    $uploadOk = 2;
	header("Location: ../admin/PQSE.php?cs=2");	
}
// Allow certain file formats
elseif($FileType != "pdf" 
 ) {
       $uploadOk = 3;
	   header("Location: ../admin/PQSE.php?cs=3");	
}
else {
copy("../Documents/Politique QSE/Politique QSE.pdf", "../Documents/Politique QSE/Archive/Politique QSE".time().".pdf");
$target_file = "../Documents/Politique QSE/Politique QSE.pdf";
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	
       $uploadOk = 1;
	   header("Location: ../admin/PQSE.php?cs=1");	
    } else {
	$uploadOk = 4;
      header("Location: ../admin/PQSE.php?cs=4");	
    }
}
?>