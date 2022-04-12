<?php
function numAnn($ann,$num){
    try
            {
            $connexion = new PDO('mysql:host=localhost;dbname=mci', 'root', '');
                }
            catch(Exception $e)
                {
                die('Erreur : '.$e->getMessage());
                }
    $cnx=$connexion->prepare('select ann from auditprevu where  numero=? ');
   $cnx->execute(array($num));
   $rowcount=$cnx->rowcount();
  if($rowcount!=0){
      $obj = $cnx->Fetch(PDO::FETCH_ASSOC);
      $anne=$obj['ann'];
      if($ann==$anne){
           return true;
      }
      else{
      return false;
      }
  }
  else{
      return false;
  }
}

	
?>
