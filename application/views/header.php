<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type">
<meta charset="utf-8"/>
<title>Newsletter brik</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta content="" name="description" />
<meta content="" name="author" />
<link rel="apple-touch-icon" href="<?=base_url();?>pages/ico/60.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?=base_url();?>pages/ico/76.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?=base_url();?>pages/ico/120.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?=base_url();?>pages/ico/152.png">
<link rel="icon" type="image/x-icon" href="<?=base_url();?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/plugins/pace/pace-theme-flash.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/plugins/bootstrapv3/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/plugins/font-awesome/css/font-awesome.css" />
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,600,600i,700,700i" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url();?>assets/plugins/jquery-scrollbar/jquery.scrollbar.css"/>
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url();?>assets/plugins/select2/css/select2.min.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url();?>assets/plugins/switchery/css/switchery.min.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css" />
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url();?>assets/plugins/datatables-responsive/css/datatables.responsive.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>pages/css/pages-icons.css">
<link class="main-stylesheet" rel="stylesheet" type="text/css" href="<?=base_url();?>pages/css/pages.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/style.css?<?=date('U')?>">
<link rel="stylesheet" type="text/css" media="screen" href="<?=base_url();?>assets/plugins/summernote/css/summernote.css">
<link href="<?=base_url();?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
<link href="assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" media="screen">
<script src="<?=base_url();?>assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap-typehead/typeahead.bundle.min.js"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap-typehead/typeahead.jquery.min.js"></script>
<script src="<?=base_url();?>assets/plugins/handlebars/handlebars-v4.0.5.js"></script>
<script src="<?=base_url();?>assets/js/form_elements.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url();?>assets/custom_js/custom_js.js"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?=base_url();?>assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?=base_url();?>assets/plugins/datatables-responsive/js/lodash.min.js" type="text/javascript"></script>

<script>
UPLOADCARE_PUBLIC_KEY = '2b7ba941611069fbc4ca';
UPLOADCARE_LOCALE = 'fr';
UPLOADCARE_TABS = 'file gdrive gphotos dropbox';
UPLOADCARE_IMAGES_ONLY = true;
UPLOADCARE_PREVIEW_STEP = true;
</script>

<script charset="utf-8" src="//ucarecdn.com/libs/widget/3.6.1/uploadcare.full.min.js"></script>

