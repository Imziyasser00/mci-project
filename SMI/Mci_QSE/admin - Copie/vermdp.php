<?php
session_start();
if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
  ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
    PHP_OUTPUT_HANDLER_REMOVABLE);
} else {
  ob_start(null, 0, false);
} 
if(isset($_POST['sub']))
{
if(empty($_POST['login']) || empty($_POST['mdp']))
{
echo '<script language="javascript" type="text/javascript">
       alert("Impossible de se connecter Veuillez réesseyer");</script>';
}
elseif(!empty($_POST['login']) && !empty($_POST['mdp']))
{
include_once 'bd.php';
$r1=($_POST['login']);
$r2=($_POST['mdp']);
$req=$connexion->query("SELECT utilisateur.id as id, utilisateur.id_service as ids ,utilisateur.username as log ,utilisateur.nom as nom ,utilisateur.prenom as prenom , utilisateur.adoupas as adp FROM `utilisateur` WHERE utilisateur.username='$r1' AND utilisateur.mdp='$r2'") ;
$nbr=$req->rowcount() ;
$obj = $req->Fetch(PDO::FETCH_ASSOC);
if($nbr!=0)
{
$_SESSION['username'] = $obj['log'];
$_SESSION['prenom'] = $obj['prenom'];
$_SESSION['nom'] = $obj['nom'];
$_SESSION['id'] = $obj['id'];
$_SESSION['ids'] = $obj['ids'];
$_SESSION['adp'] = $obj['adp'];
$_SESSION['start']=time();
header('Location: index.php');
}
else{
header('Location: login.php');	
}
}
}
?>