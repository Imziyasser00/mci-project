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
    
    if (!isset($_SESSION['nom']) || !isset($_GET['num'])) {
        header("Location: 404.html");
    }
    else {
	$id_ra = $_SESSION['id'];
	$num=$_GET['num'];		
include_once 'bd.php';	
$test=$connexion->prepare("select  id from rapportcreeoupas where audit_num=? and cop=1");					
$test->execute(array($num));							
$nbra=$test->rowcount();
function valide($id1,$num){
	try
			{
			$connexion = new PDO('mysql:host=localhost;dbname=mci', 'root', '');
				}
			catch(Exception $e)
				{
				die('Erreur : '.$e->getMessage());
				}
	$cnx=$connexion->prepare('select * from fichecreeoupas where fichecreeoupas.i_RA=? and fichecreeoupas.num=?');
	$cnx->execute(array($id1,$num));
   $objaa = $cnx->rowcount();
   return $objaa;
}

if($nbra==0 and valide($id_ra,$num)!=0){	
					
	$prenom = $_SESSION['prenom'];
	$nom = $_SESSION['nom'];
	$service = $_SESSION['ids'];
	$adp=$_SESSION['adp'];
	$openfrom=1;
	$servname=$connexion->query("select nom from service where service.id=$service");
	$objser = $servname->Fetch(PDO::FETCH_ASSOC);
	$Sname=$objser['nom'];
	$cs=0;
	echo $id_ra;
	
	$delchamp=$connexion->prepare("DELETE FROM POINT where type='ecart mine' and numero_audit=?");
	$delchamp->execute(array($num));
	

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
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/bootstrap-select/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jquery-multi-select/css/multi-select.css"/>
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
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>				
				<li>
					<a href="index.php">
					<i class="fa fa-home"></i>
					<span class="title">Acceuil</span>
					</a>
				</li>
				<?php if($adp!=0) {?>
				<li class="active open">
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
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			<center><span class="auto-style3">S</span><span class="auto-style2">ystème <b>M</b>anagement <b>I</b>ntégré</span><br>
			<center><small><font color="green">Qualité Sécurité et Environnement</font></small></center>
			</h3>		
			

			<!-- END PAGE HEADER-->
					
	<!-- BEGIN PAGE CONTENT-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="tabbable tabbable-custom boxless tabbable-reversed">
						
						<div class="tab-content">
							<div class="tab-pane active" id="tab_2">
								<div class="portlet box blue">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-file-o"></i> Audit N° <?php echo $num; ?>
										</div>
										<div class="tools">
											
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										 <form action="addRapportE1.php?num=<?php echo $num ; ?>" class="form-horizontal" method="post" >
											<div class="form-body">			
												
												
												
												
														
														
												
													<div class="form-group has-error">
													<label class="control-label col-md-3"><b>Ecart mineur 1 :</b></label><a href="#" onclick="toggle_visibility('PA2','vide2'),toggle_visibility2('ic1','ic2'),cleartext('text2');">
																<i class="fa fa-plus" id="ic1" style="visibility:visible"></i>
																<i class="fa fa-minus" id="ic2" style="visibility:hidden"></i>
																</a>
																
													<div class="col-md-6">
														<textarea id="text0" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
															<span class="help-block">
															
															
													</div>
													</div>
													<div class="form-group has-error" id="PA2" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 2 :</b></label><a href="#PA2" onclick="toggle_visibility('PA3','vide3'),toggle_visibility2('icplus2','icminus2'),cleartext('text3');">
<i class="fa fa-plus" id="icplus2" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus2" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text2" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide2" style="display:none">
</div>
<div class="form-group has-error" id="PA3" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 3 :</b></label><a href="#PA3" onclick="toggle_visibility('PA4','vide4'),toggle_visibility2('icplus3','icminus3'),cleartext('text4');">
<i class="fa fa-plus" id="icplus3" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus3" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text3" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide3" style="display:none">
</div>
<div class="form-group has-error" id="PA4" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 4 :</b></label><a href="#PA4" onclick="toggle_visibility('PA5','vide5'),toggle_visibility2('icplus4','icminus4'),cleartext('text5');">
<i class="fa fa-plus" id="icplus4" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus4" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text4" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide4" style="display:none">
</div>
<div class="form-group has-error" id="PA5" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 5 :</b></label><a href="#PA5" onclick="toggle_visibility('PA6','vide6'),toggle_visibility2('icplus5','icminus5'),cleartext('text6');">
<i class="fa fa-plus" id="icplus5" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus5" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text5" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide5" style="display:none">
</div>
<div class="form-group has-error" id="PA6" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 6 :</b></label><a href="#PA6" onclick="toggle_visibility('PA7','vide7'),toggle_visibility2('icplus6','icminus6'),cleartext('text7');">
<i class="fa fa-plus" id="icplus6" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus6" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text6" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide6" style="display:none">
</div>
<div class="form-group has-error" id="PA7" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 7 :</b></label><a href="#PA7" onclick="toggle_visibility('PA8','vide8'),toggle_visibility2('icplus7','icminus7'),cleartext('text8');">
<i class="fa fa-plus" id="icplus7" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus7" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text7" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide7" style="display:none">
</div>
<div class="form-group has-error" id="PA8" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 8 :</b></label><a href="#PA8" onclick="toggle_visibility('PA9','vide9'),toggle_visibility2('icplus8','icminus8'),cleartext('text9');">
<i class="fa fa-plus" id="icplus8" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus8" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text8" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide8" style="display:none">
</div>
<div class="form-group has-error" id="PA9" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 9 :</b></label><a href="#PA9" onclick="toggle_visibility('PA10','vide10'),toggle_visibility2('icplus9','icminus9'),cleartext('text10');">
<i class="fa fa-plus" id="icplus9" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus9" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text9" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide9" style="display:none">
</div>
<div class="form-group has-error" id="PA10" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 10 :</b></label><a href="#PA10" onclick="toggle_visibility('PA11','vide11'),toggle_visibility2('icplus10','icminus10'),cleartext('text11');">
<i class="fa fa-plus" id="icplus10" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus10" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text10" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide10" style="display:none">
</div>
<div class="form-group has-error" id="PA11" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 11 :</b></label><a href="#PA11" onclick="toggle_visibility('PA12','vide12'),toggle_visibility2('icplus11','icminus11'),cleartext('text12');">
<i class="fa fa-plus" id="icplus11" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus11" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text11" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide11" style="display:none">
</div>
<div class="form-group has-error" id="PA12" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 12 :</b></label><a href="#PA12" onclick="toggle_visibility('PA13','vide13'),toggle_visibility2('icplus12','icminus12'),cleartext('text13');">
<i class="fa fa-plus" id="icplus12" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus12" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text12" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide12" style="display:none">
</div>
<div class="form-group has-error" id="PA13" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 13 :</b></label><a href="#PA13" onclick="toggle_visibility('PA14','vide14'),toggle_visibility2('icplus13','icminus13'),cleartext('text14');">
<i class="fa fa-plus" id="icplus13" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus13" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text13" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide13" style="display:none">
</div>
<div class="form-group has-error" id="PA14" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 14 :</b></label><a href="#PA14" onclick="toggle_visibility('PA15','vide15'),toggle_visibility2('icplus14','icminus14'),cleartext('text15');">
<i class="fa fa-plus" id="icplus14" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus14" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text14" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide14" style="display:none">
</div>
<div class="form-group has-error" id="PA15" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 15 :</b></label><a href="#PA15" onclick="toggle_visibility('PA16','vide16'),toggle_visibility2('icplus15','icminus15'),cleartext('text16');">
<i class="fa fa-plus" id="icplus15" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus15" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text15" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide15" style="display:none">
</div>
<div class="form-group has-error" id="PA16" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 16 :</b></label><a href="#PA16" onclick="toggle_visibility('PA17','vide17'),toggle_visibility2('icplus16','icminus16'),cleartext('text17');">
<i class="fa fa-plus" id="icplus16" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus16" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text16" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide16" style="display:none">
</div>
<div class="form-group has-error" id="PA17" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 17 :</b></label><a href="#PA17" onclick="toggle_visibility('PA18','vide18'),toggle_visibility2('icplus17','icminus17'),cleartext('text18');">
<i class="fa fa-plus" id="icplus17" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus17" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text17" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide17" style="display:none">
</div>
<div class="form-group has-error" id="PA18" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 18 :</b></label><a href="#PA18" onclick="toggle_visibility('PA19','vide19'),toggle_visibility2('icplus18','icminus18'),cleartext('text19');">
<i class="fa fa-plus" id="icplus18" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus18" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text18" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide18" style="display:none">
</div>
<div class="form-group has-error" id="PA19" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 19 :</b></label><a href="#PA19" onclick="toggle_visibility('PA20','vide20'),toggle_visibility2('icplus19','icminus19'),cleartext('text20');">
<i class="fa fa-plus" id="icplus19" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus19" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text19" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide19" style="display:none"> 
</div>
<div class="form-group has-error" id="PA20" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 20 :</b></label><a href="#PA20" onclick="toggle_visibility('PA21','vide21'),toggle_visibility2('icplus20','icminus20'),cleartext('text21');">
<i class="fa fa-plus" id="icplus20" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus20" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text20" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide20" style="display:none"> 
</div>
<div class="form-group has-error" id="PA21" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 21 :</b></label><a href="#PA21" onclick="toggle_visibility('PA22','vide22'),toggle_visibility2('icplus21','icminus21'),cleartext('text22');">
<i class="fa fa-plus" id="icplus21" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus21" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text21" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide21" style="display:none"> 
</div>
<div class="form-group has-error" id="PA22" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 22 :</b></label><a href="#PA22" onclick="toggle_visibility('PA23','vide23'),toggle_visibility2('icplus22','icminus22'),cleartext('text23');">
<i class="fa fa-plus" id="icplus22" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus22" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text22" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide22" style="display:none"> 
</div>
<div class="form-group has-error" id="PA23" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 23 :</b></label><a href="#PA23" onclick="toggle_visibility('PA24','vide24'),toggle_visibility2('icplus23','icminus23'),cleartext('text24');">
<i class="fa fa-plus" id="icplus23" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus23" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text23" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide23" style="display:none"> 
</div>
<div class="form-group has-error" id="PA24" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 24 :</b></label><a href="#PA24" onclick="toggle_visibility('PA25','vide25'),toggle_visibility2('icplus24','icminus24'),cleartext('text25');">
<i class="fa fa-plus" id="icplus24" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus24" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text24" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide24" style="display:none"> 
</div>
<div class="form-group has-error" id="PA25" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 25 :</b></label><a href="#PA25" onclick="toggle_visibility('PA26','vide26'),toggle_visibility2('icplus25','icminus25'),cleartext('text26');">
<i class="fa fa-plus" id="icplus25" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus25" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text25" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide25" style="display:none"> 
</div>
<div class="form-group has-error" id="PA26" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 26 :</b></label><a href="#PA26" onclick="toggle_visibility('PA27','vide27'),toggle_visibility2('icplus26','icminus26'),cleartext('text27');">
<i class="fa fa-plus" id="icplus26" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus26" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text26" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide26" style="display:none"> 
</div>
<div class="form-group has-error" id="PA27" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 27 :</b></label><a href="#PA27" onclick="toggle_visibility('PA28','vide28'),toggle_visibility2('icplus27','icminus27'),cleartext('text28');">
<i class="fa fa-plus" id="icplus27" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus27" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text27" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide27" style="display:none"> 
</div>
<div class="form-group has-error" id="PA28" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 28 :</b></label><a href="#PA28" onclick="toggle_visibility('PA29','vide29'),toggle_visibility2('icplus28','icminus28'),cleartext('text29');">
<i class="fa fa-plus" id="icplus28" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus28" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text28" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide28" style="display:none"> 
</div>
<div class="form-group has-error" id="PA29" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 29 :</b></label><a href="#PA29" onclick="toggle_visibility('PA30','vide30'),toggle_visibility2('icplus29','icminus29'),cleartext('text30');">
<i class="fa fa-plus" id="icplus29" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus29" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text29" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide29" style="display:none"> 
</div>
<div class="form-group has-error" id="PA30" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 30 :</b></label><a href="#PA30" onclick="toggle_visibility('PA31','vide31'),toggle_visibility2('icplus30','icminus30'),cleartext('text31');">
<i class="fa fa-plus" id="icplus30" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus30" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text30" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide30" style="display:none"> 
</div>
<div class="form-group has-error" id="PA31" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 31 :</b></label><a href="#PA31" onclick="toggle_visibility('PA32','vide32'),toggle_visibility2('icplus31','icminus31'),cleartext('text32');">
<i class="fa fa-plus" id="icplus31" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus31" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text31" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide31" style="display:none"> 
</div>
<div class="form-group has-error" id="PA32" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 32 :</b></label><a href="#PA32" onclick="toggle_visibility('PA33','vide33'),toggle_visibility2('icplus32','icminus32'),cleartext('text33');">
<i class="fa fa-plus" id="icplus32" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus32" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text32" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide32" style="display:none"> 
</div>
<div class="form-group has-error" id="PA33" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 33 :</b></label><a href="#PA33" onclick="toggle_visibility('PA34','vide34'),toggle_visibility2('icplus33','icminus33'),cleartext('text34');">
<i class="fa fa-plus" id="icplus33" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus33" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text33" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide33" style="display:none"> 
</div>
<div class="form-group has-error" id="PA34" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 34 :</b></label><a href="#PA34" onclick="toggle_visibility('PA35','vide35'),toggle_visibility2('icplus34','icminus34'),cleartext('text35');">
<i class="fa fa-plus" id="icplus34" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus34" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text34" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide34" style="display:none"> 
</div>
<div class="form-group has-error" id="PA35" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 35 :</b></label><a href="#PA35" onclick="toggle_visibility('PA36','vide36'),toggle_visibility2('icplus35','icminus35'),cleartext('text36');">
<i class="fa fa-plus" id="icplus35" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus35" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text35" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide35" style="display:none"> 
</div>
<div class="form-group has-error" id="PA36" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 36 :</b></label><a href="#PA36" onclick="toggle_visibility('PA37','vide37'),toggle_visibility2('icplus36','icminus36'),cleartext('text37');">
<i class="fa fa-plus" id="icplus36" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus36" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text36" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide36" style="display:none"> 
</div>
<div class="form-group has-error" id="PA37" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 37 :</b></label><a href="#PA37" onclick="toggle_visibility('PA38','vide38'),toggle_visibility2('icplus37','icminus37'),cleartext('text38');">
<i class="fa fa-plus" id="icplus37" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus37" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text37" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide37" style="display:none"> 
</div>
<div class="form-group has-error" id="PA38" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 38 :</b></label><a href="#PA38" onclick="toggle_visibility('PA39','vide39'),toggle_visibility2('icplus38','icminus38'),cleartext('text39');">
<i class="fa fa-plus" id="icplus38" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus38" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text38" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide38" style="display:none"> 
</div>
<div class="form-group has-error" id="PA39" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 39 :</b></label><a href="#PA39" onclick="toggle_visibility('PA40','vide40'),toggle_visibility2('icplus39','icminus39'),cleartext('text40');">
<i class="fa fa-plus" id="icplus39" style="visibility:visible"></i>
<i class="fa fa-minus" id="icminus39" style="visibility:hidden"></i>
</a>
<div class="col-md-6">
<textarea id="text39" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide39" style="display:none"> 
</div>
<div class="form-group has-error" id="PA40" style="display:none">
<label class="control-label col-md-3"><b>Ecart mineur 40 :</b></label>
<div class="col-md-6">
<textarea id="text40" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="pf[]"></textarea>
<span class="help-block">


</div>
</div>
<div class="form-group has-error" id="vide40" style="display:none"> 
</div>

													
										
						
						</div>
						
						
									
																				
													<!--/span-->
											
													<div class="form-actions">
												<div class="row" name="bas">
													<div class="col-md-offset-3 col-md-9">
																										
														<center><button type="submit" name="suivant" class="btn btn-circle blue">Suivant</button></center>
														
														
														
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
<script type="text/javascript" src="../../assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js"></script>
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
<script src="../../assets/admin/pages/scripts/components-dropdowns.js"></script>
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
	 function toggle_visibility2(id,id2) {
       var e = document.getElementById(id);
       var e2 = document.getElementById(id2);
       if(e.style.visibility == 'visible')
          e.style.visibility = 'hidden';
       else
          e.style.visibility = 'visible';
		   if(e2.style.visibility == 'visible')
          e2.style.visibility = 'hidden';
       else
          e2.style.visibility = 'visible';
    }
function cleartext(id){
	var e = document.getElementById(id)
     e.value = "";
};
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
			ComponentsDropdowns.init();
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
	else {
		 header("Location: 404.html");	
	}
	}
 ?>
</html>