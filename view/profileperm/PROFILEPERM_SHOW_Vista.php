<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Permissions");
$profiles = $view->getVariable("profiles");
$permissions = $view->getVariable("permissions");
$profileperms = $view->getVariable("profileperms");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Profile</th>
          <th>Controller</th>
          <th>Action</th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($profileperms as $profileperm){ ?>
          <tr>
	      <td><?php echo $profileperm->getID(); ?></td>
          <td><?php echo $profileperm->getProfileName(); ?></td>
          <td><?php echo $profileperm->getController(); ?></td>
          <td><?php echo $profileperm->getAction(); ?></td>
          <td>
              <a href="index.php?controller=profileperm&action=delete&amp;id=<?php echo $profileperm->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
        <form class="top-buffer" action="index.php?controller=profileperm&amp;action=add" method="POST">
        Profile: <select name="profile">
        <option value="" selected></option>
        <?php foreach($profiles as $profile) {?>
            <option value="<?= $profile->getID()?>"><?= $profile->getProfileName()?></option>
        <?php }?>
        </select>
        Permission: <select name="permission">
        <option value="" selected></option>
        <?php foreach($permissions as $permission) {?>
        <option value="<?= $permission->getID()?>"><?= $permission->getController()." ".$permission->getAction() ?></option>
        <?php }?>
        </select>
	       <button type="submit" name="submit" value="submit" class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>
