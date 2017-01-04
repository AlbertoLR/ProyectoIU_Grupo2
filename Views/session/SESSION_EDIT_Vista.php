<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Session");
$session = $view->getVariable("session");
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
      <li class="breadcrumb-item active"><?= i18n("Modify Session") ?></li>
    </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Modify Session")?></h1>
        <form action="index.php?controller=session&amp;action=edit" method="POST" enctype="multipart/form-data">

          <div class="form-group">
            <label><?= i18n("Hours") ?>:</label>
            <select name="hoursid" class="form-control" required>
              <option value=""></option>
            <?php foreach($hours as $hour => $value){ ?>
                <?php if($value["id"]==$session->getHoursID()){ ?>
              <option value="<?php echo $value["id"]?>" selected><?php echo i18n(date('l', strtotime($value["dia"])))." dia ".i18n($value["dia"])." desde ".i18n($value["hora_inicio"])." hasta ".i18n($value["hora_fin"]) ?></option>

             <?php }   else {  ?>
               <?php if($value["active"]!=true){ ?>
               <option value="<?php echo $value["id"]?>" ><?php echo i18n(date('l', strtotime($value["dia"])))." dia ".i18n($value["dia"])." desde ".i18n($value["hora_inicio"])." hasta ".i18n($value["hora_fin"]) ?></option>
               <?php } } } ?>
             </select>
          </div>

          <div class="form-group">
            <label><?= i18n("Activity") ?>:</label>
            <select name="activity" class="form-control"  id="activity">
              <option value=""></option>
            <?php foreach($activities as $activity => $value){ ?>
              <?php if($value["id"]==$session->getActivityID()){ ?>
              <option value="<?php echo $value["id"]?>" selected ><?php echo i18n($value["nombre"])?></option>
             <?php } else {  ?>
              <option value="<?php echo $value["id"]?>" ><?php echo i18n($value["nombre"])?></option>
             <?php } }  ?>
             </select>
          </div>

          <div class="form-group" id="limpiar">
            <label><?= i18n("Event") ?>:</label>
            <select name="event" class="form-control" >
              <option value=""></option>
              <?php foreach($events as $event => $value){ ?>
                <?php if($value["id"]==$session->getEventID()){ ?>
                <option value="<?php echo $value["id"]?>" selected ><?php echo i18n($value["nombre"])?></option>
               <?php } else {  ?>
                <option value="<?php echo $value["id"]?>" ><?php echo i18n($value["nombre"])?></option>
               <?php } }  ?>
             </select>
          </div>
          <div class="form-group">
            <label><?= i18n("Space") ?>:</label>
            <select name="spaces" class="form-control" id="ex1">
              <?php foreach($spaces as $space) {?>
              <?php if($space["id"] == $session->getSpaceID()) {?>
                <option value="<?= $space["id"]?>"selected><?= $space["nombre"]?></option>
              <?php }else{ ?>
              <option value="<?= $space["id"]?>"><?= $space["nombre"]?></option>
              <?php } }?>
            </select>
          </div>
          <div class="form-group">
            <label><?= i18n("User") ?>:</label>
            <select name="user" class="form-control" required="required">
              <option value=""></option>
            <?php foreach($users as $user=> $value){ ?>
              <?php if($value["profile"]=="monitor"){ ?>
                <?php if($value["id"]==$session->getUserID()){ ?>
              <option value="<?php echo $value["id"]?>" selected ><?php echo i18n($value["name"])?></option>
             <?php  } else {  ?>
              <option value="<?php echo $value["id"]?>" ><?php echo i18n($value["name"])?></option>
             <?php } } }  ?>
             </select>
          </div>
              <input type="hidden" name="id" value="<?= $session->getID() ?>">
             <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
