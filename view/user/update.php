<?php  
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Update User");
$user = $view->getVariable("user");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
      <h1><?= i18n("Update User")?></h1>
      <form action="index.php?controller=user&amp;action=update" method="POST">
        <?= i18n("Name") ?>: <input type="text" name="username" value="<?php echo $user->getUsername(); ?>">
        <?= i18n("Password") ?>: <input type="password" name="passwd" required>
        <?= i18n("Profile") ?>: <input type="text" name="profile" value="<?php echo $user->getProfile(); ?>">
      <input type="hidden" name="id" value="<?= $user->getID() ?>">
      <input type="submit" name="submit" value="<?= i18n("Update User") ?>">
</form>
    </div>
</div>