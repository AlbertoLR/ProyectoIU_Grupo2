<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$restrictions = array('userperm', 'profileperm');
$currentuser = $view->getVariable("currentusername");
$controllers = $view->getVariable("user_controllers");
$days1= $view->getVariable("days1");
$days2= $view->getVariable("days2");
$days3= $view->getVariable("days3");
$days4= $view->getVariable("days4");
$days5= $view->getVariable("days5");
$week= $view->getVariable("week");
$view->setVariable("title", "Login");
$errors = $view->getVariable("errors");
$permissions = $view->getVariable("permissions");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); echo $week?>
  <div class="jumbotrone">
	   <div class="container">
	      <?php if (isset($currentuser)): ?>
		    <h1><?= sprintf(i18n("Welcome to Moovett %s"), $currentuser);$c=-1 ?></h1>

        <?php  foreach ($days1 as $day => $value) {
              $c++;
              if($c<1){
                echo "<h3>Week of Monday ".$value["fecha"]."</h3>";
              }
          }?>
          <?php if ($week-1 == 0) {
            $weekA = 52;
          } else{
            $weekA = $week-1;
          }?>
          <div class="corner top-buffer">
            <form action="index.php?controller=user&amp;action=login" method="POST">
              <input type="number" name="wk" value="<?= $weekA ?>" hidden=true>
              <button type="submit" class="btn btn-default"><?= i18n("Semana Anterior") ?></button>
            </form>
            <?php if ($week+1 == 53) {
              $weekN=1;
            }else{
              $weekN = $week+1;
            } ?>
           <form action="index.php?controller=user&amp;action=login" method="POST">
             <input type="number" name="wk" value="<?= $weekN ?>" hidden=true>
             <button type="submit" class="btn btn-default"><?= i18n("Semana Siguiente") ?></button>
           </form>
       </div>


<div class="row top-buffer">

<table class="table">
  <thead>
    <tr>
      <th><?= i18n("Monday") ?></th>
      <th><?= i18n("Tuesday") ?></th>
      <th><?= i18n("Wednesday") ?></th>
      <th><?= i18n("Thursday") ?></th>
      <th><?= i18n("Friday") ?></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
      <?php foreach ($days1 as $day => $value) {?>
            <p><?php echo $value["hora_inicio"]." - ".$value["hora_fin"]."\n" ?></p>
            <p><a href="#"><?php echo $value["actividad"]."\n" ?></a><p>
            <p><a href="#"><?php echo $value["user"]."\n" ?></a><p>
            <p><a href="#"><?php echo $value["space"]."\n" ?></a><p>
            <hr>
        <?php }?>
        </td>
        <td class="active">
          <?php foreach ($days2 as $day => $value) {?>
              <p><?php echo $value["hora_inicio"]." - ".$value["hora_fin"]."\n" ?></p>
              <p><a href="#"><?php echo $value["actividad"]."\n" ?></a><p>
              <p><a href="#"><?php echo $value["user"]."\n" ?></a><p>
              <p><a href="#"><?php echo $value["space"]."\n" ?></a><p>
              <hr>
          <?php }?>
        </td>
        <td>
          <?php foreach ($days3 as $day => $value) {?>
              <p><?php echo $value["hora_inicio"]." - ".$value["hora_fin"]."\n" ?></p>
              <p><a href="#"><?php echo $value["actividad"]."\n" ?></a><p>
              <p><a href="#"><?php echo $value["user"]."\n" ?></a><p>
              <p><a href="#"><?php echo $value["space"]."\n" ?></a><p>
              <hr>
          <?php }?>
        </td>
        <td class="active">
          <?php foreach ($days4 as $day => $value) {?>
              <p><?php echo $value["hora_inicio"]." - ".$value["hora_fin"]."\n" ?></p>
              <p><a href="#"><?php echo $value["actividad"]."\n" ?></a><p>
              <p><a href="#"><?php echo $value["user"]."\n" ?></a><p>
              <p><a href="#"><?php echo $value["space"]."\n" ?></a><p>
              <hr>
          <?php }?>
        </td>
        <td>
          <?php foreach ($days5 as $day => $value) {?>
              <p><?php echo $value["hora_inicio"]." - ".$value["hora_fin"]."\n" ?></p>
              <p><a href="#"><?php echo $value["actividad"]."\n" ?></a><p>
              <p><a href="#"><?php echo $value["user"]."\n" ?></a><p>
              <p><a href="#"><?php echo $value["space"]."\n" ?></a><p>
              <hr>
          <?php }?>
        </td>
      </tr>
  </tbody>
</table>
</div>

  <div class="row top-buffer">
    <p><h3><?= i18n("Administer this site") ?></h3></p>
  </div>
    <div class="row top-buffer">

	    <?php foreach ($controllers as $controller) {?>
            <?php if (!in_array($controller, $restrictions)): ?>
        <div class="col-sm-4 form-group" >
          <a class="btn btn-primary btn-lg btn-block" href="index.php?controller=<?php echo $controller ?>&amp;action=show" role="button"><?= i18n($controller) ?>s &raquo;</a>
        </div>
            <?php endif ?>
      <?php }?>
    </div>
	    <?php else: ?>
	      <h1><?= i18n("Welcome to Moovett") ?></h1>
              <p><?= i18n("Please Login") ?></p>
	     <?php endif ?>
      </div>
    </div>
