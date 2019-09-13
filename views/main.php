<html>
<head>
  <meta charset="utf-8">
  <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
  <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--<meta name="apple-mobile-web-app-capable" content="yes">-->
	<title>Lotosystem</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
  <!--<link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/semantic/semantic.min.css">-->
  <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/main.css">
</head>
<body class="pushable">
    <div class="ui vertical inverted sidebar menu left">
      <a class="active item" href="<?php echo ROOT_URL; ?>">Home</a>
      <?php if(isset($_SESSION['is_logged_in'])) : ?>
        <a class="item" href="<?php echo ROOT_URL; ?>operations">Operations</a>
        <a class="item" href="<?php echo ROOT_URL; ?>reports">Reports</a>
      <?php endif; ?>
      <?php if(isset($_SESSION['is_logged_in'])) : ?>
        <a class="item" href="<?php echo ROOT_URL; ?>users/logout">Logout</a>
      <?php else : ?>
        <a class="item" href="<?php echo ROOT_URL; ?>users/login">Login</a>
      <?php endif; ?>
    </div>
    <div class="pusher">
      <div class="ui large secondary inverted pointing menu">
        <div class="ui container">
          <a class="toc item">
            <i class="sidebar icon"></i>
          </a>
          <a class="active item" href="<?php echo ROOT_URL; ?>">Home</a>
          <?php if(isset($_SESSION['is_logged_in'])) : ?>
            <a class="item" href="<?php echo ROOT_URL; ?>operations">Operations</a>
            <a class="item" href="<?php echo ROOT_URL; ?>reports">Reports</a>
          <?php endif; ?>
          <?php if(isset($_SESSION['is_logged_in'])) : ?>
            <a class="item" href="<?php echo ROOT_URL; ?>users/logout">Logout</a>
          <?php else : ?>
            <a class="item" href="<?php echo ROOT_URL; ?>users/login">Login</a>
          <?php endif; ?>
        </div>    
      </div>
        <div class="ui segment">
          <?php require($view); ?>
          <?php Messages::display(); ?>
        </div>
      </div>
    </div>
    <div class="ui center aligned segment">
      <p class="">© 2018 Copyright:<a class="item" href=""> Loteria Lotoplaza</a></p>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo ROOT_URL; ?>assets/js/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?php echo ROOT_URL; ?>assets/js/jquery/jquery.mask.min.js"></script>
    <script src="<?php echo ROOT_URL; ?>assets/js/semantic/semantic.min.js"></script>
    <script src="<?php echo ROOT_URL; ?>assets/js/main.js"></script>
</body>
</html>