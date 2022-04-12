<!DOCTYPE html>
<html lang="fr"> 
<?php
function fonction($fonction)
							{
								if($fonction=="1"){
									return "RA";
								}
								elseif($fonction=="2"){
									return "A";
								}
								elseif($fonction=="3"){
									return "O";
								}
								else {
									return "#Erreur";}
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
    session_start();
if (version_compare(PHP_VERSION, '5.4.0', '>=')) {
  ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^
    PHP_OUTPUT_HANDLER_REMOVABLE);
} else {
  ob_start(null, 0, false);
} 
$show=0;
if(isset($_SESSION['nom']) and isset($_GET['ann'])){
	$show=1;
		$ann=$_GET['ann'];
}
   if (isset($_SESSION['nom']) and isset($_POST['ann'])) {
      
		$ann=$_POST['ann'];
		 $show=1;
    }
    if($show==1) {
		
	include_once 'bd.php';
	$prenom = $_SESSION['prenom'];
	$nom = $_SESSION['nom'];
	$openfrom=1;
	
	$service = $_SESSION['ids'];
	$adp=$_SESSION['adp'];
	include_once 'bd.php';
	$servname=$connexion->query("select nom from service where service.id=$service");
	$objser = $servname->Fetch(PDO::FETCH_ASSOC);
	$Sname=$objser['nom'];
	if($adp==0){
		header("Location: 404.html");
	}
	else{
		$verif=$connexion->query("select * from plandaudit where  annee=$ann");
		$nbrv=$verif->rowcount();
			if($nbrv==0){
			$cree=$connexion->exec("INSERT INTO `plandaudit` values ('',$ann,0)");
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
				<li>
					<a href="admin.php">
					<i class="fa fa-user"></i>
					<span class="title">Administration</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="#">
							<i class="fa fa-users"></i>
							<font size="2pt">Gestion des utilisateurs</font></a>
							<ul class="sub-menu">
										 <li>
										<a href="showusers.php"><i class="fa fa-list-ol"></i>Listes des utilisateurs</a>
										</li>
										<li>
										<a href="adduser.php"><i class="fa fa-plus"></i>Ajouter utilisateur</a>
										</li>
							</ul>
						</li>
						
						<li>
							<a href="#">
							<i class="fa fa-folder-open"></i>
							<font size="2pt">Gestion des documents</font></a>
							<ul class="sub-menu">
										<li>
										<a href="listedoc.php"><i class="fa fa-list-ol"></i>Listes des Documents</a>
										</li>
										<li>
										<a href="archivage.php"><i class="fa fa-archive"></i>Archivage</a>
										</li>
										<li>
										<a href="adddoc.php"><i class="fa fa-file-o"></i>Nouveau Document</a>
										</li>
										
							</ul>
						</li>
						<li>
							<a href="#">
							<i class="fa  fa-sitemap"></i>
							<font size="2pt">Gestion des diffusions</font></a>
							<ul class="sub-menu">
										<li>
										<a href="listediff.php"><font size="2pt">Diffusions par service</font></a>
										</li>
										<li>
										<a href="listediffdoc.php"><font size="2pt">Diffusions par document</font></a>
										</li>
										<li>
										<a href="moddiff.php"><font size="2pt">Ajouter diffusion</font></a>
										</li>
										<li>
										<a href="moddiff2.php"><font size="2pt">Annuler diffusion</font></a>
										</li>
										
							</ul>
						</li>
						<?php include_once 'menu/more.php';?>
					</ul>
				</li>
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
								<i class="fa fa-users"></i>Plan d'audit interne
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
								<?php
									$testcop=$connexion->query("select cop from plandaudit where annee=$ann");
									$tcop = $testcop->Fetch(PDO::FETCH_ASSOC);
									$cop=$tcop['cop'];
									if($cop==0){
									?>
									<div class="col-md-6">
										<div class="btn-group">
											<button id="sample_editable_1_new" class="btn green" onClick="parent.location='confirmplan.php?ann=<?php echo $ann; ?>'" >
											Confirmer le plan d'Audit
											</button>
										</div>
									</div>
									<?php }
									else{ ?>
									<div class="col-md-3">
										<a class="list-group-item bg-green-jungle">
									<center> Plan Confirmé </center>
										</a>
									</div>
									<div class="col-md-3">
										<div class="btn-group">
											<button id="sample_editable_1_new" class="btn red" onClick="parent.location='annulconfirmplan.php?ann=<?php echo $ann; ?>'" >
											Annuler la confirmation
											</button>
										</div>
									</div>
									<?php	
									}
									?>
									<div class="col-md-6">
										<div class="btn-group pull-right">
										<button class="btn dropdown-toggle" data-toggle="dropdown">Actions <i class="fa fa-angle-down"></i>
										</button>
										<ul class="dropdown-menu pull-right">
										<?php 
										if($cop==0){?>
											<li>
												<a href="addaudit.php?ann=<?php echo $ann; ?>" data-toggle="modal" class="config" id="Acc">
												Ajouter audit </a>
											</li>
											<li>
												<a href="addaudit.php?ann=<?php echo $ann; ?>" data-toggle="modal" class="config" id="Acc">
												Modifier audit </a>
											</li>
											<?php
										}
										?>
											<li>
												<a href="pdf/reg/gerplananuel.php?ann=<?php echo $ann; ?>" data-toggle="modal" class="config" id="Acc">
												Enregistrer PDF </a>
											</li>											
										</ul>
										</div>
									</div>
								</div>
							</div>
							<table class="table table-striped table-hover table-bordered" id="sample_editable_1">
							<thead>
							<tr>
								<th>
									<center>N °</center>
								</th>
								<th>
									 <center>Sous processus</center>
								</th>								
								<th>
									<center>Date</center>
								</th>
								<th>
									<center>Auditeurs</center>
								</th>
								<th>
									<center>durée</center>
								</th>
								<th>
									<center>Date effective</center>
								</th>															
							</tr>
							
							</thead>
							<tbody>
							<?php include 'bd.php';
							$selectaudit=$connexion->query("select numero,ann, id_service,id_sservice, ddatep, fdatep,duree  from auditprevu where ann=$ann ");
							$fdatep1='';
							while($audits = $selectaudit->Fetch(PDO::FETCH_ASSOC)){
								$numero=$audits['numero'];
								$duree=$audits['duree'];
								$ddatep=$audits['ddatep'];
								$fdatep=$audits['fdatep'];
							
								$date1 = $ddatep;
								$date2 = $fdatep;
													
								
								$interval='<b>Entre </b>'.$date1.'</br><b> et </b>'.$date2;								
								$id_sservice=$audits['id_sservice'];
								$selectnomss=$connexion->query("select nom from sservice where id=$id_sservice");
								$sservice = $selectnomss->Fetch(PDO::FETCH_ASSOC);
								$ssnom=utf8_encode($sservice ['nom']);
								$selectauditeurprevu=$connexion->query('select id,id_auditeur, fonction,numero_audit  from auditeurprevu where auditeurprevu.numero_audit="'.$numero.'" order by fonction');
								// on stock les auditeurs dans une chaine de caractère .
							$list='';
							
								while($auditeurs1 = $selectauditeurprevu->Fetch(PDO::FETCH_ASSOC)){
							$id=$auditeurs1['id'];
							$auditeurs['fonction']=$auditeurs1['fonction'];
							$auditeurs['id_auditeur']=$auditeurs1['id_auditeur'];
								$r1=$auditeurs['id_auditeur'];
								
									$SelectAuditeurPrevuNom=$connexion->query("select nom,prenom,fonction from auditeur where auditeur.id=$r1");
										$auditeurselect = $SelectAuditeurPrevuNom->Fetch(PDO::FETCH_ASSOC);
											$auditeurs['nom']=$auditeurselect['nom'];
												$auditeurs['prenom']=$auditeurselect['prenom'];
												
													$auditeurs['complet']=substr($auditeurs['prenom'],0,1).'.'.$auditeurselect['nom'];
													$list.=' <b> '.fonction($auditeurs['fonction']).'</b> :'.$auditeurs['complet'].'<br> ';
								}
								
							// ucfirst ($auditeurs[$id]['complet']
							$real='';
						
								$reqdate=$connexion->query("select  date from fichdaudit where  audit_num='$numero'");
								while($seldate = $reqdate->Fetch(PDO::FETCH_ASSOC)){
									$real=$seldate['date'];
									$real = date_create($real);
									$real=date_format($real, 'd/m/Y');	
																
								}
							
							echo'
							<tr>							
								<td valign="middle">
									 <center><br>'.$numero.'</center>
								</td>
								<td valign="middle">
									 <center><br>'.sservice($ssnom).'</center>
								</td>								
								<td valign="middle">
									<center> '.$interval.' </center>
								</td >
								<td valign="middle">
									 <center>'.$list.' </center>
								</td>
								<td valign="middle">
									 <center><br>'.$duree.' </center>
								</td>	
								<td valign="middle">
								<center><br>'.$real.'</center>
								</td>							
							</tr>';
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
			}
			else{
				header("Location: 404.html");
			}
	
?>
</html>
