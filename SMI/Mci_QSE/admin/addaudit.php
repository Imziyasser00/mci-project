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
    if ($_SESSION['adp']==0){
	header("Location: 404.html");
	}
    elseif (!isset($_SESSION['nom'])) {
        header("Location: 404.html");
    }
    else {
		include_once 'bd.php';
	if(isset($_POST['ann'])){
	$ann=$_POST['ann'];
	}
	if(isset($_GET['ann'])){
	$ann=$_GET['ann'];
	}
			$testvalidation=$connexion->prepare('select cop from plandaudit where  annee=?');
			$testvalidation->execute(array($ann));
			$test = $testvalidation->Fetch(PDO::FETCH_ASSOC);
			$cop=$test['cop'];
			if($cop==1){
				header("Location: addaudit0.php?msg=1");
			}	
	$prenom = $_SESSION['prenom'];
	$nom = $_SESSION['nom'];
	$service = $_SESSION['ids'];
	$adp=$_SESSION['adp'];
	$openfrom=1;
	$servname=$connexion->query("select nom from service where service.id=$service");
	$objser = $servname->Fetch(PDO::FETCH_ASSOC);
	$Sname=$objser['nom'];
	$cs=0;
	$reqa=$connexion->query("select id from utilisateur");
	$nbrcount=$reqa->rowcount();
	$verif=$connexion->query("select * from plandaudit where  annee=$ann");
		$nbrv=$verif->rowcount();
			if($nbrv==0){
			$cree=$connexion->exec("INSERT INTO `plandaudit` values (null,$ann,0)");
			}
?>
<?php
echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
<meta charset="utf-8"/>
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
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/typeahead/typeahead.css">
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/clockface/css/clockface.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="../../assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="../../assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
<style type="text/css">
.auto-style1 {
	font-size: small;
}
.auto-style2 {
	color: #0B6294;
}
.auto-style3 {
	color: #0B6294;
	font-weight: bold;
}
.auto-style4 {
	color: #0B9657;
}
</style>
<script type="text/javascript" src="ajax/serv_xhr.js" charset="iso_8859-1"></script>
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
				
				<?php if($adp!=0) {?>
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
						
						<li>
							<a href="">
							<i class="fa fa-files-o"></i>
							Liste des documents<span class="arrow"></span></a>
							<ul class="sub-menu">
										<?php if($adp==0){
										include_once 'bd.php';
								$not=$connexion->query("select * from document where document.type='FAP' and document.id_service=$service");
								$nbr=$not->rowcount();
								if($nbr!=0){ ?>
										<li>
											<a <?php echo 'href="../admin/docadmin.php?type=FAP&service='.$Sname.'"';?>><i class="fa fa-file-text-o"></i> FAP 
											</a>
											
										</li>
										<?php } }else {?>
										<li>
											<a href="#"><i class="fa fa-file-text-o"></i> FAP 
											<span class="arrow"></span></a>
											<ul class="sub-menu">
												<?php
																	include_once 'bd.php';
																	$req1=$connexion->query("select * from service where service.id!=19 and service.id != 20 order by ref");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																		
																	echo '<li><a href="../admin/docadmin.php?type=FAP&service='.$obj['nom'].'"><i class="fa fa-file-text-o"></i>'.$obj['ref'].'</a>';
																		
																		
											} } 
											?>
											</ul>
										</li>
										<?php } ?>
										</li>
								
								<?php if($adp==0){
										include_once 'bd.php';
								$not=$connexion->query("select * from document where document.type='Processus' and document.id_service=$service");
								$nbr=$not->rowcount();
								if($nbr!=0){ ?>
										<li>
											<a <?php echo 'href="../admin/docadmin.php?type=Processus&service='.$Sname.'"';?>><i class="fa fa-file-text-o"></i> Processus 
											<span class="arrow"></span></a>											
										</li>
										<?php } }else {?>
										<li>
											<a href="#"><i class="fa fa-file-text-o"></i> Processus 
											<span class="arrow"></span></a>
											<ul class="sub-menu">
												<?php
																	include_once 'bd.php';
																	$req1=$connexion->query("select * from service where service.id!=19 and service.id != 20 order by ref");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																		
																	echo '<li><a href="../admin/docadmin.php?type=Processus&service='.$obj['nom'].'"><i class="fa fa-file-text-o"></i>'.$obj['ref'].'</a>';
																		
																		
											} } 
											?>
											</ul>
										</li>
										<?php } ?>
											<?php if($adp==0){
										include_once 'bd.php';
								$not=$connexion->query("select * from document where document.type='Procedures' and document.id_service=$service");
								$nbr=$not->rowcount();
								if($nbr!=0){ ?>
										<li>
											<a <?php echo 'href="../admin/docadmin.php?type=Procedures&service='.$Sname.'"';?>><i class="fa fa-file-text-o"></i> Procédures 
											</a>
											
										</li>
										<?php } }else {?>
										<li>
											<a href="#"><i class="fa fa-file-text-o"></i> Procédures 
											<span class="arrow"></span></a>
											<ul class="sub-menu">
												<?php
																	include_once 'bd.php';
																	$req1=$connexion->query("select * from service where service.id!=19 and service.id != 20 order by ref");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																		
																	echo '<li><a href="../admin/docadmin.php?type=Procedures&service='.$obj['nom'].'"><i class="fa fa-file-text-o"></i>'.$obj['ref'].'</a>';
																		
																		
											} } 
											?>
											</ul>
										</li>
										<?php } ?>
										<?php if($adp==0){
										include_once 'bd.php';
								$In=$connexion->query("select * from document,diff where document.type='Instructions' and diff.id_serv=$service and document.id=diff.id_doc");
								$nbr=$In->rowcount();
								if($nbr!=0){ ?>
										<li>
											<a <?php echo 'href="../admin/docadmin.php?type=Instructions&service='.$Sname.'"';?>><i class="fa fa-file-text-o"></i> Instructions 
											</a>
											
										</li>
										<?php } }else {?>
										<li>
											<a href="#"><i class="fa fa-file-text-o"></i> Instructions
												<span class="arrow"></span></a>
											<ul class="sub-menu">
											<?php
																	include_once 'bd.php';
																	$req1=$connexion->query("select * from service where service.id!=19 and service.id != 20 order by ref");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																		
																	echo '<li><a href="../admin/docadmin.php?type=Instructions&service='.$obj['nom'].'"><i class="fa fa-file-text-o"></i>'.$obj['ref'].'</a>';
																			} } 
											?>
											</ul>
										
										</li>
										
										<?php } if($adp==0){
										include_once 'bd.php';
								$not=$connexion->query("select * from document,diff where document.type='Notices' and diff.id_serv=$service and document.id=diff.id_doc");
								$nbr=$not->rowcount();
								if($nbr!=0){ ?>
										<li>
											<a <?php echo 'href="../admin/docadmin.php?type=Notices&service='.$Sname.'"';?>><i class="fa fa-file-text-o"></i> Notices d'utilisation 
											</a>
											
										</li>
											<?php } }else {?>
											<li>
											<a href="#"><i class="fa fa-file-text-o"></i> Notices d'utilisation 
												<span class="arrow"></span></a>
											<ul class="sub-menu">
												<?php
																	include_once 'bd.php';
																	$req1=$connexion->query("select * from service where service.id!=19 and service.id != 20 order by ref");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																		
																	echo '<li><a href="../admin/docadmin.php?type=Notices&service='.$obj['nom'].'"><i class="fa fa-file-text-o"></i>'.$obj['ref'].'</a>';
																		
																		
											} } 
											?>
											</ul>
										</li>
											<?php } ?>
												<?php if($adp==0){
										include_once 'bd.php';
								$not=$connexion->query("select * from document,diff where document.type='Dossiers Analytiques' and diff.id_serv=$service and document.id=diff.id_doc");
								$nbr=$not->rowcount();
								if($nbr!=0){ ?>
										<li>
											<a <?php echo 'href="../admin/docadmin.php?type=Dossiers Analytiques&service='.$Sname.'"';?>><i class="fa fa-file-text-o"></i> Dossiers Analytiques 
											</a>
											
										</li>
										<?php } }else {?>
											<li>
											<a href="#"><i class="fa fa-file-text-o"></i> Dossier analytique
											<span class="arrow"></span></a>
											<ul class="sub-menu">
												<?php
																	include_once 'bd.php';
																	$req1=$connexion->query("select * from service where service.id!=19 and service.id != 20 order by ref");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																		
																	echo '<li><a href="../admin/docadmin.php?type=Dossiers Analytiques&service='.$obj['nom'].'"><i class="fa fa-file-text-o"></i>'.$obj['ref'].'</a>';
																		
																		
																			
																		
											} } 
											?>
											</ul>
										</li>
										<?php } ?>
												<?php if($adp==0){
										include_once 'bd.php';
								$not=$connexion->query("select * from document where document.type='Protocoles' and document.id_service=$service");
								$nbr=$not->rowcount();
								if($nbr!=0){ ?>
										
										<li>
											<a <?php echo 'href="../admin/docadmin.php?type=Protocoles&service='.$Sname.'"';?>><i class="fa fa-file-text-o"></i> Protocoles 
											</a>
											
										</li>
								<?php } }else {?>
									<li>
											<a href="#"><i class="fa fa-file-text-o"></i> Protocoles 
											<span class="arrow"></span></a>
											<ul class="sub-menu">
												<?php
																	include_once 'bd.php';
																	$req1=$connexion->query("select * from service where service.id!=19 and service.id != 20 order by ref");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																	
																	echo '<li><a href="../admin/docadmin.php?type=Protocoles&service='.$obj['nom'].'"><i class="fa fa-file-text-o"></i>'.$obj['ref'].'</a>';
																		
											} } 
											?>
											</ul>
										</li>
										<?php } ?>
											<?php if($adp==0){
										include_once 'bd.php';
								$not=$connexion->query("select * from document where document.type='Formulaires' and document.id_service=$service");
								$nbr=$not->rowcount();
								if($nbr!=0){ ?>
										<li>
											<a <?php echo 'href="../admin/docadmin.php?type=Formulaires&service='.$Sname.'"';?>><i class="fa fa-file-text-o"></i> Formulaires 
											</a>
											
										</li>
										<?php } }else {?>
										<li>
											<a href="#"><i class="fa fa-file-text-o"></i> Formulaires
											<span class="arrow"></span></a>
											<ul class="sub-menu">
												<?php
																	include_once 'bd.php';
																	$req1=$connexion->query("select * from service where service.id!=19 and service.id != 20 order by ref");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																	
																	echo '<li><a href="../admin/docadmin.php?type=Formulaires&service='.$obj['nom'].'"><i class="fa fa-file-text-o"></i>'.$obj['ref'].'</a>';
																		
																		
																		
											} } 
											?>
											</ul>
										</li>
											<?php } ?>
										<?php if($adp==0){
										include_once 'bd.php';
								$not=$connexion->query("select * from document,diff where document.type='Consignes' and diff.id_serv=$service and document.id=diff.id_doc");
								$nbr=$not->rowcount();
								if($nbr!=0){ ?>
										<li>
											<a <?php echo 'href="../admin/docadmin.php?type=Consignes&service='.$Sname.'"';?>><i class="fa fa-file-text-o"></i> Consignes 
											</a>
											
										</li>
										<?php } }else {?>
											<li>
											<a href="#"><i class="fa fa-file-text-o"></i> Consignes 
											<span class="arrow"></span></a>
												<ul class="sub-menu">
													<?php
																	include_once 'bd.php';
																	$req1=$connexion->query("select * from service where service.id!=19 and service.id != 20 order by ref");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																		
																	echo '<li><a href="../admin/docadmin.php?type=Consignes&service='.$obj['nom'].'"><i class="fa fa-file-text-o"></i>'.$obj['ref'].'</a>';
																	} 
																	} 
													?>
												</ul>
											</li>
										<?php } ?>
									
									
											<?php if($adp==0){
										include_once 'bd.php';
								$not=$connexion->query("select * from document where document.type='Rapports' and document.id_service=$service");
								$nbr=$not->rowcount();
								if($nbr!=0){ ?>
										<li>
											<a <?php echo 'href="../admin/docadmin.php?type=Rapports&service='.$Sname.'"';?>><i class="fa fa-file-text-o"></i> Rapports 
											</a>
											
										</li>
								<?php } }else {?>
									<li>
											<a href="#"><i class="fa fa-file-pdf-o"></i> Rapports
												<span class="arrow"></span></a>
											<ul class="sub-menu">
												<?php
																	include_once 'bd.php';
																	$req1=$connexion->query("select * from service where service.id!=19 and service.id != 20 order by ref");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																	
																	echo '<li><a href="../admin/docadmin.php?type=Rapports&service='.$obj['nom'].'"><i class="fa fa-file-text-o"></i>'.$obj['ref'].'</a>';
																		
																		
																		
																		
											} } 
											?>
											</ul>
										</li>
								<?php } ?>
							</ul>
						</li>						
					</ul>
				</li>
			<?php include_once 'menu/menu.php';?>
					</ul>
				
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
			<center><span class="auto-style3">S</span><span class="auto-style2">ystème <b>M</b>anagement <b>I</b>ntégré</span><br>
			<center><small><font color="green">Qualité Sécurité et Environnement</font></small></center>
			</h3>		
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-cogs"></i>
						<a href="javascript:;" id="Acc">Management</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<i class="fa fa-cog"></i>
						<a href="javascript:;" id="Acc">Gestion des audits</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<i class="fa fa-plus"></i>
						<a href="javascript:;" id="Acc">Ajouter Audit</a>
						
					</li>
					
				</ul>
				<div class="page-toolbar">
				</div>
			</div>

			<!-- END PAGE HEADER-->
					
	<!-- BEGIN PAGE CONTENT-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="tabbable tabbable-custom boxless tabbable-reversed">
						
						<div class="tab-content">
							<div class="tab-pane active" id="tab_2">
								<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-folder-o"></i>Prevoir un audit
										</div>
										<div class="tools">
											
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form action="addaudit.php" class="form-horizontal" method="post" >
											<div class="form-body">						
												
												<div class="form-group has-error">
													<label class="col-md-3 control-label">
															Numero
													</label>
													<div class="col-md-4">
														<input class="form-control" type="text" placeholder="N° d'audit" name="num"></input>
														<span class="help-block"></span>
														</div>   

												</div>										
													<div class="form-group has-error">
															<label class="col-md-3 control-label">Processus</label>
															<div class="col-md-4">
																<select name="ser" class="select2me form-control" onchange="getDepartements(this.value);">
																	<option value="">Choix du processus</option>
																	<?php
																	include_once bd.php;
																	$req1=$connexion->query("select * from service where id!=19 and id!=20 and valide=0 order by ref");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																		
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																	$i=$obj['nom'];																	
																	$n=$obj['id'];																	
																	echo '<option value="'.$n.'">'.utf8_encode($i).'</option>';
																	?>
																
																	 <?php } } ?>
																	 </select>
																<span class="help-block">
																 </span>
															</div>
												</div>
												<span id="blocDepartements"></span><br />
												<div class="form-group has-error">
															<label class="col-md-3 control-label">Responsable d'audit</label>
															
															<div class="col-md-4">
																<select name="1" class="select2me form-control">
																	<option value="vide">>-Responsable d'audit-<</option>
																	<?php
																	include_once bd.php;
																	$req1=$connexion->query("select * from Auditeur");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																	$n=$obj['nom'];
																	$ida=$obj['id'];
																	echo '<option value="'.$ida.'">'.$n.'</option>';
																	?>
																
																	 <?php } } ?>
																	 </select>
																<span class="help-block">
																 </span>
															</div>
															
												</div>
												<div class="form-group has-error">
															<label class="col-md-3 control-label">Auditeur</label>
															<div class="col-md-4">
																<select name="2" class="select2me form-control">
																	<option value="vide">>----Auditeur----<</option>
																	<?php
																	include_once bd.php;
																	$req1=$connexion->query("select * from Auditeur");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																	$n=$obj['nom'];
																	$ida=$obj['id'];
																	echo '<option value="'.$ida.'">'.$n.'</option>';
																	?>
																
																	 <?php } } ?>
																	 </select>
																<span class="help-block">
																 </span>
															</div>
															
												</div>
												<div class="form-group has-error">
															<label class="col-md-3 control-label">Observateur</label>
															<div class="col-md-4">
																<select name="3" class="select2me form-control">
																	<option value="vide">>--Observateur--<</option>
																	<?php
																	include_once bd.php;
																	$req1=$connexion->query("select * from Auditeur");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																	$n=$obj['nom'];
																	$ida=$obj['id'];
																	echo '<option value="'.$ida.'">'.$n.'</option>';
																	?>
																
																	 <?php } } ?>
																	 </select>
																<span class="help-block">
																 </span>
																 
														</div>												
																<a href="#" class="btn btn-lg green" onclick="toggle_visibility('foo','foo2');">
																<i class="fa fa-plus" ></i>
																</a>			
												</div>															
														<div class="form-group has-error" id="foo2" style="display:none">
															<label class="col-md-3 control-label">Nombre d'auditeurs suplémentaires</label>
															<div class="col-md-4">
																<select name="sup" class="select2me form-control">	
																	<option value="vide">Auncun</option>																
																	<option value="1">1</option>
																	<option value="2">2</option>
																	<option value="3">3</option>																																
																</select>
																<span class="help-block">
																 </span>
															</div>															
														</div>
														<div class="form-group has-error" id="foo" style="display:none">
																														
														</div>														
									<div class="form-group">
										<label class="control-label col-md-3">Date</label>
										<div class="col-md-4">
											<div class="input-group input-large date-picker input-daterange"  data-date-format="dd/mm/yyyy">
												<input type="text" class="form-control" name="from" id ="from">
												<span class="input-group-addon">
											au </span>
												<input type="text" class="form-control" name="to" id="to">
											</div>
											<!-- /input-group -->
											<span class="help-block">
											Choisir un interval de temps .</span>
										</div>
									</div>
												<div class="form-group has-error">
													<label class="col-md-3 control-label">
															Durée
													</label>
													<div class="col-md-3">
														<select name="duree" class="select2me form-control">
																	<option value="1H">1H</option>
																	<option value="1H15">1H15mins</option>
																	<option value="1H30">1H30mins</option>
																	<option value="1H45">1H45mins</option>
																	<option value="2H">2H</option>
																	<option value="2H15">2H15mins</option>
																	<option value="2H30">2H30mins</option>
																	<option value="2H45">2H45mins</option>
																																
														</select>
													</div>											
												</div>									
													<!--/span-->
											
													<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
														
														
														<input type="hidden" name="ann" value="<?php echo $ann; ?>"</input>														
														<button type="submit" name="valider2" class="btn btn-circle blue">Valider</button>
														<button type="reset" class="btn btn-circle default">Annuler</button>
													</div>
												</div>
													<div class="col-md-6">
													</div>
												</div>
											</div>
										</form>
											
										<!-- END FORM-->
									</div>
								</div>
								
										</form>
										
										
										<!-- END FORM-->
						</div>	
					</div>
				</div>
			</div>						
			<!-- END PAGE CONTENT-->
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
	<div class="page-footer-tools">
		<span class="go-top">
		<i class="fa fa-angle-up"></i>
		</span>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 

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
<script type="text/javascript" src="../../assets/global/plugins/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
<script src="../../assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../../assets/global/plugins/ckeditor/ckeditor.js"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/form-samples.js"></script>
<script src="../../assets/admin/pages/scripts/components-form-tools.js"></script>
<script src="../../assets/admin/pages/scripts/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
<!--
    function toggle_visibility(id,id2) {
       var e = document.getElementById(id);
       var e2 = document.getElementById(id2);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
		   if(e2.style.display == 'block')
          e2.style.display = 'none';
       else
          e2.style.display = 'block';
    }
