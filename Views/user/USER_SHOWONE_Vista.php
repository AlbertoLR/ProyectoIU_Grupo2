<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show User");
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=show"><?= i18n("List of Users") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("User") ?></li>
  </ol>
  </div>
    <div class="container">
  	  <div class="row">
          <?php if($user->getFoto()){?>
            <div class="col-sm-4 col-sm-push-8"><img src=<?= basename(__FILE__)."../../pictures/".$user->getFoto() ?> alt="<?= $user->getFoto()?>" width="100px" height="100px" /></div>
          <?php } else { ?>
            <div class="col-sm-4 col-sm-push-8"><img src=<?= basename(__FILE__)."../../pictures/profile_image.png" ?> alt="default_image" width="100px" height="100px" /></div>
          <?php } ?>
      <div class="col-sm-8 col-sm-pull-4"><h1><?= i18n("User")?></h1></div>
      </div>
      <div class="row top-buffer">
    		<table class="table" >
          <tr class="active">
            <th><?= i18n("Identifier")?>:</th>
            <td><?= $user->getID() ?></td>
          </tr>
          <tr>
            <th><?= i18n("Profile")?>:</th>
            <td><?= $user->getProfile() ?></td>
          </tr>
          <tr class="active">
            <th>DNI:</th>
            <td><?= $user->getDni() ?></td>
          </tr>
          <tr>
            <th><?= i18n("Username")?>:</th>
            <td><?= $user->getUsername() ?></td>
          </tr>
          <tr class="active">
            <th><?= i18n("Name")?>:</th>
            <td><?= $user->getName() ?></td>
          </tr>
          <tr>
            <th><?= i18n("Surname")?>:</th>
            <td><?= $user->getSurname() ?></td>
          </tr>
          <tr class="active">
            <th><?= i18n("Email")?>:</th>
            <td><?= $user->getEmail() ?></td>
          </tr>
          <tr>
            <th><?= i18n("Birthdate")?>:</th>
            <td><?= $user->getFechaNac() ?></td>
          </tr>
          <tr class="active">
            <th><?= i18n("Address")?>:</th>
            <td><?= $user->getDireccion() ?></td>
          </tr>
          <tr>
            <th><?= i18n("Bank accout")?>:</th>
            <td><?= $user->getNumCuenta() ?></td>
          </tr>
          <tr class="active">
            <th><?= i18n("Contract")?>:</th>
            <td><?= $user->getTipoContrato() ?></td>
          </tr>
          <tr>
            <th><?= i18n("Operating")?>:</th>
              <?php if($user->getActivo()){ ?>
              <td><?= i18n("Yes") ?></td>
              <?php } else { ?>
              <td><?= i18n("No") ?></td>
              <?php } ?>
          </tr>
          <tr class="active">
            <th class="col-md-2">Comentario:</th>
            <td class="col-md-2"><?= $user->getComentario() ?></td>
          </tr>
        </table>
      </div>
    </div>
</div>
