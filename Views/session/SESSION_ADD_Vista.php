<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Session");
$sessions = $view->getVariable("sessions");
$hours = $view->getVariable("hours");
$activities = $view->getVariable("activities");
$events = $view->getVariable("events");
$users = $view->getVariable("users");
$spaces = $view->getVariable("spaces");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=session&amp;action=show"><?= i18n("List of Sessions") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Create Session") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Create Session")?></h1>
        <form action="index.php?controller=session&amp;action=add" method="POST" enctype="multipart/form-data">

          <div class="form-group">
            <label><?= i18n("Hours") ?>:</label>
            <select name="hoursid[]" class="form-control" required multiple id="example-getting-started" >
            <?php foreach($hours as $hour => $value){ ?>
              <?php if($value["active"]!=true){ ?>
              <option value="<?php echo $value["id"]?>" ><?php echo i18n(date('l', strtotime($value["dia"])))." dia ".i18n($value["dia"])." desde ".i18n($value["hora_inicio"])." hasta ".i18n($value["hora_fin"]) ?></option>
             <?php } }   ?>
             </select>
          </div>

          <div class="form-group">
            <label><?= i18n("Activity") ?>:</label>
            <select name="activity[]" class="form-control" id="activity">
              <option value=""></option>
            <?php foreach($activities as $activity => $value){ ?>
              <option value="<?php echo $value["id"]."-". $value["espacio_id"]?>" ><?php echo i18n($value["nombre"])?></option>
             <?php }   ?>
             </select>
          </div>

          <div class="form-group" id="limpiar">
            <label><?= i18n("Event") ?>:</label>
            <select name="event[]" class="form-control" >
              <option value=""></option>
            <?php foreach($events as $event => $value){ ?>
              <option value="<?php echo $value["id"]."-". $value["espacio_id"]?>" ><?php echo i18n($value["nombre"])?></option>
             <?php }   ?>
             </select>
          </div>

          <div class="form-group">
            <label><?= i18n("User") ?>:</label>
            <select name="user" class="form-control" required="required">
              <option value=""></option>
            <?php foreach($users as $user=> $value){ ?>
              <?php if($value["profile"]=="monitor"){ ?>
              <option value="<?php echo $value["id"]?>" ><?php echo i18n($value["name"])?></option>
             <?php } }   ?>
             </select>
          </div>

             <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
