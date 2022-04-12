<?php
/**
 * Code qui sera aeeplé par un objet XHR et qui
 * retournera la liste déroulante des départements
 * correspondant à la région sélectionnée.
 */
/* Paramètres de connexion */
$serveur = "localhost";
$admin   = "root";
$mdp     = "";
$base    = "regions";

/* On récupère l'identifiant de la région choisie. */
$idr = isset($_GET['idr']) ? $_GET['idr'] : false;
/* Si on a une région, on procède à la requête */
if(false !== $idr)
{
    /* Cération de la requête pour avoir les départements de cette région */

include_once '../bd.php';

    $rech_dept =$connexion->prepare("SELECT `id`, `nom`
            FROM `sservice` WHERE `id_service` = ? ");
		 $rech_dept->execute(array(utf8_encode($idr)));	
    /* Un petit compteur pour les départements */
    
    /* On crée deux tableaux pour les numéros et les noms des départements */
    
    /* On va mettre les numéros et noms des départements dans les deux tableaux */
	
    ?><select name="sservice">'<?php
    while($ligne_dept = $rech_dept->Fetch(PDO::FETCH_ASSOC)) 
    {
		$idtt=$ligne_dept['id'];
		$nomtt=$ligne_dept['nom'];
        echo'<option value="'.$idtt.'">'.$nomtt.'</option>';
        
    }
    /* Maintenant on peut construire la liste déroulante */  
   ?>
   </select>
  <?php
}
/* Sinon on retourne un message d'erreur */
else
{
    echo("<p>Une erreur s'est produite. La région sélectionnée comporte une donnée invalide.</p>\n");

}
?>