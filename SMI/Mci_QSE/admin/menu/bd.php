<?php
// Connexion à la base de données SQL WORKBENCH
//$PARAM_HOTE='localhost';//le chemin vers le serveur
//$PARAM_port='8881';
try
{
$connexion = new PDO('mysql:host=localhost;dbname=mci', 'root', '');
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}


