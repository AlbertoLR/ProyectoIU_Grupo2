<?php  
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Actions");
$actions = $view->getVariable("actions");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
	<a href="index.php?controller=action&action=insert" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Create Action</a>
<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Action Name</th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($actions as $action){ ?>
          <tr>
	  <td><?php echo $action->getID(); ?></td>
          <td><?php echo $action->getActionName(); ?></td>
          <td>
              <a href="index.php?controller=action&action=showone&id=<?php echo $action->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=action&action=update&id=<?php echo $action->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=action&action=delete&id=<?php echo $action->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
