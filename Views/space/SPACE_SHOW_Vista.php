<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Spaces");
$spaces = $view->getVariable("spaces");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
	<div class="design">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="index.php?controller=user&amp;action=login">
					<?=i18n("Home")?>
				</a>
			</li>
			<li class="breadcrumb-item">
				<a href="index.php?controller=space&amp;action=filter">
					<?=i18n("Filter")?>
				</a>
			</li>
			<li class="breadcrumb-itemactive">
				<?=i18n("Show Spaces")?>
			</li>
		</ol>
	</div>
	<div class="container">
    <h1><?= i18n("List of Spaces")?></h1>
	<a href="index.php?controller=space&action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Space")?></a>
	<a href="index.php?controller=space&amp;action=search" class="btn btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> <?= i18n("Advanced Search") ?></a>

<table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th><?= i18n("Space")?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($spaces as $space){ ?>
          <tr>
	  <td><?php echo $space->getID(); ?></td>
          <td><?php echo $space->getNombre(); ?></td>
          <td>
              <a href="index.php?controller=space&action=showone&amp;id=<?php echo $space->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=space&action=edit&amp;id=<?php echo $space->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=space&action=delete&amp;id=<?php echo $space->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>
