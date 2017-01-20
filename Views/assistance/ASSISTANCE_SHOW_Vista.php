<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Assistance Control");
$inscriptions = $view->getVariable("inscriptions");
$sesion = $view->getVariable("sesion");
$date = $view->getVariable("date");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
  <div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Assistance Control") ?></li>
  </ol>
  </div>
    <div class="container">
      <h1><?= i18n("Assistance Control")?></h1>
      <h3><?= i18n("Activity") .": " ?><?php  echo $inscriptions[0]["actividad"] ?></h3>
      <h3><?= i18n("Date").": " ?><?php  echo $date[0]["dia"] ?></h3>
      <h3><?= i18n("Start").": " ?><?php  echo $date[0]["hora_inicio"] ?></h3>
      <h3><?= i18n("End").": " ?><?php  echo $date[0]["hora_fin"] ?></h3>
    <table class="table top-buffer">
          <thead>
            <tr>
              <th><?= i18n("Name Client") ?></th>
              <th><?= i18n("DNI Client") ?></th>
              <th><?= i18n("Check Assistance") ?></th>
              <th style="width: 72px;"></th>
            </tr>
          </thead>
          <tbody>
        <?php if($inscriptions!=NULL){ ?>
        <?php foreach($inscriptions as $inscription){ ?>
              <tr>
              <td><?php echo $inscription["nombre_c"]; ?></td>
              <td><?php echo $inscription["dni_c"]; ?></td>
              <form action="index.php?controller=assistance&amp;action=add" method="POST" class="top-buffer">
                <?php if(!empty($sesion)){ ?>
                  <td>
                <?php foreach($sesion as $ses){ ?>

                    <div class="checkbox">
                      <input type="hidden" name="id" value="<?= $date[0]["si"]?>">
                      <input type="hidden" name="actividad_id" value="<?= $inscriptions[0]["act"]?>">
                      <?php if($ses->getClientID()==$inscription["idclie"]){ ?>
                      <?php if($ses->getAssistance()){ ?>
                      <input type="checkbox" value="<?=$inscription["idclie"] ?>" name="check[]" checked>
                        <?php  } else {?>
                      <input type="checkbox" value="<?=$inscription["idclie"] ?>" name="check[]">
                          <?php  } ?>
                    </div>

                  <?php } } } ?>
                  <?php if(empty($sesion)){ ?>
                    <td>
                      <div class="checkbox">
                        <input type="hidden" name="id" value="<?= $date[0]["si"]?>">
                        <input type="hidden" name="actividad_id" value="<?= $inscriptions[0]["act"]?>">
                        <input type="checkbox" value="<?=$inscription["idclie"] ?>" name="check[]">
                      </div>

                    <?php }  ?>
                </td>
            </tr>
      <?php } } ?>
          </tbody>
          <tbody>
          <tr>
            <td>
            </td>
            <td>
            </td>
            <td>
            <button type="submit" name="submit" class="btn btn-default"><?= i18n("Submit") ?></button>
          </form>
            </td>
          </tr>
        </tbody>
    </table>
  </div>
</div>
