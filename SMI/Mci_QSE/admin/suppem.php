<?php 
session_start();

    if ($_SESSION['adp']==0){
	header("Location: 404.html");
	}
	 elseif (!isset($_SESSION['nom'])) {
        header("Location: login.php");
    }
if(!isset($_GET['idpoint'])){
	header("Location: 404.html");
}
else{
	include_once 'bd.php';	
	$idpoint=$_GET['idpoint'];
	$an=$_GET['an'];
	$idproc=$_GET['idproc'];
				$update=$connexion->exec("UPDATE em SET em.etat='1'  WHERE em.id_point='".$idpoint."' ");
				header("Location: listecart1.php?idproc=".$idproc."&ann=$an");
			}	
			?>
	</html>