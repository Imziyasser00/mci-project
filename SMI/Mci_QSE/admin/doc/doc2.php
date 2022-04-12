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
    if (!isset($_SESSION['nom'])) {
        header("Location: login.php");
    }
    else {
		$service = $_SESSION['ids'];
		if (!isset($_GET['service']) || !isset($_GET['type'])){
			
	header("Location: 404.html");
		}
	else {
		include_once 'bd.php';
		$serv=$_GET['service'];
	$reqa=$connexion->query("select id as id from service where service.nom='$serv'");
	$obje = $reqa->Fetch(PDO::FETCH_ASSOC);
	$id=$obje['id'];
	$type=$_GET['type'];
	$prenom = $_SESSION['prenom'];
	$service = $_SESSION['ids'];
	$nom = $_SESSION['nom'];
	$adp=$_SESSION['adp'];
	include_once 'bd.php';
	$servname=$connexion->query("select nom from service where service.id=$service");
	$objser = $servname->Fetch(PDO::FETCH_ASSOC);
	$Sname=$objser['nom'];
	if($adp==0){
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
						<?php include_once 'menu/menu.php';?>
					</ul>
				
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

			<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box grey-cascade">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-file-o"></i>Liste des Documents
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
											<button id="sample_editable_1_new" class="btn green" onClick="parent.location='adddoc.php'" >
											Nouveau Document <i class="fa fa-plus"></i>
											</button>
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
									 <?php echo $type;?>
								</th>
								<th>
									 Etat
								</th>
								<th>
									 Date APP
								</th>
								<th>
									 Date REV
								</th>
								
								<th>
									 Actions
								</th>								
								
							</tr>
							</thead>
							<tbody>
							
								<?php			
								include_once 'bd.php';
									if($adp==2){
								$req1=$connexion->query("select document.id as id,document.id_service as id_ser, document.nom as nom, document.lien as lien,document.dateAPP as app,document.DATTREV as rev, document.Etat as etat, document.type as type, document.ajtpar as ajt from document where document.ajtpar=2 and document.Etat != 'Annule' and document.type='$type' and document.id_service='$id' union select document.id as id,document.id_service as id_ser, document.nom as nom, document.lien as lien,document.dateAPP as app,document.DATTREV as rev, document.Etat as etat, document.type as type, document.ajtpar as ajt from document,diff where  document.id=diff.id_doc and diff.id_serv=19 and diff.doc_type='$type' and document.id_service='$id'");
								
							
								}
								elseif($adp==3){
								$req1=$connexion->query(" select document.id as id,document.id_service as id_ser, document.nom as nom, document.lien as lien,document.dateAPP as app,document.DATTREV as rev, document.Etat as etat, document.type as type, document.ajtpar as ajt from document where document.ajtpar=3 and document.type='$type' and document.id_service='$id'  union select document.id as id,document.id_service as id_ser, document.nom as nom, document.lien as lien,document.dateAPP as app,document.DATTREV as rev, document.Etat as etat, document.type as type, document.ajtpar as ajt from document,diff where  document.id=diff.id_doc and diff.id_serv=20 and diff.doc_type='$type' and document.id_service='$id'");
								
								}
								elseif($adp==1){
								$req1=$connexion->query("select document.id as id,document.id_service as id_ser, document.nom as nom, document.lien as lien,document.dateAPP as app,document.DATTREV as rev, document.Etat as etat, document.type as type from document where document.Etat != 'Annule' and document.type='$type' and document.id_service='$id' order by document.id_service");	
								$ajt=1;
								}								
								$nbr=$req1->rowcount();
								if($nbr!=0){
								
								while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
								{

									$lien=$obj['lien'];
									if($adp!=1){$ajt=$obj['ajt'];}
									$nom=utf8_encode($obj['nom']);
									$id_doc=$obj['id'];
									$date=$obj['app'];
									$rev=$obj['rev'];
									$etat=utf8_encode($obj['etat']);
								echo '<tr class="odd gradeX"><td>'.$serv.'</td>';
								echo '<td>'.utf8_encode($obj['nom']).'';if( $ajt==1 || $ajt==$adp){ echo' <a href="moddoc.php?doc_id='.$id_doc.'" onclick="return(confirm(\'Etes-vous sûr de vouloir Modifier ce document?\'))"; id="Acc" title="Modifier">      <span class="fa fa-pencil"></span></a>';}echo'</td>';
							if($etat=="En cours de rédaction"){
								echo '<td><span class="label label-sm label-warning">
										En cours de rédaction</span></td>';	
								}
							elseif($etat=="En cours d'application"){
								echo '<td><span class="label label-sm label-success">
										En cours d\'application </span></td>';	
								}
							elseif($etat=="En cours de révision"){
								echo '<td><span class="label label-sm label-info">
										En cours de révision </span></td>';	
								}
							elseif($etat=="Annulé"){
								echo '<td><center><span class="label label-sm label-danger">
										Annulé </span><center></td>';	
								}
							elseif($etat=="Périmé"){
								echo '<td><center><span class="label label-sm label-danger">
										Périmé </span></center></td>';	
								}
							elseif($etat=="Reconduit"){
								echo '<td><center><span class="label label-sm label-danger">
										Reconduit </span><center></td>';	
								}
							else{
								echo '<td></td>';	
								}
								echo '<td>'.$date.'</td>';
								echo '<td>'.$rev.'</td>';
								
								$var='../Documents/'.$serv.'/'.$type.'/'.$nom.'';
								echo  '          <td> <a href="'.$var.'" class="fancybox fancybox.iframe" title="Visualiser"><span class="fa fa-eye"></span></a>';
                                                    if( $ajt==1 || $ajt==$adp){ echo'  <a href="deldoc.php?doc_id='.$id_doc.'" onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer ce document?\'))"; id="Acc" title="Supprimer"><span class="fa fa-trash-o"></span></a>';}
                                                       
                                                       
                                $var=urlencode($nom);
								
								$req3=$connexion->query("select liaison.id_anx as anx from liaison where liaison.id_doc='$id_doc'");
								$nbr3=$req3->rowcount();
								if($nbr3==0){
									echo '	<a href="" class="" title="Aucun document associé"">
											<span class="fa fa-ban"></span></a>';
								}
								else{
									$obj2 = $req3->Fetch(PDO::FETCH_ASSOC);
									$asso=	utf8_encode($obj2['anx']);
									echo '	<a href="liste.php?id_doc='.$id_doc.'" class="fancybox fancybox.iframe" title="Liste des documents assiciés"><span class="fa fa-chain "></span></a>											
								
														                     
                                                </td></tr>';
								}
								}								
								}								
								else{
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
			<!-- END PAGE CONTENT-->
	
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../../assets/admin/pages/scripts/table-managed.js"></script>
<script type="text/javascript" src="../../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
      jQuery(document).ready(function() {    
         Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
   TableManaged.init();
      });
   </script>
   <script>
    $(document).ready(function() {
        $('.fancybox').fancybox();
		 iframe: {
              preload: false // fixes issue with iframe and IE
          }
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
	}
?>
</html>