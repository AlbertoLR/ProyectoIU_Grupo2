<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Send Notification");
$notifications = $view->getVariable("notifications");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<script>

function seleccionar_todo(){
	for (i=0;i<document.f1.elements.length;i++)
		if(document.f1.elements[i].type == "checkbox")
			document.f1.elements[i].checked=1
}
function deseleccionar_todo(){
	for (i=0;i<document.f1.elements.length;i++)
		if(document.f1.elements[i].type == "checkbox")
			document.f1.elements[i].checked=0
}
</script>

<div class="jumbotron">
<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Send Notification") ?></li>
  </ol>
  </div>
    <div class="container">
	<a href="index.php?controller=notification&amp;action=search" class="btn btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> <?= i18n("Advanced Search") ?></a>
	<h1><?= i18n("Send Notification")?></h1>

        <div ="top-buffer">
		<form name="f1" action="index.php?controller=notification&amp;action=add" method="POST">
        <a href="javascript:seleccionar_todo()"><?=i18n("Set All")?></a> |
		<a href="javascript:deseleccionar_todo()"><?=i18n("Unset All")?></a> |
		<table class="table">
              <thead>
                <tr>
                  <th><a href="index.php?controller=notification&amp;action=show&amp;orderby=name"><?=i18n("Name")?></a></th>
                  <th><a href="index.php?controller=notification&amp;action=show&amp;orderby=surname"><?=i18n("Surname")?></a></th>
                  <th><a href="index.php?controller=notification&amp;action=show&amp;orderby=activity"><?=i18n("Activity")?></a></th>
                  <th><a href="index.php?controller=notification&amp;action=show&amp;orderby=email"><?=i18n("Email")?></a></th>
                  <th style="width: 36px;"></th>
                </tr>
              </thead>
              <tbody>
        	  <?php foreach($notifications as $notification){ ?>
                  <tr>
        	      <td><?php echo $notification->getName(); ?></td>
                  <td><?php echo $notification->getSurname(); ?></td>
                  <td><?php echo $notification->getActivity(); ?></td>
                  <td><?php echo $notification->getEmail(); ?></td>
                  <td>
                      <input type="checkbox" name="misemails[]" value=<?php echo $notification->getEmail(); ?>>
                  </td>
                </tr>
        	<?php } ?>
              </tbody>
        </table>
		<?= i18n("Subject")?>: <input type="text" name="subject" minlength="2" maxlength="30"></br></br>
		<?= i18n("Message")?>:</br> <textarea type="textarea" name="message" cols="40" rows="10" minlength="2"></textarea></br>
		<input type="submit" value=<?= i18n("Send") ?>>
		</form>
      </div>
    </div>
</div>
