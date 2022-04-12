
<?php

    session_start();
if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
  ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
    PHP_OUTPUT_HANDLER_REMOVABLE);
} else {
  ob_start(null, 0, false);
} 
    if ($_SESSION['adp']==0){
	header("Location: 404.html");
	}
    elseif (!isset($_SESSION['nom'])) {
        header("Location: login.php");
    }
    else {
	$prenom = $_SESSION['prenom'];
	$nom = $_SESSION['nom'];
	$service = $_SESSION['ids'];
	$adp=$_SESSION['adp'];

if (isset($_POST['valider'])){
	include_once 'bd.php';
	$num=$_POST['num'];	
	$duree=$_POST['duree'];	
	$ids=$_POST['ser'];
	$id_nom =$connexion->query("SELECT `id` FROM `service` WHERE `nom` = '$ids'");
	$objnom = $id_nom ->Fetch(PDO::FETCH_ASSOC);
	$idt=$objnom['id'];
	$idss=$_POST['sservice'];
	$RA=$_POST['RA'];
	$A=$_POST['A'];
	$openfrom=1;
	$O=$_POST['O'];	
	$addRA=0;
	
	
	$date_from = date_create($_POST['from']);
	$from=date_format($date_from, 'Y-m-d');	
	$date_to = date_create($_POST['to']);
	$to=date_format($date_to, 'Y-m-d');
	$addRA=$connexion->exec("INSERT INTO `auditeurprevu`(`id`, `id_auditeur`, `numero_audit`, `fonction`) VALUES ('','$RA','$num','RA')");
	$addA=$connexion->exec("INSERT INTO `auditeurprevu`(`id`, `id_auditeur`, `numero_audit`, `fonction`) VALUES ('','$A','$num','A')");
	$addO=$connexion->exec("INSERT INTO `auditeurprevu`(`id`, `id_auditeur`, `numero_audit`, `fonction`) VALUES ('','$O','$num','O')");
	if($_POST['idsup']!='' and $_POST['fonctionsup']!=''){
		$idsup=$_POST['idsup'];
		$fsup=$_POST['fonctionsup'];
	$addRA=$connexion->exec("INSERT INTO `auditeurprevu`(`id`, `id_auditeur`, `numero_audit`, `fonction`) VALUES ('','$idsup','$num','$fsup')");
	}
	$addauditp=$connexion->exec("INSERT INTO auditprevu VALUES ('','$num','$duree',$idt,$idss,'$from','$to')");
	if($addauditp!=0){
		header("location:planaudit.php"); 
	}
	else{
		echo $idt;
		
	}
		}
	}
	
		?>