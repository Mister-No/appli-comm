<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>Pages - Admin Dashboard UI Kit - Lock Screen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="<?=base_url();?>assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url();?>assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?=base_url();?>assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?=base_url();?>assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?=base_url();?>pages/css/pages-icons.css" rel="stylesheet" type="text/css">
    <link class="main-stylesheet" href="<?=base_url();?>pages/css/pages.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/style.css">

    <script src="<?=base_url();?>assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?=base_url();?>assets/custom_js/custom_js.js"></script>
    <!--[if lte IE 9]>
        <link href="pages/css/ie9.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    <script type="text/javascript">
    window.onload = function()
    {
      // fix for windows 8
      if (navigator.appVersion.indexOf("Windows NT 6.2") != -1)
        document.head.innerHTML += '<link rel="stylesheet" type="text/css" href="pages/css/windows.chrome.fix.css" />'
    }
    </script>
  </head>
  <body class="fixed-header ">
    <div class="login-wrapper ">
      <!-- START Login Background Pic Wrapper-->
      <div class="bg-pic">
        <!-- START Background Pic-->
        <img src="<?=base_url();?>assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" data-src="<?=base_url();?>assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" data-src-retina="<?=base_url();?>assets/img/demo/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" alt="" class="lazy">
        <!-- END Background Pic-->
      </div>
      <!-- END Login Background Pic Wrapper-->
      <!-- START Login Right Container-->
      <div class="login-container bg-white">
        <div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
          <img src="<?=base_url();?>assets/img/logo.png" alt="logo" data-src="<?=base_url();?>assets/img/logo.png" data-src-retina="<?=base_url();?>assets/img/logo_2x.png" width="78" height="22">
          <p class="p-t-35">Mot de passe oublié</p>
          <div class="erreur alert alert-danger">
            <strong class="message"></strong>
            <button class="close"></button>
          </div>
          <!-- START Login Form -->
          <form id="form" class="p-t-15" action="<?=base_url();?>login/recup_password.html">
            <!-- START Form Control-->
            <div class="form-group form-group-default">
              <label>Votre Email</label>
              <div class="controls">
                <input type="mail" name="email" class="form-control" required>
              </div>
            </div>
            <!-- END Form Control-->
            <button class="btn btn-primary btn-cons m-t-10" type="submit">Récupérer</button>
          </form>
          <!--END Login Form-->
        </div>
      <!-- END Login Right Container-->
    </div>
  </div>
  <!-- BEGIN VENDOR JS -->
  <script src="<?=base_url();?>assets/plugins/pace/pace.min.js" type="text/javascript"></script>
  <script src="<?=base_url();?>assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
  <script src="<?=base_url();?>assets/plugins/jquery/jquery-1.11.1.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/custom_js/custom_js.js"></script>
  <script src="<?=base_url();?>assets/plugins/modernizr.custom.js" type="text/javascript"></script>
  <script src="<?=base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
  <script src="<?=base_url();?>assets/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="<?=base_url();?>assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
  <script src="<?=base_url();?>assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
  <script src="<?=base_url();?>assets/plugins/jquery-bez/jquery.bez.min.js"></script>
  <script src="<?=base_url();?>assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
  <script src="<?=base_url();?>assets/plugins/jquery-actual/jquery.actual.min.js"></script>
  <script src="<?=base_url();?>assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
  <script type="text/javascript" src="<?=base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>
  <script type="text/javascript" src="<?=base_url();?>assets/plugins/classie/classie.js"></script>
  <script src="<?=base_url();?>assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
  <script src="<?=base_url();?>assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
  <!-- END VENDOR JS -->

  <script>

  base_url = '<?=base_url();?>';

  $(function()
  {
    $('#form').validate()
  });

  $('#form').submit(function(e) {

    e.preventDefault();

    data = $(this).serialize();
    urlCheck = base_url+'login/recup_password.html';
    urlRedirect = base_url+'login.html';

    check_exist(urlCheck, urlRedirect, data);

  });

  </script>
  </body>
</html>
