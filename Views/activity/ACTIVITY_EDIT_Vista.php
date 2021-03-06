<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Activity");
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
      <li class="breadcrumb-item active"><?= i18n("Modify Activity") ?></li>
    </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Modify Activity")?></h1>
      <form activity="index.php?controller=activity&amp;action=edit" method="POST">
      <div class="form-group">
        <label><?= i18n("Name") ?>:</label>
         <input type="text" name="name" class="form-control" value="<?= $activity->getActivityName()?>" minlength="2" maxlength="25" required="required">
      </div>
      <div class="form-group">
        <label><?= i18n("Capacity") ?>:</label>
         <input type="number" name="capacity" class="form-control" value="<?= $activity->getCapacity()?>" min="1" max="99" required="required">
      </div>
      <div class="form-group">
        <label><?= i18n("Price") ?>:</label>
         <input type="number" name="price" class="form-control" value="<?= $activity->getPrice()?>" min="0" max="99" required="required">
      </div>
      <div class="form-group">
        <label><?= i18n("Discount") ?>:</label>
        <select name="discounts[]" class="form-control" id="category">
          <?php if($activity->getDiscountid()==NULL) {?>
            <option  value="" selected=""></option>
            <?php } else { ?>
              <option  value="" selected=""></option>
            <?php } ?>
          <?php foreach($discounts as $discount) {?>
          <?php if($discount["id"] == $activity->getDiscountid()) {?>
            <option value="<?= $discount["id"]."-".$discount["categoria_id"]?>"selected><?= $discount["descripcion"]."-".$discount["cantidad"]."%"?></option>
          <?php }else{ ?>
          <option value="<?= $discount["id"]."-".$discount["categoria_id"]?>"><?= $discount["descripcion"]."-".$discount["cantidad"]."%"?></option>
          <?php } }?>
        </select>
      </div>
      <?php if($activity->getDiscountid()==NULL) {?>
      <div class="form-group" id="extra" style="visibility: hidden; display:none">
        <label><?= i18n("Extra discount") ?>:</label>
          <input type="number" name="extra" class="form-control" value="<?= $activity->getExtraDiscount()."%"?>" min="2" max="100" >
      </div>
      <?php } else{?>
        <div class="form-group" id="extra">
          <label><?= i18n("Extra discount") ?>:</label>
            <input type="number" name="extra" class="form-control" value="<?= $activity->getExtraDiscount()."%"?>" min="2" max="100" >
        </div>
      <?php } ?>
      <div class="form-group" id="limpiar">
        <label><?= i18n("Category") ?>:</label>
        <select name="categories" class="form-control" >
          <?php foreach($categories as $category) {?>
          <?php if($category["id"] == $activity->getCategoryid()) {?>
            <option value="<?= $category["id"]?>"selected><?= $category["tipo"]?></option>
          <?php }else{ ?>
          <option value="<?= $category["id"]?>"><?= $category["tipo"]?></option>
          <?php } }?>
        </select>
      </div>
      <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
      </form>
    </div>
</div>
