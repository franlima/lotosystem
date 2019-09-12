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
  <!--<link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/bootstrap.min.css">-->
  <style type="text/css">

.hidden.menu {
  display: none;
}

.masthead.segment {
  min-height: 700px;
  padding: 1em 0em;
}
.masthead .logo.item img {
  margin-right: 1em;
}
.masthead .ui.menu .ui.button {
  margin-left: 0.5em;
}
.masthead h1.ui.header {
  margin-top: 3em;
  margin-bottom: 0em;
  font-size: 4em;
  font-weight: normal;
}
.masthead h2 {
  font-size: 1.7em;
  font-weight: normal;
}

.ui.vertical.stripe {
  padding: 8em 0em;
}
.ui.vertical.stripe h3 {
  font-size: 2em;
}
.ui.vertical.stripe .button + h3,
.ui.vertical.stripe p + h3 {
  margin-top: 3em;
}
.ui.vertical.stripe .floated.image {
  clear: both;
}
.ui.vertical.stripe p {
  font-size: 1.33em;
}
.ui.vertical.stripe .horizontal.divider {
  margin: 3em 0em;
}

.quote.stripe.segment {
  padding: 0em;
}
.quote.stripe.segment .grid .column {
  padding-top: 5em;
  padding-bottom: 5em;
}

.footer.segment {
  padding: 5em 0em;
}

.secondary.pointing.menu .toc.item {
  display: none;
}

@media only screen and (max-width: 700px) {
  .ui.fixed.menu {
    display: none !important;
  }
  .secondary.pointing.menu .item,
  .secondary.pointing.menu .menu {
    display: none;
  }
  .secondary.pointing.menu .toc.item {
    display: block;
  }
  .masthead.segment {
    min-height: 350px;
  }
  .masthead h1.ui.header {
    font-size: 2em;
    margin-top: 1.5em;
  }
  .masthead h2 {
    margin-top: 0.5em;
    font-size: 1.5em;
  }
}
</style>
</head>
<body class="pushable">
    <div class="ui vertical inverted sidebar menu left">
      <a class="active item">Home</a>
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
      <div class="ui inverted vertical masthead center aligned segment">
        <div class="ui container">
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
        </div>
        <div class="ui text container">
          <?php require($view); ?>
          <?php Messages::display(); ?>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo ROOT_URL; ?>assets/js/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?php echo ROOT_URL; ?>assets/js/jquery/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
    <!--<script src="<?php echo ROOT_URL; ?>assets/js/semantic/semantic.min.js"></script>-->
    <script src="<?php echo ROOT_URL; ?>assets/js/popper.min.js"></script>
    <script>
  $(document)
    .ready(function() {
      // fix menu when passed
      $('.masthead')
        .visibility({
          once: false,
          onBottomPassed: function() {
            $('.fixed.menu').transition('fade in');
          },
          onBottomPassedReverse: function() {
            $('.fixed.menu').transition('fade out');
          }
        })
      ;

      // create sidebar and attach to menu open
      $('.ui.sidebar')
        .sidebar('attach events', '.toc.item')
      ;
    })
  ;
  </script>
</body>
<footer style="ui inverted header">
  <p class="">© 2018 Copyright:<a href=""> Loteria Lotoplaza</a></p>
</footer>
</html>