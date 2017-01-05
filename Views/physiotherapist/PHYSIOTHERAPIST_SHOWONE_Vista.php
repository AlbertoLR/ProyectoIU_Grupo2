<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Show Physiotherapist");
$physiotherapist = $view->getVariable("physiotherapist");
$clients = $view->getVariable("clients");
$hours = $view->getVariable("hours");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>
<?php $array_date=$physiotherapist->getDay();?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
<div class="design">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
    <li class="breadcrumb-item"><a href="index.php?controller=physiotherapist&amp;action=show"><?= i18n("Show Physiotherapist Sessions") ?></a></li>
    <li class="breadcrumb-item active"><?= i18n("Show One Physiotherapist Session") ?></li>
  </ol>
  </div>
    <div class="container">
  	  <div class="row">
      <h1><?= i18n("Physiotherapist Session")?></h1>
      </div>
      <div class="row top-buffer">
        <table class="table">
        <tbody>
          <tr class="active">
            <th class="col-sm-2"><?= i18n("Identifier")?></th>
            <td class="col-sm-10"><?= $physiotherapist->getID() ?></td>
          </tr>
        </tbody>
        <tbody>
          <tr>
            <th><?= i18n("Date")?></th>
			<td><?=$array_date[8].$array_date[9].$array_date[7].$array_date[5].$array_date[6].$array_date[4].$array_date[0].$array_date[1].$array_date[2].$array_date[3]?></td>
          </tr>
        </tbody>
		<tbody>
          <tr>
            <th><?= i18n("Day")?></th>
			<?php foreach($hours as $hour => $value){if($value["id"] == $physiotherapist->getIDHour()) { ?>
            <td><?php $day=$value["dia"]; switch($day){case "1":echo i18n("monday");break;case "2":echo i18n("tuesday");break;case "3":echo i18n("wednesday");break;case "4":echo i18n("thursday");break;case "5":echo i18n("friday");break;case "6":echo i18n("saturday");break;case "7":echo i18n("sunday");break; }?></td>
          </tr>
        </tbody>
        <tbody>
          <tr>
            <th><?= i18n("Start Time")?></th>
            <td><?= $value["hora_i"] ?></td>
          </tr>
        </tbody>
		<tbody>
          <tr>
            <th><?= i18n("End Time")?></th>
            <td><?= $value["hora_f"] ?></td>
			<?php  } } ?>
          </tr>
        </tbody>		
		<tbody>
          <tr>
            <th><?= i18n("Attendance")?></th>
			<?php if(1 == $physiotherapist->getAttendance()) {?>
            <td><?= "Yes" ?></td>
			<?php } else{  ?>
			<td><?= "No" ?></td>
			<?php }  ?>

          </tr>
        </tbody>
        <tbody>
          <tr>
            <th><?= i18n("Client")?></th>
        	  <?php foreach($clients as $client => $value){ ?>
              <?php if($value["dni_c"] == $physiotherapist->getDni()) {?>
              <td><?=$value["apellidos_c"].", ".$value["nombre_c"].": ".$value["telefono"] ?></td>
            <?php } }  ?>
          </tr>
        </tbody> 
		<tbody>
          <tr>
            <th><?= i18n("Price")?></th>
            <td><?= $physiotherapist->getPrice() ?></td>
          </tr>
        </tbody>		
        </table>
    </div>
    </div>
</div>
