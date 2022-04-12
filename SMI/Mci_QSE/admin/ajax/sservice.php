
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
	$id_nom =$connexion->query("SELECT `id` FROM `service` WHERE `nom` = '$idr'");
	$objnom = $id_nom ->Fetch(PDO::FETCH_ASSOC);
	$idt=$objnom['id'];
    $rech_dept =$connexion->query("SELECT `id`, `nom`
            FROM `sservice` WHERE `id_service` = $idt ");
    /* Un petit compteur pour les départements */
    
    /* On crée deux tableaux pour les numéros et les noms des départements */
    
    /* On va mettre les numéros et noms des départements dans les deux tableaux */
	?>
	<div class="form-group has-error" >
		<label class="col-md-3 control-label">Sous Processus</label>
		<div class="col-md-4">
		<select name="sservice" class="select2me form-control">
	<?php
		while($ligne_dept = $rech_dept->Fetch(PDO::FETCH_ASSOC)) 
    {
		$id=$ligne_dept['id'];
		$nom=$ligne_dept['nom'];
        echo'<option value="'.$id.'">'.utf8_encode($nom).'</option>';
        
    }
	?>													
   </select>
		<span class="help-block">
		 </span>
			</div>
				</div>
  <?php
}
/* Sinon on retourne un message d'erreur */
else
{
    echo("<p>Une erreur s'est produite. Le service sélectionné comporte une donnée invalide.</p>\n");

}
?>