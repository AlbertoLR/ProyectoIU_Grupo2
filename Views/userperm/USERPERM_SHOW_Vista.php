<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Permissions");
$users = $view->getVariable("users");
$permissions = $view->getVariable("permissions");
$userperms = $view->getVariable("userperms");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
        <h1><?= i18n("List of User Permissions") ?></h1>
        <form action="index.php?controller=userperm&amp;action=add" method="POST">
          <div>
        <div class="col-xs-2">
          <div>
              <?= i18n("User") ?>:
          </div>
          <select name="user" class="form-control" id="ex1">
          <?php foreach($users as $user) {?>
              <option value="<?= $user->getID()?>"><?= $user->getUsername()?></option>
          <?php }?>
          </select>
        </div>
        <div>
          <?= i18n("Permission") ?>:
        </div>
        <select name="permission[]" multiple id="example-getting-started">
          <?php foreach($permissions as $permission) {?>
          <option value="<?= $permission->getID()?>"><?= $permission->getController()." ".$permission->getAction() ?></option>
          <?php }?>
        </select>

	    <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
      </div>
      <div  class="top-buffer">
      <table class="table">
        <thead>
          <tr>
            <th><a href="index.php?controller=userperm&amp;action=show&amp;orderby=id">#</a></th>
            <th><a href="index.php?controller=userperm&amp;action=show&amp;orderby=user"><?= i18n("User") ?></a></th>
            <th><a href="index.php?controller=userperm&amp;action=show&amp;orderby=controller"><?= i18n("Controller") ?></a></th>
            <th><a href="index.php?controller=userperm&amp;action=show&amp;orderby=action"><?= i18n("Action") ?></a></th>
            <th style="width: 36px;"></th>
          </tr>
        </thead>
        <tbody>
	         <?php foreach($userperms as $userperm) { ?>
          <tr>
	           <td><?php echo $userperm->getID(); ?></td>
             <td><?php echo $userperm->getUserName(); ?></td>
             <td><?php echo $userperm->getController(); ?></td>
             <td><?php echo $userperm->getAction(); ?></td>
             <td>
               <a href="index.php?controller=userperm&action=delete&id=<?php echo $userperm->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
            </td>
        </tr>
	         <?php } ?>
      </tbody>
    </table>
    </div>
</div>
</div>
