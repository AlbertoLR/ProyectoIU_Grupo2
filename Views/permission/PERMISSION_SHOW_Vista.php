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

            <a href="index.php?controller=userperm&amp;action=show" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Manage User Permissions")?></a>
            <a href="index.php?controller=profileperm&amp;action=show" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Manage Profile Permissions")?></a>

        <h1><?= i18n("List of Controller Actions")?></h1>
        <form class="top-buffer" action="index.php?controller=permission&amp;action=add" method="POST">
          <div>
            <div class="col-xs-2">
              <div>
                <?= i18n("Controller") ?>:
              </div>
        <select name="controller" class="form-control" id="ex1">
        <?php foreach($controllers as $controller) {?>
            <option value="<?= $controller->getControllerName()?>"><?= $controller->getControllerName()?></option>
        <?php }?>
        </select>
      </div>
        <div>
          <?= i18n("Action") ?>:
        </div>

        <select name="action[]" multiple id="example-getting-started">
        <?php foreach($actions as $action) {?>
            <option value="<?= $action->getActionName()?>"><?= $action->getActionName()?></option>
        <?php }?>
        </select>
	       <button type="submit" name="submit" value="submit" class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
      </div>

      <div class="top-buffer">
      <table class="table">
      <thead>
        <tr>
          <th><a href="index.php?controller=permission&amp;action=show&amp;orderby=id">#</a></th>
          <th><a href="index.php?controller=permission&amp;action=show&amp;orderby=controller">Controller</a></th>
          <th><a href="index.php?controller=permission&amp;action=show&amp;orderby=action">Action</a></th>
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
    </div>
</div>
