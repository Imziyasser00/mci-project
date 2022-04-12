<?php
/**
 * Code qui sera aeepl� par un objet XHR et qui
 * retournera la liste d�roulante des d�partements
 * correspondant � la r�gion s�lectionn�e.
 */
/* Param�tres de connexion */
$serveur = "localhost";
$admin   = "root";
$mdp     = "";
$base    = "regions";

/* On r�cup�re l'identifiant de la r�gion choisie. */
$idr = isset($_GET['idr']) ? $_GET['idr'] : false;
/* Si on a une r�gion, on proc�de � la requ�te */
if(false !== $idr)
{
    /* C�ration de la requ�te pour avoir les d�partements de cette r�gion */

include_once '../bd.php';

    $rech_dept =$connexion->prepare("SELECT `id`, `nom`
            FROM `sservice` WHERE `id_service` = ? ");
		 $rech_dept->execute(array(utf8_encode($idr)));	
    /* Un petit compteur pour les d�partements */
    
    /* On cr�e deux tableaux pour les num�ros et les noms des d�partements */
    
    /* On va mettre les num�ros et noms des d�partements dans les deux tableaux */
	
    ?><select name="sservice">'<?php
    while($ligne_dept = $rech_dept->Fetch(PDO::FETCH_ASSOC)) 
    {
		$idtt=$ligne_dept['id'];
		$nomtt=$ligne_dept['nom'];
        echo'<option value="'.$idtt.'">'.$nomtt.'</option>';
        
    }
    /* Maintenant on peut construire la liste d�roulante */  
   ?>
   </select>
  <?php
}
/* Sinon on retourne un message d'erreur */
else
{
    echo("<p>Une erreur s'est produite. La r�gion s�lectionn�e comporte une donn�e invalide.</p>\n");

}
?>