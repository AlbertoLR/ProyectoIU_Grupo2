<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Search Activity");
$activity = $view->getVariable("activity");
$categories = $view->getVariable("categories");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=activity&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=activity&amp;action=show"><?= i18n("List of Activities") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Search Activities") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Search Activity")?></h1>
        <form action="index.php?controller=activity&amp;action=search" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label><?= i18n("Name") ?>:</label>
            <input type="text" name="name" class="form-control">
          </div>
          <div class="form-group">
            <label><?= i18n("Category") ?>:</label>
            <select name="id" class="form-control" id="ex1">
              <option  value=""></option>
              <?php foreach($categories as $category) {?>
              <option value="<?= $category["id"]?>"><?= $category["tipo"]?></option>
              <?php }?>
            </select>
          </div>
             <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
