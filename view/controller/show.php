<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Controllers");
$controllers = $view->getVariable("controllers");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
	<a href="index.php?controller=controller&action=insert" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Create Controller</a>
<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Controller Name</th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($controllers as $controller){ ?>
          <tr>
	  <td><?php echo $controller->getID(); ?></td>
          <td><?php echo $controller->getControllerName(); ?></td>
          <td>
              <a href="index.php?controller=controller&action=showone&id=<?php echo $controller->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=controller&action=update&id=<?php echo $controller->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=controller&action=delete&id=<?php echo $controller->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>