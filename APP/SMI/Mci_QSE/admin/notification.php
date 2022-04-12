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

	include_once 'bd.php';
	$prenom = $_SESSION['prenom'];
	$nom = $_SESSION['nom'];
	$service = $_SESSION['ids'];
	$adp=$_SESSION['adp'];
	include_once 'bd.php';
	$servname=$connexion->query("select nom from service where service.id=$service");
	$objser = $servname->Fetch(PDO::FETCH_ASSOC);
	$Sname=$objser['nom'];
	$openfrom=0;
	if($adp==999){
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
<!-- END HEADER -->	
	<!-- BEGIN CONTENT -->
	<div>
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
							<?php
								if($adp!=1 || $adp!=2){
							$icom=0;
							$icomRA=0;
							$icomrap=0;
							}
										include 'top_menu\notification\docEXP.php';
										include 'top_menu\notification\VaEXP.php';
										include 'top_menu\notification\action.php';
										include_once 'top_menu\notification\ficheaudit.php';
										include_once 'top_menu\notification\comqse.php';
										include_once 'top_menu\notification\comRA.php';
										include_once 'top_menu\notification\rapportdaudit.php';
										include_once 'top_menu\notification\rapcree.php';
										$total=$i+$iVEX+$iFCP+$iRA+$icom+$icomRA+$icomrap+$icomAction; 
										$j=0; 
							?>
								<i class="fa fa-file-o"></i>Notification <?php  echo $total; ?>
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
									 Type
								</th>
								<th>
									 Notification
								</th>								
								
							</tr>
							</thead>
							<tbody>
							
								<?php			
								include_once 'bd.php';
							
							while($j < $i ){								
								?>
								<tr>
									<td>
										<span class="label label-sm label-icon label-danger">
									<i class="fa fa-bolt"></i>
									</span>Document expiré
									</td>
									<td>
									<?php echo'<a href="docdocdetail.php?exp=0&file='.$NOT_EX[$j]['id'].'&type='.$NOT_EX[$j]['type'].'&service='.$NOT_EX[$j]['service'].'">'; ?>
									
									<?php echo $NOT_EX[$j]['lien'] ; ?> <span class="time">
									<?php echo "  ".$NOT_EX[$j]['exp'] ; ?> </span>
									</a>
									</td>
								</tr>
								<?php $j++;}?>
							<?php $j=0; while($j < $iVEX ){								
								?>
								<tr>
									<td>
										<span class="label label-sm label-icon label-warning">
									<i class="fa fa-bell-o"></i>
									</span>Document expire dans <?php echo $NOT_VEX[$j]['exp'] ; ?> 
									</td>
									<td>
									<?php echo'<a href="docdocdetail.php?exp=1&file='.$NOT_VEX[$j]['id'].'&type='.$NOT_VEX[$j]['type'].'&service='.$NOT_VEX[$j]['service'].'">'; ?>
									
									<?php echo $NOT_VEX[$j]['lien'] ; ?> <span class="time"><br>
									<?php echo $NOT_VEX[$j]['exp'] ; ?> </span>
									</a>
									</td>
								</tr>
								<?php $j++;}?>								
								<?php $j=0; while($j < $iFCP ){								
								?>
								<tr>
									<td>
										<span class="label label-sm label-icon label-warning">
									<i class="fa fa-file-o"></i>
									</span>Création de fiche d'audit
									</td>
									<td>
									<?php echo '<a href="addfiche.php?num='.$NOT_FCP[$j]['num'].'" title="Créer la fiche d\'audit">';?>
									
									
									<?php echo $NOT_FCP[$j]['lien'] ; ?> <span class="time"><br>
									<?php echo $NOT_FCP[$j]['exp'] ; ?> </span>
									</a>
									</td>
								</tr>
								<?php $j++;}?>
								
									<?php $j=0; while($j < $iRA ){								
								?>
								<tr>
									<td>
										<span class="label label-sm label-icon label-warning">
									<i class="fa fa-file-o"></i>
									</span>Création de rapport d'audit
									</td>
									<td>
									<?php echo '<a href="addRapport.php?num='.$NOT_RA[$j]['num'].'" title="Rédiger le rapport d\'audit">';?>
									
									
									<?php echo $NOT_RA[$j]['lien'] ; ?> <span class="time"><br>
									
									</a>
									</td>
								</tr>
								<?php $j++;}?>
								<?php $j=0; while($j < $icom ){								
								?>
								<tr>
									<td>
										<span class="label label-sm label-icon label-warning">
									<i class="fa fa-file-o"></i>
									</span>Validation de la fiche d'audit
									</td>
									<td>
									<?php echo '<a href="addfiche5.php?num='.$NOT_com[$j]['num'].'" title="Valider la fiche d\'audit">';?>
									
									
									<?php echo $NOT_com[$j]['lien'] ; ?> <span class="time"><br>
									
									</a>
									</td>
								</tr>
								<?php $j++;}?>
								<?php $j=0; while($j < $icomrap ){								
								?>
								<tr>
									<td>
										<span class="label label-sm label-icon label-warning">
									<i class="fa fa-file-o"></i>
									</span>rapport d'audit
									</td>
									<td>
									<?php echo '<a href='.$NOT_comrap[$j]['num'].' title="Visualiser le rapport d\'audit">';?>
									
									
									<?php echo $NOT_comrap[$j]['lien'] ; ?> <span class="time"><br>
									
									</a>
									</td>
								</tr>
								<?php $j++;}?>
								<?php $j=0; while($j < $icomRA ){								
								?>
								<tr>
									<td>
										<span class="label label-sm label-icon label-warning">
									<i class="fa fa-file-o"></i>
									</span>fiche d'audit
									</td>
									<td>
									<?php echo '<a href="addfiche5.php?num='.$NOT_comRA[$j]['num'].'" title="Completer la fiche d\'audit">';?>
									
									
									<?php echo $NOT_comRA[$j]['lien'] ; ?> <span class="time"><br>
									
									</a>
									</td>
								</tr>
								<?php $j++;}?>
								<?php $j=0; while($j < $icomAction ){								
								?>
								<tr>
									<td>
									
									
									<span class="label label-sm label-icon label-warning">
									<i class="fa fa-file-o"></i>
									</span>
									</td>
									<td>
									<?php echo '<a href="completerPlan.php?num='.$NOT_ActionNum.'" title="Completer le plan d\'action">';?>
									<?php echo $NOT_ActionLien ; ?> <span class="time"><br>
									
									</a>
									</td>
								</tr>
								<?php $j++;}?>
								<?php if($total==0){ ?>
								<li>
									<a href="#">
									<span class="label label-sm label-icon label-info">
									<i class="fa fa-bullhorn"></i>
									</span>
									Aucune notification 
									 </span>
									</a>
								</li>
								<?php } ?>
														
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
