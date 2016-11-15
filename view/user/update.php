<?php  
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Update User");
$user = $view->getVariable("user");
$profiles = $view->getVariable("profiles");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
      <h1><?= i18n("Update User")?></h1>
        <a href="index.php?controller=user&action=permissions" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Manage Permissions</a><br />
      <form action="index.php?controller=user&amp;action=update" method="POST">
        <?= i18n("Name") ?>: <input type="text" name="username" value="<?php echo $user->getUsername(); ?>">
        <?= i18n("Password") ?>: <input type="password" name="passwd">
        <?= i18n("Profile") ?>: <select name="profile">
        <option value=""></option>
        <?php foreach($profiles as $profile) {?>
            <?php if ($profile->getProfileName() == $user->getProfile()): ?>
            <option value="<?= $profile->getProfileName()?>" selected><?= $profile->getProfileName()?></option>
            <?php else: ?>
            <option value="<?= $profile->getProfileName()?>"><?= $profile->getProfileName()?></option>
            <?php endif ?>
        <?php }?>
        </select>
      <input type="hidden" name="id" value="<?= $user->getID() ?>">
      <input type="submit" name="submit" value="<?= i18n("Update User") ?>">
</form>
    </div>
</div>