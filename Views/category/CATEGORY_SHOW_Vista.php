<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Categories");
$categories = $view->getVariable("categories");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("List of Categories") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("List of Categories")?></h1>
	<a href="index.php?controller=category&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Category")?></a>
<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th><?= i18n("Category")?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($categories as $category){ ?>
          <tr>
	  <td><?php echo $category->getID(); ?></td>
          <td><?php echo $category->getType(); ?></td>
          <td>
              <a href="index.php?controller=category&action=showone&id=<?php echo $category->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=category&action=edit&id=<?php echo $category->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=category&action=delete&id=<?php echo $category->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
