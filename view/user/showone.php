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
    <div class="container">
  	  <div class="row">
          <?php if($user->getFoto()){?>
            <div class="col-sm-4 col-sm-push-8"><img src="/IU/pictures/<?= $user->getFoto()?>" alt="<?= $user->getFoto()?>" width="100px" height="100px" /></div>
          <?php } else { ?>
            <div class="col-sm-4 col-sm-push-8"><img src="/IU/pictures/profile_image.png" alt="default_image" width="100px" height="100px" /></div>
          <?php } ?>
      <div class="col-sm-8 col-sm-pull-4"><h1><?= i18n("User")?></h1></div>
      </div>
      <div class="row top-buffer">
    		<table class="table" >
          <tr class="active">
            <th>ID:</th>
            <td><?= $user->getID() ?></td>
          </tr>
          <tr>
            <th>Profile:</th>
            <td><?= $user->getProfile() ?></td>
          </tr>
          <tr class="active">
            <th>DNI:</th>
            <td><?= $user->getDni() ?></td>
          </tr>
          <tr>
            <th>Nombre usuario:</th>
            <td><?= $user->getUsername() ?></td>
          </tr>
          <tr class="active">
            <th>Nombre:</th>
            <td><?= $user->getName() ?></td>
          </tr>
          <tr>
            <th>Apellidos:</th>
            <td><?= $user->getSurname() ?></td>
          </tr>
          <tr class="active">
            <th>Email:</th>
            <td><?= $user->getEmail() ?></td>
          </tr>
          <tr>
            <th>Fecha nacimiento:</th>
            <td><?= $user->getFechaNac() ?></td>
          </tr>
          <tr class="active">
            <th>Direccion:</th>
            <td><?= $user->getDireccion() ?></td>
          </tr>
          <tr>
            <th>Número cuenta:</th>
            <td><?= $user->getNumCuenta() ?></td>
          </tr>
          <tr class="active">
            <th>Tipo contrato:</th>
            <td><?= $user->getTipoContrato() ?></td>
          </tr>
          <tr>
            <th>Activo:</th>
            <td><?= $user->getActivo() ?></td>
          </tr>
          <tr class="active">
            <th class="col-md-2">Comentario:</th>
            <td class="col-md-2"><?= $user->getComentario() ?></td>
          </tr>
        </table>
      </div>
    </div>
</div>
