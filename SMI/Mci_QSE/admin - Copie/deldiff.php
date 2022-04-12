<?php 
session_start();

    if ($_SESSION['adp']==0){
	header("Location: 404.html");
	}
	 elseif (!isset($_SESSION['nom'])) {
        header("Location: login.php");
    }
if(!isset($_GET['doc_id'])){
	header("Location: 404.html");
}
else{
	include_once 'bd.php';	
	$r5=$_GET['doc_id'];
	$ser=$_GET['ser'];
				$del8 = $connexion->query("DELETE FROM diff WHERE diff.id=$r5");
				header("Location: listediffdocdel.php?ser=$ser");
			}	
			?>
	</html>