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
	$id_session = $_SESSION['id'];
	$adp=$_SESSION['adp'];
	$num=$_GET['num'];		
include_once 'bd.php';	

$verification=$connexion->prepare("select * from diffusionaudit where num_audit=?");
$verification->execute(array($num));
$testeur=0;
while(  $test = $verification->Fetch(PDO::FETCH_ASSOC)){
	if($id_session == $test['id_utilisateur'] ){
		$testeur=1;
	}	
}
$verification2=$connexion->prepare("select id from auditeur where id_utilisateur=?");
$verification2->execute(array($id_session));
$testeur2=0;
$aud=$verification2->rowcount();
while(  $test2 = $verification2->Fetch(PDO::FETCH_ASSOC)){
	$id_aud=$test2['id'];
	}	
	
function verifierRA($id1,$num){
	try
			{
			$connexion = new PDO('mysql:host=localhost;dbname=mci', 'root', '');
				}
			catch(Exception $e)
				{
				die('Erreur : '.$e->getMessage());
				}
	$cnx=$connexion->prepare('select id from auditeurprevu where id_auditeur=? and numero_audit=? and fonction="1"');
   $cnx->execute(array($id1,$num));
   $rowcount=$cnx->rowcount();
  if($rowcount==0){
	  return false;  
  }
  else{
	  return true;
  }
}
if($aud!=0){
 $b=verifierRA($id_aud,$num);
 if($b==false){
	 $testeur2=0;
 }
 else{
	$testeur2=1; 
 }
 }
function fonction($fonction)
							{
								if($fonction=="1"){
									return "RA";
								}
								elseif($fonction=="2"){
									return "A";
								}
								elseif($fonction=="3"){
									return "O";
								}
								else {
									return "#Erreur";}
							}

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
  if (valide($id_session,$num)==0 and $testeur!=1 and $adp==0){
	  header("Location: 404.html");
  }
