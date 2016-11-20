<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Permissions");
$permissions = $view->getVariable("permissions");
$controllers = $view->getVariable("controllers");
$actions = $view->getVariable("actions");
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
          <th>Controller</th>
          <th>Action</th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($permissions as $permission){ ?>
          <tr>
	      <td><?php echo $permission->getID(); ?></td>
          <td><?php echo $permission->getController(); ?></td>
          <td><?php echo $permission->getAction(); ?></td>
          <td>
              <a href="index.php?controller=permission&action=delete&amp;id=<?php echo $permission->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>

        <form class="top-buffer" action="index.php?controller=permission&amp;action=add" method="POST">
        Controller: <select name="controller">
        <option value="" selected></option>
        <?php foreach($controllers as $controller) {?>
            <option value="<?= $controller->getControllerName()?>"><?= $controller->getControllerName()?></option>
        <?php }?>
        </select>

        Action: <select name="action">
        <option value="" selected></option>
        <?php foreach($actions as $action) {?>
            <option value="<?= $action->getActionName()?>"><?= $action->getActionName()?></option>
        <?php }?>
        </select>

	       <button type="submit" name="submit" value="submit" class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
    </div>
</div>