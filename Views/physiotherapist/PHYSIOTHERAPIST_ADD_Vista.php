<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Add Physiotherapist Session");
$physiotherapist = $view->getVariable("physiotherapist");
$clients = $view->getVariable("clients");
$hours = $view->getVariable("hours");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>
<?php $dias = array('1','2','3','4','5','6','7');$n=0;?>

<div class="jumbotron">
<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=physiotherapist&amp;action=show"><?= i18n("Show Physiotherapist Sessions") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Add Physiotherapist Sessions") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Add Physiotherapist Session")?></h1>
      <form physiotherapist="index.php?controller=physiotherapist&amp;action=add" method="POST">
      <div class="form-group">
        <label><?= i18n("Date") ?>:</label>
         <input type="date" name="day" id="day" class="form-control"  value="<?php echo date("Y"."-"."m"."-"."d");?>"  required="required" pattern="[0-9][0-9][0-9][0-9][-][0-9][0-9][-][0-9][0-9]">
      </div>
	  <div class="form-group">
        <label><?= i18n("Time") ?>:</label>
        <select name="time" class="form-control" id="horas">  
		<?php $fecha = $dias[date('N', strtotime(date("Y"."-"."m"."-"."d")))-1]; foreach($hours as $hour){if($fecha==$hour["dia"]){?>
          <option id="<?=$hour["dia"]?>" <?php if($n==0){$n++;echo 'selected="selected"';}?> value="<?= $hour["id"]?>"><?= $hour["hora_i"]." - ".$hour["hora_f"]?></option>
		<?php }else{?>
		<option style="visibility: hidden; display:none"  id="<?=$hour["dia"]?>" value="<?= $hour["id"]?>"><?= $hour["hora_i"]." - ".$hour["hora_f"]?></option>
		<?php }}?>
		<option style="visibility: hidden; display:none" id="not_valid" value="not_valid"><?=i18n("There are no hours this day")?></option>
        </select>
	  </div>
      <div class="form-group">
        <label><?= i18n("Price") ?>:</label>
         <input type="number" name="price" class="form-control" minlength="2" required="required">
      </div>
      <div class="form-group">
        <label><?= i18n("Client") ?>:</label>
        <select name="client" class="form-control" required="required">			
          <?php foreach($clients as $client) {?>          
          <option display= 'none' value="<?= $client["id"]?>"><?= $client["apellidos_c"].", ".$client["nombre_c"]?> </option>
          <?php  }?>
        </select>
	  </div>
      <button type="submit" name="submit" class="btn btn-default"><?= i18n("Submit") ?></button>
      </form>
    </div>
</div>


