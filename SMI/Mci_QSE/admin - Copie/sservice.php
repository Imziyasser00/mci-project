
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
$idr=utf8_decode($idr);
include_once 'bd.php';
	
    $rech_dept =$connexion->query("SELECT `id`, `nom`
            FROM `sservice` WHERE `id_service` = $idr ");
    /* Un petit compteur pour les d�partements */
    
    /* On cr�e deux tableaux pour les num�ros et les noms des d�partements */
    
    /* On va mettre les num�ros et noms des d�partements dans les deux tableaux */
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
    echo("<p>Une erreur s'est produite. Le service s�lectionn� comporte une donn�e invalide.</p>\n");

}
?>