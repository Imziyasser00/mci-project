<!DOCTYPE html>
<html lang="fr"> 
<?php

    session_start();

    if (!isset($_SESSION['nom']) || !isset($_GET['num'])) {
        header("Location: 404.html");
    }
    else {
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
	$aud=$connexion->prepare('select id_auditeur from auditeurprevu where numero_audit=? and fonction="A"');
	$aud->execute(array($num));
	$objt = $aud->Fetch(PDO::FETCH_ASSOC);
	$A=$objt['id_auditeur'];
	
	$audO=$connexion->prepare('select id_auditeur from auditeurprevu where numero_audit=? AND fonction="O"');
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
													<label class="control-label col-md-13">Les activités et résultats audités satisfont aux dispositions préétablies ?   </label>
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
		<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Commentaires du Responsable MQSE sur le déroulement de l’audit : </h4>
						</div>
						<div class="portlet-body form">
						<form action="audit/addcom.php?num=<?php echo $num; ?>" method="post" class="form-horizontal form-bordered">
								<div class="form-body">								
								<div class="form-group has-error">
														<div class="col-md-11">
														<textarea id="maxlength_textarea" class="form-control" maxlength="225" rows="2" placeholder="Un maximum de 225 caractères" name="reps1"></textarea>
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
						<a href="javascript:;" id="Acc">Fiche n° <?php echo $num; ?></a>
						
					</li>
									
				</ul>
				<div class="page-toolbar">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
						Actions <i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
						<?php
						
						$tot1=$connexion->prepare('select * from fichecomqse where id_fiche=? and vop=1');
						$tot1->execute(array($id_fiche));
						$verif1=$tot1->rowcount();
						
						
						$tot=$connexion->prepare('select * from fichecompet where id_fiche=?');
						$tot->execute(array($id_fiche));
						$verif=$tot->rowcount();						
						
							if(getIdUser($RA)==$id){
								if($verif1==0){
								if($verif==0){ 
							?>
							<li>
							
							<a href="#portlet-config" data-toggle="modal" class="config" id="Acc">Completer
								</a>
							<li>
								<a  data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="false">Modifier
								</a>	
								<ul>
							
							<?php 
								}
							elseif($verif!=0){ ?>
								<li>
								<a  data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="false">Modifier
								</a>
								<ul>
								
									<li>
										<a href="#portlet-config2" data-toggle="modal" class="config" id="Acc">Conclusion</a>
									</li>
							<?php }?>	
									<li>
										<a href="#portlet-config3" data-toggle="modal" class="config" id="Acc">Objectif de l'audit</a>
									</li>
									<li>
										<a href="#portlet-config4" data-toggle="modal" class="config" id="Acc"> Identification des documents de référence</a>
									</li>
									<li>
										<a href="#portlet-config5" data-toggle="modal" class="config" id="Acc"> Reunion </a>
									</li>
									
								</ul>
							</li>
							<?php 
							    }
							    }
							?>
							</li>
							<?php
							if($adp==1 || $adp==2){		
							if($verif1==0){ ?>
							<li> <a class="btn btn-fit-height green dropdown-toggle" href="#portlet-config7" data-toggle="modal" id="Acc">
							Commenter et valider</a>
						</li>
							<?php }
							else{
								?>
							<li> <a class="btn btn-fit-height red dropdown-toggle"  href="audit/annulqse.php?id_fiche=<?php echo $id_fiche;?>" data-toggle="modal" id="Acc">
							Annuler la validation</a>
						</li>
							<?php
							}
							} ?>
						
						<li class="divider">
							</li>	
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
		
			
			<h3 class="page-title">
			
			
			<center>
			<table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" style="width: 541px; height: 137px">
				<tr>
					<td rowspan="2" valign="top" width="142">
					<h6><span>&nbsp;
					<img height="51" src="../images/logomci.jpg" v:shapes="_x0000_s1026" width="100"></span></h6>
					</td>
					<td colspan="2" width="398" align="center">
					<h5><span><b>FORMULAIRE</b><o:p></o:p></span></h5>
					</td>
					<td rowspan="3" style="width: 148px">
					<p align="center" class="MsoNormal"><b><i><span>Management 
					QSE<o:p></o:p></span></i></b></p>
					</td>
				</tr>
				<tr>
					<td colspan="2" width="398">
					<p align="center" class="MsoNormal"><b><span>FICHE D’audit 
					INTERNE<o:p></o:p></span></b></p>
					</td>
				</tr>
				<tr>
					<td width="142">
					<p class="auto-style4" style="page-break-after: avoid;">
					Référence</p>
					</td>
					<td colspan="2" width="398">
					<p class="auto-style4" style="page-break-after: avoid;">
					<span>FOR-QSE 032 b<o:p></o:p></span></p>
					</td>
				</tr>
				<tr>
					<td width="142">
					<p align="center" class="MsoNormal"><b><span>Page/pages</span></b><span><o:p></o:p></span></p>
					</td>
					<td width="242">
					<p class="auto-style4" style="page-break-after: avoid;">
					<span>0</span><!--[if supportFields]><span> PAGE </span><![endif]-->
					<span>1</span><!--[if supportFields]><![endif]--><span>/01<o:p></o:p></span></p>
					</td>
					<td width="156">
					<p class="auto-style4" style="page-break-after: avoid;">Date 
					d’application<span><o:p></o:p></span></p>
					</td>
					<td style="width: 148px">
					<p align="center" class="MsoNormal"><span>26/02/2013<o:p></o:p></span></p>
					</td>
				</tr>
			</table><br><table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" style="width:495.0pt;margin-left:-12.6pt;border-collapse:collapse;border:none;
 mso-border-alt:thick-thin-small-gap windowtext 4.5pt;mso-yfti-tbllook:1184;
 mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid black;
 mso-border-insidev:.5pt solid windowtext" width="660">
				<tr>
		<?php 
		include_once 'bd.php';
		$selectall=$connexion->query("select date , objectif , idr from fichdaudit where audit_num='$num'");
		$objt = $selectall->Fetch(PDO::FETCH_ASSOC);
		$date = $objt['date'];
		$date = date_create($date);
		$date=date_format($date, 'd  / m / Y');
		$objectif = utf8_encode($objt['objectif']);
		$idr = utf8_encode($objt['idr']);
		?>
			<table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" style="width:495.0pt;margin-left:-12.6pt;border-collapse:collapse;border:none;
 mso-border-alt:thick-thin-small-gap windowtext 4.5pt;mso-yfti-tbllook:1184;
 mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid black;
 mso-border-insidev:.5pt solid windowtext" width="660">
				<tr>
					<td width="288">
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal"><span>&nbsp;&nbsp;Date de l’audit&nbsp;:&nbsp; <?php echo $date; ?><o:p></o:p></span></p>
					</td>
		<?php
																	include_once 'bd.php';
																	$req1=$connexion->query("select id_auditeur from auditeurprevu where numero_audit='$num' and fonction='RA'");	
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																		$r1=$obj['id_auditeur'];
																		
																			$SelectAuditeurPrevuNom=$connexion->query("select nom,prenom from auditeur where auditeur.id=$r1.");
																			$auditeurselect = $SelectAuditeurPrevuNom->Fetch(PDO::FETCH_ASSOC);
																				$auditeurs['nom']=$auditeurselect['nom'];
																						$auditeurs['prenom']=$auditeurselect['prenom'];
																								$auditeurs['complet']=$auditeurs['nom'].' '.$auditeurselect['prenom'];
																										$list=$auditeurs['complet'];
																			
																	}	
																	}
														?>
					<td colspan="2" width="372">
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal"><span>&nbsp;&nbsp;Responsable d’audit&nbsp;&nbsp;: &nbsp;&nbsp;<?php echo $list; ?><o:p></o:p></span></p>
					</td>
				</tr>
				<tr>
					<td colspan="3" width="660">
					<?php $req1=$connexion->query("select id_sservice from auditprevu where numero='$num'");	
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																		$r2=$obj['id_sservice'];
																			$Selectsservice=$connexion->query("select nom from sservice where id=$r2");
																					$sservice = $Selectsservice->Fetch(PDO::FETCH_ASSOC);
																						$sservicenom=$sservice['nom'];
																	}
																	}
															?>
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;line-height:normal"><span>&nbsp;&nbsp;Champ de 
					l’activité auditée&nbsp;&nbsp;: &nbsp;&nbsp;<b><i><?php echo utf8_encode($sservicenom); ?></i></b><o:p></o:p></span></p>
					<p class="MsoNormal" style="mso-margin-bottom-alt:auto;line-height:normal">
					<span><o:p>&nbsp;</o:p></span></p>
					</td>
				</tr>
				<tr>
					<td colspan="3" valign="top" width="660">
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;&nbsp;Objectifs de l’audit&nbsp;: <o:p></o:p></span>
					</p>
					<p align="center" class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal"><b><i><span>&nbsp;&nbsp;<?php echo $objectif;?><o:p></o:p></span></i></b></p>
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><span><o:p>&nbsp;</o:p></span></p>
					</td>
				</tr>
				<tr>
					<td colspan="3" valign="top" width="660">
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><span>&nbsp;&nbsp;&nbsp;&nbsp;Identification des documents de référence&nbsp;: <o:p></o:p></span>
					</p>
					<p align="center" class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;
  margin-bottom:0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:center;
  line-height:normal"><b><i><span>&nbsp;&nbsp;<?php echo $idr;?><o:p></o:p></span></i></b></p>
					</td>
				</tr>
				<tr><?php 
				$selectauditeurprevu=$connexion->query('select id,id_auditeur, fonction,numero_audit  from auditeurprevu where auditeurprevu.numero_audit="'.$num.'" order by id');
								// on stock les auditeurs dans une chaine de caractère .
							$list2='';
								while($auditeurs1 = $selectauditeurprevu->Fetch(PDO::FETCH_ASSOC)){
							$id=$auditeurs1['id'];
							$auditeurs['fonction']=$auditeurs1['fonction'];
							$auditeurs['id_auditeur']=$auditeurs1['id_auditeur'];
								$r1=$auditeurs['id_auditeur'];
								
									$SelectAuditeurPrevuNom=$connexion->query("select nom,prenom from auditeur where auditeur.id=$r1.");
										$auditeurselect = $SelectAuditeurPrevuNom->Fetch(PDO::FETCH_ASSOC);
											$auditeurs['nom']=$auditeurselect['nom'];
												$auditeurs['prenom']=$auditeurselect['prenom'];
													$auditeurs['complet']=$auditeurs['nom'].'.'.$auditeurselect['prenom'];
													$list2.='<br>&nbsp;'.$auditeurs['complet'];
								}
					?>
					<td colspan="2" valign="top" width="330">
				<?php 
				$selectauditee=$connexion->query('select id, id_utilisateur ,num_audit  from auditee where auditee.num_audit="'.$num.'" order by id');
								// on stock les auditeurs dans une chaine de caractère .
							$list3='';
								while($auditees1 = $selectauditee->Fetch(PDO::FETCH_ASSOC)){
														
							$auditees['id_utilisateur']=$auditees1['id_utilisateur'];
								$r3=$auditees['id_utilisateur'];								
									$SelectAuditeeNom=$connexion->query("select nom,prenom from utilisateur where utilisateur.id=$r3.");
										$auditeeselect = $SelectAuditeeNom->Fetch(PDO::FETCH_ASSOC);
											$audites['nom']=$auditeeselect['nom'];
												$audites['prenom']=$auditeeselect['prenom'];
													$audites['complet']=$audites['nom'].' '.$auditeeselect['prenom'];
													$list3.='<br>&nbsp;'.$audites['complet'];
								}
					?>
				<?php 
				$selectclosouhait=$connexion->query('select id, id_utilisateur ,num_audit  from presencecloture where presencecloture.num_audit="'.$num.'" order by id');
								// on stock les auditeurs dans une chaine de caractère .
							$list5='';
								while($souhaites = $selectclosouhait->Fetch(PDO::FETCH_ASSOC)){
														
							$souhaite['id_utilisateur']=$souhaites['id_utilisateur'];
								$r5=$souhaite['id_utilisateur'];								
									$Selectsouhaite=$connexion->query("select nom , prenom from utilisateur where utilisateur.id=$r5");
										$souhaitess = $Selectsouhaite->Fetch(PDO::FETCH_ASSOC);
											$souhaitessss['nom']=$souhaitess['nom'];
												$souhaitessss['prenom']=$souhaitess['prenom'];
													$souhaitessss['complet']=$souhaitess['nom'].' '.$souhaitess['prenom'];
													$list5.='<br>&nbsp;'.$souhaitessss['complet'].'  ';
								}
					?>
				<?php 
				$selectousouhait=$connexion->query('select id, id_utilisateur ,num_audit  from presenceouverture where presenceouverture.num_audit="'.$num.'" order by id');
								// on stock les auditeurs dans une chaine de caractère .
							$list6='';
								while($souhaites = $selectousouhait->Fetch(PDO::FETCH_ASSOC)){
														
							$souhaite['id_utilisateur']=$souhaites['id_utilisateur'];
								$r6=$souhaite['id_utilisateur'];								
									$Selectsouhaite=$connexion->query("select nom , prenom from utilisateur where utilisateur.id=$r6");
										$souhaitess = $Selectsouhaite->Fetch(PDO::FETCH_ASSOC);
											$souhaitessss['nom']=$souhaitess['nom'];
												$souhaitessss['prenom']=$souhaitess['prenom'];
													$souhaitessss['complet']=$souhaitess['nom'].' '.$souhaitess['prenom'];
													$list6.='<br>&nbsp;'.$souhaitessss['complet'].'  ';
								}
					?>
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><b><span>&nbsp;&nbsp;&nbsp;&nbsp;Auditeurs</span></b><span> : <b><i><?php echo $list2; ?></i></b><o:p></o:p></span></p>
					
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;Responsable&nbsp;: <o:p></o:p></span></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;Visa&nbsp;:<o:p></o:p></span></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span><o:p>&nbsp;</o:p></span></p>
					</td>
					<td valign="top" width="330">
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><b><span>&nbsp;&nbsp;&nbsp;&nbsp;Audités </span></b><span>: <b><i>&nbsp;<?php echo $list3; ?></i></b><o:p></o:p></span></p>
				
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbspResponsable&nbsp;: <o:p></o:p></span></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;Visa&nbsp;:<o:p></o:p></span></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span><o:p>&nbsp;</o:p></span></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span><o:p>&nbsp;</o:p></span></p>
					</td>
				</tr>
				<tr><?php
				$selectouverture=$connexion->query("select date , time from reunionouverture where numero='$num'");
				$ouverture = $selectouverture->Fetch(PDO::FETCH_ASSOC);
				$dateo=$ouverture['date'];
				$time=$ouverture['time'];
				?>
				<?php
				$selectcloture=$connexion->query("select date , time from reunioncloture where numero='$num'");
				$cloture = $selectcloture->Fetch(PDO::FETCH_ASSOC);
				$dateclo=$cloture['date'];
				$timeclo=$cloture['time'];
				?>
					<td colspan="2" valign="top" width="330">
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><b><span>&nbsp;&nbsp;Réunion d’ouverture : <o:p></o:p></span></b></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><b><span><o:p>&nbsp;</o:p></span></b></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;Date&nbsp;: <b><i><?php echo $dateo; ?></i></b><o:p></o:p></span></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;Heure&nbsp;: <b><i><?php echo $time; ?></i></b><o:p></o:p></span></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span><o:p>&nbsp;</o:p></span></p>
					</td>
					<td valign="top" width="330">
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><b><span>Présence souhaitée de&nbsp;: <o:p></o:p></span></b></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><b><i><span><?php echo $list6; ?> <o:p></o:p></span>
					</i></b></p>				
					</td>
				</tr>
				<tr>
					<td colspan="2" valign="top" width="330">
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><b><span>&nbsp;&nbsp;Réunion de clôture : <o:p></o:p></span></b></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><b><span><o:p>&nbsp;</o:p></span></b></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;Date&nbsp;&nbsp;: &nbsp;<b><i><?php echo $dateclo; ?></i></b><o:p></o:p></span></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span>&nbsp;Heure&nbsp;&nbsp;:&nbsp;<b><i><?php echo $timeclo; ?></i></b><o:p></o:p></span></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span><o:p>&nbsp;</o:p></span></p>
					</td>
					<td valign="top" width="330">
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><b><span>Présence souhaitée de&nbsp;: <o:p></o:p></span></b></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><b><i><span<?php echo $list5; ?><o:p></o:p></span>
					</i></b></p>
					
					</td>
				</tr>
				<tr>
			<?php
			if($verif!=0){
			$comp=$connexion->prepare('select * from fichecompet where id_fiche=?');
			$comp->execute(array($id_fiche));
			$valcomp = $comp->Fetch(PDO::FETCH_ASSOC);
			$rep1=$valcomp['reponse1'];
			$rep2=$valcomp['reponse2'];
			$comp2=$connexion->prepare('select * from fichecomqse where id_fiche=?');
			$comp2->execute(array($id_fiche));
			$valcomp2 = $comp2->Fetch(PDO::FETCH_ASSOC);
			$rep3=utf8_encode($valcomp2['commentaire']);
			}
			else{
			$rep1='';
			$rep2='';	
			$rep3='';	
			}
			?>
					<td colspan="3" valign="top" width="660">
					<p class="MsoNormal" style="margin-top:6.0pt;mso-margin-bottom-alt:auto;
  text-align:justify;line-height:normal"><b><span>Conclusions de l'auditeur vis 
					à vis de l'activité auditée&nbsp;: <o:p></o:p></span></b></p>
					<p class="MsoNormal" style="mso-margin-bottom-alt:auto;text-align:justify;
  line-height:normal"><span>Les activités et résultats audités satisfont aux 
					dispositions préétablies ?&nbsp;&nbsp; <o:p></o:p></span>
					</p>
					<p class="MsoNormal" style="mso-margin-bottom-alt:auto;text-align:justify;
  line-height:normal"><b><i><span><?php echo $rep1; ?>.<o:p></o:p></span></i></b></p>
					<p class="MsoNormal" style="mso-margin-bottom-alt:auto;text-align:justify;
  line-height:normal"><span>Ces dispositions sont mises en œuvre de façon 
					efficace et aptes à atteindre les objectifs?<o:p></o:p></span></p>
				<p class="MsoNormal" style="mso-margin-bottom-alt:auto;text-align:justify;
  line-height:normal"><b><i><span><?php echo $rep2; ?>.<o:p></o:p></span></i></b></p>
					</td>
				</tr>
				<tr>
					<td colspan="3" valign="top" width="660">
					<p class="MsoNormal" style="margin-top:6.0pt;margin-right:0cm;margin-bottom:
  0cm;margin-left:0cm;margin-bottom:.0001pt;text-align:justify;line-height:
  normal"><b><span>Commentaires du Responsable MQSE&nbsp;sur le déroulement de 
					l’audit : <o:p></o:p></span></b></p>
					<p class="MsoNormal" style="mso-margin-bottom-alt:auto;text-align:justify;
  line-height:normal"><b><span><?php echo $rep3; ?> .<o:p></o:p></span></b></p>
					<p class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:
  justify;line-height:normal"><span><o:p>&nbsp;</o:p></span></p>
					</td>
				</tr>
			
			</table>
			</h3></center>
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modification  : </h4>
						</div>
						
							<h3 class="modal-title"><font size="2p">Conclusions de l'auditeur vis à vis de l'activité auditée  : </font></h3>
						
						<div class="portlet-body form">
						<form action="audit/modconcusion.php?num=<?php echo $num; ?>" method="post" class="form-horizontal form-bordered">
								<div class="form-body">								
								<div class="form-group has-error">
													<label class="control-label col-md-13">Les activités et résultats audités satisfont aux dispositions préétablies ? </label>
													<div class="col-md-11">
														<textarea id="maxlength_textarea" class="form-control" maxlength="225" rows="2"  name="reps1"><?php echo $rep1; ?></textarea>
															<span class="help-block">
															</span>
														</div>
									</div>	
								
								<div class="form-group has-error">
													<label class="control-label col-md-13">Les activités et résultats audités satisfont aux dispositions préétablies ?   </label>
													<div class="col-md-11">
														<textarea id="maxlength_textarea" class="form-control" maxlength="225" rows="2"  name="reps2"><?php echo $rep2; ?></textarea>
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
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM     2-->
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM 3-->
			<div class="modal fade" id="portlet-config3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modification  : </h4>
						</div>
						
							
						
						<div class="portlet-body form">
						<form action="audit/modobj.php?num=<?php echo $num; ?>" method="post" class="form-horizontal form-bordered">
								<div class="form-body">								
								<div class="form-group has-error">
													<label class="control-label col-md-13">Objectif de l'audit :</label>
													<div class="col-md-11">
														<textarea id="maxlength_textarea" class="form-control" maxlength="225" rows="2"  name="reps1"><?php echo $rep1; ?></textarea>
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
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM--3>
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM 4-->
			<div class="modal fade" id="portlet-config4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modification  : </h4>
						</div>
						
							
						
						<div class="portlet-body form">
						<form action="audit/modidr.php?num=<?php echo $num; ?>" method="post" class="form-horizontal form-bordered">
								<div class="form-body">								
								<div class="form-group has-error">
													<label class="control-label col-md-13">Identification des documents de référence : </label>
													<div class="col-md-11">
														<textarea id="maxlength_textarea" class="form-control" maxlength="225" rows="2"  name="reps1"><?php echo $rep1; ?></textarea>
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
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM   4-->
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM   5-->
			<div class="modal fade" id="portlet-config5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Choix de Reunion : </h4>
						</div>					
						<div class="portlet-body form">
						<form action="audit/modreuo.php?num=<?php echo $num; ?>" method="post" class="form-horizontal form-bordered">								
						
						<div class="form-group has-error">
									<div class="col-md-13">
														<div class="form-group">															
															<div class="radio-list">
																<label class="radio-inline">
																<input type="radio" name="optionsRadios" value="reunioncloture" checked> Réunion de clôture </label>
																<label class="radio-inline">
																<input type="radio" name="optionsRadios"  value="reunionouverture"> Réunion d'ouvertue </label>
															</div>
														</div>
										</div>
									</div>		
						
						
						<div class="form-group has-error">
										<label class="control-label col-md-3">Date</label>
										<div class="col-md-4">
											<input class="form-control" id="mask_date" type="text" name="dateo" value="" />
											<span class="help-block">
											jr/mm/aaaa </span>
										</div>
									</div>
						<div class="form-group  has-error">
										<label class="control-label col-md-3">Heure </label>
										<div class="col-md-3">
											<div class="input-group">
												<input type="text" id="clockface_2" value="" name="time" class="form-control" readonly=""/>
												<span class="input-group-btn">
												<button class="btn default" type="button" id="clockface_2_toggle"><i class="fa fa-clock-o"></i></button>
												</span>
											</div>
										</div>
									</div>
						<div class="form-group has-error">
															<label class="control-label col-md-3">Présence souhaitée  : </label>
															<div class="col-md-4">
																<select multiple="multiple" class="multi-select" id="my_multi_select2" name="reunionouverture[]">
																	<?php
																	include_once 'bd.php';
																	$req2=$connexion->query("select id, prenom, nom from utilisateur order by nom");
																	$nbr1=$req2->rowcount();
																	if($nbr1!=0){
																	while  ($obj1 = $req2->Fetch(PDO::FETCH_ASSOC)) 
																	{
																	$id=$obj1['id'];
																	$ret=$obj1['nom'];
																	$ret2=$obj1['prenom'];
																	echo '<option value="'.$id.'">'.$ret.' '.$ret2.'</option>';
																	?>																	
																	 <?php } } ?>
																	 </select>
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
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM   5-->		
	
			
					
					
			
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
<?php
if(isset($_GET['ps'])){
	
	if($_GET['ps']==1){
	echo '<script language="javascript" type="text/javascript">
       alert("Mot de passe modifié");</script>';
	}
	elseif($_GET['ps']==3){
	echo '<script language="javascript" type="text/javascript">
       alert("Document supprimer");</script>';
	}
	elseif($_GET['ps']==4){
	echo '<script language="javascript" type="text/javascript">
       alert("Utilisateur supprimer");</script>';
	}
	}
	}
?>
</html>
