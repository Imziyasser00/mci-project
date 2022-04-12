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
	$nb=$connexion->query("select * from document where document.id=$r5");
	$obj = $nb->Fetch(PDO::FETCH_ASSOC);
	$file=$obj['lien'];
	$type=$obj['type'];
	$name=$obj['nom'];
	$ser=$obj['id_service'];
	$nb2=$connexion->query("select * from service where service.id='$ser'");
	$obj2 = $nb2->Fetch(PDO::FETCH_ASSOC);
	$service=$obj2['nom'];
	$deli=$connexion->query("select diff.id_doc as doc from diff where diff.id_doc='$r5'");
		$nbr8=$deli->rowcount();
		if($nbr8!=0){
			while($obj8=$deli->Fetch(PDO::FETCH_ASSOC)){
				$del8 = $connexion->query("DELETE FROM diff WHERE diff.id_doc=$r5");
			}
			}	
	$cousnt = $connexion->query("DELETE FROM Document WHERE Document.id=$r5");
	$req3=$connexion->query("select liaison.id_anx as anx from liaison where liaison.id_doc='$r5'");
		$nbr3=$req3->rowcount();
		if($nbr3!=0){
			while($obj3=$req3->Fetch(PDO::FETCH_ASSOC)){
				$del = $connexion->query("DELETE FROM liaison WHERE liaison.id_doc=$r5");
			}
			}
	$req8=$connexion->query("select diff.id_doc as doc from diff where diff.id_doc='$r5'");
		$nbr8=$req8->rowcount();
		if($nbr8!=0){
			while($obj8=$req3->Fetch(PDO::FETCH_ASSOC)){
				$del8 = $connexion->query("DELETE FROM diff WHERE diff.id_doc=$r5");
			}
			}
	$to='../Documents/'.$service.'/'.$type.'/Archive/'.$name.'_del_'.time().'';
	copy($file,$to);
	unlink($file);
	if(isset($_GET['t'])){
	header("Location: adddoc.php");
	}
	ELSE{
		header("Location: listedoc.php");
	}
} ?>
</html>