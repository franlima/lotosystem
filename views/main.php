<html>
<head>
  <meta charset="utf-8">
  <title>Lotosystem</title>
  <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
  <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--<meta name="apple-mobile-web-app-capable" content="yes">-->
  <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/semantic.min.css">
  <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/main.css">
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="<?php echo ROOT_URL; ?>assets/js/jquery/jquery-3.4.1.min.js"></script>
  <script src="<?php echo ROOT_URL; ?>assets/js/jquery/jquery.mask.min.js"></script>
  <script src="<?php echo ROOT_URL; ?>assets/js/semantic/semantic.min.js"></script>
  <script src="<?php echo ROOT_URL; ?>assets/js/jquery/jquery.maskMoney.min.js"></script>
  <script src="<?php echo ROOT_URL; ?>assets/js/main.js"></script>
</head>
<body class="pushable">
  <div class="ui blue inverted labeled icon left inline vertical sidebar menu">
    <?php require("menus.php"); ?>
  </div>
  <div class="pusher">
    <div class="ui top attached blue inverted menu">
      <div class="ui container">
        <a class="toc item">
          <i class="sidebar icon"></i>
        </a>
      </div>    
    </div>
    <div class="ui blue inverted segment">
        <?php require($view); ?>
        <?php Messages::display(); ?>
    </div>
  </div>
  <div class="ui center aligned segment">
    <p class="">© 2018 Copyright:<a class="item" href=""> Loteria Lotoplaza</a></p>
  </div>
</body>
</html>