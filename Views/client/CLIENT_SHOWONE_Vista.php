<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show Client");
$client = $view->getVariable("client");
$injuries = $view->getVariable("injuries");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
  	  <div class="row">
            <?php if($client->getPhoto()){?>
              <div class="col-sm-4 col-sm-push-8"><img src=<?= basename(__FILE__)."../../pictures/".$client->getPhoto() ?> alt="<?= $client->getPhoto()?>" width="100px" height="100px" /></div>
            <?php } else { ?>
              <div class="col-sm-4 col-sm-push-8"><img src=<?= basename(__FILE__)."../../pictures/profile_image.png" ?> alt="default_image" width="100px" height="100px" /></div>
            <?php } ?>
      <div class="col-sm-8 col-sm-pull-4"><h1><?= i18n("Client")?></h1></div>
    </div>
    <div class="row top-buffer">
        <a href="index.php?controller=client&amp;action=inscriptions&amp;id=<?=$client->getID()?>" class="btn btn-default"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <?= i18n("View Inscriptions") ?></a>
    </div>
      <div class="row top-buffer">
    		<table class="table" >
          <tr class="active">
            <th><?= i18n("Identifier")?>:</th>
            <td><?= $client->getID() ?></td>
          </tr>
          <tr>
            <th><?= i18n("DNI")?>:</th>
            <td><?= $client->getDni() ?></td>
          </tr>
          <tr class="active">
            <th><?= i18n("Name")?></th>
            <td><?= $client->getName() ?></td>
          </tr>
          <tr>
            <th><?= i18n("Surname")?>:</th>
            <td><?= $client->getSurname() ?></td>
          </tr>
          <tr class="active">
            <th><?= i18n("Birthdate")?>:</th>
            <td><?= $client->getBirthday() ?></td>
          </tr>
          <tr>
            <th><?= i18n("Profession")?>:</th>
            <?php if($client->getProfession()){ ?>
            <td><?= $client->getProfession() ?></td>
            <?php } else{ ?>
              <td><?= i18n("No") ?></td>
            <?php }  ?>
          </tr>
          <tr class="active">
            <th><?= i18n("Phone")?>:</th>
            <td><?= $client->getPhone() ?></td>
          </tr>
          <tr>
            <th><?= i18n("Address")?>:</th>
            <td><?= $client->getAddress() ?></td>
          </tr>
          <tr class="active">
            <th><?= i18n("Email")?>:</th>
            <td><?= $client->getEmail() ?></td>
          </tr>
          <tr >
            <th><?= i18n("Alert Fault")?>:</th>
              <?php if($client->getAlert()){ ?>
              <td><?= i18n("Yes") ?></td>
              <?php } else { ?>
              <td><?= i18n("No") ?></td>
              <?php } ?>
          </tr>
          <tr class="active">
            <th><?= i18n("Unemployed")?>:</th>
              <?php if($client->getUnemployed()){ ?>
              <td><?= i18n("Yes") ?></td>
              <?php } else { ?>
              <td><?= i18n("No") ?></td>
              <?php } ?>
          </tr>
          <tr >
            <th><?= i18n("Student")?>:</th>
              <?php if($client->getStudent()){ ?>
              <td><?= i18n("Yes") ?></td>
              <?php } else { ?>
              <td><?= i18n("No") ?></td>
              <?php } ?>
          </tr>
          <tr class="active">
            <th><?= i18n("Family")?>:</th>
              <?php if($client->getFamily()){ ?>
              <td><?= i18n("Yes") ?></td>
              <?php } else { ?>
              <td><?= i18n("No") ?></td>
              <?php } ?>
          </tr>
          <tr>
            <th><?= i18n("Bank account")?>:</th>
            <td><?= $client->getAccount() ?></td>
          </tr>
          <tr class="active">
            <th><?= i18n("Operating")?>:</th>
              <?php if($client->getActive()){ ?>
              <td><?= i18n("Yes") ?></td>
              <?php } else { ?>
              <td><?= i18n("No") ?></td>
              <?php } ?>
          </tr>
          <tr>
            <th><?= i18n("Injury")?></th>
            <td>
            <a href="index.php?controller=client&amp;action=injuries&amp;id=<?=$client->getID()?>" class="btn btn-default"><i aria-hidden="true"></i> <?= i18n("View Injuries") ?></a>
          </td>
          </tr>
          <tr class="active">
            <th class="col-md-2"><?= i18n("Comment")?></th>
            <td class="col-md-2"><?= $client->getComment() ?></td>
          </tr>
        </table>
      </div>
</div>
