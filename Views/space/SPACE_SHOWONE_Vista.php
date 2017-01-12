<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show Space");
$space = $view->getVariable("space");
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
				<a href="index.php?controller=space&amp;action=show">
					<?=i18n("Show Spaces")?>
				</a>
			</li>
			<li class="breadcrumb-itemactive">
				<?=i18n("Space")?>
			</li>
		</ol>
	</div>
    <div class="container">
        <h1><?= i18n("Space")?></h1>
        <table class="table">
        <thead>
          <tr class="active">
            <th class="col-sm-2"><?= i18n("Identifier")?></th>
            <td class="col-sm-10"><?= $space->getID() ?></td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th><?= i18n("Name")?></th>
            <td><?= $space->getNombre() ?></td>
          </tr>
        </tbody>
      </table>
    </div>
</div>
