<?php
$target_dir = "../Documents/Code d'éthique/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

// Check if file already exists

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    
    $uploadOk = 2;
	header("Location: ../admin/cde.php?cs=2");	
}
// Allow certain file formats
elseif($FileType != "pdf" 
 ) {
       $uploadOk = 3;
	   header("Location: ../admin/cde.php?cs=3");	
}
else {
copy("../Documents/Code d'éthique/Code d'éthique.pdf", "../Documents/Code d'éthique/trush/Code d'éthique.pdf".time().".pdf");
$target_file = "../Documents/Code d'éthique/Code d'éthique.pdf";
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	
       $uploadOk = 1;
	   header("Location: ../admin/cde.php");	
    } else {
	$uploadOk = 4;
      header("Location: ../admin/cde.php?cs=4");	
    }
}
?>