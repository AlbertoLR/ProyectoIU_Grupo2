<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create cash");
$cash = $view->getVariable("cash");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=cash&amp;action=show"><?= i18n("List of cash") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Create cash") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Create cash")?></h1>
      <form action="index.php?controller=cash&amp;action=add" method="POST">

	  <div class="form-group">
        <label><?= i18n("Amount") ?>:</label>
        <input type="text" name="cantidad" class="form-control"  placeholder="ej: 100" required="required" pattern="([0-9]+)" >
      </div>
	  
	  <div class="form-group">
        <label><?= i18n("Type") ?>:</label>
		<select name="tipo"  class="form-control" required="required" >
			<option><label><?= i18n("payment") ?></label></option>
			<option><label><?= i18n("cash income") ?></label></option>
			<option><label><?= i18n("withdraw") ?></label></option>
        </select>
      </div>
	
	   <div class="form-group">
         <label><?= i18n("Description") ?>:</label>
         <input type="text" name="descripcion" class="form-control"  placeholder="ej: Pago de una actividad" required="required" maxlength="90" "pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
       </div>	
		
	  <div class="form-group">
         <label><?= i18n("Payment id (ONLY FOR CASH INCOMES)") ?>:</label>
         <input type="text" name="pagoid" class="form-control"  placeholder="ej: 1"  pattern="[0-9]+">
       </div>
	  
	  <div class="form-group">
         <label><?= i18n("Date") ?>:</label>
         <input type="date" name="fecha" class="form-control" value="<?php echo date("Y-m-d");?>">
       </div>
	  
        <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
		<a href="index.php?controller=cash&amp;action=show" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Return") ?></a>
      </form>
    </div>
</div>