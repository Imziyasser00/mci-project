<!DOCTYPE html>
<html lang="fr"> 
<?php

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
if(isset($_SESSION['nom']) and isset($_GET['pid']) and isset($_GET['idproc'])  and isset($_GET['ann'])){
	$show=1;
		$pid=$_GET['pid'];
		$idproc=$_GET['idproc'];
		$ann=$_GET['ann'];
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
					 <form action="modpoint3.php?pid=<?php echo $pid ; ?>&idproc=<?php echo $idproc ; ?>&ann=<?php echo $ann ; ?>" class="form-horizontal" method="post" >
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
														
							</tr>
							
							</thead>
							<tbody>
							<?php include 'bd.php';															
								//point
								$selectNC=$connexion->query('select * from nonconfirmite where id_point="'.$pid.'"');
								$verif=$selectNC->rowcount();
								if($verif!=0){
								while  ($selectNonC = $selectNC->Fetch(PDO::FETCH_ASSOC)) 
								{
									$idPoint = $selectNonC['id_point'];
									$numero = $selectNonC['num_audit'];
									$acap = $selectNonC['acap'];
									$resp = $selectNonC['resp'];
									$remarque = $selectNonC['remarque'];
									$cop = $selectNonC['cop'];
								$selectPoint=$connexion->query('select * from point where id='.$idPoint.'');
								//date
								$selectdate=$connexion->query('select date from fichdaudit where fichdaudit.audit_num="'.$numero.'"');
								while($dateselect = $selectdate->Fetch(PDO::FETCH_ASSOC)){
								$date2=$dateselect['date'];
								$date2 = date_create($date2);
								$date2=date_format($date2, 'd  / m  Y');	
								}	
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
								// user
								$selectNCR=$connexion->query('select * from confirmitereponse where id_point='.$idPoint.'');
								$verifNCR=$selectNCR->rowcount();
								$ncr=0;
								$proposition="";
								$dateR="";
								$dateV="";
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
									 <center><br>'.$numero.'</center>
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
								<center><br><textarea  class="form-control" maxlength="225" rows="2" placeholder=""  name="proposition">'.$proposition.'</textarea></center>
								</td>';
								?>								
								<td>
								<br>
										<select name="resp" class="select2me form-control" >
											<option value="<?php echo $resp; ?>"><?php echo $resp; ?></option>
											<?php
											include_once 'bd.php';
											$req1=$connexion->query("select * from responsable ");
											$nbr=$req1->rowcount();
											if($nbr!=0){																		
											while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
											{
											$res=$obj['resp'];																	
											$id_resp=$obj['id'];																	
											echo '<option value="'.$res.'">'.utf8_encode($res).'</option>';
											?>
											<?php } } ?>
										</select>																
														
											
								</td>
								<?php
								echo'
								<td valign="middle">
								 <center><br>'.$acap.' </center>
								</td>	
								<td valign="middle">
								<br>
											<input class="form-control" id="mask_date" type="text" name="dateR" value="'.$dateR.'"/>
											<span class="help-block">
											
											jr/mm/aaaa </span>
									
								</td>	
								<td valign="middle">
								<br>
											<input class="form-control" id="mask_date" type="text" name="dateV" value="'.$dateV.'"/>
											<span class="help-block">
											
											jr/mm/aaaa </span>
									
								</td>		
							<td valign="middle">
								<center><br><textarea  class="form-control" maxlength="225" rows="2" placeholder=""  name="remarque">'.$remarque.'</textarea></center>
								</td>';						
								}	
								}
								}
								
							?>
							</tbody>
							</table>
							
							<button type="submit" name="valider" class="btn btn-circle blue">Valider</button>
							<button type="submit" class="btn btn-circle default">Annuler</button>
						</div>
						</div>
					<!-- END EXAMPLE TABLE PORTLET-->
					</form>
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
