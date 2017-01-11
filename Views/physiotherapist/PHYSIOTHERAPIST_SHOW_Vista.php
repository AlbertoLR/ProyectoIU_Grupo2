<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Physiotherapist");
$physiotherapists = $view->getVariable("physiotherapists");
$hours = $view->getVariable("hours");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
	<div class="design">
    <ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
		<li class="breadcrumb-item active"><?= i18n("Show Physiotherapist Sessions") ?></li>
    </ol>
    </div>
    <div class="container">
	<a href="index.php?controller=physiotherapisthour&amp;action=show" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Manage Physiotherapist Hours")?></a>
	<a href="index.php?controller=physiotherapist&amp;action=search" class="btn btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> <?= i18n("Advanced Search") ?></a>
        <h1><?= i18n("List of Physiotherapist Sessions")?></h1>
	<a href="index.php?controller=physiotherapist&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Physiotherapist Session")?></a>
<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th><?= i18n("Date")?></th>
		  <th><?= i18n("Start Time")?></th>
		  <th><?= i18n("End Time")?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($physiotherapists as $physiotherapist){ ?>
          <tr>
	    <?php foreach($hours as $hour => $value){if($value["id"] == $physiotherapist->getIDHour()) { ?>
	      <td><?php echo $physiotherapist->getID(); ?></td>
            <td><?php $array_date=$physiotherapist->getDay(); echo $array_date[8].$array_date[9].$array_date[7].$array_date[5].$array_date[6].$array_date[4].$array_date[0].$array_date[1].$array_date[2].$array_date[3]?></td>
            <td><?php echo $value["hora_i"];?></td>
            <td><?php echo $value["hora_f"]; ?></td>
            <td>
              <a href="index.php?controller=physiotherapist&action=showone&id=<?php echo $physiotherapist->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=physiotherapist&action=edit&id=<?php echo $physiotherapist->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=physiotherapist&action=delete&id=<?php echo $physiotherapist->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
		  <?php  } } ?>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