else{
	$nbrv=0;
}  
if($nbrv==0){

	$prenom = $_SESSION['prenom'];
	$nom = $_SESSION['nom'];
	$service = $_SESSION['ids'];
	$adp=$_SESSION['adp'];
	$openfrom=1;
	$servname=$connexion->query("select nom from service where service.id=$service");
	$objser = $servname->Fetch(PDO::FETCH_ASSOC);
	$Sname=$objser['nom'];
	$cs=0;
	
	/*$prp = $connexion->prepare("DELETE FROM fichdaudit WHERE audit_num=?");
	$prp2 = $connexion->prepare("DELETE FROM auditee WHERE num_audit=?");
	$prp->execute(array($num));
	$prp2->execute(array($num));*/
	

?>
<?php
echo("<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
    <meta charset="utf-8" />
    <title>MCI | Système Management Intégré</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
        type="text/css" />
    <link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css"
        href="../../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" />
    <link rel="stylesheet" type="text/css"
        href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" />
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.css" />
    <link rel="stylesheet" type="text/css"
        href="../../assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/typeahead/typeahead.css">
    <link rel="stylesheet" type="text/css"
        href="../../assets/global/plugins/bootstrap-select/bootstrap-select.min.css" />
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css" />
    <link rel="stylesheet" type="text/css"
        href="../../assets/global/plugins/jquery-multi-select/css/multi-select.css" />
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/clockface/css/clockface.css" />
    <link rel="stylesheet" type="text/css"
        href="../../assets/global/plugins/bootstrap-datepicker/css/datepicker3.css" />
    <link rel="stylesheet" type="text/css"
        href="../../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" type="text/css"
        href="../../assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css"
        href="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css"
        href="../../assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="../../assets/global/css/components.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/global/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css" />
    <link id="style_color" href="../../assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css" />
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
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

    .auto-style4 text {

        font-family: Times, New Roman, serif;

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
                                    <font size="2pt">Gestion des utilisateurs</font>
                                </a>
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
                                    <font size="2pt">Gestion des documents</font>
                                </a>
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
                                    <font size="2pt">Gestion des diffusions</font>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="listediff.php">
                                            <font size="2pt">Diffusions par service</font>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="listediffdoc.php">
                                            <font size="2pt">Diffusions par document</font>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="moddiff.php">
                                            <font size="2pt">Ajouter diffusion</font>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="moddiff2.php">
                                            <font size="2pt">Annuler diffusion</font>
                                        </a>
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

                <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">Conclusions de l'auditeur vis à vis de l'activité auditée :
                                </h4>
                            </div>
                            <div class="portlet-body form">
                                <form action="completer.php?num=<?php echo $num; ?>" method="post"
                                    class="form-horizontal form-bordered">
                                    <div class="form-body">
                                        <div class="form-group has-error">
                                            <label class="control-label col-md-13">Les activités et résultats audités
                                                satisfont aux dispositions préétablies ? </label>
                                            <div class="col-md-11">
                                                <textarea id="maxlength_textarea" class="form-control" maxlength="225"
                                                    rows="2" placeholder="Un maximum de 225 caractères"
                                                    name="reps1"></textarea>
                                                <span class="help-block">
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group has-error">
                                            <label class="control-label col-md-13">Ces dispositions sont mises en œuvre
                                                de façon
                                                efficace et aptes à atteindre les objectifs? </label>
                                            <div class="col-md-11">
                                                <textarea id="maxlength_textarea" class="form-control" maxlength="225"
                                                    rows="2" placeholder="Un maximum de 225 caractères"
                                                    name="reps2"></textarea>
                                                <span class="help-block">
                                                </span>
                                            </div>
                                        </div>


                                        <div class="modal-footer">
                                            <input type="hidden" name="id_fiche"
                                                value="<?php echo $id_fiche; ?>"></input>

                                            <input type="submit" class="btn blue" name="valider" value="Valider">
                                            <button type="button" class="btn default"
                                                data-dismiss="modal">annuler</button>
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
            <center><span class="auto-style3">S</span><span class="auto-style2">ystème <b>M</b>anagement
                    <b>I</b>ntégré</span><br>
                <center><small>
                        <font color="green">Qualité Sécurité et Environnement</font>
                    </small></center>
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
                    <button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown"
                        data-hover="dropdown" data-delay="1000" data-close-others="true">
                        Actions <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu pull-right" role="menu">
                        <?php if($testeur2==1){?>
                        <li>
                            <a data-toggle="dropdown" data-hover="dropdown" data-delay="1000"
                                data-close-others="false">Modifier
                            </a>
                            <ul>

                                <li>
                                    <a href="#portlet-config01" data-toggle="modal" class="config" id="Acc">Référentiel
                                        Chapitre</a>
                                </li>

                                <li>
                                    <a href="#portlet-config02" data-toggle="modal" class="config" id="Acc">CHAMP DE
                                        L’AUDIT</a>
                                </li>
                                <li>
                                    <a href="#portlet-config03" data-toggle="modal" class="config" id="Acc">Points
                                        forts</a>
                                </li>
                                <li>
                                    <a href="#portlet-config04" data-toggle="modal" class="config" id="Acc">Points à
                                        améliorer</a>
                                </li>
                                <li>
                                    <a href="#portlet-config05" data-toggle="modal" class="config" id="Acc">Ecarts
                                        mineurs</a>
                                </li>
                                <li>
                                    <a href="#portlet-config06" data-toggle="modal" class="config" id="Acc">Ecarts
                                        majeurs</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a data-toggle="dropdown" data-hover="dropdown" data-delay="1000"
                                data-close-others="false">Diffusions
                            </a>
                            <ul>
                                <li>
                                    <a href="rapport/diffusion.php?num=<?php echo $num; ?>">Diffusion / list</a>
                                </li>
                                <li>
                                    <a href="#send" data-toggle="modal" class="config" id="Acc">Diffusion / mail</a>
                                </li>
                            </ul>
                        </li>
                        <?php } ?>
                        <li>
                            <a data-toggle="dropdown" data-hover="dropdown" data-delay="1000"
                                data-close-others="false">Enregistrer
                            </a>
                            <ul>
                                <li>
                                    <a href="pdf/reg/gerrapport.php?num=<?php echo $num; ?>">pdf</a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
        <?php
		$selectall=$connexion->query("select lieu ,date ,id_ss, idr from fichdaudit where audit_num='$num'");
		$objt = $selectall->Fetch(PDO::FETCH_ASSOC);
		$date = $objt['date'];
		$date = date_create($date);
		$date=date_format($date, 'd  / m / Y');		
		$idr = utf8_encode($objt['idr']);
		$lieu=utf8_encode($objt['lieu']);
		$id_ss=$objt['id_ss'];
		$selectnomss=$connexion->query("select nom from sservice where id=$id_ss");
								$sservice = $selectnomss->Fetch(PDO::FETCH_ASSOC);
								$ssnom=utf8_encode($sservice ['nom']);
		$objectif='';
		$req13=$connexion->query("select objectif from objectifaudit where num_audit='$num'");	
																	$objobje=$req13->rowcount();
																	if($objobje!=0){
																		
																	while  ($objobje = $req13->Fetch(PDO::FETCH_ASSOC)) 
																	{
																	$objectifs=utf8_encode($objobje ['objectif']);
																	$objectifs=str_replace('?', '\'', $objectifs); 	
																	$objectif=$objectif.'																	
																<p align="center" class="MsoNormal" style="margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:left;line-height:normal"><b><i><span><o:p></o:p></span></i></b></p>
  <p class="MsoNormal"><span lang="FR-CH">&nbsp;&nbsp;-&nbsp;'.$objectifs.'</span></p>';
																	}
																	}
		$selectduree=$connexion->query("select duree from auditprevu where numero='$num'");
								$seldurr = $selectduree->Fetch(PDO::FETCH_ASSOC);
								$duree=$seldurr ['duree'];	
		$selectRauditee=$connexion->query('select id_utilisateur from respentaudite where respentaudite.num_audit="'.$num.'"');
						$Raaa='';	
						$fct='';						
								while($aRA = $selectRauditee->Fetch(PDO::FETCH_ASSOC)){							
								$r=$aRA['id_utilisateur'];								
															
									$SelectRaNom=$connexion->query("select nom , prenom ,fonction from utilisateur where utilisateur.id=$r");
									
										$aRAselect = $SelectRaNom->Fetch(PDO::FETCH_ASSOC);
										if($aRAselect!=0){
											$Raa['nom']=$aRAselect['nom'];
												$Raa['prenom']=$aRAselect['prenom'];
												$fct=$aRAselect['fonction'];
												$Raa['complet']=substr($aRAselect['prenom'],0,1).'.'.$aRAselect['nom'];
											$Raaa=$Raa['complet'];												
										}												
								}
		
		$lol='';
		$selectauditee=$connexion->query('select id_utilisateur from auditeefinal where auditeefinal.num_audit="'.$num.'" order by id');
							$tab=$selectauditee->rowcount();	
								while($auditees1 = $selectauditee->Fetch(PDO::FETCH_ASSOC)){
														
							$auditees['id_utilisateur']=$auditees1['id_utilisateur'];
								$rau=$auditees['id_utilisateur'];								
									$SelectAuditeeNom=$connexion->query("select nom, prenom, fonction from utilisateur where utilisateur.id=$rau.");
										$auditeeselect = $SelectAuditeeNom->Fetch(PDO::FETCH_ASSOC);
											$audites['nom']=$auditeeselect['nom'];
												$audites['prenom']=$auditeeselect['prenom'];
												$audites['fonction']=$auditeeselect['fonction'];
													$audites['complet']=$audites['nom'].' '.$auditeeselect['prenom'];
													$lol.='<tr>
					<td width="211">
					<p align="center" class="MsoNormal"><span lang="FR-CH">'.utf8_encode($audites['complet']).'</span></p>
					</td>
					<td colspan="2" width="213">
					<p align="center" class="MsoNormal"><span lang="FR-CH">'.utf8_encode($audites['fonction']).'</span></p>
					</td>
				</tr>';													
								}	
		$selectauditeurprevuRA=$connexion->query('select id,id_auditeur, fonction,numero_audit  from auditeurprevu where auditeurprevu.numero_audit="'.$num.'" and fonction="1"');
								
								while($auditeurs1RA = $selectauditeurprevuRA->Fetch(PDO::FETCH_ASSOC)){
													
							$auditeursRA['id_auditeur']=$auditeurs1RA['id_auditeur'];
								$r1=$auditeursRA['id_auditeur'];								
									$SelectAuditeurPrevuRANom=$connexion->query("select nom,prenom from auditeur where auditeur.id=$r1.");
										$RAselect = $SelectAuditeurPrevuRANom->Fetch(PDO::FETCH_ASSOC);
											$RA['nom']=$RAselect['nom'];
												$RA['prenom']=$RAselect['prenom'];
												$RA['complet']=substr($RA['prenom'],0,1).'.'.$RA['nom'];												
								}
								$listA='';
		$selectauditeurprevuA=$connexion->query('select id,id_auditeur, fonction,numero_audit  from auditeurprevu where auditeurprevu.numero_audit="'.$num.'" and fonction="2"');
								
								while($auditeurs1A = $selectauditeurprevuA->Fetch(PDO::FETCH_ASSOC)){
													
							$auditeursA['id_auditeur']=$auditeurs1A['id_auditeur'];
								$r1=$auditeursA['id_auditeur'];								
									$SelectAuditeurPrevuANom=$connexion->query("select nom,prenom from auditeur where auditeur.id=$r1.");
										$Aselect = $SelectAuditeurPrevuANom->Fetch(PDO::FETCH_ASSOC);
											$A['nom']=$Aselect['nom'];
												$A['prenom']=$Aselect['prenom'];
												$A['complet']=substr($A['prenom'],0,1).'.'.$A['nom'];
											$listA=$A['complet'].' , '.$listA;												
								}
								$listO='';
		$selectauditeurprevuO=$connexion->query('select id,id_auditeur, fonction,numero_audit  from auditeurprevu where auditeurprevu.numero_audit="'.$num.'" and fonction="3"');
								
								while($auditeurs1O = $selectauditeurprevuO->Fetch(PDO::FETCH_ASSOC)){
													
							$auditeursO['id_auditeur']=$auditeurs1O['id_auditeur'];
								$r1=$auditeursO['id_auditeur'];								
									$SelectAuditeurPrevuONom=$connexion->query("select nom,prenom from auditeur where auditeur.id=$r1.");
										$Oselect = $SelectAuditeurPrevuONom->Fetch(PDO::FETCH_ASSOC);
											$O['nom']=$Oselect['nom'];
												$O['prenom']=$Oselect['prenom'];
												$O['complet']=substr($O['prenom'],0,1).'.'.$O['nom'];
											$listO=$O['complet'].' , '.$listO;												
								}
								$showPF='';
		$selectPF=$connexion->query('select * from point where type ="fort" and numero_audit="'.$num.'"');
		while($PF = $selectPF->Fetch(PDO::FETCH_ASSOC)){
			$pointF=$PF['commentaire'];	
			$showPF=$showPF.'<li class="MsoNormal"><span lang="FR-CH">'.utf8_encode($pointF).'</span></li>';
			
		}
		$showPA='';
		$selectPA=$connexion->query('select * from point where type ="ameliorati" and numero_audit="'.$num.'"');
		while($PA = $selectPA->Fetch(PDO::FETCH_ASSOC)){
			$pointA=$PA['commentaire'];	
			$showPA=$showPA.'<p class="auto-style5" style="mso-list: l1 level1 lfo2">
					<span lang="FR-CH">Ø<span>&nbsp; </span></span>
					<span lang="FR-CH">'.utf8_encode($pointA).'</span></p>	';
			
		}
		//ref
		$showref='';
		$selectref=$connexion->query('select * from point where type ="ref" and numero_audit="'.$num.'"');
		while($ref = $selectref->Fetch(PDO::FETCH_ASSOC)){
			$pointref=$ref['commentaire'];	
			$showref=$showref.'<p class="auto-style5" style="mso-list: l1 level1 lfo2">
					<span lang="FR-CH">Ø<span>&nbsp; </span></span>
					<span lang="FR-CH">'.utf8_encode($pointref).'</span></p>	';
			
		}
		//champ
		$showchamp='';
		$selectchamp=$connexion->query('select * from point where type ="champ" and numero_audit="'.$num.'"');
		while($champ = $selectchamp->Fetch(PDO::FETCH_ASSOC)){
			$pointchamp=$champ['commentaire'];	
			$showchamp=$showchamp.''.utf8_encode($pointchamp).'';
			
		}
		//ecart mineur
		$showEm='';
		$selectEm=$connexion->query('select * from point where type ="ecart mine" and numero_audit="'.$num.'"');
		while($Em = $selectEm->Fetch(PDO::FETCH_ASSOC)){
			$pointEm=$Em['commentaire'];	
			$showEm=$showEm.'<p class="auto-style5" style="mso-list: l1 level1 lfo2">
					<span lang="FR-CH">Ø<span>&nbsp; </span></span>
					<span lang="FR-CH">'.utf8_encode($pointEm).'</span></p>	';
			
		}
		$showEma='';
		$selectEma=$connexion->query('select * from point where type ="ecart maje" and numero_audit="'.$num.'"');
		while($Ema = $selectEma->Fetch(PDO::FETCH_ASSOC)){
			$pointEma=$Ema['commentaire'];	
			$showEma=$showEma.'<p class="auto-style5" style="mso-list: l1 level1 lfo2">
					<span lang="FR-CH">Ø<span>&nbsp; </span></span>
					<span lang="FR-CH">'.utf8_encode($pointEma).'</span></p>	';
			
		}
		$selectdiff=$connexion->query('select id_utilisateur ,num_audit  from diffusionaudit where diffusionaudit.num_audit="'.$num.'"');
								// on stock les auditeurs dans une chaine de caractère .
							$list6='';
								while($diffaudits = $selectdiff->Fetch(PDO::FETCH_ASSOC)){
														
							$diffaudit['id_utilisateur']=$diffaudits['id_utilisateur'];
								$r6=$diffaudit['id_utilisateur'];								
									$Selectdiffaudit=$connexion->query("select nom , prenom from utilisateur where utilisateur.id=$r6");
										$souhaitess = $Selectdiffaudit->Fetch(PDO::FETCH_ASSOC);
											$souhaitessss['nom']=$souhaitess['nom'];
												$souhaitessss['prenom']=$souhaitess['prenom'];
													$souhaitessss['complet']=$souhaitess['nom'].' '.$souhaitess['prenom'];
													$comp=$souhaitessss['complet'];
													$list6.=$comp.';';
								}
		$selectdate=$connexion->query('select date from rapportcreeoupas where rapportcreeoupas.audit_num="'.$num.'"');
	
		while($dateselect = $selectdate->Fetch(PDO::FETCH_ASSOC)){
			$date2=$dateselect['date'];
			$date2 = date_create($date2);
			$date2=date_format($date2, 'd  / m / Y');	
			}
		
															?>


        <div id="foo2" style="display:block">
            <center>
                <table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" width="696">
                    <tr>
                        <td rowspan="2" width="143">
                            <h6><span>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<img height="51" src="../images/logomci.jpg"
                                        v:shapes="_x0000_i1025" width="116"></span>
                                <o:p></o:p>
                            </h6>
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
                            <p align="center" class="MsoNormal"><b><span>RAPPORT D’AUDIT<o:p></o:p></span></b></p>
                        </td>
                    </tr>
                    <tr>
                        <td width="143">
                            <p class="MsoNormal" style="page-break-after: avoid;">
                                Référence<o:p></o:p>
                            </p>
                        </td>
                        <td colspan="2" width="401">
                            <p class="MsoNormal" style="page-break-after: avoid;">
                                <span>FOR-QSE 010 c<o:p></o:p></span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td width="143">
                            <p align="center" class="MsoNormal"><b>Page/pages</b>
                                <o:p></o:p>
                            </p>
                        </td>
                        <td width="267">
                            <p class="MsoNormal" style="page-break-after: avoid;">
                                <span>&nbsp;01/02<o:p></o:p></span>
                            </p>
                        </td>
                        <td width="134">
                            <p class="MsoNormal" style="page-break-after: avoid;">Date
                                d’application<span>
                                    <o:p></o:p>
                                </span></p>
                        </td>
                        <td width="152">
                            <p align="center" class="MsoNormal"><span>26/02/2013</span></p>
                        </td>
                    </tr>
                </table>
                <p align="center" class="MsoNormal">
                    <b><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N°audit
                            <?php echo $num; ?></span></b></p>
                <table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" width="639">
                    <tr>
                        <td colspan="5" valign="top" width="639">
                            <p class="MsoNormal"><b><span lang="FR-CH">&nbsp;&nbsp;DOCUMENTS AUDITES<span>
                                        </span></span></b></p>
                            <p class="MsoNormal"><span lang="FR-CH">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $idr; ?></span>
                            </p>
                            <p class="MsoNormal"><b><span lang="FR-CH">&nbsp;&nbsp;ENTITE AUDITEE&nbsp;</span></b></p>
                            <p class="MsoNormal">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo sservice($ssnom); ?></p>
                            <p class="MsoNormal"><b><span lang="FR-CH">&nbsp;&nbsp;CHAMP DE L’AUDIT</span></b></p>
                            <p class="MsoNormal"><span lang="FR-CH">&nbsp;&nbsp;<?php echo $showchamp ;?>.</span></p>
                            <p class="MsoNormal"><b><span lang="FR-CH">&nbsp;&nbsp;LIEU DE L’AUDIT</span></b><span
                                    lang="FR-CH">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>
                                    </span><b>DATE DE L’AUDIT</b>&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $date ;?>
                                    <o:p></o:p></span></p>
                            <p class="MsoNormal"><span lang="FR-CH">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lieu;?></span>
                            </p>
                            <p class="MsoNormal"><b><span lang="FR-CH">&nbsp;&nbsp;OBJECTIF DE L’AUDIT&nbsp;<o:p></o:p>
                                        </span></b></p>
                            <?php echo $objectif; ?>
                            <p class="MsoNormal"><b><span lang="FR-CH">&nbsp;&nbsp;DIFFUSION DU RAPPORT D’AUDIT&nbsp;
                                        <o:p></o:p></span></b></p>
                            </p>
                            <p class="MsoNormal"><span lang="FR-CH">&nbsp;&nbsp;<?php echo $list6; ?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" valign="top" width="639">
                            <p class="MsoNormal"><span
                                    lang="FR-CH"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Durée
                                    totale de l’audit du site&nbsp;:<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </span><?php echo $duree; ?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" rowspan="4" valign="top" width="534">
                            <p class="MsoNormal"><span lang="FR-CH">&nbsp;&nbsp;Sommaire du rapport<o:p></o:p></span>
                            </p>
                            <p class="MsoNormal"><span
                                    lang="FR-CH"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </span>Page de garde et sommaire<o:p></o:p></span></p>
                            <p class="MsoNormal"><span
                                    lang="FR-CH"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>Note
                                    de synthèse et conclusion<o:p></o:p></span></p>
                            <p class="MsoNormal"><span
                                    lang="FR-CH"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                            <p class="MsoNormal"><span lang="FR-CH">
                                    <o:p>&nbsp;</o:p>
                                </span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="2" valign="top" width="215">
                            <p align="center" class="MsoNormal"><span lang="FR-CH">Responsable de
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
                            <p align="center" class="MsoNormal"><span><?php echo $Raaa;?></span></p>
                        </td>
                        <td colspan="2" width="213">
                            <p align="center" class="MsoNormal"><span
                                    lang="FR-CH"><?php echo utf8_encode($fct); ?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="<?php echo $tab+1;?>" valign="top" width="215">
                            <p align="center" class="MsoNormal"><span lang="FR-CH">Noms, fonctions des personnes
                                    rencontrées lors de l’audit</span></p>
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


                    <?php echo $lol; ?>
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
                            <p align="center" class="MsoNormal"><span lang="EN-US"><?php echo $RA['complet'];?></span>
                            </p>

                        </td>
                    </tr>
                    <tr>
                        <td width="210">
                            <p align="center" class="MsoNormal"><span lang="FR-CH">Auditeurs</span></p>
                        </td>
                        <td colspan="4" width="429">
                            <p align="center" class="MsoNormal"><span lang="EN-US"><?php echo $listA;?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td width="210">
                            <p align="center" class="MsoNormal"><span lang="FR-CH">Observateurs</span></p>
                        </td>
                        <td colspan="4" width="429">
                            <p align="center" class="MsoNormal"><span lang="EN-US"><?php echo $listO;?></span></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" valign="top" width="639">
                            <p class="MsoNormal"><span lang="FR-CH">&nbsp;&nbsp;Visa du responsable
                                    audit<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </span>Date&nbsp;:<span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $date2 ;?></span></p>
                            <p class="MsoNormal"><span lang="FR-CH">
                                    <o:p>&nbsp;</o:p>
                                </span></p>
                            <p class="MsoNormal"><span lang="FR-CH">
                                    <o:p>&nbsp;</o:p>
                                </span></p>
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
                                    &nbsp;&nbsp;&nbsp;&nbsp;<img height="51" src="../images/logomci.jpg"
                                        v:shapes="_x0000_i1025" width="116"></span>
                                <o:p></o:p>
                            </h6>
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
                            <p align="center" class="MsoNormal"><b><span>RAPPORT D'AUDIT<o:p></o:p></span></b></p>
                        </td>
                    </tr>
                    <tr>
                        <td width="143">
                            <p class="MsoNormal" style="page-break-after: avoid;">
                                Référence<o:p></o:p>
                            </p>
                        </td>
                        <td colspan="2" width="401">
                            <p class="MsoNormal" style="page-break-after: avoid;">
                                <span>FOR-QSE 010 c<o:p></o:p></span>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td width="143">
                            <p align="center" class="MsoNormal"><b>Page/pages</b>
                                <o:p></o:p>
                            </p>
                        </td>
                        <td width="267">
                            <p class="MsoNormal" style="page-break-after: avoid;">
                                <span>&nbsp;02/02<o:p></o:p></span>
                            </p>
                        </td>
                        <td width="134">
                            <p class="MsoNormal" style="page-break-after: avoid;">Date
                                d’application<span>
                                    <o:p></o:p>
                                </span></p>
                        </td>
                        <td width="152">
                            <p align="center" class="MsoNormal"><span>26/02/2013<o:p></o:p></span></p>
                        </td>
                    </tr>
                </table>
                <p align="center" class="MsoNormal">
                    <b><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;N°audit
                            <?php echo $num; ?></span></b></p>
                <table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" width="639">
                    <tr>
                        <td valign="top" width="639">
                            <p class="MsoNormal"><span lang="FR-CH">
                                    <o:p></o:p>
                                </span></p>
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
                            <?php echo utf8_encode($pointref) ; ?>
                            <p class="MsoNormal"><b><u><span lang="FR-CH">Points forts&nbsp;:<o:p></o:p></span></u></b>
                            </p>
                            <ul type="disc">
                                <?php echo $showPF; ?>
                            </ul>

                            <b><u><span lang="FR-CH">Propositions d’amélioration&nbsp;:<o:p></o:p></span></u></b></p>

                            <?php echo $showPA; ?>
                            <p class="MsoNormal"><b><u><span lang="FR-CH">Ecarts&nbsp;majeurs:<o:p></o:p></span></u></b>
                            </p>
                            <?php echo $showEma; ?>
                            <p class="MsoNormal"><b><u><span lang="FR-CH">Ecarts&nbsp;mineurs:<o:p></o:p></span></u></b>
                            </p>
                            <?php echo $showEm; ?>
                            <p class="auto-style6"><span lang="FR-CH">
                                    <o:p>&nbsp;</o:p>
                                </span></p>

                            <p class="MsoNormal"><span lang="FR-CH">
                                    <o:p>&nbsp;</o:p>
                                </span></p>
                        </td>
                    </tr>
                </table>

        </div>




        <!-- /.modal -->
        <!-- Référentiels chapitre model-->
        <div class="modal fade" id="portlet-config01" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Modification du référentiel chapitre : </h4>
                    </div>
                    <div class="portlet-body form">
                        <form action="rapport/modificationRef.php?num=<?php echo $num; ?>" method="post"
                            class="form-horizontal form-bordered">
                            <div class="form-body">
                                <?php 

								?>
                                <div class="form-group has-error">
                                    <label class="control-label col-md-13">Référentiels chapitre </label>
                                    <div class="col-md-11">
                                        <textarea id="maxlength_textarea" class="form-control" maxlength="225" rows="2"
                                            name="reps1"><?php echo utf8_encode($pointref);?></textarea>
                                        <span class="help-block">
                                        </span>
                                    </div>
                                </div>


                                <div class="modal-footer">

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
    <!-- Référentiels chapitre model-->
    <div class="modal fade" id="send" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Diffusion de rapport : </h4>
                </div>
                <div class="portlet-body form">
                    <form action="rapport/send.php?num=<?php echo $num; ?>" method="post"
                        class="form-horizontal form-bordered">
                        <div class="form-body">
                            <?php 

								?>
                            <div class="form-group has-error">
                                <label class="control-label col-md-4">Diffusions du rapport d'audit : </label>
                                <div class="col-md-6">
                                    <select name="mail" class="select2me form-control">
                                        <?php
																	include_once 'bd.php';
																	$req2=$connexion->query("select mail, prenom, nom from utilisateur order by id_service");
																	
																	$nbr1=$req2->rowcount();
																	if($nbr1!=0){
																	while  ($obj1 = $req2->Fetch(PDO::FETCH_ASSOC)) 
																	{
																	$mail=$obj1['mail'];
																	$ret=$obj1['nom'];
																	$ret2=$obj1['prenom'];
																	echo '<option value="'.$mail.'">'.$ret.' '.$ret2.'</option>';
																	?>
                                        <?php } } ?>
                                    </select>
                                    <span class="help-block">
                                    </span>
                                </div>

                            </div>


                            <div class="modal-footer">

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
    <!-- Référentiels chapitre model-->
    <div class="modal fade" id="portlet-config02" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Modification du champ de l'audit : </h4>
                </div>
                <div class="portlet-body form">
                    <form action="rapport/modificationChamp.php?num=<?php echo $num; ?>" method="post"
                        class="form-horizontal form-bordered">
                        <div class="form-body">
                            <?php 

								?>
                            <div class="form-group has-error">
                                <label class="control-label col-md-13">CHAMP DE L’AUDIT </label>
                                <div class="col-md-11">
                                    <textarea id="maxlength_textarea" class="form-control" maxlength="225" rows="2"
                                        name="champ"><?php echo $showchamp ;?></textarea>
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>


                            <div class="modal-footer">

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
    <!-- Point fort model-->
    <div class="modal fade" id="portlet-config03" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Modification des points forts : </h4>
                </div>
                <div class="portlet-body form">

                    <form action="rapport/modificationPf.php?num=<?php echo $num; ?>" method="post"
                        class="form-horizontal form-bordered">
                        <div class="form-body">
                            <?php 
								$i=0;
								$selectPF=$connexion->query('select * from point where type ="fort" and numero_audit="'.$num.'"');
								$rpw=$selectPF->rowcount();			
								while($PF = $selectPF->Fetch(PDO::FETCH_ASSOC)){
								$pointF=$PF['commentaire'];									
								$i++;
								$j=$i+1;
								if($i!=$rpw){
								
								?>

                            <div class="form-group has-error" id="<?php echo $i.'v'; ?>" style="display:block">
                                <label class="control-label col-md-13">Point fort </label><a href="#"
                                    onclick="toggle_visibility('<?php echo $i.'v'; ?>','<?php echo $i.'d'; ?>'),cleartext('text<?php echo $i; ?>');">
                                    <i class="fa fa-trash-o" id="<?php echo $i; ?>" style="visibility:visible"></i>

                                </a>
                                <div class="col-md-11">
                                    <textarea id="text<?php echo $i; ?>" class="form-control" maxlength="225" rows="2"
                                        name="pointF[]"><?php echo utf8_encode($pointF) ;?></textarea>
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group has-error" id="<?php echo $i.'d'; ?>" style="display:none">

                            </div>
                            <?php }
								else{
									?>
                            <div class="form-group has-error" id="<?php echo $i.'v'; ?>" style="display:block">
                                <label class="control-label col-md-13">Point fort </label><a href="#"
                                    onclick="toggle_visibility('<?php echo $i.'v'; ?>','<?php echo $i.'d'; ?>'),cleartext('text<?php echo $i; ?>');">
                                    <i class="fa fa-trash-o" id="<?php echo $i; ?>" style="visibility:visible"></i>
                                </a>
                                <a href="#"
                                    onclick="toggle_visibility('<?php echo $j.'v'; ?>','<?php echo $j.'d'; ?>'),toggle_visibility2('<?php echo 'ic1'.$i.'v'; ?>','<?php echo 'ic2'.$i.'v'; ?>'),cleartext('text<?php echo $j; ?>');">
                                    <i class="fa fa-plus" id="ic1<?php echo $i.'v'; ?>" style="visibility:visible"></i>
                                    <i class="fa fa-minus" id="ic2<?php echo $i.'v'; ?>" style="visibility:hidden"></i>
                                </a>
                                <div class="col-md-11">
                                    <textarea id="text<?php echo $i; ?>" class="form-control" maxlength="225" rows="2"
                                        name="pointF[]"><?php echo utf8_encode($pointF) ;?></textarea>
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group has-error" id="<?php echo $i.'d'; ?>" style="display:none">

                            </div>
                            <div class="form-group has-error" id="<?php echo $j.'v'; ?>" style="display:none">
                                <label class="control-label col-md-13">Nouveau point fort </label><a href="#"
                                    onclick="toggle_visibility('<?php echo $j.'v'; ?>','<?php echo $j.'d'; ?>'),cleartext('text<?php echo $j; ?>')">
                                    <i class="fa fa-trash-o" id="<?php echo $i; ?>" style="visibility:visible"></i>
                                </a>
                                <a href="#"
                                    onclick="toggle_visibility2('<?php echo 'ic1'.$i.'v'; ?>','<?php echo 'ic2'.$j.'v'; ?>'),cleartext('text<?php echo $j+1; ?>');">
                                </a>
                                <div class="col-md-11">
                                    <textarea id="text<?php echo $j; ?>" class="form-control" maxlength="225" rows="2"
                                        name="pointF[]"></textarea>
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group has-error" id="<?php echo $j.'d'; ?>" style="display:block">

                            </div>

                            <?php
								}
								} ?>
                            <div class="modal-footer">

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
    <!-- Point à ameliorer model-->
    <div class="modal fade" id="portlet-config04" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Modification des points à améliorer : </h4>
                </div>
                <div class="portlet-body form">
                    <form action="rapport/modificationPa.php?num=<?php echo $num; ?>" method="post"
                        class="form-horizontal form-bordered">
                        <div class="form-body">
                            <?php 
								$i=0;
								$selectPA=$connexion->query('select * from point where type ="ameliorati" and numero_audit="'.$num.'"');
								$row=$selectPA->rowcount();
		while($PA = $selectPA->Fetch(PDO::FETCH_ASSOC)){
			$pointA=$PA['commentaire'];	
								
								$i++;
								$j=$i+1;
								if($i!=$row){
								
								?>

                            <div class="form-group has-error" id="<?php echo $i.'vz'; ?>" style="display:block">
                                <label class="control-label col-md-13">Point à améliorer </label><a href="#"
                                    onclick="toggle_visibility('<?php echo $i.'vz'; ?>','<?php echo $i.'dz'; ?>'),cleartext('texta<?php echo $i; ?>');">
                                    <i class="fa fa-trash-o" id="<?php echo $i; ?>" style="visibility:visible"></i>

                                </a>
                                <div class="col-md-11">
                                    <textarea id="texta<?php echo $i; ?>" class="form-control" maxlength="225" rows="2"
                                        name="pointA[]"><?php echo  utf8_encode($pointA) ;?></textarea>
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group has-error" id="<?php echo $i.'dz'; ?>" style="display:none">

                            </div>
                            <?php }
								else{
									?>
                            <div class="form-group has-error" id="<?php echo $i.'vz'; ?>" style="display:block">
                                <label class="control-label col-md-13">Point à améliorer </label><a href="#"
                                    onclick="toggle_visibility('<?php echo $i.'vz'; ?>','<?php echo $i.'dz'; ?>'),cleartext('texta<?php echo $i; ?>');">
                                    <i class="fa fa-trash-o" id="<?php echo $i; ?>" style="visibility:visible"></i>
                                </a>
                                <a href="#"
                                    onclick="toggle_visibility('<?php echo $j.'vz'; ?>','<?php echo $j.'dz'; ?>'),toggle_visibility2('<?php echo 'ic1'.$i.'vz'; ?>','<?php echo 'ic2'.$i.'vz'; ?>'),cleartext('texta<?php echo $j; ?>');">
                                    <i class="fa fa-plus" id="ic1<?php echo $i.'vz'; ?>" style="visibility:visible"></i>
                                    <i class="fa fa-minus" id="ic2<?php echo $i.'vz'; ?>" style="visibility:hidden"></i>
                                </a>
                                <div class="col-md-11">
                                    <textarea id="texta<?php echo $i; ?>" class="form-control" maxlength="225" rows="2"
                                        name="pointA[]"><?php echo  utf8_encode($pointA) ;?></textarea>
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group has-error" id="<?php echo $i.'dz'; ?>" style="display:none">

                            </div>
                            <div class="form-group has-error" id="<?php echo $j.'vz'; ?>" style="display:none">
                                <label class="control-label col-md-13">Nouveau point à améliorer </label><a href="#"
                                    onclick="toggle_visibility('<?php echo $j.'vz'; ?>','<?php echo $j.'dz'; ?>'),cleartext('texta<?php echo $j; ?>')">
                                    <i class="fa fa-trash-o" id="<?php echo $i; ?>" style="visibility:visible"></i>
                                </a>
                                <a href="#"
                                    onclick="toggle_visibility2('<?php echo 'ic1'.$i.'vz'; ?>','<?php echo 'ic2'.$j.'vz'; ?>'),cleartext('texta<?php echo $j+1; ?>');">

                                </a>
                                <div class="col-md-11">
                                    <textarea id="texta<?php echo $j; ?>" class="form-control" maxlength="225" rows="2"
                                        name="pointA[]"></textarea>
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group has-error" id="<?php echo $j.'dz'; ?>" style="display:block">

                            </div>

                            <?php
								}
								} ?>
                            <div class="modal-footer">

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
    <!-- Point fort model-->
    <div class="modal fade" id="portlet-config05" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Modification des écarts mineurs : </h4>
                </div>
                <div class="portlet-body form">

                    <form action="rapport/modificationE.php?num=<?php echo $num; ?>" method="post"
                        class="form-horizontal form-bordered">
                        <div class="form-body">
                            <?php 
								$i=0;
								$selectEm=$connexion->query('select * from point where type ="ecart mine" and numero_audit="'.$num.'"');
								$rpw=$selectEm->rowcount();			
								while($Em = $selectEm->Fetch(PDO::FETCH_ASSOC)){						
								$pointEm=$Em['commentaire'];															
								$i++;
								$j=$i+1;
								if($i!=$rpw){
								
								?>

                            <div class="form-group has-error" id="<?php echo $i.'ve'; ?>" style="display:block">
                                <label class="control-label col-md-13">Ecart mineur </label><a href="#"
                                    onclick="toggle_visibility('<?php echo $i.'ve'; ?>','<?php echo $i.'de'; ?>'),cleartext('texte<?php echo $i; ?>');">
                                    <i class="fa fa-trash-o" id="<?php echo $i; ?>" style="visibility:visible"></i>

                                </a>
                                <div class="col-md-11">
                                    <textarea id="texte<?php echo $i; ?>" class="form-control" maxlength="225" rows="2"
                                        name="pointEm[]"><?php echo utf8_encode($pointEm) ;?></textarea>
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group has-error" id="<?php echo $i.'de'; ?>" style="display:none">

                            </div>
                            <?php }
								else{
									?>
                            <div class="form-group has-error" id="<?php echo $i.'ve'; ?>" style="display:block">
                                <label class="control-label col-md-13">Ecart mineur </label><a href="#"
                                    onclick="toggle_visibility('<?php echo $i.'ve'; ?>','<?php echo $i.'de'; ?>'),cleartext('texte<?php echo $i; ?>');">
                                    <i class="fa fa-trash-o" id="<?php echo $i; ?>" style="visibility:visible"></i>
                                </a>
                                <a href="#"
                                    onclick="toggle_visibility('<?php echo $j.'ve'; ?>','<?php echo $j.'de'; ?>'),toggle_visibility2('<?php echo 'ic1'.$i.'ve'; ?>','<?php echo 'ic2'.$i.'ve'; ?>'),cleartext('texte<?php echo $j; ?>');">
                                    <i class="fa fa-plus" id="ic1<?php echo $i.'ve'; ?>" style="visibility:visible"></i>
                                    <i class="fa fa-minus" id="ic2<?php echo $i.'ve'; ?>" style="visibility:hidden"></i>
                                </a>
                                <div class="col-md-11">
                                    <textarea id="texte<?php echo $i; ?>" class="form-control" maxlength="225" rows="2"
                                        name="pointEm[]"><?php echo utf8_encode($pointEm) ;?></textarea>
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group has-error" id="<?php echo $i.'de'; ?>" style="display:none">

                            </div>
                            <div class="form-group has-error" id="<?php echo $j.'ve'; ?>" style="display:none">
                                <label class="control-label col-md-13">Nouveau Ecart mineur </label><a href="#"
                                    onclick="toggle_visibility('<?php echo $j.'ve'; ?>','<?php echo $j.'de'; ?>'),cleartext('texte<?php echo $j; ?>')">
                                    <i class="fa fa-trash-o" id="<?php echo $i; ?>" style="visibility:visible"></i>
                                </a>
                                <a href="#"
                                    onclick="toggle_visibility2('<?php echo 'ic1'.$i.'ve'; ?>','<?php echo 'ic2'.$j.'ve'; ?>'),cleartext('texte<?php echo $j+1; ?>');">
                                </a>
                                <div class="col-md-11">
                                    <textarea id="texte<?php echo $j; ?>" class="form-control" maxlength="225" rows="2"
                                        name="pointEm[]"></textarea>
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group has-error" id="<?php echo $j.'de'; ?>" style="display:block">

                            </div>

                            <?php
								}
								} ?>
                            <div class="modal-footer">

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
    <!-- Point fort model-->
    <div class="modal fade" id="portlet-config06" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Modification des écarts majeurs : </h4>
                </div>
                <div class="portlet-body form">

                    <form action="rapport/modificationEma.php?num=<?php echo $num; ?>" method="post"
                        class="form-horizontal form-bordered">
                        <div class="form-body">
                            <?php 
								$i=0;
								$selectEma=$connexion->query('select * from point where type ="ecart maje" and numero_audit="'.$num.'"');
								$rpw=$selectEma->rowcount();			
								while($Ema = $selectEma->Fetch(PDO::FETCH_ASSOC)){
			$pointEma=$Ema['commentaire'];																
								$i++;
								$j=$i+1;
								if($i!=$rpw){
								
								?>

                            <div class="form-group has-error" id="<?php echo $i.'vem'; ?>" style="display:block">
                                <label class="control-label col-md-13">Ecart majeur </label><a href="#"
                                    onclick="toggle_visibility('<?php echo $i.'vem'; ?>','<?php echo $i.'dem'; ?>'),cleartext('textm<?php echo $i; ?>');">
                                    <i class="fa fa-trash-o" id="<?php echo $i; ?>" style="visibility:visible"></i>

                                </a>
                                <div class="col-md-11">
                                    <textarea id="textm<?php echo $i; ?>" class="form-control" maxlength="225" rows="2"
                                        name="pointEma[]"><?php echo utf8_encode($pointEma) ;?></textarea>
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group has-error" id="<?php echo $i.'dem'; ?>" style="display:none">

                            </div>
                            <?php }
								else{
									?>
                            <div class="form-group has-error" id="<?php echo $i.'vem'; ?>" style="display:block">
                                <label class="control-label col-md-13">Ecart majeur </label><a href="#"
                                    onclick="toggle_visibility('<?php echo $i.'vem'; ?>','<?php echo $i.'dem'; ?>'),cleartext('textm<?php echo $i; ?>');">
                                    <i class="fa fa-trash-o" id="<?php echo $i; ?>" style="visibility:visible"></i>
                                </a>
                                <a href="#"
                                    onclick="toggle_visibility('<?php echo $j.'vem'; ?>','<?php echo $j.'dem'; ?>'),toggle_visibility2('<?php echo 'ic1'.$i.'vem'; ?>','<?php echo 'ic2'.$i.'vem'; ?>'),cleartext('textm<?php echo $j; ?>');">
                                    <i class="fa fa-plus" id="ic1<?php echo $i.'vem'; ?>"
                                        style="visibility:visible"></i>
                                    <i class="fa fa-minus" id="ic2<?php echo $i.'vem'; ?>"
                                        style="visibility:hidden"></i>
                                </a>
                                <div class="col-md-11">
                                    <textarea id="textm<?php echo $i; ?>" class="form-control" maxlength="225" rows="2"
                                        name="pointEma[]"><?php echo utf8_encode($pointEma) ;?></textarea>
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group has-error" id="<?php echo $i.'dem'; ?>" style="display:none">

                            </div>
                            <div class="form-group has-error" id="<?php echo $j.'vem'; ?>" style="display:none">
                                <label class="control-label col-md-13">Nouveau Ecart majeur </label><a href="#"
                                    onclick="toggle_visibility('<?php echo $j.'vem'; ?>','<?php echo $j.'dem'; ?>'),cleartext('textm<?php echo $j; ?>')">
                                    <i class="fa fa-trash-o" id="<?php echo $i; ?>" style="visibility:visible"></i>
                                </a>
                                <a href="#"
                                    onclick="toggle_visibility2('<?php echo 'ic1'.$i.'vem'; ?>','<?php echo 'ic2'.$j.'vem'; ?>'),cleartext('textm<?php echo $j+1; ?>');">
                                </a>
                                <div class="col-md-11">
                                    <textarea id="textm<?php echo $j; ?>" class="form-control" maxlength="225" rows="2"
                                        name="pointEma[]"></textarea>
                                    <span class="help-block">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group has-error" id="<?php echo $j.'dem'; ?>" style="display:block">

                            </div>

                            <?php
								}
								} ?>
                            <div class="modal-footer">

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
    <!-- BEGIN FOOTER -->
    <div class="page-footer">


        <div class="page-footer-inner">

            2015 &copy; M.C.I. Santé Animale.
        </div>
        <div class="clearfix" align="right">
            <img src="../../assets/admin/layout/img/footer-img.png" alt="logo" class="logo-default" width="295" />
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
    <script src="../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
        type="text/javascript"></script>
    <script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript">
    </script>
    <script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript">
    </script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="../../assets/global/plugins/fuelux/js/spinner.min.js"></script>
    <script type="text/javascript" src="../../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js">
    </script>
    <script type="text/javascript" src="../../assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js">
    </script>
    <script type="text/javascript" src="../../assets/global/plugins/jquery.input-ip-address-control-1.0.min.js">
    </script>
    <script src="../../assets/global/plugins/bootstrap-pwstrength/pwstrength-bootstrap.min.js" type="text/javascript">
    </script>
    <script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript">
    </script>
    <script src="../../assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript">
    </script>
    <script src="../../assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript">
    </script>
    <script src="../../assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
    <script src="../../assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../assets/global/plugins/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="../../assets/global/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="../../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js">
    </script>
    <script type="text/javascript" src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js">
    </script>
    <script type="text/javascript"
        src="../../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script type="text/javascript" src="../../assets/global/plugins/clockface/js/clockface.js"></script>
    <script type="text/javascript" src="../../assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js">
    </script>
    <script type="text/javascript" src="../../assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js">
    </script>
    <script type="text/javascript"
        src="../../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

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
    function toggle_visibility(id, id2) {
        var e = document.getElementById(id);
        var e2 = document.getElementById(id2);
        if (e.style.display == 'block')
            e.style.display = 'none';
        else
            e.style.display = 'block';
        if (e2.style.display == 'block')
            e2.style.display = 'none';
        else
            e2.style.display = 'block';
    }

    function toggle_visibility2(id, id2) {
        var e = document.getElementById(id);
        var e2 = document.getElementById(id2);
        if (e.style.visibility == 'visible')
            e.style.visibility = 'hidden';
        else
            e.style.visibility = 'visible';
        if (e2.style.visibility == 'visible')
            e2.style.visibility = 'hidden';
        else
            e2.style.visibility = 'visible';
    }

    function cleartext(id) {
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
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
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