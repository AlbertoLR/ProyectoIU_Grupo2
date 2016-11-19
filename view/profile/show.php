<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Profiles");
$profiles = $view->getVariable("profiles");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
	<a href="index.php?controller=profile&action=insert" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Create Profile</a>
    <a href="index.php?controller=profileperm&amp;action=show" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Manage Permissions</a>
<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Profile Name</th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($profiles as $profile){ ?>
          <tr>
	  <td><?php echo $profile->getID(); ?></td>
          <td><?php echo $profile->getProfileName(); ?></td>
          <td>
              <a href="index.php?controller=profile&action=showone&amp;id=<?php echo $profile->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=profile&action=update&amp;id=<?php echo $profile->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=profile&action=delete&amp;id=<?php echo $profile->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
