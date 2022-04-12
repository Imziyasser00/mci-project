<!DOCTYPE html>
<html lang="en"> 
<?php

    session_start();

    if (!isset($_SESSION['nom'])) {
        header("Location: login.php");
    }
    else {
		$service = $_SESSION['ids'];
		if (!isset($_GET['service']) || !isset($_GET['type'])){
			
	header("Location: ../404.html");
		}
	else {
		include_once 'bd.php';
		$serv=$_GET['service'];
	$reqa=$connexion->prepare("select id as id from service where service.nom=?");
	$reqa->execute(array($serv));
	$obje = $reqa->Fetch(PDO::FETCH_ASSOC);
	$id=$obje['id'];
		if(($_SESSION['adp']!=1) )
			{
		
			$type=$_GET['type'];
	$prenom = $_SESSION['prenom'];
	$nom = $_SESSION['nom'];
	include_once 'bd.php';
	$servname=$connexion->prepare("select nom from service where service.id=.");
	$servname->execute(array($service));
	$objser = $servname->Fetch(PDO::FETCH_ASSOC);
	$Sname=$objser['nom'];	
	$adp=$_SESSION['adp'];	
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
<link href="../../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="../../../assets/global/plugins/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
<!-- END GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" type="text/css" href="../../../assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="../../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- BEGIN THEME STYLES -->
<link href="../../../assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/global/css/pdf.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="../../../assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
<link href="../../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
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
				<li class="active open">
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
	<div class="page-content-wrapper">
		<div class="page-content">
		

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title"><img src="../../../images/LogoApp.png">
			
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					
				
					<li>
						<i class="fa fa-home"></i>
						<a  id="Acc"><?php echo $type; ?></a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li class="active">
						<i class="fa fa-file-o"></i>
						<a  id="Acc"><?php echo $serv; ?></a>
						<i class="fa fa-angle-right"></i>
					</li>
									
				</ul>
					
				
				<div class="page-toolbar">
				</div>
			</div>

			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<!-- BEGIN DASHBOARD STATS -->
			<!-- END DASHBOARD STATS -->			
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box blue-hoki">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i><?php echo $serv;  ?>
							</div>
							<div class="tools">
							</div>
						</div>
						<div class="portlet-body">
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
									 Document Associé
								</th>
								<th>
									 Actions
								</th>								
							</tr>
							</thead>
							<tbody>
							
						<?php			
								include_once 'bd.php';
								$req1=$connexion->prepare("select diff.id_doc as id from diff where id_serv=? and doc_type=?");
								$req1->execute(array($service,$type));
								$nbr=$req1->rowcount();
								if($nbr!=0){
								while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC))
								{
									$id_doc=$obj['id'];									
									$InfoDoc=$connexion->prepare("select document.id_service as idss,document.nom as nom, document.lien as lien from document where document.id=? and document.Etat != 'Annule' ");
									$InfoDoc->execute(array($id_doc));
									$InfosDoc=$InfoDoc->FETCH(PDO::FETCH_ASSOC);
									$lien=utf8_encode($InfosDoc['lien']);
									$nom=utf8_encode($InfosDoc['nom']);								
									$idss=$InfosDoc['idss'];
									$selectserv=$connexion->query("select service.nom as nom from service where service.id=$idss");
									$nomservice=$selectserv->FETCH(PDO::FETCH_ASSOC);
									
								echo ' <tr>
								<td><center>'.$nomservice['nom'].'</center></td>
								<td>'.$nomservice['nom'].'';							
								 $var=urlencode($nom);								
									$req3=$connexion->query("select liaison.id_anx as anx from liaison where liaison.id_doc='$id_doc'");
									$nbr3=$req3->rowcount();
								if($nbr3==0){
									echo'<td><center>Aucun document</center></td>';
								}
								else{
									$obj2 = $req3->Fetch(PDO::FETCH_ASSOC);
									$asso=	utf8_encode($obj2['anx']);
									echo '	<td>
									<a href="../liste.php?id_doc='.$id_doc.'" class="fancybox fancybox.iframe" title="Liste des documents associés"><span class="fa fa-chain ">     Liste des documents associés</span></a>											
															                     
                                               </td>';
								}
								
								 echo '<td> <a href="../../../Documents/'.$nomservice['nom'].'/'.$type.'/'.$nom.'" class="fancybox fancybox.iframe" title="Visualiser"><center>Visualiser</a></td></tr>';
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
					
			<!-- END PAGE CONTENT-->
			</div>
		</div>
	</div>
</div>
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		 <table><tr><td style="width: 500px">2015 &copy; M.C.I. Santé Animale.</td><td><img src="../../../assets/admin/layout/img/footer-img.png" alt="logo" class="logo-defaul../../../td></tr>
	</table></div>
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
<script src="../../../../assets/global/plugins/respond.min.js"></script>
<script src="../../../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="../../../assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="../../../assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="../../../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>


<script src="../../../assets/global/plugins/bootstr../../../bootstrap.min.js" type="text/javascript"></script>
<script src="../../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="../../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../../assets/global/plugins/bootstrap-swit../../../bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="../../../assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="../../../assets/global/plugins/datatables/med../../../jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../../assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="../../../assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="../../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="../../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="../../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="../../../assets/admin/pages/scripts/table-managed.js"></script>
<script type="text/javascript" src="../../../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
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
	if(isset($_GET['cs'])){
	
	if($_GET['cs']==2){
	echo '<script language="javascript" type="text/javascript">
       alert("La taille du fichier est trés grande");</script>';
	}
	elseif($_GET['cs']==3){
	
	echo '<script language="javascript" type="text/javascript">
       alert("Désolé, seuls les fichiers de formats de type images ou PDF sont autorisés");</script>';
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
	<?php
	}
	}
	
	
?>
	<!-- END BODY -->

</html>