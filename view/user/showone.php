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
        <h1><?= i18n("User")?></h1>
        <div class="form-group">
        </div>
        <div class="row">
          <div>ID: <?= $user->getID() ?></div>
          <div>Profile: <?= $user->getProfile() ?></div>
          <div>DNI: <?= $user->getDni() ?></div>
          <div >Nombre usuario: <?= $user->getUsername() ?></div>
          <div>Nombre: <?= $user->getName() ?></div>
          <div>Apellidos: <?= $user->getSurname() ?></div>
          <div>Fecha nacimiento: <?= $user->getFechaNac() ?></div>
          <div>Direccion: <?= $user->getDireccion() ?></div>
          <div>Comentario: <?= $user->getComentario() ?></div>
          <div>Número cuenta: <?= $user->getNumCuenta() ?></div>
          <div>Tipo contrato: <?= $user->getTipoContrato() ?></div>
          <div>Email: <?= $user->getEmail() ?></div>
          <div>Activo: <?= $user->getActivo() ?></div>
        </div>
    </div>
</div>
