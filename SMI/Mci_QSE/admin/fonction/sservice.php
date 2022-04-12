<?php


function getNomService($id){
  try
{
$connexion = new PDO('mysql:host=localhost;dbname=mci', 'root', '');
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
$getServiceName=$connexion->prepare("select service.nom as nom from service where service.id=?");
$getServiceName->execute(array($id));
$ServiceName = $getServiceName->Fetch(PDO::FETCH_ASSOC); 
return $ServiceName['nom'];
}
function getNomSservice($id){
  try
{
$connexion = new PDO('mysql:host=localhost;dbname=mci', 'root', '');
}
catch(Exception $e)
{
xdie('Erreur : '.$e->getMessage());
}
$getServiceName=$connexion->prepare("select sservice.nom as nom from sservice where sservice.id=?");
$getServiceName->execute(array($id));
$ServiceName = $getServiceName->Fetch(PDO::FETCH_ASSOC); 
return $ServiceName['nom'];
}
?>

