<?php 
session_start();

    if ($_SESSION['adp']!=1){
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
	$nb=$connexion->query("select * from document where document.id=$r5");
	$obj = $nb->Fetch(PDO::FETCH_ASSOC);
	$file=$obj['lien'];
	$type=$obj['type'];
	$name=$obj['nom'];
	$ser=$obj['id_service'];
	$nb2=$connexion->query("select * from service where service.id='$ser'");
	$obj2 = $nb2->Fetch(PDO::FETCH_ASSOC);
	$service=$obj2['nom'];
	$to="../../Documents/".$service."/".$type."/Archive/".$name."".time()."";
	copy($file,$to);
	$cousnt = $connexion->query("DELETE FROM Document WHERE Document.id=$r5");
	header("Location: ../index.php?ps=3");
	
} ?>
</html>