<!DOCTYPE html>
<html lang="fr"> 
 <?php

     
    session_start();

    if (!isset($_SESSION['nom'])) {
        header("Location: login.php");
    }
    else {
	$prenom = $_SESSION['prenom'];
	$nom = $_SESSION['nom'];
	$service = $_SESSION['ids'];
	$adp=$_SESSION['adp'];
	include_once 'bd.php';
	$servname=$connexion->query("select nom from service where service.id=$service");
	$objser = $servname->Fetch(PDO::FETCH_ASSOC);
	$Sname=$objser['nom'];
	$openfrom=0;
	

?>
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
<!-- BEGIN THEME STYLES -->
<link href="../../assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/global/css/pdf.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="../../assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="../images/favicon.ico"/>
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
	<!-- BEGIN CONTENT -->
	<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Télécharger les modifications</h4>
						</div>
						<div class="modal-body">
							<form action="../uploads/qse.php" method="post" enctype="multipart/form-data">								
							<input type="file" name="fileToUpload" id="fileToUpload">					
							
						</div>
						<div class="modal-footer">
							<input type="submit" class="btn blue" name="submit" value="Valider">
							<button type="button" class="btn default" data-dismiss="modal">annuler</button>
							</form>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
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
						<i class="fa fa-home"></i>
						<a href="javascript:;" id="Acc">Documents</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<i class="fa fa-file-o"></i>
						<a href="javascript:;" id="Acc">Politique QSE</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<i class="fa fa-eye"></i>
						<a href="../Documents/Politique QSE/Politique QSE.pdf" target="_blank" id="Acc">Visualiser</a>
						<?php if($adp!=0) {?> <i class="fa fa-angle-right"></i> <?php } ?>
					</li>
					<?php if($adp!=0) { ?>
					<li>
						<i class="fa fa-pencil"></i>
						<a <a href="#portlet-config" data-toggle="modal" class="config" id="Acc">Modifier</a>
						
					</li>
					
					<?php } ?>
					
				</ul>
				<div class="page-toolbar">
				</div>
			</div>

			<!-- END PAGE HEADER-->

			<!-- END PAGE HEADER-->
					
		<!-- BEGIN PAGE CONTENT-->
		<form class="acc-page">
			<div class="acc-page" style="height: 484px">
			
				<div id="fich1" > 
				<object data="../Documents/Politique QSE/Politique QSE.pdf" type="text/html" codetype="application/pdf" style="width: 581px; height: 392px" ></object> 
				</div> 

				</div>
			</div>
			</form>
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
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../script/test.js" type="text/javascript"></script>
<script>
      jQuery(document).ready(function() {    
         Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
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
	if(isset($_GET['cs'])){
	
	if($_GET['cs']==2){
	echo '<script language="javascript" type="text/javascript">
       alert("La taille du fichier est trés grande");</script>';
	}
	elseif($_GET['cs']==3){
	
	echo '<script language="javascript" type="text/javascript">
       alert("Désolé, seuls les fichiers de formats PDF sont autorisés");</script>';
	}
	elseif($_GET['cs']==4){
		echo '<script language="javascript" type="text/javascript">
       alert("Désolé, une erreur s est produite lors du téléchargement.");</script>';
	}elseif($_GET['cs']==1){
		echo '<script language="javascript" type="text/javascript">
       alert("le fichier  est modifié avec succée..");</script>';
	}
	
	}
	}
?>
</html>