//-->
</script>

<script>
        jQuery(document).ready(function() {       
           // initiate layout and plugins
           Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
FormSamples.init();
           ComponentsFormTools.init();
		    ComponentsPickers.init();
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
if (isset($_POST['valider2'])){
	
	include_once 'bd.php';
	$num=$_POST['num'];

	$ann=$_POST['ann'];
	$sup=$_POST['sup'];
	$verif=$connexion->query("select id from auditprevu where numero='".$num."'");
	$verifcount=$verif->rowcount();
	if($verifcount!=0){	
		echo '<script language="javascript" type="text/javascript">
       alert(" Numero d\'audit déjà existant");</script>';
	}	
	else{
	$RA=$_POST['1'];
	$A=$_POST['2'];
	$O=$_POST['3'];
	if($RA==$A || $RA==$O || $A==$O){
	echo '<script language="javascript" type="text/javascript">
       alert(" Un auditeur ne peut pas faire deux  fonctions dans le meme audit");</script>';	
	}
	else{
	$duree=$_POST['duree'];	
	$idt=$_POST['ser'];
	// $id_nom =$connexion->query("SELECT `id` FROM `service` WHERE `nom` = '$ids'");
	// $objnom = $id_nom ->Fetch(PDO::FETCH_ASSOC);
	// $idt=$objnom['id'];
	$idss=$_POST['sservice'];		
	$addRA=0;	
	// $date_from = date_create($_POST['from']);
	// $from=date_format($date_from, 'Y-m-d');	
	$from=$_POST['from'];
	// $date_to = date_create($_POST['to']);
	$to=$_POST['to'];
	$addRA=$connexion->exec("INSERT INTO `auditeurprevu` VALUES (null,".$RA.",'".$num."',".$ann.",'1')");
	$addA=$connexion->exec("INSERT INTO `auditeurprevu`VALUES (null,".$A.",'".$num."',".$ann.",'2')");
	$addO=$connexion->exec("INSERT INTO `auditeurprevu` VALUES (null,".$O.",'".$num."',".$ann.",'3')");

	$addauditp=$connexion->exec("INSERT INTO auditprevu VALUES (null,".$ann.",'".$num."','".$duree."',".$idt.",".$idss.",'".$from."','".$to."')");
	if($addauditp!=0 ){
		if($sup!='vide'){
		header("location:addauditsup.php?num=$num&ann=$ann&sup=$sup");
		}
	else	{
		header("location:planaudits1.php?num=$num&ann=$ann");
	}
	
	}
	
	else{
		header("location:404.html");


	}
	
		}
		}
		}
		}
		}
	
 ?>
</html>