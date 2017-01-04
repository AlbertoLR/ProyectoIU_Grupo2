<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Manage Documents");
$documents = $view->getVariable("documents");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
<div class="design">
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
  <li class="breadcrumb-item active"><?= i18n("List of Documents") ?></li>
</ol>
</div>
    <div class="container">
    <h1><?= i18n("List of Documents") ?></h1>
	<a href="index.php?controller=document&amp;action=add" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("Create Document") ?></a>
    <a href="index.php?controller=document&amp;action=search" class="btn btn-default"><i class="fa fa-search-plus" aria-hidden="true"></i> <?= i18n("Advanced Search") ?></a>

<table class="table top-buffer">
      <thead>
        <tr>
          <th>#</th>
          <th><?= i18n("DNI") ?></th>
          <th><?= i18n("Client?") ?></th>
          <th><?= i18n("Type") ?></th>
          <th><?= i18n("Document") ?></th>
          <th style="width: 72px;"></th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach($documents as $document){ ?>
          <tr>
	      <td><?php echo $document->getID(); ?></td>
          <?php if ($document->getDNI()): ?>
            <td><?php echo $document->getDNI(); ?></td>
            <td></td>
          <?php else: ?>
            <td><?php echo $document->getDNIC(); ?></td>
            <td><i class="fa fa-check" aria-hidden="true"></i></td>
          <?php endif ?>
          <td><?php echo $document->getType() ?></td>
               <td><a href=<?= basename(__FILE__).'../../files/' . $document->getDocument() ?> ><?php echo $document->getDocument() ?></a></td>
          <td>
              <a href="index.php?controller=document&amp;action=showone&amp;id=<?php echo $document->getID();  ?>"><i class="fa fa-id-card" aria-hidden="true"></i></a>
              <a href="index.php?controller=document&amp;action=edit&amp;id=<?php echo $document->getID();  ?>"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i></a>
              <a href="index.php?controller=document&amp;action=delete&amp;id=<?php echo $document->getID();  ?>" role="button" data-toggle="modal"><i class="fa fa-times" aria-hidden="true"></i></a>
          </td>
        </tr>
	<?php } ?>
      </tbody>
</table>
    </div>
</div>