<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Physiotherapist Hours");
$physiotherapisthours = $view->getVariable("physiotherapisthours");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
	<li class="breadcrumb-item"><a href="index.php?controller=physiotherapist&amp;action=show"><?= i18n("Show Physiotherapist Sessions") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Show Physiotherapist Hours") ?></li>
  </ol>
  </div>
    <div class="container">
	<a href="index.php?controller=physiotherapisthour&amp;action=search" class="btn btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> <?= i18n("Advanced Search") ?></a>
		<h1><?= i18n("List of Physiotherapist Hours")?></h1>
	<a href="index.php?controller=physiotherapisthour&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Hour")?></a>
<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th><?= i18n("Day")?></th>
		  <th><?= i18n("Start Time")?></th>
		  <th><?= i18n("End Time")?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($physiotherapisthours as $physiotherapisthour){ ?>
          <tr>
	  <td><?php echo $physiotherapisthour->getID(); ?></td>
          <td><?php $day=$physiotherapisthour->getDay(); switch($day){case "1":echo i18n("monday");break;case "2":echo i18n("tuesday");break;case "3":echo i18n("wednesday");break;case "4":echo i18n("thursday");break;case "5":echo i18n("friday");break;case "6":echo i18n("saturday");break;case "7":echo i18n("sunday");break; }?></td>
		  <td><?php echo $physiotherapisthour->getStarttime(); ?></td>
		  <td><?php echo $physiotherapisthour->getEndtime(); ?></td>
          <td>
              <a href="index.php?controller=physiotherapisthour&action=showone&id=<?php echo $physiotherapisthour->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=physiotherapisthour&action=edit&id=<?php echo $physiotherapisthour->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=physiotherapisthour&action=delete&id=<?php echo $physiotherapisthour->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>