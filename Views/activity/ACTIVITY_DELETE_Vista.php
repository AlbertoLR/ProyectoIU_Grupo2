<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Delete Activity");
$activity = $view->getVariable("activity");
$discounts = $view->getVariable("discounts");
$categories = $view->getVariable("categories");
$errors = $view->getVariable("errors");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=activity&amp;action=show"><?= i18n("List of Activities") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Delete Activity") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("Delete Activity")." ".$activity->getActivityName()?></h1>
      <form activity="index.php?controller=activity&amp;action=delete" method="POST">
        <button type="submit" value="yes" name="submit" class="btn btn-default"><?= i18n("Yes") ?></button>
        <button type="submit" value="no" name="submit" class="btn btn-default"><?= i18n("No") ?></button>
        <input type="hidden" name="id" value="<?= $activity->getID() ?>">
      </form>
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
            <?php $d = "0" ?>
            <?php foreach($discounts as $discount => $value){ ?>
              <?php if($value["id"] == $activity->getDiscountid()) {
                 $d=$value["cantidad"];
               } }  ?><td><?php echo $d."%"  ?></td>
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
