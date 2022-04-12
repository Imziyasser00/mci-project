<!DOCTYPE html>
<html lang="fr">
<?php

	session_start();


	$prenom = $_SESSION['prenom'];
	$id = $_SESSION['id'];
	$nom = $_SESSION['nom'];
	$service = $_SESSION['ids'];
	$adp=$_SESSION['adp'];
	include_once 'bd.php';
	$servname=$connexion->query("select nom from service where service.id=$service");
	$objser = $servname->Fetch(PDO::FETCH_ASSOC);
	$Sname=$objser['nom'];
	$num=$_GET['num'];
	$ficheid=$connexion->prepare('select id, id_RA from fichdaudit where audit_num=?');
	$ficheid->execute(array($num));
	$objt = $ficheid->Fetch(PDO::FETCH_ASSOC);
	$id_fiche=$objt['id'];
	$RA=$objt['id_RA'];
	$openfrom=1;
	$aud=$connexion->prepare('select id_auditeur from auditeurprevu where numero_audit=? and fonction="2"');
	$aud->execute(array($num));
	$objt = $aud->Fetch(PDO::FETCH_ASSOC);
	$A=$objt['id_auditeur'];

	$audO=$connexion->prepare('select id_auditeur from auditeurprevu where numero_audit=? AND fonction="3"');
	$audO->execute(array($num));
	$objtO = $audO->Fetch(PDO::FETCH_ASSOC);
	$O=$objtO['id_auditeur'];


function getIdUser($id1){
	try
			{
			$connexion = new PDO('mysql:host=localhost;dbname=mci', 'root', '');
				}
			catch(Exception $e)
				{
				die('Erreur : '.$e->getMessage());
				}
	$cnx=$connexion->prepare('select id_utilisateur from auditeur where id=?');
   $cnx->execute(array($id1));
   $objaa = $cnx->Fetch(PDO::FETCH_ASSOC);
   $a=$objaa['id_utilisateur'];
   return $a;
}


  if ((getIdUser($A)!=$id) and getIdUser($O)!=$id and getIdUser($RA)!=$id and $adp!=1 and $adp!=2){
	  header("Location: 404.html");
  }
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
.auto-style2 {
	color: #0B6294;
}
.auto-style3 {
	color: #0B6294;
	font-weight: bold;
}
 table.MsoNormalTable
	{font-size:10.0pt;
	font-family:"Calibri",sans-serif;
	}
 p.MsoNormal
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:10.0pt;
	margin-left:0cm;
	line-height:115%;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	}
