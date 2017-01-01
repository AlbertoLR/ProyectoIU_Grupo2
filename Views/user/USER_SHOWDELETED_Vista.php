<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Users");
$users = $view->getVariable("users");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=show"><?= i18n("List of Users") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("List of Deleted Users") ?></li>
  </ol>
  </div>
    <div class="container">
        <h1><?= i18n("List of Deleted Users")?></h1>
<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th><?= i18n("Username") ?></th>
          <th><?= i18n("Profile") ?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($users as $user){ ?>
          <tr>
	      <td><?php echo $user->getID(); ?></td>
          <td><?php echo $user->getUsername(); ?></td>
          <td><?php echo $user->getProfile(); ?></td>
          <td>
              <a href="index.php?controller=user&amp;action=showone&amp;id=<?php echo $user->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=user&amp;action=edit&amp;id=<?php echo $user->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=user&amp;action=recovery&amp;id=<?php echo $user->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-undo" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
