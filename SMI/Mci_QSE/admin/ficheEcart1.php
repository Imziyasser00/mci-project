<!DOCTYPE html>
<html lang="fr"> 
<?php	

    session_start();

    if (!isset($_SESSION['nom']) || !isset($_GET['id'])) {
        header("Location: 404.html");
    }
    else {
	$prenom = $_SESSION['prenom'];
	$id = $_SESSION['id'];
		$openfrom=1;
	$nom = $_SESSION['nom'];
	$service = $_SESSION['ids'];
	$adp=$_SESSION['adp'];
	include_once 'bd.php';
	$servname=$connexion->query("select nom from service where service.id=$service");
	$objser = $servname->Fetch(PDO::FETCH_ASSOC);
	$Sname=$objser['nom'];
	$idEm=$_GET['id'];
	//idN : id notification
	$idN="";
	if(isset($_GET['idN'])){
	$idN=$_GET['idN'];
	}
	else{
	$selectidN=$connexion->query("select id from notificationficheecart where notificationficheecart.id_point=$idEm");
	$objidN = $selectidN->Fetch(PDO::FETCH_ASSOC);
	$idN=$objidN['id'];	
	}
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
function sservice($nom)
							{
								if($nom=="Controle in-Vivo"){
									return "Contrôle in-Vivo";
								}
								elseif($nom=="Controle Physico-Chimique"){
									return "Contrôle Physico-Chimique";
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
$selEcart=$connexion->query('select * from point where id='.$idEm.'');
									$obcount=$selEcart->rowcount();
									if($obcount!=0){
									while($ob = $selEcart->Fetch(PDO::FETCH_ASSOC)){
									$comOb=$ob['commentaire'];
									}
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

</style>
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
	<form action="EcartM.php?id=<?php echo $idEm;?><?php if (isset($_GET['idN'])){echo '&idN='.$idN; }?>" method="post" class="form-horizontal form-bordered">
	<div class="page-content-wrapper">
		<div class="page-content">
			
		<?php
		$servname=$connexion->query("select nom from service where service.id=$service");
		?>
			
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			<center><span class="auto-style3">S</span><span class="auto-style2">ystème <b>M</b>anagement <b>I</b>ntégré</span><br>
			<center><small><font color="green">Qualité Sécurité et Environnement</font></small></center>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-file-o"></i>
						<a href="javascript:;" id="Acc">Ecart : <?php echo utf8_encode($comOb); ?></a>
						
					</li>
									
				</ul>
				
		
			
			<h3 class="page-title">
			<div class="page-toolbar">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
						Actions <i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
						<?php if($idN!=""){?>	
						<li>
							
							<button type="submit" name="enregistrer" class="btn btn-circle blue">Enregistrer</button>
									
						</li>
						<?php } ?>
						<li>
							
							<button type="submit" name="diffusion" class="btn btn-circle blue">Diffusion</button>
									
						</li>		
					
						</ul>
					</div>
				</div>
			</div>
			
			<center>
			<table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" style="width: 739px; height: 137px">
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
					<p align="center" class="MsoNormal"><b><span>FICHE D’AUDIT 
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
			</table><br><br><table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" style="width:495.0pt;margin-left:-12.6pt;border-collapse:collapse;border:none;
 mso-border-alt:thick-thin-small-gap windowtext 4.5pt;mso-yfti-tbllook:1184;
 mso-padding-alt:0cm 5.4pt 0cm 5.4pt;mso-border-insideh:.5pt solid black;
 mso-border-insidev:.5pt solid windowtext" width="660">
				<tr>
		
<head>
<style type="text/css">

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
table.MsoNormalTable
	{font-size:10.0pt;
	font-family:"Times New Roman",serif;
}
h6
	{margin-bottom:.0001pt;
	text-align:center;
	page-break-after:avoid;
	font-size:9.0pt;
	font-family:"Times New Roman",serif;
	color:blue;
	margin-left: 0cm;
	margin-right: 0cm;
	margin-top: 0cm;
}
h5
	{margin-bottom:.0001pt;
	text-align:center;
	page-break-after:avoid;
	font-size:18.0pt;
	font-family:"Times New Roman",serif;
	margin-left: 0cm;
	margin-right: 0cm;
	margin-top: 0cm;
}
 p.MsoNormal
	{margin-bottom:.0001pt;
	font-size:10.0pt;
	font-family:"Times New Roman",serif;
	margin-left: 0cm;
	margin-right: 0cm;
	margin-top: 0cm;
}
p.MsoHeading7
	{margin-bottom:.0001pt;
	text-align:center;
	page-break-after:avoid;
	font-size:10.0pt;
	font-family:"Times New Roman",serif;
	font-weight:bold;
	margin-left: 0cm;
	margin-right: 0cm;
	margin-top: 0cm;
}
p.MsoListParagraph
	{margin-top:0cm;
	margin-right:0cm;
	margin-bottom:0cm;
	margin-left:36.0pt;
	margin-bottom:.0001pt;
	font-size:10.0pt;
	font-family:"Times New Roman",serif;
	}
</style>
</head>
<?php
function testChecked($idEm,$valueas){
	try
			{
			$connexion = new PDO('mysql:host=localhost;dbname=mci', 'root', '');
				}
			catch(Exception $e)
				{
				die('Erreur : '.$e->getMessage());
				}
	$verfication=$connexion->query('SELECT * FROM `ecartm1` WHERE `Id_em`="'.$idEm.'" and `check`="'.$valueas.'" and  `on`="1"');

	$verif1=$verfication->rowcount();
	if($verif1!=0){
	return 'checked';
	}
	else{
		return '';
	}
}
$selectLT=$connexion->query('SELECT * FROM `effdate` WHERE `id_em`="'.$idEm.'"')
;			
$verif11=$selectLT->rowcount();					
	if($verif11!=0){						
								while  ($obj = $selectLT->Fetch(PDO::FETCH_ASSOC)){
									
								$effdate=$obj['text'];
								}
	}
	else{
		$effdate='';
	}
$selectLT=$connexion->query('SELECT * FROM `libtext` WHERE `id_em`="'.$idEm.'"')
;			
$verif11=$selectLT->rowcount();					
	if($verif11!=0){						
								while  ($obj = $selectLT->Fetch(PDO::FETCH_ASSOC)){
									
								$lebText=$obj['text'];
								
								}
	}
	else{
		$lebText='';
	}
$selectLT1=$connexion->query('SELECT * FROM `causetext` WHERE `id_em`="'.$idEm.'"')
;			
$verif11=$selectLT1->rowcount();					
	if($verif11!=0){						
								while  ($obj1 = $selectLT1->Fetch(PDO::FETCH_ASSOC)){
									
								$CauseText=$obj1['CauseText'];
								}
	}
	else{
		$CauseText='';
	}
$selectLT1=$connexion->query('SELECT * FROM `represp` WHERE `id_em`="'.$idEm.'"')
;			
$verif11=$selectLT1->rowcount();					
	if($verif11!=0){						
								while  ($obj1 = $selectLT1->Fetch(PDO::FETCH_ASSOC)){
									
								$repAction=$obj1['analyse'];
								}
	}
	else{
		$repAction='';
	}
	$selectLT1=$connexion->query('SELECT * FROM `refaction` WHERE `id_em`="'.$idEm.'"')
;			
$verif11=$selectLT1->rowcount();					
	if($verif11!=0){						
								while  ($obj1 = $selectLT1->Fetch(PDO::FETCH_ASSOC)){
									
								$refaction=$obj1['ref'];
								}
	}
	else{
		$refaction='';
	}
	$selectLT1=$connexion->query('SELECT * FROM `dateAction` WHERE `id_em`="'.$idEm.'"')
;			
$verif11=$selectLT1->rowcount();					
	if($verif11!=0){						
								while  ($obj1 = $selectLT1->Fetch(PDO::FETCH_ASSOC)){
									
								$dateAction=$obj1['dateAction'];
								}
	}
	else{
		$dateAction='';
	}
	$selectLT1=$connexion->query('SELECT * FROM `listaction` WHERE `id_em`="'.$idEm.'"')
;			
$verif11=$selectLT1->rowcount();					
	if($verif11!=0){						
								while  ($obj1 = $selectLT1->Fetch(PDO::FETCH_ASSOC)){
									
								$listaction=$obj1['listAcTION'];
								}
	}
	else{
		$listaction='';
	}
		$selectLT1=$connexion->query('SELECT * FROM `verifText` WHERE `id_em`="'.$idEm.'"')
;			
$verif11=$selectLT1->rowcount();					
	if($verif11!=0){						
								while  ($obj1 = $selectLT1->Fetch(PDO::FETCH_ASSOC)){
									
								$verifText=$obj1['verifText'];
								
								}
	}
	else{
		$verifText='';
	}
	
$verif1="disabled";												
$verif2="disabled";												
$verif3="disabled";												
$selectResponsable=$connexion->query('select * from point where id="'.$idEm.'"');
							
										
											while  ($obj = $selectResponsable->Fetch(PDO::FETCH_ASSOC)){
									
								$num=$obj['numero_audit'];
								}
								$selectauditeurprevuRA=$connexion->query('select id,id_auditeur, fonction,numero_audit  from auditeurprevu where auditeurprevu.numero_audit="'.$num.'" and fonction="1"');
								
								while($auditeurs1RA = $selectauditeurprevuRA->Fetch(PDO::FETCH_ASSOC)){
													
							$auditeursRA['id_auditeur']=$auditeurs1RA['id_auditeur'];
								$r1=$auditeursRA['id_auditeur'];
							
									$SelectAuditeurPrevuRANom=$connexion->query("select nom,prenom,id_utilisateur from auditeur where auditeur.id=$r1.");
										$RAselect = $SelectAuditeurPrevuRANom->Fetch(PDO::FETCH_ASSOC);
											$idUtilisateur=$RAselect['id_utilisateur'];
											$RA['nom']=$RAselect['nom'];
											
												$RA['prenom']=$RAselect['prenom'];
													if($RA['nom']==$nom && $RA['prenom']==$prenom){
									$verif1="";
								}
												$RA['complet']=substr($RA['prenom'],0,1).'.'.$RA['nom'];												
								}
								$selectall=$connexion->query('select date,id_ss from fichdaudit where audit_num="'.$num.'"');
		$objt = $selectall->Fetch(PDO::FETCH_ASSOC);
		$idss = $objt['id_ss'];
		$date = $objt['date'];
		$date = date_create($date);
		$date=date_format($date, 'd  / m / Y');
		
					$selectmail=$connexion->query('select mail from utilisateur where id='.$idUtilisateur.'');
		$objtt = $selectmail->Fetch(PDO::FETCH_ASSOC);
		$mailAuditeur=$objtt['mail'];
		
		$selectRauditee=$connexion->query('select id_utilisateur from respentaudite where respentaudite.num_audit="'.$num.'"');
						$Raaa='';	
						$fct='';						
								while($aRA = $selectRauditee->Fetch(PDO::FETCH_ASSOC)){							
								$r=$aRA['id_utilisateur'];								
															
									$SelectRaNom=$connexion->query("select nom , prenom , fonction , mail from utilisateur where utilisateur.id=$r");
									
										$aRAselect = $SelectRaNom->Fetch(PDO::FETCH_ASSOC);
										if($aRAselect!=0){
											$Raa['nom']=$aRAselect['nom'];
												$Raa['prenom']=$aRAselect['prenom'];
												if($Raa['nom']==$nom && $Raa['prenom']==$prenom){
									$verif2="";
								}
												$fct=$aRAselect['fonction'];
												$mail2=$aRAselect['nom'];
												$Raa['complet']=substr($aRAselect['prenom'],0,1).'.'.$aRAselect['nom'];
											$Raaa=$Raa['complet'];												
										}												
								}
				if($id==28){
					$verif3="";
				}
		
	//droit
	
		
?>
<input type="hidden" value="<?php echo $verif1;?>" name="verif1">
<input type="hidden" value="<?php echo $verif2;?>" name="verif2">
<input type="hidden" value="<?php echo $verif3;?>" name="verif3">
<input type="hidden" value="<?php echo $num;?>" name="num">
<input type="hidden" value="<?php echo $mail2;?>" name="mail2">
<input type="hidden" value="<?php echo $mailAuditeur;?>" name="mailAuditeur">
<table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" style="border-style: none; border-color: inherit; border-width: medium; width:706pt; margin-left:-12.6pt; border-collapse:collapse; mso-border-alt:thick-thin-small-gap windowtext 4.5pt; mso-yfti-tbllook:1184;
 mso-padding-alt:0cm 5.4pt 0cm 5.4pt; mso-border-insideh:.5pt solid black;
 mso-border-insidev:.5pt solid windowtext">

	<tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes">
		<td colspan="3" style="width:365.3pt;border:solid windowtext 1.5pt;
  padding:0cm 3.5pt 0cm 3.5pt" width="487">
		<p align="center" class="MsoNormal" style="text-align:center;mso-element:frame;
  mso-element-frame-hspace:7.05pt;mso-element-wrap:around;mso-element-anchor-vertical:
  page;mso-element-anchor-horizontal:margin;mso-element-left:-29.0pt;
  mso-element-top:128.75pt;mso-height-rule:exactly">
		<b style="mso-bidi-font-weight:
  normal"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt">FICHE D’ECART<o:p></o:p></span></b></p>
		</td>
		<td style="width:142.2pt;border:solid windowtext 1.5pt;
  border-left:none;mso-border-left-alt:solid windowtext 1.5pt;padding:0cm 3.5pt 0cm 3.5pt" valign="top" width="190">
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><b style="mso-bidi-font-weight:normal">
		<span style="font-size:11.0pt;
  mso-bidi-font-size:10.0pt">N°&nbsp;: <o:p></o:p></span></b></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><b style="mso-bidi-font-weight:normal">
		<span style="font-size:11.0pt;
  mso-bidi-font-size:10.0pt"><o:p>&nbsp;</o:p></span></b></p>
		</td>
	</tr>
	<tr style="mso-yfti-irow:1">
		<td colspan="4" style="width:507.5pt;border:solid windowtext 1.5pt;
  border-top:none;mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 3.5pt 0cm 3.5pt" valign="top" width="677">
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt">
		Référentiel&nbsp;:<o:p></o:p></span>
		</td>
	</tr>
	<tr style="mso-yfti-irow:2">
		<td colspan="4" style="width:507.5pt;border:solid windowtext 1.5pt;
  border-top:none;mso-border-top-alt:solid windowtext 1.5pt;padding:0cm 3.5pt 0cm 3.5pt" valign="top" width="677">
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><b style="mso-bidi-font-weight:normal">
		<span style="font-size:11.0pt;
  mso-bidi-font-size:10.0pt">LIBELLE DE L’ECART CONSTATE&nbsp;</span></b><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"> 
		concerne&nbsp;:<span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><input type="checkbox" name="lapplication" value="lapplication"  <?php echo testChecked($idEm,"lapplication"); ?> <?php echo $verif1; ?> >l’application<span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</span>&nbsp;<span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><input type="checkbox" name="documentation" value="documentation" <?php echo testChecked($idEm,'documentation'); ?>  <?php echo $verif1; ?> ></span>la documentation<o:p></o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly">
		<span style="font-size:11.0pt;mso-bidi-font-size:10.0pt">
		<span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"> 
		<input type="checkbox" name="Seuil" value="Seuil" <?php echo testChecked($idEm,'Seuil') ;?> <?php echo $verif1; ?> ></span><span style="mso-spacerun:yes">&nbsp;</span></span>Seuil de non-conformité<span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</span>
		<span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"> 
		<input type="checkbox" name="Audit" value="Audit"  <?php echo testChecked($idEm,'Audit'); ?>  <?php echo $verif1; ?>></span><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><span style="mso-spacerun:yes">&nbsp;
		</span></span>Audit<span style="font-size:11.0pt;
  mso-bidi-font-size:10.0pt"><span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</span></span>
		<span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"> 
		<input type="checkbox" name="Autres" value="Autres"  <?php echo testChecked($idEm,'Autres'); ?>  <?php echo $verif1; ?>></span><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt">
		</span>Autres&nbsp;: <o:p></o:p></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><o:p>&nbsp;</o:p></p>
		<p class="MsoListParagraph" style="margin-right:10.65pt;text-align:justify;
  text-indent:-18.0pt;line-height:150%;mso-list:l0 level1 lfo1"><textarea id="maxlength_textarea" class="form-control" maxlength="225" rows="2"  name="AutresText" <?php echo $verif1; ?>><?php echo utf8_encode($comOb);?></textarea><![if !supportLists]>
		<span lang="FR-CH" style="font-size:11.0pt;mso-bidi-font-size:10.0pt;line-height:
  150%;font-family:Wingdings;mso-fareast-font-family:Wingdings;mso-bidi-font-family:
  Wingdings;color:black;mso-ansi-language:FR-CH;mso-bidi-font-weight:bold;
  mso-bidi-font-style:italic"><span style="mso-list:Ignore"><span style="font:7.0pt &quot;Times New Roman&quot;">&nbsp;
		</span></span></span><![endif]><b><i>
		<span lang="FR-CH" style="font-size:11.0pt;mso-bidi-font-size:10.0pt;line-height:
  150%;color:black;mso-ansi-language:FR-CH"><o:p></o:p></span></i></b></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly">
		<span lang="FR-CH" style="font-size:11.0pt;mso-bidi-font-size:10.0pt;
  mso-ansi-language:FR-CH"><o:p>&nbsp;</o:p></span></p>
		</td>
	</tr>
	<tr style="mso-yfti-irow:3;height:40.1pt">
		<td style="width:166.1pt;border-top:none;border-left:
  solid windowtext 1.5pt;border-bottom:solid windowtext 1.5pt;border-right:
  solid windowtext 1.0pt;mso-border-top-alt:solid windowtext 1.5pt;mso-border-alt:
  solid windowtext 1.5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0cm 3.5pt 0cm 3.5pt;height:40.1pt" valign="top" width="221">
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly">
		<span lang="FR-CH" style="font-size:11.0pt;mso-bidi-font-size:10.0pt;
  mso-ansi-language:FR-CH">Nom <span style="color:navy">: <?php echo $RA['complet']; ?></span><o:p></o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly">
		<span lang="FR-CH" style="font-size:11.0pt;mso-bidi-font-size:10.0pt;
  mso-ansi-language:FR-CH"><o:p>&nbsp;</o:p></span></p>
		</td>
		<td style="width:153.55pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext 1.5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-top-alt:1.5pt;mso-border-left-alt:.5pt;mso-border-bottom-alt:1.5pt;
  mso-border-right-alt:.5pt;mso-border-color-alt:windowtext;mso-border-style-alt:
  solid;padding:0cm 3.5pt 0cm 3.5pt;height:40.1pt" valign="top" width="205">
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly">
		<span lang="FR-CH" style="font-size:11.0pt;mso-bidi-font-size:10.0pt;
  mso-ansi-language:FR-CH">Date&nbsp;: <b><?php echo $date; ?></b><o:p></o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly">
		<span lang="FR-CH" style="font-size:11.0pt;mso-bidi-font-size:10.0pt;
  mso-ansi-language:FR-CH"><o:p>&nbsp;</o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly">
		<span lang="FR-CH" style="font-size:11.0pt;mso-bidi-font-size:10.0pt;
  mso-ansi-language:FR-CH">Visa&nbsp;:<span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</span><o:p></o:p></span></p>
		</td>
		<td colspan="2" style="width:187.85pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.5pt;border-right:solid windowtext 1.5pt;
  mso-border-top-alt:solid windowtext 1.5pt;mso-border-left-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt;height:40.1pt" valign="top" width="250">
		<p class="MsoNormal" style="mso-layout-grid-align:none;text-autospace:none;
  mso-element:frame;mso-element-frame-hspace:7.05pt;mso-element-wrap:around;
  mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:exactly">
		<span lang="FR-CH" style="font-size:11.0pt;mso-bidi-font-size:10.0pt;mso-ansi-language:
  FR-CH">Réf. de l’exigence&nbsp;: <span style="mso-spacerun:yes">&nbsp;</span><span lang="FR-CH" style="font-size:11.0pt;mso-bidi-font-size:10.0pt;mso-ansi-language:
  FR-CH">BIO sécurité<input type="checkbox" name="BIO" value="BIO"  <?php echo testChecked($idEm,'BIO'); ?> <?php echo $verif1; ?>><span style="mso-spacerun:yes"></span>BPF<span style="mso-spacerun:yes">
		</span><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><input type="checkbox" name="BPF" value="BPF"  <?php echo testChecked($idEm,'BPF'); ?>  <?php echo $verif1; ?>></span>QSE<o:p></o:p></span></span><input type="checkbox" name="QSE" value="QSE" <?php echo testChecked($idEm,'QSE'); ?>  <?php echo $verif1; ?> ><span style="font-family:&quot;Arial&quot;,sans-serif"><o:p></o:p></span></p>
		</span> &nbsp;</p>

		</td>
	</tr>
	<tr style="mso-yfti-irow:4">
		<td colspan="4" style="width:507.5pt;border-top:none;
  border-left:solid windowtext 1.5pt;border-bottom:solid windowtext 1.0pt;
  border-right:solid windowtext 1.5pt;mso-border-top-alt:solid windowtext 1.5pt;
  mso-border-alt:solid windowtext 1.5pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt" valign="top" width="677">
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><b style="mso-bidi-font-weight:normal">
		<span style="font-size:11.0pt;
  mso-bidi-font-size:10.0pt">ANALYSE DE CAUSE <o:p></o:p></span></b></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><o:p>&nbsp;</o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><b style="mso-bidi-font-weight:normal">
		<span style="font-size:11.0pt;
  mso-bidi-font-size:10.0pt"><textarea id="maxlength_textarea" class="form-control" maxlength="225" rows="2"  name="CauseText" <?php echo $verif2; ?>><?php echo $CauseText; ?></textarea></span></b></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><b style="mso-bidi-font-weight:normal">
		<span style="font-size:11.0pt;
  mso-bidi-font-size:10.0pt"><o:p>&nbsp;</o:p></span></b></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly">
		<span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"> 
		<input type="checkbox" name="CORRECTION" value="CORRECTION" <?php echo $verif2; ?> <?php echo testChecked($idEm,'CORRECTION'); ?>></span><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt">
		<b style="mso-bidi-font-weight:
  normal">CORRECTION(S) <o:p></o:p></b></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly">
		<span style="font-size:11.0pt;mso-bidi-font-size:10.0pt">
		<span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"> 
		<input type="checkbox" name="ACTIONS" value="ACTIONS" <?php echo $verif2; ?> <?php echo testChecked($idEm,'ACTIONS'); ?> ></span>
		<b style="mso-bidi-font-weight:
  normal">ACTIONS CORRECTIVES PROPOSEES</b><o:p></o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><o:p>&nbsp;</o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><textarea id="maxlength_textarea" class="form-control" maxlength="225" rows="2"  name="repAction" <?php echo $verif2; ?>><?php echo $repAction; ?></textarea></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><o:p>&nbsp;</o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><o:p>&nbsp;</o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly; width: 828px;">
		<span lang="FR-CH" style="font-size:11.0pt;mso-bidi-font-size:10.0pt;
  mso-ansi-language:FR-CH">CHANGEMENT DOCUMENTAIRE&nbsp;:<span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"> 
		<input type="checkbox" name="CHANGEMENTNON" value="CHANGEMENTNON" <?php echo $verif2; ?> <?php echo testChecked($idEm,'CHANGEMENTNON'); ?> ></span></span></span><span lang="FR-CH" style="font-size:11.0pt;mso-bidi-font-size:10.0pt;mso-ansi-language:
  FR-CH"> Non<span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"> 
		<input type="checkbox" name="CHANGEMENTOUI" value="CHANGEMENTOUI" <?php echo $verif2; ?> <?php echo testChecked($idEm,'CHANGEMENTOUI'); ?> ></span></span> Oui<span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</span>Référence&nbsp;:&nbsp;&nbsp;<input type="text" name="refaction" value="<?php echo $refaction; ?>" <?php echo $verif2; ?>>	</p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly">
		<span lang="FR-CH" style="font-size:11.0pt;mso-bidi-font-size:10.0pt;
  mso-ansi-language:FR-CH"><o:p>&nbsp;</o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly">
		<span lang="FR-CH" style="font-size:11.0pt;mso-bidi-font-size:10.0pt;
  mso-ansi-language:FR-CH"><o:p>&nbsp;</o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly">
		<span lang="FR-CH" style="font-size:11.0pt;mso-bidi-font-size:10.0pt;
  mso-ansi-language:FR-CH"><span style="mso-spacerun:yes">&nbsp;</span><o:p></o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><o:p>&nbsp;</o:p></span></p>
		</td>
	</tr>
	<tr style="mso-yfti-irow:5;height:19.55pt">
	
		<td colspan="4" style="width:507.5pt;border-top:none;border-left:
  solid windowtext 1.5pt;border-bottom:solid windowtext 1.0pt;border-right:
  solid windowtext 1.5pt;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
  .5pt;mso-border-left-alt:1.5pt;mso-border-bottom-alt:.5pt;mso-border-right-alt:
  1.5pt;mso-border-color-alt:windowtext;mso-border-style-alt:solid;padding:
  0cm 3.5pt 0cm 3.5pt;height:19.55pt" width="677">
		<p class="MsoNormal" style="tab-stops:472.75pt;mso-element:frame;mso-element-frame-hspace:
  7.05pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt">Date cible&nbsp;:<span style="mso-spacerun:yes">&nbsp;
		</span><input type="text" name="dateAction" value="<?php echo $dateAction; ?> "<?php echo $verif2; ?>><span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		&nbsp;</span>Nom du responsable de l’action&nbsp;: <select name="listAcTION" <?php echo $verif2; ?>>
																	<option value="<?php echo $listaction; ?>"><?php echo $listaction; ?></option>
																	<?php
																	$req1=$connexion->query('select * from utilisateur ');
																	
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																		
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																	$n1=$obj['nom'];
																	$p1=$obj['prenom'];	
																	$id1=$obj['id'];
																	echo '<option value="'.$n1.' '.$p1.'">'.$n1.' '.$p1.'</option>';
																	?>
																
																	 <?php } } ?>
																</select></span></p>
		</td>
	</tr>
	<tr style="mso-yfti-irow:7">
		<td colspan="4" style="width:507.5pt;border-top:none;
  border-left:solid windowtext 1.5pt;border-bottom:solid windowtext 1.0pt;
  border-right:solid windowtext 1.5pt;mso-border-top-alt:solid windowtext 1.5pt;
  mso-border-alt:solid windowtext 1.5pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 3.5pt 0cm 3.5pt" valign="top" width="677">
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><b style="mso-bidi-font-weight:normal">
		<span style="font-size:11.0pt;
  mso-bidi-font-size:10.0pt">VERIFICATION DE LA REALISATION DE L'ACTION/CORRECTION  
		<o:p></o:p></span></b></p><br>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly">Effectué le &nbsp;:&nbsp;&nbsp;<input type="text" name="effdate" value="<?php echo $effdate; ?>" <?php echo $verif3; ?>>	
		</span>
 <span style="font-size:11.0pt;mso-bidi-font-size:10.0pt">Vérification 
		documentaire  
		<input type="checkbox" name="Vdocumentaire" value="Vdocumentaire"<?php echo $verif3; ?> <?php echo testChecked($idEm,'Vdocumentaire'); ?> ><span style="mso-spacerun:yes">&nbsp;
		</span>Audit complémentaire  
		<input type="checkbox" name="AuditC" value="AuditC" <?php echo $verif3; ?> <?php echo testChecked($idEm,'AuditC'); ?> ></span></p><br>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><b style="mso-bidi-font-weight:normal">
		<span style="font-size:11.0pt;
  mso-bidi-font-size:10.0pt">VERIFICATION DE L'EFFICACITE DE L'ACTION/CORRECTION 
		ET CONCLUSION<o:p></o:p></span></b></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><textarea id="maxlength_textarea" class="form-control" maxlength="225" rows="2"  name="verifText" <?php echo $verif3; ?>><?php echo $verifText;?></textarea></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><o:p>&nbsp;</o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><o:p>&nbsp;</o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><o:p>&nbsp;</o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt">La 
		non-conformité est levée pour&nbsp;: <o:p></o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt">
		<span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp; </span>Application
		<span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"> 
		<input type="checkbox" name="NApplication" value="NApplication" <?php echo $verif3; ?> <?php echo testChecked($idEm,'NApplication'); ?> ></span>
		<span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Documentation <span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"> 
		<input type="checkbox" name="NDocumentation" value="NDocumentation" <?php echo $verif3; ?> <?php echo testChecked($idEm,'NDocumentation'); ?>  ></span><span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;
		</span>Application et documentation <span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"> 
		<input type="checkbox" name="NDocApp" value="NDocApp" <?php echo $verif3; ?> <?php echo testChecked($idEm,'NDocApp'); ?> ></span></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><o:p>&nbsp;</o:p></span></p>
		<p class="MsoNormal" style="tab-stops:330.0pt;mso-element:frame;mso-element-frame-hspace:
  7.05pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt">
		<span style="mso-tab-count:1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</span><o:p></o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><o:p>&nbsp;</o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><o:p>&nbsp;</o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><o:p>&nbsp;</o:p></span></p>
		<p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:7.05pt;
  mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-left:-29.0pt;mso-element-top:128.75pt;mso-height-rule:
  exactly"><b style="mso-bidi-font-weight:normal">
		<span style="font-size:11.0pt;
  mso-bidi-font-size:10.0pt">Clôture&nbsp;:<span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
		&nbsp;<span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><input type="checkbox" name="Efficace" value="Efficace" <?php echo $verif3; ?> <?php echo testChecked($idEm,'Efficace'); ?> ></span></span></span><span style="font-size:11.0pt;mso-bidi-font-size:
  10.0pt"><span style="mso-spacerun:yes">&nbsp; </span>Efficace<span style="mso-spacerun:yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"> 
		<input type="checkbox" name="NEfficace" value="NEfficace" <?php echo $verif3; ?> <?php echo testChecked($idEm,'NEfficace'); ?> ></span>&nbsp; 
		</span>Non efficace</span></b><span style="font-size:11.0pt;mso-bidi-font-size:10.0pt"><o:p></o:p></span></p>
		</td>
	</tr>

</table>

			</h3></center>
			
</form>			
			

			
					
					
			
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
