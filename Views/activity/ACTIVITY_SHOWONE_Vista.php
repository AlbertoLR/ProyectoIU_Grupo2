<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show Activity");
$activity = $view->getVariable("activity");
$spaces = $view->getVariable("spaces");
$discounts = $view->getVariable("discounts");
$categories = $view->getVariable("categories");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=activity&amp;action=show"><?= i18n("List of Activities") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Activity") ?></li>
  </ol>
  </div>
    <div class="container">
  	  <div class="row">
      <h1><?= i18n("Activity")?></h1>
      </div>
      <a href="index.php?controller=activity&amp;action=inscriptions&amp;id=<?=$activity->getID()?>" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("View Inscriptions") ?></a>
      <div class="row top-buffer">
        <table class="table">
        <tbody>
          <tr class="active">
            <th class="col-sm-2"><?= i18n("Identifier")?></th>
            <td class="col-sm-10"><?= $activity->getID() ?></td>
          </tr>
        </tbody>
        <tbody>
          <tr>
            <th><?= i18n("Name")?></th>
            <td><?= $activity->getActivityName() ?></td>
          </tr>
        </tbody>
        <tbody>
          <tr class="active">
            <th><?= i18n("Capacity")?></th>
            <td><?= $activity->getCapacity() ?></td>
          </tr>
        </tbody>
        <tbody>
          <tr>
            <th><?= i18n("Discount")?></th>
            <?php $d = "-" ?>
            <?php foreach($discounts as $discount => $value){ ?>
              <?php if($value["id"] == $activity->getDiscountid()) {
                 $d=$value["cantidad"];
               } }  ?><td><?php echo $d."%"  ?></td>
          </tr>
        </tbody>
        <tbody>
          <tr class="active">
            <th><?= i18n("Extra discount")?></th>
              <?php if($activity->getExtraDiscount()!=NULL) {?>
                <td><?=$activity->getExtraDiscount()."%" ?></td>
              <?php }else{ ?>
                <td>0%</td>
              <?php }?>
            </th>
          </tr>
        </tbody>
        <tbody>
          <tr>
            <th><?= i18n("Space")?></th>
            <?php foreach($spaces as $space => $value){ ?>
              <?php if($value["id"] == $activity->getSpaceid()) {?>
              <td><?=$value["nombre"] ?></td>
            <?php } }  ?>
          </tr>
        </tbody>
        <tbody>
          <tr class="active">
            <th><?= i18n("Category")?></th>
            <?php foreach($categories as $category => $value){ ?>
              <?php if($value["id"] == $activity->getCategoryid()) {?>
              <td><?=$value["tipo"] ?></td>
            <?php } }  ?>
          </tr>
        </tbody>
        </table>
    </div>
    </div>
</div>
