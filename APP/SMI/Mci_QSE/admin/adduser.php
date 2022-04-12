<!DOCTYPE html>
<html lang="fr">
<?php
     session_start();

    if ($_SESSION['adp']==0 ){
	header("Location: 404.html");
	}
    elseif (!isset($_SESSION['nom'])) {
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
	$cs=0;
	$reqa=$connexion->query("select id from utilisateur");
	$nbrcount=$reqa->rowcount();
	$openfrom=0;
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
    <link rel="stylesheet" href="../../assets/global/plugins/fancybox/source/jquery.fancybox.css" type="text/css"
        media="screen" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="../../assets/global/plugins/select2/select2.css" />
    <!-- END PAGE LEVEL SCRIPTS -->
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
                            <?php include_once 'menu/more.php';?><?php include_once 'menu/more.php';?>

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
                <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

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
                            <i class="fa fa-users"></i>
                            <a href="javascript:;" id="Acc">Administration</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <i class="fa fa-user"></i>
                            <a href="javascript:;" id="Acc">Gestion des utilisateurs</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <i class="fa fa-plus"></i>
                            <a href="javascript:;" id="Acc">Ajouter Utilisateur</a>

                        </li>

                    </ul>
                    <div class="page-toolbar">
                    </div>
                </div>

                <!-- END PAGE HEADER-->

                <!-- BEGIN PAGE CONTENT-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabbable tabbable-custom boxless tabbable-reversed">

                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_0">
                                    <div class="portlet box green">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-plus"></i>Ajouter un utilisateur
                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse">
                                                </a>

                                                <a href="javascript:;" class="remove">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <!-- BEGIN FORM-->
                                            <form action="insuser.php" class="form-horizontal" method='POST'>
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Identifiant</label>
                                                        <div class="col-md-4">
                                                            <div class="input-group">
                                                                <input type="text" name="login"
                                                                    class="form-control input-circle-left"
                                                                    placeholder="" autocomplete="off">
                                                                <span class="input-group-addon input-circle-right">
                                                                    <i class="fa fa-user"></i>
                                                                </span>
                                                            </div>
                                                            <span class="help-block">
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Mot de passe</label>
                                                        <div class="col-md-4">
                                                            <div class="input-group">
                                                                <input type="text" name="mdp"
                                                                    class="form-control input-circle-left"
                                                                    placeholder="" autocomplete="off">
                                                                <span class="input-group-addon input-circle-right">
                                                                    <i class="fa fa-lock"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Nom</label>
                                                        <div class="col-md-4">
                                                            <div class="input-icon right">
                                                                <input type="text" name="nom"
                                                                    class="form-control input-circle" placeholder="Nom"
                                                                    autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Prenom</label>
                                                        <div class="col-md-4">
                                                            <div class="input-icon right">

                                                                <input type="text" name="prenom"
                                                                    class="form-control input-circle"
                                                                    placeholder="Prenom" autocomplete="off">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Fonction</label>
                                                        <div class="col-md-4">
                                                            <div class="input-icon right">

                                                                <input type="text" name="fonction"
                                                                    class="form-control input-circle"
                                                                    placeholder="Fonction" autocomplete="on">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Adresse Mail</label>
                                                        <div class="col-md-4">
                                                            <div class="input-icon right">

                                                                <input type="text" name="mail"
                                                                    class="form-control input-circle" placeholder="mail"
                                                                    autocomplete="on">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group has-error">
                                                        <label class="col-md-3 control-label">Processus</label>
                                                        <div class="col-md-4">
                                                            <select name="ser" class="select2me form-control"
                                                                onchange="getDepartements(this.value);">
                                                                <option value="">Choix du processus</option>
                                                                <?php
																	include_once 'bd.php';
																	$req1=$connexion->query("select * from service where id != 19 and id != 20 order by ref");
																	$nbr=$req1->rowcount();
																	if($nbr!=0){
																		
																	while  ($obj = $req1->Fetch(PDO::FETCH_ASSOC)) 
																	{
																	$i=$obj['nom'];																	
																	$n=$obj['id'];																	
																	echo '<option value="'.$n.'">'.utf8_encode($i).'</option>';
																	?>

                                                                <?php } } ?>
                                                            </select>
                                                            <span class="help-block">
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <span id="blocDepartements"></span><br />
                                                </div>


                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <button type="submit" name="valider"
                                                                class="btn btn-circle blue">Valider</button>
                                                            <button type="reset"
                                                                class="btn btn-circle default">Annuler</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- END FORM-->
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
                        <img src="../../assets/admin/layout/img/footer-img.png" alt="logo" class="logo-default"
                            width="295" />
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
                <script src="../../assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js"
                    type="text/javascript"></script>
                <script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
                <script src="../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
                    type="text/javascript"></script>
                <script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
                    type="text/javascript"></script>
                <script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
                <script src="../../assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
                <script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
                <script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js"
                    type="text/javascript"></script>
                <!-- END CORE PLUGINS -->
                <!-- BEGIN PAGE LEVEL PLUGINS -->
                <script type="text/javascript" src="../../assets/global/plugins/select2/select2.min.js"></script>
                <!-- END PAGE LEVEL PLUGINS -->
                <!-- BEGIN PAGE LEVEL SCRIPTS -->
                <script src="../../assets/global/scripts/metronic.js" type="text/javascript"></script>
                <script src="../../assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
                <script src="../../assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
                <script src="../../assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
                <script src="../../assets/admin/pages/scripts/form-samples.js"></script>
                <!-- END PAGE LEVEL SCRIPTS -->

                <script>
                jQuery(document).ready(function() {
                    // initiate layout and plugins
                    Metronic.init(); // init metronic core components
                    Layout.init(); // init current layout
                    QuickSidebar.init(); // init quick sidebar
                    Demo.init(); // init demo features
                    FormSamples.init();
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

?>

</html>