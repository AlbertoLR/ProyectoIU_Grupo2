<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Search Physiotherapist Session");
$physiotherapist = $view->getVariable("physiotherapist");
$clients = $view->getVariable("clients");
$hours = $view->getVariable("hours");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>
<?php $dias = array(i18n("monday"),i18n("tuesday"),i18n("wednesday"),i18n("thursday"),i18n("friday"),i18n("saturday"),i18n("sunday"));?>

<div class="jumbotron">
<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=physiotherapist&amp;action=show"><?= i18n("Show Physiotherapist Sessions") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Search Physiotherapist Sessions") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Search Physiotherapist Session")?></h1>
      <form physiotherapist="index.php?controller=physiotherapist&amp;action=search" method="POST">
      <div class="form-group">
        <label><?= i18n("Date") ?>:</label>
         <input type="date" name="day1" class="form-control" value="<?php echo date("Y"."-"."m"."-"."d");?>" pattern="[0-9][0-9][0-9][0-9][-][0-9][0-9][-][0-9][0-9]" >
      </div>
	  <div class="form-group">
        <label><?= i18n("Time") ?>:</label>
        <select name="time" class="form-control" id="horas"> 
		<option value="" selected></option>		
		<?php foreach($hours as $hour){$fecha = $dias[$hour["dia"]-1];?>
          <option id="<?=$hour["dia"]?>" value="<?= $hour["id"]?>"><?=$fecha.": ".$hour["hora_i"]." - ".$hour["hora_f"]?></option>
		<?php }?>		
      </select>
	  </div>	        
	  <div class="form-group">
        <label><?= i18n("Attendance") ?>:</label>
         <input type="checkbox" name="attendance" class="form-control" >
      </div>
	  <div class="form-group">
        <label><?= i18n("Price") ?>:</label>
         <input type="number" name="price" class="form-control" minlength="2">
      </div>
      <div class="form-group">
        <label><?= i18n("Client") ?>:</label>
        <select name="client" class="form-control">	
		<option value="" selected></option>		
          <?php foreach($clients as $client) {?>          
          <option value="<?= $client["dni_c"]?>"><?= $client["apellidos_c"].", ".$client["nombre_c"]?></option>
          <?php  }?>
        </select>
      </div>
      <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
      </form>
    </div>
</div>

