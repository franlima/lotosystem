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
  <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/bootstrap.min.css">
</head>
<body class="pushable">
  <!--
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">Lotosystem 
            <?php if(isset($_SESSION['is_logged_in'])) : ?>
              <em><?php echo 'Ola ' .$_SESSION['user_data']['username']; ?></em>
            <?php endif; ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>
    -->
    <div class="pusher">
      <div class="ui large secondary inverted pointing menu">
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
      <div class="jumbotron jumbotron-fluid">
     	  <?php require($view); ?>
        <?php Messages::display(); ?>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo ROOT_URL; ?>assets/js/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?php echo ROOT_URL; ?>assets/js/jquery/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
    <!--<script src="<?php echo ROOT_URL; ?>assets/js/semantic/semantic.min.js"></script>-->
    <script src="<?php echo ROOT_URL; ?>assets/js/popper.min.js"></script>
    <script src="<?php echo ROOT_URL; ?>assets/js/bootstrap.min.js"></script>
</body>
<footer style="text-align: center">
  <p class="mt-5 mb-3 text-muted">© 2018 Copyright:<a href=""> Loteria Lotoplaza</a></p>
</footer>
</html>