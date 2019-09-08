<html>
<head>
  <meta charset="utf-8">
  <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
  <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--<meta name="apple-mobile-web-app-capable" content="yes">-->
	<title>Lotosystem</title>
  <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/bootstrap.min.css">
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="<?php echo ROOT_URL; ?>assets/js/jquery.slim.min.js"></script>
  <script src="<?php echo ROOT_URL; ?>assets/js/popper.min.js"></script>
  <script src="<?php echo ROOT_URL; ?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo ROOT_URL; ?>assets/js/jquery.mask.min.js"></script>
  <!--<script src="<?php echo ROOT_URL; ?>assets/js/validate.min.js"></script>-->
  <!--<script src="<?php echo ROOT_URL; ?>assets/js/jquery.tabledit.js"></script>-->
</head>
<body>
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
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="nav navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo ROOT_URL; ?>">Home</a></li>
              <?php if(isset($_SESSION['is_logged_in'])) : ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>shares">Shares</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>operations">Operations</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>reports">Reports</a></li>
              <?php endif; ?>
              <?php if(isset($_SESSION['is_logged_in'])) : ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>users/logout">Logout</a></li>
              <?php else : ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo ROOT_URL; ?>users/login">Login</a></li>
              <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="jumbotron jumbotron-fluid">
     	<?php require($view); ?>
      <?php Messages::display(); ?>
      </div>
</body>
<footer style="text-align: center">
  <p class="mt-5 mb-3 text-muted">© 2018 Copyright:<a href=""> Loteria Lotoplaza</a></p>
</footer>
</html>