<?php 
session_start();

function cpy($source, $dest){
    if(is_dir($source)) {
        $dir_handle=opendir($source);
        while($file=readdir($dir_handle)){
            if($file!="." && $file!=".."){
                if(is_dir($source."/".$file)){
                    if(!is_dir($dest."/".$file)){
                        mkdir($dest."/".$file);
                    }
                    cpy($source."/".$file, $dest."/".$file);
                } else {
                    copy($source."/".$file, $dest."/".$file);
                }
            }
        }
        closedir($dir_handle);
    } else {
        copy($source, $dest);
    }
}
function delTree($dir) {
   $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
  }

    if ($_SESSION['adp']==0){
	header("Location: 404.html");
	}
	 elseif (!isset($_SESSION['nom'])) {
        header("Location: login.php");
    }
if(!isset($_GET['id'])){
	header("Location: 404.html");
}
else{
	include_once 'bd.php';
	$id=$_GET['id'];
	$nm = $connexion->query("select nom from service WHERE service.id=$id");
	$objser = $nm->Fetch(PDO::FETCH_ASSOC);
	$nom=$objser['nom'];
	mkdir("../Documents/Archive/".$nom."");
	$file="../Documents/".$nom."";
	
	$to="../Documents/Archive/".$nom."";
		cpy($file,$to);
	if(delTree($file)){		
	$cousnt = $connexion->query("DELETE FROM service WHERE service.id=$id");
	
	header("Location: listeservice.php");
	}
}
?>
