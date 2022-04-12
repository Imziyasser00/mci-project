<!DOCTYPE html>
<html lang="fr"> 
<?php
    session_start();
if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
  ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
    PHP_OUTPUT_HANDLER_REMOVABLE);
} else {
  ob_start(null, 0, false);
} 
$tcop=0;
$cmf=0;
include "fonction/sservice.php";
function verifierAdmin($id){
if($id==43 || $id==34|| $id==31 || $id==38 || $id==32 || $id==42 || $id==39 || $id==37 || $id==40 || $id==58 || $id==60 || $id==61 || $id==62 || $id==41 || $id==29){
	return 2;
}

	elseif($id==10 || $id==2 || $id==6 || $id==9 || $id==1 || $id==35 || $id==8 || $id=36 || $id==7 || $id==5 || $id==44 || $id==33){
	return 3;	
	}

}
function Verifadmin($idproc,$idadmin){
    try
            {
            $connexion = new PDO('mysql:host=localhost;dbname=mci', 'root', '');
                }
            catch(Exception $e)
                {
                die('Erreur : '.$e->getMessage());
                }
    $cnx=$connexion->prepare('select id from utilisateur where  id_sservice=? ');
   $cnx->execute(array($idproc));
   $rowcount=$cnx->rowcount();
  if($rowcount!=0){
      $obj = $cnx->Fetch(PDO::FETCH_ASSOC);
      $ida=$obj['id'];
      if($idadmin==$ida){
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
function numSer($ser,$num){
    try
            {
            $connexion = new PDO('mysql:host=localhost;dbname=mci', 'root', '');
                }
            catch(Exception $e)
                {
                die('Erreur : '.$e->getMessage());
                }
    $cnx=$connexion->prepare('select id_sservice from auditprevu where  numero=? ');
   $cnx->execute(array($num));
   $rowcount=$cnx->rowcount();
  if($rowcount!=0){
      $obj = $cnx->Fetch(PDO::FETCH_ASSOC);
      $serv=$obj['id_sservice'];
      if($serv==$ser){
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
function sservice($nom)
							{
								if($nom=="Controle in-Vivo"){
									return "Contrôle in-Vivo";
								}
								elseif($nom=="Controle Physico-Chimique"){
									return "Controle Physico-Chimique";
								}
								elseif($nom=="Controle Microbiologique"){
									return "Contrôle Microbiologique";
								}
								elseif($nom=="Controle in-vitro"){
									return "Contrôle in-vitro";
								}
								elseif($nom=="Controle Qualite"){
									return "Contrôle Qualité";
								}
								elseif($nom=="Assurance Qualite"){
									return "Assurance Qualité";
								}
								elseif($nom=="Systeme d information"){
									return "Système d'information";
								}
								elseif($nom=="Comptabilite et Finance"){
									return "Comptabilité et Finance";
								}
								elseif($nom=="Services Generaux"){
									return "Services Généraux";
								}
								elseif($nom=="Methodes et validations"){
									return "Méthodes et validations";
								}
								elseif($nom=="Homologation & Affaires reglementaires"){
									return "Homologation & Affaires réglementaires";
								}
								elseif($nom=="Recherche et developpement"){
									return "Recherche et développement";
								}
								else{
									return $nom;
								}
							} 						

$show=0;

if(isset($_SESSION['nom']) and (isset($_POST['idproc']) || isset($_GET['idproc']))){
	$show=1;
	if(isset($_POST['idproc'])){$idproc=$_POST['idproc'];}
	if(isset($_POST['ann'])){$ann=$_POST['ann'];
	$an=$_POST['ann'];}
	if(isset($_GET['idproc'])){$idproc=$_GET['idproc'];}	
	if(isset($_GET['ann'])){$ann=$_GET['ann'];
	$an=$_GET['ann'];}	
}

//Début
    if($show==1) {
		
	include_once 'bd.php';
	$prenom = $_SESSION['prenom'];
	$nom = $_SESSION['nom'];
	$openfrom=1;
	$idresp = $_SESSION['id'];
	$service = $_SESSION['ids'];
	$adp=$_SESSION['adp'];
	include_once 'bd.php';
	$servname=$connexion->query("select nom from service where service.id=$service");
	$objser = $servname->Fetch(PDO::FETCH_ASSOC);
	$Sname=$objser['nom'];
//filtre administrateur
	if($adp==0){
		header("Location: 404.html");
	}
	else{
	$creationplan=$connexion->query("select * from  planaction where id_proc=".$idproc." and ann=".$ann."");
	$verif=$creationplan->rowcount();
	
	if($verif==0){
	//Creation des non conformité	
	$correction=$connexion->exec("INSERT INTO planaction VALUES(null,$idproc,$ann,0,0)");	
	
	$creation=$connexion->query("select * from  nonconfirmitecreation where id_proc=".$idproc." and ann=".$ann."");
	$verif=$creation->rowcount();
	//if($verif==0){
	
		//$correction=$connexion->exec("INSERT INTO nonconfirmitecreation VALUES(null,$idproc,$ann)");
	

									$co=$connexion->query('select * from point where type!="ref" and type!="champ"  and type!="fort" and numero_audit="'.$numero.'"');
									while($cor= $co->Fetch(PDO::FETCH_ASSOC)){
									$correction=$connexion->exec("INSERT INTO nonconfirmite VALUES(null,$idPoint,'$numero','','','','0')");
										$idPoint=$cor['id'];
										$numero=$cor['numero_audit'];
									}
								}
								
								
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>MCI | Système Management Intégré</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="../../assets/global/plugins/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
<!-- END GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- BEGIN THEME STYLES -->
<link href="../../assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/pdf.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="../../assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<style type="text/css">
	font-size: small;
}
.auto-style2 {
	color: #0B6294;
}
.auto-style3 {
	color: #0B6294;
	font-weight: bold;
}
.auto-style5 {
	color: #0B6294;
}
</style>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<?php include_once 'header.php' ?>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>				
				<li>
					<a href="index.php">
					<i class="fa fa-home"></i>
					<span class="title">Acceuil</span>
					</a>
				</li>
				<?php if($adp!=0) {?>
			
						
						<?php include_once 'menu/administration.php';?>
						
			
				<?php } ?>
				<li>
					<a href="javascript:;">
					<i class="fa fa-folder-open-o"></i>
					<span class="title">Documents</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="PQSE.php">
							<i class="fa fa-file-o"></i>
							Politique QSE</a>
						</li>
						<li>
							<a href="pos.php">
							<i class="fa fa-folder-o"></i>
							Plan d'orientation stratégique</a>
						</li>
						<li>
							<a href="mmi.php">
							<i class="fa fa-book"></i>
							Manuel Management Intégré</a>
						</li>
						
						<?php include_once 'menu/listdoc.php';?>
					</ul>
				</li>					
						<?php include_once 'menu/menu.php';?>
			</ul>
			
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
		

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			<center><span class="auto-style3">S</span><span class="auto-style5">ystème <b>M</b>anagement <b>I</b>ntégré</span><br>
			<center><small><font color="green">Qualité Sécurité et Environnement</font></small></center>
			</h3>
			
			<!-- END PAGE HEADER-->			
			<div class="clearfix">
			</div>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-sitemap"></i>Plan d'action
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>								
								<a href="javascript:;" class="reload">
								</a>								
							</div>
						</div>
						
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="row">
							
									
									<div class="col-md-6">
										<div class="btn-group">
										<?php 
										$selectNumero=$connexion->query("select numero  from auditprevu where id_sservice=".$idproc." and ann=".$ann."");
							$c=$selectNumero->rowcount();
								if($c!=0){
																		
								while  ($numeros = $selectNumero->Fetch(PDO::FETCH_ASSOC)) 
								{
								$numero=$numeros['numero'];
								}
								}
										$selectnc=$connexion->query('select * from nonconfirmite where num_audit="'.$numero.'"');
										$cmfr=1;
										while  ($selectnon = $selectnc->Fetch(PDO::FETCH_ASSOC)) 
											{
												$tcop=1;
												$tt=$selectnon['cop'];
												$idncp=$selectnon['id_point'];
												$tcop=$tcop*$tt;
												$selectncp=$connexion->query('select * from confirmitereponse where id_point="'.$idncp.'"');
												while  ($selectnoncp = $selectncp->Fetch(PDO::FETCH_ASSOC)) 
											{
											$datencrp=$selectnoncp['dateV'];
											
												if($datencrp==''){
													$cmfr=0;
												}
											$cmfr=$cmfr*$cmfr;
											}
											}
										while($sel= $creationplan->Fetch(PDO::FETCH_ASSOC)){
										$cmf=$sel['cop'];
										}
										if($cmf==0 and $tcop==0) { ?>
											<input onclick="location.href = 'confirmplanaction.php?ann=<?php echo $ann; ?>&idproc=<?php echo $idproc; ?>';" class="btn green" type="button" value="Confirmer le plan d'action" disabled="disabled">
										
										<?php }
										
									else {  
								
										if($cmf==0){									
										?>
										<?php	if(verifierAdmin($idproc)==$adp){?>		
										<input onclick="location.href = 'confirmplanaction.php?ann=<?php echo $ann; ?>&idproc=<?php echo $idproc; ?>';" class="btn green" type="button" value="Confirmer le plan d'action">
										<?php } ?>
										<?php }
										else{
											if($cmfr!=0){
											?>
										<?php	if(verifierAdmin($idproc)==$adp){?>		
										<input onclick="location.href = 'confirmpropositions.php?ann=<?php echo $ann; ?>&idproc=<?php echo $idproc; ?>';" class="btn green" type="button" value="Confirmer les propositions">
										<?php } ?>
										<?php } 
										else{
										
											?>
										<input onclick="location.href = '#'" class="btn green" type="button" value="Plan confirmer" disabled="disabled">
										<?php
										}
										
										}
									}
										?>
										</div>
									</div>								
								
						
							
									<div class="col-md-6">
									<?php	if(verifierAdmin($idproc)==$adp){?>	
										<div class="btn-group pull-right">
									
										<button class="btn dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i>
										</button>
										
											<?php 
											$selNumero=$connexion->query("select numero  from auditprevu where id_sservice=".$idproc." and ann=".$ann."");
									$cm=$selNumero->rowcount();
								if($cm!=0){											
								while  ($numeros = $selNumero->Fetch(PDO::FETCH_ASSOC)) 
								{
								$numero=$numeros['numero'];
								}
											$testnc=$connexion->query('select * from nonconfirmite where num_audit="'.$numero.'"');
								$verifn=$testnc->rowcount();
								$a=1;
								if($verifn!=0){
								while  ($testnca = $testnc->Fetch(PDO::FETCH_ASSOC)) 
								{			
									$resp = $testnca['resp'];
									if($resp==""){
										$a=0;
									}
								}
								}
								}
								if($a==1){?>
										<ul class="dropdown-menu pull-right">	
											<li>
												<a href="<?php echo 'validall.php?idproc='.$idproc.'&ann='.$ann.'&num='.$numero.'' ;?> "class="btn green" id="Acc"  type="button" >
												Tout Valider </a>
											</li>
										
										</ul>
								<?php } else{?>
								<ul class="dropdown-menu pull-right">	
											<li>
												<a href="<?php echo 'validall.php?idproc='.$idproc.'&ann='.$ann.'' ;?> "class="btn green" id="Acc"  type="button" disabled="disabled">
												Completer avant de valider </a>
											</li>
										
										</ul>
									<?php }?>	
										</div>
									<?php } ?>
									</div>
								
							
								</div>
								<div class="portlet-body">
							
							</div>
							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
							<tr>
								<th>
									<center>N °</center>
								</th>
								<th>
									 <center>Date</center>
								</th>							
								
								<th>
									<center>Type</center>
								</th>
								<th>
									<center>Description</center>
								</th>
								<th>
									<center>Proposition </center>
								</th>
								<th>
									<center>Resp</center>
								</th>
								<th>
									<center>AC/AP</center>
								</th>
								<th>
									<center>Date R</center>
								</th>
								<th>
									<center>Date V</center>
								</th>
								<th>
									<center>Remarques</center>
								</th>
								<th>
									<center>Actions</center>
								</th>								
							</tr>
							
							</thead>
							<tbody>
							<?php include 'bd.php';
							$resp1='';
							$resp='';
							 //selection du resp d'aprés utilisateur connnecté
                                $selectresp=$connexion->query('select resp from responsable where responsable.id_resp='.$idresp.'');
                                while($respselect = $selectresp->Fetch(PDO::FETCH_ASSOC)){
                                $resp=$respselect['resp'];
                                }
								$selectresp1=$connexion->query('select resp from responsable where responsable.id_service='.$idproc.'');
                                while($respselect = $selectresp1->Fetch(PDO::FETCH_ASSOC)){
                                $resp1=$respselect['resp'];
                                }
							$selectNumero=$connexion->query("select numero  from auditprevu where id_sservice=".$idproc." and ann=".$ann."");
							$c=$selectNumero->rowcount();
								if($c!=0){
																		
								while  ($numeros = $selectNumero->Fetch(PDO::FETCH_ASSOC)) 
								{
								$numero=$numeros['numero'];								
								//point
								if($resp1!=''){
								$selectNC=$connexion->query('select * from nonconfirmite where resp="'.$resp1.'" UNION select * from nonconfirmite where num_audit="'.$numero.'" UNION select * from nonconfirmite where resp="'.$resp.'"');
								}
								else{
								$selectNC=$connexion->query('select * from nonconfirmite where num_audit="'.$numero.'" UNION select * from nonconfirmite where resp="'.$resp.'"');	
								}
								//$selectNC=$connexion->query('select * from nonconfirmite where num_audit="'.$numero.'"');
								$verif=$selectNC->rowcount();
								if($verif!=0){
								while  ($selectNonC = $selectNC->Fetch(PDO::FETCH_ASSOC)) 
								{
									$idPoint = $selectNonC['id_point'];
									$acap = $selectNonC['acap'];
									$resp2 = $selectNonC['resp'];
									$remarque = $selectNonC['remarque'];
									$numnon = $selectNonC['num_audit'];
if(Verifadmin($idproc,$idresp)==false){
									if(numSer($idproc,$numnon)==true || ($resp2 == $resp1)){
								

					
								
									if(numAnn($an,$numnon)==true){
                                        $selectdate=$connexion->query('select date from fichdaudit where fichdaudit.audit_num="'.$numnon.'"');
                                //date
                                while($dateselect = $selectdate->Fetch(PDO::FETCH_ASSOC)){
                                $date2=$dateselect['date'];
                                $date2 = date_create($date2);
                                $date2=date_format($date2, 'd  / m  Y');
                                }
									$cop = $selectNonC['cop'];
								$selectPoint=$connexion->query('select * from point where id='.$idPoint.'');
								while($Em = $selectPoint->Fetch(PDO::FETCH_ASSOC)){
								$description=utf8_encode($Em['commentaire']);
								$type=$Em['type'];
								
								if($type=="ameliorati"){
								$type="PA";	
								}
								elseif($type=="ecart mine"){
								$type="E min";		
								}elseif($type=="ecart maje"){
								$type="E maj";		
								}
								
								$selectNCR=$connexion->query('select * from confirmitereponse where id_point='.$idPoint.'');
								$verifNCR=$selectNCR->rowcount();
								$ncr=0;
								$proposition="";
								$dateV="";
								$dateR="";
								if($verifNCR!=0){
								while  ($selectNonC = $selectNCR->Fetch(PDO::FETCH_ASSOC)) 
								{
									$proposition=$selectNonC['proposition'];
									$dateR=$selectNonC['dateR'];
									$dateV=$selectNonC['dateV'];
									$ncr=1;
								}
							}
									
								
								echo'
							<tr>							
								<td valign="middle">
									 <center><br>'.$numnon.'</center>
								</td>																
								<td valign="middle">
									<center><br> '.$date2.' </center>
								</td >
								<td valign="middle">
									 <center><br>'.$type.' </center>
								</td>
								<td valign="middle">
									 <center><br>'.$description.' </center>
								</td>	
								<td valign="middle">
								<center><br>'.$proposition.'</center>
								</td>									
								<td valign="middle">
								 <center><br>'.$resp2.'</center>
								</td>
								<td valign="middle">
								 <center><br>'.$acap.'</center>
								</td>		
								<td valign="middle">
								<center><br> '.$dateR.' </center>
								</td>	
								<td valign="middle">
								<center><br> '.$dateV.' </center>
								</td>	
								<td valign="middle">
								<center><br>'.$remarque.'</center>
								</td>';
							if($cop==0){
								if(verifierAdmin($idproc)==$adp and $adp!=1){
							echo'
							
								<td valign="middle">
								<center><br>
								<a class="" href="modpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Modifier"><span class="fa fa-pencil"></span></a>								
								<a class="" href="validpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'&resp='.$resp.'"; id="Acc" title="Valider"><span class="fa fa-check"></span></a>
								<a class="" href="delpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Supprimer"><span class="fa fa-trash-o"></span></a>';								
								$selectdroit=$connexion->query('select * from pointDroit where id_point='.$idPoint.'');
								$verifdroit=$selectdroit->rowcount();
								if($verifdroit==0){
								echo '<a class="" href="droitpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="droit"><span class="fa fa-exchange"></span></a>
								</td>								
							</tr>';
								}
							else {
								if(verifierAdmin($idproc)!=$adp){
								echo'
								<a class="" href="modpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Modifier"><span class="fa fa-pencil"></span></a>								
								<a class="" href="validpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'&resp='.$resp.'"; id="Acc" title="Valider"><span class="fa fa-check"></span></a>
								<a class="" href="delpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Supprimer"><span class="fa fa-trash-o"></span></a>	
								</td>								
							</tr>';
							}
							}
							
								echo'
								</center>
								</td>								
							</tr>';
							}
							elseif(verifierAdmin($idproc)!=$adp || $adp==1) {
								echo'
								<td valign="middle"><br><center>';
								$selectdroit=$connexion->query('select * from pointDroit where id_point='.$idPoint.'');
								$verifdroit=$selectdroit->rowcount();
							if($verifdroit==0){
								
								echo'<a class="" href="#"; id="Acc" title=""><span class="fa fa-ban"></span></a>						</center></td>								
							</tr>';							
							}
							else{
								echo'
								<a class="" href="modpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Modifier"><span class="fa fa-pencil"></span></a>								
								<a class="" href="validpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'&resp='.$resp.'"; id="Acc" title="Valider"><span class="fa fa-check"></span></a>
								<a class="" href="delpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Supprimer"><span class="fa fa-trash-o"></span></a>
								</td>								
							</tr>';	
							}
							}
							}
							elseif($cop==1){
								if(verifierAdmin($idproc)==$adp || $adp==1){
								echo'
								<td valign="middle">
								<a class="" href="modpoint2.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Modifier"><span class="fa fa-pencil"></span></a>';
								$selectdroit=$connexion->query('select * from pointDroit where id_point='.$idPoint.'');
								$verifdroit=$selectdroit->rowcount();
								if($verifdroit==0){
								echo '<a class="" href="droitpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="droit"><span class="fa fa-exchange"></span></a>
								</td>								
							</tr>';
								}
							else {
								echo'</td>								
							</tr>';
							}
							
								}
							
							elseif(verifierAdmin($idproc)!=$adp || $adp==1) {
								echo'
								<td valign="middle">';
								$selectdroit=$connexion->query('select * from pointDroit where id_point='.$idPoint.'');
								$verifdroit=$selectdroit->rowcount();
							if($verifdroit!=0){
								echo'<a class="" href="modpoint2.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Modifier"><span class="fa fa-pencil"></span></a>
								</td>								
							</tr>';
							}
							else{
									echo'<a class="" href="#"; id="Acc" title=""><span class="fa fa-ban"></span></a></td>								
							</tr>';
							}
							
							}
							}
								}	
								}
								}
								}
							else{
if(numAnn($an,$numnon)==true){
                                        $selectdate=$connexion->query('select date from fichdaudit where fichdaudit.audit_num="'.$numnon.'"');
                                //date
                                while($dateselect = $selectdate->Fetch(PDO::FETCH_ASSOC)){
                                $date2=$dateselect['date'];
                                $date2 = date_create($date2);
                                $date2=date_format($date2, 'd  / m  Y');
                                }
									$cop = $selectNonC['cop'];
								$selectPoint=$connexion->query('select * from point where id='.$idPoint.'');
								while($Em = $selectPoint->Fetch(PDO::FETCH_ASSOC)){
								$description=utf8_encode($Em['commentaire']);
								$type=$Em['type'];
								
								if($type=="ameliorati"){
								$type="PA";	
								}
								elseif($type=="ecart mine"){
								$type="E min";		
								}elseif($type=="ecart maje"){
								$type="E maj";		
								}
								// to be continued
								$selectNCR=$connexion->query('select * from confirmitereponse where id_point='.$idPoint.'');
								$verifNCR=$selectNCR->rowcount();
								$ncr=0;
								$proposition="";
								$dateV="";
								$dateR="";
								if($verifNCR!=0){
								while  ($selectNonC = $selectNCR->Fetch(PDO::FETCH_ASSOC)) 
								{
									$proposition=$selectNonC['proposition'];
									$dateR=$selectNonC['dateR'];
									$dateV=$selectNonC['dateV'];
									$ncr=1;
								}
							}
									
								
								echo'
							<tr>							
								<td valign="middle">
									 <center><br>'.$numnon.'</center>
								</td>																
								<td valign="middle">
									<center><br> '.$date2.' </center>
								</td >
								<td valign="middle">
									 <center><br>'.$type.' </center>
								</td>
								<td valign="middle">
									 <center><br>'.$description.' </center>
								</td>	
								<td valign="middle">
								<center><br>'.$proposition.'</center>
								</td>									
								<td valign="middle">
								 <center><br>'.$resp2.'</center>
								</td>
								<td valign="middle">
								 <center><br>'.$acap.'</center>
								</td>		
								<td valign="middle">
								<center><br> '.$dateR.' </center>
								</td>	
								<td valign="middle">
								<center><br> '.$dateV.' </center>
								</td>	
								<td valign="middle">
								<center><br>'.$remarque.'</center>
								</td>';
							if($cop==0){
								if(verifierAdmin($idproc)==$adp and $adp!=1){
							echo'
							
								<td valign="middle">
								<center><br>
								<a class="" href="modpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Modifier"><span class="fa fa-pencil"></span></a>								
								<a class="" href="validpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'&resp='.$resp.'"; id="Acc" title="Valider"><span class="fa fa-check"></span></a>
								<a class="" href="delpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Supprimer"><span class="fa fa-trash-o"></span></a>';								
								$selectdroit=$connexion->query('select * from pointDroit where id_point='.$idPoint.'');
								$verifdroit=$selectdroit->rowcount();
								if($verifdroit==0){
								echo '<a class="" href="droitpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="droit"><span class="fa fa-exchange"></span></a>
								</td>								
							</tr>';
								}
							else {
								if(verifierAdmin($idproc)!=$adp){
								echo'
								<a class="" href="modpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Modifier"><span class="fa fa-pencil"></span></a>								
								<a class="" href="validpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'&resp='.$resp.'"; id="Acc" title="Valider"><span class="fa fa-check"></span></a>
								<a class="" href="delpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Supprimer"><span class="fa fa-trash-o"></span></a>	
								</td>								
							</tr>';
							}
							}
							
								echo'
								</center>
								</td>								
							</tr>';
							}
							elseif(verifierAdmin($idproc)!=$adp || $adp==1) {
								echo'
								<td valign="middle"><br><center>';
								$selectdroit=$connexion->query('select * from pointDroit where id_point='.$idPoint.'');
								$verifdroit=$selectdroit->rowcount();
							if($verifdroit==0){
								
								echo'<a class="" href="#"; id="Acc" title=""><span class="fa fa-ban"></span></a>						</center></td>								
							</tr>';							
							}
							else{
								echo'
								<a class="" href="modpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Modifier"><span class="fa fa-pencil"></span></a>								
								<a class="" href="validpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'&resp='.$resp.'"; id="Acc" title="Valider"><span class="fa fa-check"></span></a>
								<a class="" href="delpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Supprimer"><span class="fa fa-trash-o"></span></a>
								</td>								
							</tr>';	
							}
							}
							}
							elseif($cop==1){
								if(verifierAdmin($idproc)==$adp || $adp==1){
								echo'
								<td valign="middle">
								<a class="" href="modpoint2.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Modifier"><span class="fa fa-pencil"></span></a>';
								$selectdroit=$connexion->query('select * from pointDroit where id_point='.$idPoint.'');
								$verifdroit=$selectdroit->rowcount();
								if($verifdroit==0){
								echo '<a class="" href="droitpoint.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="droit"><span class="fa fa-exchange"></span></a>
								</td>								
							</tr>';
								}
							else {
								echo'</td>								
							</tr>';
							}
							
								}
							
							elseif(verifierAdmin($idproc)!=$adp || $adp==1) {
								echo'
								<td valign="middle">';
								$selectdroit=$connexion->query('select * from pointDroit where id_point='.$idPoint.'');
								$verifdroit=$selectdroit->rowcount();
							if($verifdroit!=0){
								echo'<a class="" href="modpoint2.php?pid='.$idPoint.'&ann='.$ann.'&idproc='.$idproc.'"; id="Acc" title="Modifier"><span class="fa fa-pencil"></span></a>
								</td>								
							</tr>';
							}
							else{
									echo'<a class="" href="#"; id="Acc" title=""><span class="fa fa-ban"></span></a></td>								
							</tr>';
							}
							
							}
							}
								}	
								}	
							}
								}
								}
								}
								}
							?>
							</tbody>
							</table>
						</div>
						</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			
			
			
			
			
		</div>
	</div>
	<!-- END CONTENT -->
	
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	
	
	<div class="page-footer-inner">
			
		 2015 &copy; M.C.I. Santé Animale.
	</div>
	<div class="clearfix" align="right">
			<img src="../../assets/admin/layout/img/footer-img.png" alt="logo" class="logo-default" width="295"/>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="../../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/table-editable.js"></script>
<script>
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
   TableEditable.init();
});
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-37564768-1', 'keenthemes.com');
  ga('send', 'pageview');
</script>
</body>

<!-- END BODY -->
<?php
			}
			if(isset($_GET['info'])){
				if($_GET['info']=="1"){
					echo '<script language="javascript" type="text/javascript">
       alert("Impossible de valider une non confirmité incomplète");</script>';
				}
			}
			}
			
			else{
				header("Location: 404.html");
			}
	
?>
</html>
