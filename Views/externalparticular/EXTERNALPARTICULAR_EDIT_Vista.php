<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Update External Particular");
$externalparticular = $view->getVariable("externalparticular");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=externalparticular&amp;action=show"><?= i18n("List of External Particulars") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Update External Particular") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Update External Particular")?></h1>
      <form action="index.php?controller=externalparticular&amp;action=edit" method="POST">

		<div class="form-group">
          <label><?= i18n("Name") ?>:</label>
          <input type="text" name="name" class="form-control" value="<?php echo $externalparticular->getNombre(); ?>"  minlength="2" maxlength="40" required="required" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
        </div>
		
		<div class="form-group">
          <label><?= i18n("Surname") ?>:</label>
           <input type="text" name="surname" class="form-control" value="<?= $externalparticular->getApellidos()?>"  minlength="2" maxlength="40" required="required" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+">
        </div>
		
	     <div class="form-group">
            <label><?= i18n("Telephone") ?>:</label>
             <input type="tel" name="telephone" class="form-control" value="<?= $externalparticular->getTelefono()?>" minlength="9" maxlength="9" required="required" pattern="^[9|8|7|6]\d{8}$">
         </div>
		
		<input type="hidden" name="id" value="<?= $externalparticular->getID() ?>">
        <button type="submit" name="submit"class="btn btn-default"><?= i18n("Update") ?></button>
		<a href="index.php?controller=externalparticular&amp;action=show" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Volver") ?></a>
      </form>
    </div>
</div>