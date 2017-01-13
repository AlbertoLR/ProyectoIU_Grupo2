<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Injuries");
$injuries = $view->getVariable("injuries");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Download Logs") ?></li>
  </ol>
  </div>
    <div class="container">
    <h1><?= i18n("Injury Logs")?></h1>
     <?php  $page = file_get_contents(__DIR__ . '/../../documents/injury_logs.txt'); print_r(explode("\n",$page)) ?>
     <div class="top-buffer">
       <input class="btn btn-default" type="button" onclick="window.print()" value="<?= i18n("Download")?> " />
     </div>
    </div>
</div>
