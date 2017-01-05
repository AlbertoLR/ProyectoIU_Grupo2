<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Add Physiotherapist Hour");
$physiotherapisthour = $view->getVariable("physiotherapisthour");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
	<li class="breadcrumb-item"><a href="index.php?controller=physiotherapist&amp;action=show"><?= i18n("Show Physiotherapist Sessions") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=physiotherapisthour&amp;action=show"><?= i18n("Show Physiotherapist Hours") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Add Physiotherapist Hour") ?></li>
  </ol>
    <div class="container">
      <h1><?= i18n("Add Physiotherapist Hour")?></h1>
      <form physiotherapisthour="index.php?controller=physiotherapisthour&amp;action=add" method="POST">
      <div class="form-group">
        <label><?= i18n("Day") ?>:</label>
        <select name="day" class="form-control">			         
          <option value="1"><?= i18n("monday")?></option>
		  <option value="2"><?= i18n("tuesday")?></option>
		  <option value="3"><?= i18n("wednesday")?></option>
		  <option value="4"><?= i18n("thursday")?></option>
		  <option value="5"><?= i18n("friday")?></option>
		  <option value="6"><?= i18n("saturday")?></option>
		  <option value="7"><?= i18n("sunday")?></option>
        </select>
      </div>
      <div class="form-group">
        <label><?= i18n("Start Time") ?>:</label>
         <input type="time" name="stime" class="form-control" placeholder="ej: 14:00" required="required" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?">
      </div>
      <div class="form-group">
        <label><?= i18n("End Time") ?>:</label>
         <input type="time" name="etime" class="form-control" placeholder="ej: 15:00" required="required" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?">
      </div>
      <button type="submit" name="submit" class="btn btn-default"><?= i18n("Submit") ?></button>
      </form>
    </div>
</div>