<!--[if lte IE 9]>
<link href="assets/plugins/codrops-dialogFx/dialog.ie.css" rel="stylesheet" type="text/css" media="screen" />
<![endif]-->
</head>
<body class="fixed-header horizontal-menu">
<!-- START PAGE-CONTAINER -->
<div class="page-container ">
  <!-- START HEADER -->
  <div class="header">
    <!-- START MOBILE CONTROLS -->
    <div class="container-fluid relative">
      <div class="pull-center hidden-md hidden-lg">
        <div class="header-inner">
          <div class="brand inline">
            <img src="assets/img/logo.png" alt="logo" data-src="assets/img/logo.png" data-src-retina="assets/img/logo_2x.png" width="78" height="22">
          </div>
        </div>
      </div>
      <!-- RIGHT SIDE -->
      <div class="pull-right full-height visible-sm visible-xs">
        <!-- START ACTION BAR -->
        <div class="header-inner">
          <a href="#" class="btn-link visible-xs-inline-block visible-sm-inline-block m-r-10" data-pages="horizontal-menu-toggle">
            <span class="icon-set menu-hambuger"></span>
          </a>
        </div>
        <!-- END ACTION BAR -->
      </div>
    </div>
    <!-- END MOBILE CONTROLS -->
    <div class=" pull-left sm-table hidden-xs hidden-sm">
      <div class="header-inner">
        <div class="brand inline">
          <img src="<?=base_url();?>assets/img/logo.png" alt="logo" data-src="<?=base_url();?>assets/img/logo.png" data-src-retina="<?=base_url();?>assets/img/logo_2x.png" width="78" height="22">
        </div>
        <a href="#" class="search-link" data-toggle="search"><i class="pg-search"></i>Rechercher</a> </div>
    </div>
    <div class=" pull-right">
      <!-- START User Info-->
      <div class="visible-lg visible-md m-t-10">
        <div class="pull-left p-r-10 p-t-10 fs-16 font-heading">
          <span>[<?=$_SESSION["group"]?>]</span>
          <span class="semi-bold"><?=$_SESSION["user_nom"]?></span>
        </div>
        <div class="dropdown pull-right">
          <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="thumbnail-wrapper d32 circular inline m-t-5">
              <!--<img src="<?=base_url();?>assets/img/profiles/avatar.jpg" alt="" data-src="<?=base_url();?>assets/img/profiles/avatar.jpg" data-src-retina="<?=base_url();?>assets/img/profiles/avatar_small2x.jpg" width="32" height="32">-->
            </span>
          </button>
          <ul class="dropdown-menu profile-dropdown" role="menu">
            <li><a href="<?=base_url();?>users/modifier/<?=$_SESSION["user_id"]?>"><i class="pg-settings_small"></i> Mon profil</a>
            </li>
            <li><a href="#"><i class="pg-outdent"></i> Feedback</a>
            </li>
            <li><a href="#"><i class="pg-signals"></i> Help</a>
            </li>
            <li class="bg-master-lighter">
              <a href="<?=base_url();?>login/logout.html" class="clearfix">
                <span class="pull-left">Logout</span>
                <span class="pull-right"><i class="pg-power"></i></span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <!-- END User Info-->
    </div>
  </div>
  <!-- END HEADER -->
  <!-- START PAGE CONTENT WRAPPER -->
  <div class="page-content-wrapper ">
    <!-- START PAGE CONTENT -->
    <div class="content ">
      <div class="bar">
        <div class="pull-right">
          <a href="#" class="text-black padding-10 visible-xs-inline visible-sm-inline pull-right m-t-10 m-b-10 m-r-10 on" data-pages="horizontal-menu-toggle">
            <i class=" pg-close_line"></i>
          </a>
        </div>
        <div class="bar-inner">
          <ul>
            <li>
              <a href="<?=base_url();?>dashboard.html"><span class="title">Accueil</span>
              </a>
            </li>
            <li class="mega">
              <a href="javascript:;"><span class="title">Campagnes</span>
              <span class=" arrow"></span></a>
              <ul class="mega">
                <div class="container">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="sub-menu-heading bold">
                        <a href="<?=base_url();?>campagnes/informations/creation.html">Créer une campagne</a>
                      </div>
                    </div>
                    <div class="col-md-3 ">
                      <div class="sub-menu-heading bold">
                        <a href="<?=base_url();?>campagnes/en_cours.html">Voir les campagnes en cours</a>
                      </div>
                    </div>
                    <div class="col-md-3 ">
                      <div class="sub-menu-heading bold">
                        <a href="<?=base_url();?>campagnes/envoyees.html">Voir les campagnes envoyées</a>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="sub-menu-heading bold">
                        <a href="<?=base_url();?>campagnes/archivees.html">Voir les campagnes archivées</a>
                      </div>
                    </div>
                </div>
              </div>
            </ul>
          </li>
          <!--<li class="mega">
            <a href="javascript:;"><span class="title">Statistiques</span>
            <span class=" arrow"></span></a>
            <ul class="mega">
              <div class="container">
                <div class="row">
                  <div class="col-md-3 ">
                    <div class="sub-menu-heading bold">Voir les statistiques</div>
                    <ul class="sub-menu">
                      <li> <a href="#">Statistique 1</a> </li>
                      <li> <a href="#">Statistique 2</a> </li>
                      <li> <a href="#">Statistique 3</a> </li>
                      <li> <a href="#">Statistique 4</a> </li>
                      <li> <a href="#">Statistique 5</a> </li>
                      <li> <a href="#">Statistique 6</a> </li>
                      <li> <a href="#">Statistique 7</a> </li>
                      <li class="active"> <a href="#">Statistique 8</a> </li>
                    </ul>
                  </div>
                  <div class="col-md-3">
                    <div class="sub-menu-heading bold">Statistiques des campagnes</div>
                    <ul class="sub-menu">
                      <li> <a href="#">Campagne 1</a> </li>
                      <li> <a href="#">Campagne 2</a> </li>
                      <li> <a href="#">Campagne 3</a> </li>
                      <li> <a href="#">Campagne 4</a> </li>
                      <li> <a href="#">Campagne 5</a> </li>
                      <li> <a href="#">Campagne 6</a> </li>
                      <li> <a href="#">Campagne 7</a> </li>
                      <li class="active"> <a href="#">Campagne 8</a> </li>
                    </ul>
                  </div>
                  <div class="col-md-3">
                    <div class="sub-menu-heading bold">Statistiques des entreprises</div>
                    <ul class="sub-menu">
                      <li> <a href="#">Entreprise 1</a> </li>
                      <li> <a href="#">Entreprise 2</a> </li>
                      <li> <a href="#">Entreprise 3</a> </li>
                      <li> <a href="#">Entreprise 4</a> </li>
                      <li> <a href="#">Entreprise 5</a> </li>
                      <li> <a href="#">Entreprise 6</a> </li>
                      <li> <a href="#">Entreprise 7</a> </li>
                    </ul>
                  </div>
                </div>
              </div>
            </ul>
          </li>-->
          <?php if ($_SESSION['is_admin'] == 1 && $_SESSION['rang'] > 2): ?>

            <li class="mega">
              <a href="javascript:;"><span class="title">Listes</span>
              <span class=" arrow"></span></a>
              <ul class="mega">
                <div class="container">
                  <div class="row">
                    <div class="col-md-3 ">
                      <div class="sub-menu-heading bold"><a href="<?=base_url();?>listes.html">Voir les listes</a></div>
                    </div>
                    <div class="col-md-3">
                      <div class="sub-menu-heading bold"><a href="<?=base_url();?>listes/ajouter.html">Ajouter des listes</a></div>
                    </div>
                    <div class="col-md-3">
                      <div class="sub-menu-heading bold"><a href="<?=base_url();?>listes.html">Modifier des listes</a></div>
                    </div>
                  </div>
                </div>
              </ul>
            </li>

          <?php endif; ?>

          <?php if ($_SESSION['is_admin'] == 1 && $_SESSION['rang'] > 0): ?>

            <li class="mega">
              <a href="javascript:;"><span class="title">Contacts</span>
              <span class=" arrow"></span></a>
              <ul class="mega">
                <div class="container">
                  <div class="row">
                    <div class="col-md-2">
                      <div class="sub-menu-heading bold"><a href="<?=base_url();?>entreprises.html">Gérer les entreprises</a>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="sub-menu-heading bold"><a href="<?=base_url();?>contacts.html">Gérer les contacts</a>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="sub-menu-heading bold"><a href="<?=base_url();?>entreprises/ajouter.html">Ajouter une entreprise</a>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="sub-menu-heading bold"><a href="<?=base_url();?>contacts/ajouter.html">Ajouter un contact</a>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="sub-menu-heading bold"><a href="<?=base_url();?>contacts/importer.html">Importer un contact</a>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="sub-menu-heading bold"><a href="<?=base_url();?>categories/exporter.html">Exporter un contact</a>
                      </div>
                    </div>
                  </div>
                </div>
              </ul>
            </li>

          <?php endif; ?>

          <?php if ($_SESSION['is_admin'] == 1 && $_SESSION['rang'] > 3): ?>

            <li class="mega">
              <a href="<?=base_url();?>categories.html"><span class="title">Catégories</span>
              </a>
            </li>

          <?php endif; ?>

          <?php  if ($_SESSION['is_admin'] == 1 && $_SESSION['rang'] > 4) { ?>

          <li class="mega">
            <a href="<?=base_url();?>users.html"><span class="title">Utilisateurs</span>
            </a>
          </li>

          <?php } ?>

        </ul>
      </div>
    </div>
