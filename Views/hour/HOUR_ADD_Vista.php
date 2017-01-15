<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Hour");
$hour = $view->getVariable("hour");
$ranks = $view->getVariable("ranks");
$seasons = $view->getVariable("seasons");
$errors = $view->getVariable("errors");

$array_date=getDate();
if(strlen($array_date['mon']==1)){
$date=$array_date['year']."-0".$array_date['mon']."-".$array_date['mday'];
}else{
$date=$array_date['year']."-".$array_date['mon']."-".$array_date['mday'];
}
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=hour&amp;action=show"><?= i18n("List of Hours") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Create Hour") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Create Hour")?></h1>
        <form action="index.php?controller=hour&amp;action=add" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label><?= i18n("Rank") ?>:</label>
            <select name="rankid[]" class="form-control" required multiple id="example-getting-started" >
            <?php foreach($ranks as $rank => $value){ ?>
              <option value="<?php echo $value["id"]?>" ><?php echo i18n($value["dia_s"])." de ".i18n($value["hora_apertura"])." a ".i18n($value["hora_cierre"]." en horario de")?>
               <?php foreach($seasons as $season => $values){ ?>
                 <?php if($values["id"]==$value["horario_temporada_id"]){ ?>
                <?php echo $values["nombre_temp"]?>
                <?php }  }
              ?></option>
             <?php }   ?>
             </select>
          </div>
          <div class="form-group">
            <label><?= i18n("From") ?>:</label>
             <input type="date" name="from" class="form-control" id="datevalid" min="<?php echo $date ?>" placeholder="ej: 2015-06-15" >
          </div>
          <div class="form-group">
            <label><?= i18n("To") ?>:</label>
             <input type="date" name="to" class="form-control" id="datevalidation" min="<?php echo $date ?>" placeholder="ej: 2015-06-16" >
          </div>
          <div class="form-group">
            <label><?= i18n("Start") ?>:</label>
             <input type="time" name="start" class="form-control" pattern="^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$" placeholder="ej: 10:00">
          </div>
          <div class="form-group">
            <label><?= i18n("End") ?>:</label>
             <input type="time" name="end" class="form-control" pattern="^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$" placeholder="ej: 11:00" >
          </div>
             <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
