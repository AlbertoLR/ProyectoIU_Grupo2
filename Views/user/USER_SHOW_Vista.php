<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Users");
$users = $view->getVariable("users");
$users_json = $view->getVariable("users_json");
$errors = $view->getVariable("errors");
?>

<script type="text/javascript">
        var users = <?php echo $users_json ?>;
</script>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
<div class="design">
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
  <li class="breadcrumb-item active"><?= i18n("List of Users") ?></li>
</ol>
</div>
    <div class="container">
    <h1><?= i18n("List of Users") ?></h1>
	<a href="index.php?controller=user&amp;action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create User") ?></a>
    <a href="index.php?controller=userperm&amp;action=show" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Manage Permissions") ?></a>
    <a href="index.php?controller=user&amp;action=showdeleted" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("View Deleted Users") ?></a>
    <a href="index.php?controller=user&amp;action=search" class="btn btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> <?= i18n("Advanced Search") ?></a>
    <form action="index.php?controller=user&amp;action=showone" method="POST">
    <div class=" tt-dropdown-menu .tt-menu form-group top-buffer">
	   <?= i18n("Search") ?>: <input type="text" name="id" class="typeahead tt-query form-control" autocomplete="off" spellcheck="false">
    <div>
    </form>

<table class="table top-buffer">
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
              <a href="index.php?controller=user&amp;action=delete&amp;id=<?php echo $user->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
