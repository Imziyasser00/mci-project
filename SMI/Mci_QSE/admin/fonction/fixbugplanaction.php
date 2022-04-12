<?php
session_start();
 if (!isset($_SESSION['nom'])) {
        header("Location: 404.html");
    }
$adp=$_SESSION['adp'];
include_once '../bd.php';
									$co=$connexion->query('select * from point where type!="ref" and type!="champ"  and type!="fort" and numero_audit="12/18"');
									while($cor= $co->Fetch(PDO::FETCH_ASSOC)){
										$idPoint=$cor['id'];
									$correction=$connexion->exec("INSERT INTO nonconfirmite VALUES(null,$idPoint,'12/18','','','','0')");
									}


										
?>