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
include "fonction/sservice.php";
$tcop=0;
$cmf=0;
$idauditeur=$_SESSION['id'];
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
function numServ($num){
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
     
      return $serv;
     
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

if(isset($_SESSION['nom']) and (isset($_POST['ann']) || isset($_GET['ann']))){
	$show=1;
	
	if(isset($_POST['ann'])){$ann=$_POST['ann'];
	$an=$_POST['ann'];}	
	if(isset($_GET['ann'])){$ann=$_GET['ann'];
	$an=$_GET['ann'];}	
}

    if($show==1) {
		
	include_once 'bd.php';
	$prenom = $_SESSION['prenom'];
	$nom = $_SESSION['nom'];
	$openfrom=1;
	$idresp = $_SESSION['id'];
	$service = $_SESSION['ids'];
	$annee=$_POST['ann'];
	$adp=$_SESSION['adp'];
	include_once 'bd.php';
	$servname=$connexion->query("select nom from service where service.id=$service");
	$objser = $servname->Fetch(PDO::FETCH_ASSOC);
	$Sname=$objser['nom'];
	if($adp==1){
		header("Location: 404.html");
	}
	else{

	
	
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
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			
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
					<div class="portlet box grey-cascade">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-file-o"></i>Liste des Ecarts Majeurs
							</div>
							<div class="tools">
								
								
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											
										</div>
									</div>
																		
								</div>
							</div>
							<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
							<tr>
								<th>
									 Service
								</th>
								<th>
									 Num d'audit
								</th>
								<th>
									 Ecart
								</th>						
								<th>
									<span class="fa fa-wrench ">
								</th>								
								
							</tr>
							</thead>
							<tbody>
							
								<?php			
								$req1_all=$connexion->query("select  num from fichecreeoupas where CreeOuPas=1 and i_RA=$idauditeur");						
								$nbtotal=0;	
								$nbr1=$req1_all->rowcount();
								if($nbr1!=0){						
								$iem1=0;
								while  ($obj1_all = $req1_all->Fetch(PDO::FETCH_ASSOC)) 
								{
									
									$num_all=$obj1_all['num'];
									$req2_all=$connexion->query("select cop from rapportcreeoupas where cop=1 and audit_num='$num_all'");
									$nbr2=$req2_all->rowcount();
								if($nbr2!=0){	
									$req3_all=$connexion->query('select * from em where num_audit="'.$num_all.'" and etat=0');
									$nbr3=$req2_all->rowcount();
								
								if($nbr3!=0){
								
								while  ($obj = $req3_all->Fetch(PDO::FETCH_ASSOC)) 
								{
									$idpoint=$obj['id_point'];
									$nume=$obj['num_audit'];
								$selectEcmaj2=$connexion->query('select * from point where id='.$idpoint.'');	
								while  ($obj2 = $selectEcmaj2->Fetch(PDO::FETCH_ASSOC)) 
								{
									$commentaire=utf8_encode($obj2['commentaire']);
								}
							
							
								
								
							
					
								echo '<tr>
								<td>'.sservice(getNomSservice(numServ($nume))).'</td>
								<td>'.$nume.'</td>
								<td>'.$commentaire.'</td>
								<td>								
								<a class="" href="ficheEcart1.php?id='.$idpoint.'"  id="Acc" title="visualiser"><span class="fa fa-file-pdf-o"></span></a>
								</td>
								</tr>';
								$nbtotal++;
								
								}								
								}								
								}								
								}	
								}	
								$req1_all2=$connexion->query("select  num from fichecreeoupas where CreeOuPas=1");						
									
								$nbr21=$req1_all2->rowcount();
								if($nbr21!=0){				
								
								while  ($obj1_all2 = $req1_all2->Fetch(PDO::FETCH_ASSOC)) 
								{
									
									
									$num_all2=$obj1_all2['num'];
									$req2_all2=$connexion->query("select cop from rapportcreeoupas where cop=1 and audit_num='$num_all2'");
									$nbr22=$req2_all2->rowcount();
									if($nbr22!=0){
									$req2_all3=$connexion->query('select * from em where num_audit="'.$num_all2.'" and etat=0 and annee="'.$annee.'"');
									$nbr31=$req2_all3->rowcount();
								
								if($nbr31!=0){
								
										$selectA1=$connexion->query('select id_utilisateur from respentaudite where respentaudite.num_audit="'.$num_all2.'" and id_utilisateur="'.$idauditeur.'"');
										$nbr41=$selectA1->rowcount();
										if($nbr41!=0){	
									while  ($obj = $req2_all3->Fetch(PDO::FETCH_ASSOC)) 
								{
									$idpoint=$obj['id_point'];
									$nume=$obj['num_audit'];
								$selectEcmaj2=$connexion->query('select * from point where id='.$idpoint.'');	
								while  ($obj2 = $selectEcmaj2->Fetch(PDO::FETCH_ASSOC)) 
								{
									$commentaire=utf8_encode($obj2['commentaire']);
								}
							
							
								
								
							
					
								echo '<tr>
								<td>'.sservice(getNomSservice(numServ($nume))).'</td>
								<td>'.$nume.'</td>
								<td>'.$commentaire.'</td>
								<td>								
								<a class="" href="ficheEcart1.php?id='.$idpoint.'"  id="Acc" title="visualiser"><span class="fa fa-file-pdf-o"></span></a>
								</td>
								</tr>';
								$nbtotal++;
								
								}								
								}								
								}								
								}	
								}								
								}
								if($nbtotal==0){
								echo '<script language="javascript" type="text/javascript">
								alert("Aucune donnée éxistante");</script>';
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
<script type="text/javascript" src="../../assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/table-advanced.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
   <script>
    $(document).ready(function() {
        $('.fancybox').fancybox();
		 iframe: {
              preload: false // fixes issue with iframe and IE
          }
    });
</script>
<script>
      jQuery(document).ready(function() {    
         Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
    TableAdvanced.init();
      });
   </script>

<!-- END JAVASCRIPTS -->
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
			}
			
	
?>
</html>
