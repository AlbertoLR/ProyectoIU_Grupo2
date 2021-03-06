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
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("List of Profile Permissions") ?></li>
  </ol>
  </div>
    <div class="container">

	<h1><?= i18n("List of Profile Permissions")?></h1>

        <form class="top-buffer" action="index.php?controller=profileperm&amp;action=add" method="POST">
          <div>
            <div class="col-xs-2">
              <div>
              <?= i18n("Profile")?>:
              </div>
              <select name="profile" class="form-control" id="ex1">
        <?php foreach($profiles as $profile) {?>
            <option value="<?= $profile->getID()?>"><?= $profile->getProfileName()?></option>
        <?php }?>
        </select>
      </div>
      <div>
        <?= i18n("Permission")?>:
      </div>

        <select name="permission[]" multiple id="example-getting-started">
        <?php foreach($permissions as $permission) {?>
        <option value="<?= $permission->getID()?>"><?= $permission->getController()." ".$permission->getAction() ?></option>
        <?php }?>
        </select>

         <button type="submit" name="submit" value="submit" class="btn btn-default"><?= i18n("Submit") ?></button>
        </form>
        </div>

        <div ="top-buffer">
        <table class="table">
              <thead>
                <tr>
                  <th><a href="index.php?controller=profileperm&amp;action=show&amp;orderby=id">#</a></th>
                  <th><a href="index.php?controller=profileperm&amp;action=show&amp;orderby=profilename">Profile</a></th>
                  <th><a href="index.php?controller=profileperm&amp;action=show&amp;orderby=controller">Controller</a></th>
                  <th><a href="index.php?controller=profileperm&amp;action=show&amp;orderby=action">Action</a></th>
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
      </div>
    </div>
</div>
