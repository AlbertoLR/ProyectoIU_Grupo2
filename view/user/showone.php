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
