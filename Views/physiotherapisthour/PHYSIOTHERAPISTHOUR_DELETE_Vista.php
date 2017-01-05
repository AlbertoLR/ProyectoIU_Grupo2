<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show Physiotherapist");
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
    <li class="breadcrumb-item active"><?= i18n("Delete Physiotherapist Hour") ?></li>
  </ol>
    <div class="container">
  	  <h1><?= i18n("Delete Physiotherapist Hour")?></h1>
      <form physiotherapisthour="index.php?controller=physiotherapisthour&amp;action=delete" method="POST">
        <button type="submit" value="yes" name="submit" class="btn btn-default"><?= i18n("Yes") ?></button>
        <button type="submit" value="no" name="submit" class="btn btn-default"><?= i18n("No") ?></button>
        <input type="hidden" name="id" value="<?= $physiotherapisthour->getID() ?>">
      </form>
      <div class="row top-buffer">
        <table class="table">
        <tbody>
          <tr class="active">
            <th class="col-sm-2"><?= i18n("Identifier")?></th>
            <td class="col-sm-10"><?= $physiotherapisthour->getID() ?></td>
          </tr>
        </tbody>
        <tbody>
          <tr>
            <th><?= i18n("Day")?></th>
			<td><?php $day=$physiotherapisthour->getDay(); switch($day){case "1":echo i18n("monday");break;case "2":echo i18n("tuesday");break;case "3":echo i18n("wednesday");break;case "4":echo i18n("thursday");break;case "5":echo i18n("friday");break;case "6":echo i18n("saturday");break;case "7":echo i18n("sunday");break; }?></td>
          </tr>
        </tbody>
        <tbody>
          <tr>
            <th><?= i18n("Start Time")?></th>
            <td><?= $physiotherapisthour->getStarttime() ?></td>
          </tr>
        </tbody>
		<tbody>
          <tr>
            <th><?= i18n("End Time")?></th>
            <td><?= $physiotherapisthour->getEndtime() ?></td>
          </tr>
        </tbody>
        </table>
    </div>
    </div>
</div>
