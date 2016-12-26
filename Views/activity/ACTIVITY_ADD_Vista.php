<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "Create Activity");
$activity = $view->getVariable("activity");
$spaces = $view->getVariable("spaces");
$discounts = $view->getVariable("discounts");
$categories = $view->getVariable("categories");
$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">
    <div class="container">
      <h1><?= i18n("Create Activity")?></h1>
      <form activity="index.php?controller=activity&amp;action=add" method="POST">
      <div class="form-group">
        <label><?= i18n("Name") ?>:</label>
         <input type="text" name="name" class="form-control" minlength="2" required="required">
      </div>
      <div class="form-group">
        <label><?= i18n("Capacity") ?>:</label>
         <input type="number" name="capacity" class="form-control" minlength="2" required="required">
      </div>
      <div class="form-group">
        <label><?= i18n("Price") ?>:</label>
         <input type="number" name="price" class="form-control" minlength="2" required="required">
      </div>
      <div class="form-group">
        <label><?= i18n("Discount") ?>: <a onclick="message()">(Info)</a></label>
        <select name="discounts[]"  class="form-control" id="category" >
          <option  value=""></option>
          <?php foreach($discounts as $discount) {?>
          <option  value="<?= $discount["id"]."-".$discount["categoria_id"]?>"><?= $discount["descripcion"]."-".$discount["cantidad"]?></option>
          <?php }?>
        </select>
        <div class="message">
          <p><?= i18n("Press the next button to add the category associated with the selected discount") ?></p>
          <input type="button" class="btn btn-default" onclick="read_category()" value="<?= i18n("Asign Category") ?>" / >
        </div>
      </div>
      <div class="form-group" id="extra" style="visibility: hidden; display:none">
        <label><?= i18n("Extra discount") ?>:</label>
          <input type="number" name="extra" class="form-control" value="<?= $activity->getExtraDiscount()?>" minlength="2" >
      </div>
      <div class="form-group">
        <label><?= i18n("Space") ?>:</label>
        <select name="spaces" class="form-control" id="ex1">
          <option  value=""></option>
          <?php foreach($spaces as $space) {?>
          <option value="<?= $space["id"]?>"><?= $space["nombre"]?></option>
          <?php }?>
        </select>
      </div>
      <div class="form-group" id="limpiar">
        <label><?= i18n("Category") ?>:</label>
        <select name="categories" class="form-control" id="ex1">
          <option  value=""></option>
          <?php foreach($categories as $category) {?>
          <option value="<?= $category["id"]?>"><?= $category["tipo"]?></option>
          <?php }?>
        </select>
      </div>
      <button type="submit" name="submit" class="btn btn-default"><?= i18n("Submit") ?></button>
      </form>
    </div>
</div>

<script>
function read_category(){
  var category = document.getElementById("category").value;
  if(category!=""){
    var capa=document.getElementById("limpiar");
    capa.style.visibility="hidden";
    capa.style.display="none";

    var capa1=document.getElementById("extra");
    capa1.style.visibility="visible";
    capa1.style.display="block";

  }else{
    var capa=document.getElementById("limpiar");
    capa.style.visibility="visible";
    capa.style.display="block";

    var capa1=document.getElementById("extra");
    capa1.style.visibility="hidden";
    capa1.style.display="none";
  }

}

function message(){
  <?php
  $message = i18n("An activity may have a discount on the total price. Each discount belongs to an Activity Category.");
  echo "alert('$message');";
  ?>
}
</script>
