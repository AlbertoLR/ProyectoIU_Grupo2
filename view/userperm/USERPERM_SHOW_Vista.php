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
<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>Controller</th>
          <th>Action</th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($userperms as $userperm){ ?>
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
</table><br />

        <form action="index.php?controller=userperm&amp;action=add" method="POST">
        User: <select name="user">
        <option value="" selected></option>
        <?php foreach($users as $user) {?>
            <option value="<?= $user->getID()?>"><?= $user->getUsername()?></option>
        <?php }?>
        </select>

        Permission: <select name="permission">
        <option value="" selected></option>
        <?php foreach($permissions as $permission) {?>
        <option value="<?= $permission->getID()?>"><?= $permission->getController()." ".$permission->getAction() ?></option>
        <?php }?>
        </select>
        
	    <input type="submit" name="submit" value="submit">
        </form>
    </div>
</div>