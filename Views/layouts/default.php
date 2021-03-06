<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");

?><!DOCTYPE html>
<html>
    <head>
	<title><?= $view->getVariable("title", "no title") ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="css/bootstrap-datepicker3.min.css" type="text/css">
  <link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>
  <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<?= $view->getFragment("css") ?>
	<?= $view->getFragment("javascript") ?>
    </head>
    <body>
	<!-- header -->
	<header>
	    <nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
		    <div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			    <span class="sr-only">Toggle navigation</span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Moovett</a>
		    </div>
		    <div id="navbar" class="navbar-collapse collapse">
			<?php if (isset($currentuser)): ?>

		    <form class="navbar-form navbar-right" action="index.php?controller=user&amp;action=logout" method="POST">
          <?php
            include(__DIR__."/language_select_element.php");
          ?>
				<button type="submit" class="btn btn-success"><?= i18n("Logout") ?></button>
			    </form>
			<?php else: ?>
			    <form class="navbar-form navbar-right" action="index.php?controller=user&amp;action=login" method="POST">
            <?php
              include(__DIR__."/language_select_element.php");
            ?>
			    <div class="form-group">
  				<input type="text" placeholder="<?= i18n("Username")?>" class="form-control" name="username" maxlength="14">
  			    </div>
  			    <div class="form-group">
  				<input type="password" placeholder="<?= i18n("Password")?>" class="form-control" name ="passwd" maxlength="14">
  			    </div>
  			    <button type="submit" class="btn btn-success"><?= i18n("Login") ?></button>

			</form>
			<?php endif ?>
		    </div><!--/.navbar-collapse -->
		</div>
	    </nav>
	</header>

	<main>
	    <div id="flash">
		<?= $view->popFlash() ?>
	    </div>

	    <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
	</main>

	<footer>

	</footer>

	<!-- Bootstrap core JavaScript
	     ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	    <script src="js/jquery.min.js"></script>
  	  <script src="js/bootstrap.min.js"></script>
      <script src="js/bootstrap-datepicker.min.js"></script>
      <script src="js/datepicker.js"></script>
      <script src="js/bootstrap-multiselect.js"></script>
      <script src="js/multiselect-custom.js"></script>
      <script src="js/discount_change.js"></script>
      <script src="js/activity_change.js"></script>
      <script src="js/particular.js"></script>
      <script src="js/add_event.js"></script>
      <script src="js/add_activity.js"></script>
      <script src="js/dni_validator.js"></script>
      <script src="js/profile.js"></script>
      <script src="js/week_day.js"></script>
      <script src="js/payment.js"></script>
      <script src="js/datevalid.js"></script>
      <script src="js/datevalidation.js"></script>
    <!-- Typeahead core JavaScript
	     ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
      <script src="js/typeahead.bundle.js"></script>
      <script src="js/filter_users.js"></script>


    </body>
</html>
