<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Rankhour");
$rankhour = $view->getVariable("rankhour");
$seasons = $view->getVariable("seasons");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=rankhour&amp;action=show"><?= i18n("List of Rankhours") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Create Rankhour") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Create Rankhour")?></h1>
        <form action="index.php?controller=rankhour&amp;action=add" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label><?= i18n("Opening") ?>:</label>
             <input type="time" name="opening" class="form-control" placeholder="ej: 10:00" >
          </div>
          <div class="form-group">
            <label><?= i18n("Closing") ?>:</label>
             <input type="time" name="closing" class="form-control" placeholder="ej: 11:00" >
          </div>

          <div class="form-group">
            <label><?= i18n("Season") ?>:</label>
            <select name="seasonid" class="form-control" required >
            <?php foreach($seasons as $season => $value){ ?>
              <option value="<?php echo $value["id"]?>" ><?php echo i18n($value["nombre_temp"])?></option>
             <?php }   ?>
             </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Day(s)") ?>:</label>
            <select name="days[]" class="form-control" required multiple id="example-getting-started">
                    <option value="Monday"><?= i18n("Monday") ?></option>
                    <option value="Tuesday"><?= i18n("Tuesday") ?></option>
                    <option value="Wednesday"><?= i18n("Wednesday") ?></option>
                    <option value="Thursday"><?= i18n("Thursday") ?></option>
                    <option value="Friday"><?= i18n("Friday") ?></option>
          </select>
          </div>
             <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