.auto-style4 {
	text-align: center;
	font-size: 10.0pt;
	font-family: "Times New Roman", serif;
	font-weight: bold;
	margin-left: 0cm;
	margin-right: 0cm;
	margin-top: 0cm;
	margin-bottom: .0001pt;
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
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Conclusions de l'auditeur vis à vis de l'activité auditée : </h4>
						</div>
						<div class="portlet-body form">
						<form action="completer.php?num=<?php echo $num; ?>" method="post" class="form-horizontal form-bordered">
								<div class="form-body">
								<div class="form-group has-error">
													<label class="control-label col-md-13">Les activités et résultats audités satisfont aux dispositions préétablies ? </label>
													<div class="col-md-11">
														<textarea id="maxlength_textarea" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="reps1"></textarea>
															<span class="help-block">
															</span>
														</div>
									</div>

								<div class="form-group has-error">
													<label class="control-label col-md-13">Ces dispositions sont mises en œuvre de façon
					efficace et aptes à atteindre les objectifs?  </label>
													<div class="col-md-11">
														<textarea id="maxlength_textarea" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="reps2"></textarea>
															<span class="help-block">
															</span>
														</div>
									</div>


								<div class="modal-footer">
							<input type="hidden"  name="id_fiche" value="<?php echo $id_fiche; ?>"></input>

							<input type="submit" class="btn blue" name="valider" value="Valider">
							<button type="button" class="btn default" data-dismiss="modal">annuler</button>
							</form>
									</div>

							</div>
						</div>
					</div>
				</div>
			</div>



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
						<i class="fa fa-file-o"></i>

						<a href="#" onclick="toggle_visibility('foo','foo2');">
																Page Suivante
																</a>

					</li>

				</ul>
				<div class="page-toolbar">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
						Actions <i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">

							<li>
							<a  data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="false">Enregistrer
								</a>
								<ul>
								<li>
								<a href="pdf/reg/gerfiche.php?num=<?php echo $num; ?>">pdf</a>
								</li>
								</ul>
							</li>


						</ul>
					</div>
				</div>
			</div>
		<div id="foo2" style="display:block">
			<center>
			<table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" width="696">
				<tr>
					<td rowspan="2" width="143">
					<h6><span>
					<img height="51" src="../images/logomci.jpg" v:shapes="_x0000_i1025" width="116"></span><o:p></o:p></h6>
					</td>
					<td colspan="2" width="401">
					<p align="center" class="MsoNormal"><b><span>FORMULAIRE<o:p></o:p></span></b></p>
					</td>
					<td rowspan="3" width="152">
					<p align="center" class="MsoNormal"><b><i>Management<o:p></o:p></i></b></p>
					<p align="center" class="MsoNormal"><b><i>QSE<o:p></o:p></i></b></p>
					</td>
				</tr>
				<tr>
					<td colspan="2" width="401">
					<p align="center" class="MsoNormal"><b><span>Rapport d’Audit<o:p></o:p></span></b></p>
					</td>
				</tr>
				<tr>
					<td width="143">
					<p class="auto-style4" style="page-break-after: avoid;">
					Référence<o:p></o:p></p>
					</td>
					<td colspan="2" width="401">
					<p class="auto-style4" style="page-break-after: avoid;">
					<span>FOR-QSE 010 c<o:p></o:p></span></p>
					</td>
				</tr>
				<tr>
					<td width="143">
					<p align="center" class="MsoNormal"><b>Page/pages</b><o:p></o:p></p>
					</td>
					<td width="267">
					<p class="auto-style4" style="page-break-after: avoid;">
					<span>&nbsp;01/02<o:p></o:p></span></p>
					</td>
					<td width="134">
					<p class="auto-style4" style="page-break-after: avoid;">Date
					d’application<span><o:p></o:p></span></p>
					</td>
					<td width="152">
					<p align="center" class="MsoNormal"><span>26/02/2013</span></p>
					</td>
				</tr>
			</table>
			<p align="center" class="MsoNormal"><b><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N°audit 22/14</span></b></p>
			<table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" width="639">
				<tr>
					<td colspan="5" valign="top" width="639">
					<p class="MsoNormal"><b><span lang="FR-CH">&nbsp;&nbsp;DOCUMENTS AUDITES<span>
					</span><o:p></o:p></span></b></p>
					<p class="MsoNormal"><span lang="FR-CH">Procédures &amp;
					Instructions du processus ;<o:p></o:p></span></p>
					<p class="MsoNormal"><b><span lang="FR-CH">&nbsp;&nbsp;ENTITE AUDITEE&nbsp;<o:p></o:p></span></b></p>
					<p class="MsoNormal">Sous-Processus Contrôle Qualité In Vitro (Microbiologique).<o:p></o:p></p>
					<p class="MsoNormal"><b><span lang="FR-CH">&nbsp;&nbsp;CHAMP DE L’AUDIT<o:p></o:p></span></b></p>
					<p class="MsoNormal"><span lang="FR-CH">Activités du processus.<o:p></o:p></span></p>
					<p class="MsoNormal"><b><span lang="FR-CH">&nbsp;&nbsp;Lieu de l’audit</span></b><span lang="FR-CH">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>
					</span><b>DATE DE L’AUDIT</b>&nbsp;: 01/04/14<o:p></o:p></span></p>
					<p class="MsoNormal"><span lang="FR-CH">Laboratoire de Microbiologie-.<o:p></o:p></span></p>
					<p class="MsoNormal"><b><span lang="FR-CH">&nbsp;&nbsp;OBJECTIF DE L’AUDIT&nbsp;<o:p></o:p></span></b></p>
					<p class="MsoNormal"><span lang="FR-CH">- S’assurer de la conformité du processus et de son efficacité dans le cadre de respect des normes requises; <o:p></o:p></span></p>
					<p class="MsoNormal"><span lang="FR-CH">- Formuler des propositions d’amélioration. <o:p></o:p></span></p>
					<p class="MsoNormal"><b><span lang="FR-CH">&nbsp;&nbsp;DIFFUSION DU RAPPORT D’AUDIT&nbsp;<o:p></o:p></span></b></p>
					<p class="MsoNormal">Mme BELSANY<o:p></o:p></p>
					<p class="MsoNormal">Mme Diyae<o:p></o:p></p>
					<p class="MsoNormal">D<sup>rs</sup><span> F.</span>FAKRI,L.RAFI, I. BELKOURATI <o:p></o:p></p>
					</td>
				</tr>
				<tr>
					<td colspan="5" valign="top" width="639">
					<p class="MsoNormal"><span lang="FR-CH"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Durée
					totale de l’audit du site&nbsp;:<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</span>2h00<o:p></o:p></span></p>
					</td>
				</tr>
				<tr>
					<td colspan="4" rowspan="4" valign="top" width="534">
					<p class="MsoNormal"><span lang="FR-CH">&nbsp;&nbsp;Sommaire du rapport<o:p></o:p></span></p>
					<p class="MsoNormal"><span lang="FR-CH"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</span>Page de garde et sommaire<o:p></o:p></span></p>
					<p class="MsoNormal"><span lang="FR-CH"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Note
					de synthèse et conclusion<o:p></o:p></span></p>
					<p class="MsoNormal"><span lang="FR-CH"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</span>Fiche d’écart (FOR-QSE 007)<o:p></o:p></span></p>
					</td>
					<td width="105">
					<p class="MsoNormal"><span lang="FR-CH">N° de page<o:p></o:p></span></p>
					</td>
				</tr>
				<tr>
					<td width="105">
					<p class="MsoNormal"><span lang="FR-CH">1<o:p></o:p></span></p>
					</td>
				</tr>
				<tr>
					<td width="105">
					<p class="MsoNormal"><span lang="FR-CH">2-3<o:p></o:p></span></p>
					</td>
				</tr>
				<tr>
					<td valign="top" width="105">
					<p class="MsoNormal"><span lang="FR-CH"><o:p>&nbsp;</o:p></span></p>
					</td>
				</tr>
				<tr>
					<td colspan="2" rowspan="2" valign="top" width="215">
					<p align="center" class="MsoNormal"><span lang="FR-CH">esponsable de
					l’entité auditée</span></p>
					</td>
					<td width="211">
					<p align="center" class="MsoNormal"><b><span lang="FR-CH">
					Nom<o:p></o:p></span></b></p>
					</td>
					<td colspan="2" width="213">
					<p align="center" class="MsoNormal"><b><span lang="FR-CH">
					Fonction<o:p></o:p></span></b></p>
					</td>
				</tr>
				<tr>
					<td width="211">
					<p align="center" class="MsoNormal"><span>Mme BELSANY</span></p>
					</td>
					<td colspan="2" width="213">
					<p align="center" class="MsoNormal"><span lang="FR-CH">Responsable Contrôle
					Qualité In Vitro</span></p>
					</td>
				</tr>
				<tr>
					<td colspan="2" rowspan="3" valign="top" width="215">
					<p align="center" class="MsoNormal"><span lang="FR-CH">Noms, fonctions des personnes rencontrées lors de l’audit</span></p>
					</td>
					<td width="211">
					<p align="center" class="MsoNormal"><b><span lang="FR-CH">
					Nom<o:p></o:p></span></b></p>
					</td>
					<td colspan="2" width="213">
					<p align="center" class="MsoNormal"><b><span lang="FR-CH">
					Fonction<o:p></o:p></span></b></p>
					</td>
				</tr>
				<tr>
					<td width="211">
					<p align="center" class="MsoNormal"><span lang="FR-CH">Y. NAOULI</span></p>
					</td>
					<td colspan="2" width="213">
					<p align="center" class="MsoNormal"><span lang="FR-CH">Sérologie</span></p>
					</td>
				</tr>
				<tr>
					<td width="211">
					<p align="center" class="MsoNormal"><span lang="FR-CH">A. ELARKAM<</span></p>
					</td>
					<td colspan="2" width="213">
					<p align="center" class="MsoNormal"><span lang="FR-CH">Contrôle Virologique/span></p>
					</td>
				</tr>
				<tr>
					<td colspan="5" valign="top" width="639">
					<p align="center" class="MsoNormal"><b><span lang="FR-CH">
					Composition</span></b><span lang="FR-CH"> <b>de l’équipe
					d’audit</b></span></p>
					</td>
				</tr>
				<tr>
					<td width="210">
					<p align="center" class="MsoNormal"><b><span lang="FR-CH">Fonction</span></b></p>
					</td>
					<td colspan="4" width="429">
					<p align="center" class="MsoNormal"><b><span lang="FR-CH">Nom</span></b></p>
					</td>
				</tr>
				<tr>
					<td width="210">
					<p align="center" class="MsoNormal"><span lang="FR-CH">Responsable d’audit</span></p>
					</td>
					<td colspan="4" width="429">
					<p align="center" class="MsoNormal"><span lang="EN-US">AKRI</span></p>
					</td>
				</tr>
				<tr>
					<td width="210">
					<p align="center" class="MsoNormal"><span lang="FR-CH">Auditeurs</span></p>
					</td>
					<td colspan="4" width="429">
					<p align="center" class="MsoNormal"><span>I. BELKOURATI</span></p>
					</td>
				</tr>
				<tr>
					<td width="210">
					<p align="center" class="MsoNormal"><span lang="FR-CH">Observateurs</span></p>
					</td>
					<td colspan="4" width="429">
					<p align="center" class="MsoNormal"><span>D.SAHRAOUI</span></p>
					<p align="center" class="MsoNormal"><span>L. RAFI</span><span lang="FR-CH"></span></p>
					</td>
				</tr>
				<tr>
					<td colspan="5" valign="top" width="639">
					<p class="MsoNormal"><span lang="FR-CH">&nbsp;&nbsp;Visa du responsable
					audit<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</span>Date&nbsp;:<span>&nbsp;&nbsp;&nbsp;&nbsp; </span>04 /<span>&nbsp;
					</span>04<span>&nbsp; </span>/ 2014<o:p></o:p></span></p>
					<p class="MsoNormal"><span lang="FR-CH"><o:p>&nbsp;</o:p></span></p>
					<p class="MsoNormal"><span lang="FR-CH"><o:p>&nbsp;</o:p></span></p>
					</td>
				</tr>
			</table>


			</center>
		</div>

			<!-- page 2   -->
		<div id="foo" style="display:none">
		<center>
			<table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" width="696">
				<tr>
					<td rowspan="2" width="143">
					<h6><span>
					<img height="51" src="../images/logomci.jpg" v:shapes="_x0000_i1025" width="116"></span><o:p></o:p></h6>
					</td>
					<td colspan="2" width="401">
					<p align="center" class="MsoNormal"><b><span>FORMULAIRE<o:p></o:p></span></b></p>
					</td>
					<td rowspan="3" width="152">
					<p align="center" class="MsoNormal"><b><i>Management<o:p></o:p></i></b></p>
					<p align="center" class="MsoNormal"><b><i>QSE<o:p></o:p></i></b></p>
					</td>
				</tr>
				<tr>
					<td colspan="2" width="401">
					<p align="center" class="MsoNormal"><b><span>Rapport d’Audit<o:p></o:p></span></b></p>
					</td>
				</tr>
				<tr>
					<td width="143">
					<p class="auto-style4" style="page-break-after: avoid;">
					Référence<o:p></o:p></p>
					</td>
					<td colspan="2" width="401">
					<p class="auto-style4" style="page-break-after: avoid;">
					<span>FOR-QSE 010 c<o:p></o:p></span></p>
					</td>
				</tr>
				<tr>
					<td width="143">
					<p align="center" class="MsoNormal"><b>Page/pages</b><o:p></o:p></p>
					</td>
					<td width="267">
					<p class="auto-style4" style="page-break-after: avoid;">
					<span>&nbsp;02/02<o:p></o:p></span></p>
					</td>
					<td width="134">
					<p class="auto-style4" style="page-break-after: avoid;">Date
					d’application<span><o:p></o:p></span></p>
					</td>
					<td width="152">
					<p align="center" class="MsoNormal"><span>26/02/2013<o:p></o:p></span></p>
					</td>
				</tr>
			</table>
			<p align="center" class="MsoNormal"><b><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N°audit 22/14</span></b></p>
			<table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" width="639">
				<tr>
					<td valign="top" width="639">
					<p class="MsoNormal"><span lang="FR-CH"><o:p></o:p></span></p>
					<p align="center" class="MsoNormal"><b><span lang="FR-CH">
					NOTE DE SYNTHESE&nbsp;: CONCLUSIONS<o:p></o:p></span></b></p>
					</td>
				</tr>
				<tr>
					<td width="639">
					<p class="MsoNormal"><span lang="FR-CH">Référentiel Chapitre <o:p></o:p>
					</span></p>
					</td>
				</tr>
				<tr>
					<td valign="top" width="639">
					<p class="MsoNormal"><span lang="FR-CH"><o:p>&nbsp;</o:p></span></p>
					<p class="MsoNormal"><span lang="FR-CH">&nbsp;&nbsp;Cet audit s’est axé
					sur le suivi<span>&nbsp; </span>des nouvelles tâches
					(contrôles sérologique et virologique) du contrôle in vitro</span></p>
					<p class="MsoNormal"><b><u><span lang="FR-CH">Points forts&nbsp;:<o:p></o:p></span></u></b></p>
					<ul type="disc">
						<li class="MsoNormal"><span lang="FR-CH">Propreté des
						locaux et du matériel&nbsp;;<o:p></o:p></span></li>
						<li class="MsoNormal"><span lang="FR-CH">Disponibilité
						du personnel et des documents&nbsp;;<o:p></o:p></span></li>
						<li class="MsoNormal"><span lang="FR-CH">Implication du
						personnel.</span></li>
					</ul>
					<p class="MsoNormal"><span lang="FR-CH"><o:p>&nbsp;</o:p></span></p>
					<b><u><span lang="FR-CH">Propositions d’amélioration&nbsp;:<o:p></o:p></span></u></b></p>
					<p class="MsoNormal"><span lang="FR-CH"><span>&nbsp;</span>DOCUMENTAIRE&nbsp;:<o:p></o:p></span></p>
					<p class="auto-style5" style="mso-list: l1 level1 lfo2"><![if !supportLists]>
					<span lang="FR-CH">Ø<span>&nbsp; </span></span><![endif]>
					<span lang="FR-CH">Actualiser la fiche de fonction de A.
					ELARKAM en ajoutant un remplaçant pour ses activités en
					biologie moléculaire&nbsp;; NON RETENU<o:p></o:p></span></p>
					<p class="auto-style5" style="mso-list: l1 level1 lfo2"><![if !supportLists]>
					<span lang="FR-CH">Ø<span>&nbsp; </span></span><![endif]>
					<span lang="FR-CH">Le formulaire de lecture des documents
					n’est pas renseigné&nbsp;;F<o:p></o:p></span></p>
					<p class="auto-style5" style="mso-list: l1 level1 lfo2"><![if !supportLists]>
					<span lang="FR-CH">Ø<span>&nbsp; </span></span><![endif]>
					<span lang="FR-CH">Dans la procédure PRO-CQVI 010, doit être
					ajouté le volet prélèvement des produits stériles. EN COURS
					(rédaction d’une procédure de délégation du prélévement<o:p></o:p></span></p>
					<p class="MsoNormal"><span lang="FR-CH"><o:p>&nbsp;</o:p></span></p>
					<p class="MsoNormal"><b><u><span lang="FR-CH">
					Ecarts&nbsp;mineurs:<o:p></o:p></span></u></b></p>
					<p class="MsoNormal"><span lang="FR-CH"><o:p>&nbsp;</o:p></span></p>
					<p class="MsoNormal"><span lang="FR-CH"><span>&nbsp; </span>
					DOCUMENTAIRE&nbsp;:<o:p></o:p></span></p>
					<p class="MsoNormal"><span lang="FR-CH"><o:p>&nbsp;</o:p></span></p>
					<p class="auto-style5" style="mso-list: l1 level1 lfo2"><![if !supportLists]>
					<span lang="FR-CH">Ø<span>&nbsp; </span></span><![endif]>
					<span lang="FR-CH">Le tableaux de bord n’est pas mis à
					jour&nbsp;; F<o:p></o:p></span></p>
					<p class="auto-style5" style="mso-list: l1 level1 lfo2"><![if !supportLists]>
					<span lang="FR-CH">Ø<span>&nbsp; </span></span><![endif]>
					<span lang="FR-CH">La FAP<span>&nbsp; </span>doit être mis à
					jour&nbsp;;<o:p></o:p></span></p>
					<p class="auto-style5" style="mso-list: l1 level1 lfo2"><![if !supportLists]>
					<span lang="FR-CH">Ø<span>&nbsp; </span></span><![endif]>
					<span lang="FR-CH">Le SOUS-PROCESSUS ne décrit pas
					l’ensemble des activités du laboratoire de contrôle in vitro
					(uniquement le contrôle bactériologique est décrit)&nbsp;; <o:p></o:p>
					</span></p>
					<p class="auto-style5" style="mso-list: l1 level1 lfo2"><![if !supportLists]>
					<span lang="FR-CH">Ø<span>&nbsp; </span></span><![endif]>
					<span lang="FR-CH">La fiche de fonction de FZ TAREK n’inclue
					pas ses activités sérologiques&nbsp;;<o:p></o:p></span></p>
					<p class="auto-style5" style="mso-list: l1 level1 lfo2"><![if !supportLists]>
					<span lang="FR-CH">Ø<span>&nbsp; </span></span><![endif]>
					<span lang="FR-CH">Le formulaire des enregistrements n’est
					pas renseigné&nbsp;;F<o:p></o:p></span></p>
					<p class="auto-style5" style="mso-list: l1 level1 lfo2"><![if !supportLists]>
					<span lang="FR-CH">Ø<span>&nbsp; </span></span><![endif]>
					<span lang="FR-CH">Pour les contrôles virologiques&nbsp;: de
					nombreuses instructions de travail restent à créer, dont
					l’instruction de titrage sur œufs<o:p></o:p></span></p>
					<p class="auto-style6"><span lang="FR-CH"><o:p>&nbsp;</o:p></span></p>
					<p class="MsoNormal"><span lang="FR-CH">VISITE DU
					LABORATOIRE DE SEROLOGIE<o:p></o:p></span></p>
					<p class="MsoNormal"><span lang="FR-CH">Une nette
					amélioration a été constatée.<o:p></o:p></span></p>
					<p class="MsoNormal"><span lang="FR-CH"><o:p>&nbsp;</o:p></span></p>
					</td>
				</tr>
			</table>

		</div>




			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM   5-->
			<!-- END PAGE HEADER-->
			<div class="clearfix">
			</div>
			<div class="row">
				<form class="acc-page">
			<div class="acc-page">
				<div class="col-md-12">



				</div>
			</div>
			</form>
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

</html>
