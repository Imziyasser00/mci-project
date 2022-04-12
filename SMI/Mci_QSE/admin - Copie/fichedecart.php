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
    if ($_SESSION['adp']==0){
	header("Location: 404.html");
	}
    elseif (!isset($_SESSION['nom']) || !isset($_POST['sem'])) {
        header("Location: 404.html");
    }
    else {
		include_once 'bd.php';
	$sem=$_POST['sem'];
	$ann=$_POST['ann'];
	
	
			$testvalidation=$connexion->prepare('select cop from plandaudit where sem=? and annee=?');
			$testvalidation->execute(array($sem,$ann));
			$test = $testvalidation->Fetch(PDO::FETCH_ASSOC);
			$cop=$test['cop'];
			if($cop==1){
				header("Location: addaudit0.php?msg=1");
			}	
	$prenom = $_SESSION['prenom'];
	$nom = $_SESSION['nom'];
	$service = $_SESSION['ids'];
	$adp=$_SESSION['adp'];
	
	$servname=$connexion->query("select nom from service where service.id=$service");
	$objser = $servname->Fetch(PDO::FETCH_ASSOC);
	$Sname=$objser['nom'];
	$cs=0;
	$reqa=$connexion->query("select id from utilisateur");
	$nbrcount=$reqa->rowcount();
	$verif=$connexion->query("select * from plandaudit where sem=$sem and annee=$ann");
		$nbrv=$verif->rowcount();
			if($nbrv==0){
			$cree=$connexion->exec("INSERT INTO `plandaudit` values ('',$sem,$ann,0)");
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
																	$req1=$connexion->query("select * from service order by ref");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																		
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																	$n=$obj['nom'];																	
																	echo '<option value="'.$n.'">'.$n.'</option>';
																	?>
																
																	 <?php } } ?>
																	 </select>
																<span class="help-block">
																 </span>
															</div>
												</div>
												<span id="blocDepartements"></span><br />
												<div class="form-group has-error">
															<label class="col-md-3 control-label">Responsable d'audite</label>
															
															<div class="col-md-4">
																<select name="RA" class="select2me form-control">
																	<option value="vide">>-Responsable d'audite-<</option>
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
																<select name="A" class="select2me form-control">
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
																<select name="O" class="select2me form-control">
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
														<div class="form-group has-error" id="foo" style="display:none">
															<label class="col-md-3 control-label">Nom</label>
															<div class="col-md-4">
																<select name="idsup" class="select2me form-control">
																<option value="vide">>----Nom----<</option>
																	<?php
																	include_once 'bd.php';
																	$req2=$connexion->query("select id, nom from Auditeur order by nom ");
																	$nbr1=$req2->rowcount();
																	if($nbr1!=0){
																	while  ($obj1 = $req2->Fetch(PDO::FETCH_ASSOC)) 
																	{
																	$id=$obj1['id'];
																	$ret=$obj1['nom'];
																	$ret2=$obj1['prenom'];
																	echo '<option value="'.$id.'">'.$ret.'</option>';
																	?>																	
																	 <?php } } ?>
																	 </select>
																<span class="help-block">
																 </span>
															</div>
														</div>								
														
														<div class="form-group has-error" id="foo2" style="display:none">
															<label class="col-md-3 control-label">Fonction</label>
															<div class="col-md-4">
																<select name="fonctionsup" class="select2me form-control">	
																<option value="vide">>--Fonction--<</option>																
																	<option value="A">Auditeur</option>
																	<option value="O">Observateur</option>
																																
																</select>
																<span class="help-block">
																 </span>
															</div>															
														</div>	
									<div class="form-group">
										<label class="control-label col-md-3">Date</label>
										<div class="col-md-4">
											<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
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
														
														<input type="hidden" name="sem" value="<?php echo $sem; ?>"</input>
														<input type="hidden" name="ann" value="<?php echo $ann; ?>"</input>														
														<button type="submit" name="valider" class="btn btn-circle blue">Valider</button>
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

	
	}
	

	

 ?>
</html>