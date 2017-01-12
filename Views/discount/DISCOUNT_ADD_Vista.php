<?php
require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$view->setVariable("title", "Create Discount");

$discount = $view->getVariable("discount");

$categories = $view->getVariable("categories");

$errors = $view->getVariable("errors");
?>

<?= isset($errors["general"])?$errors["general"]:"" ?>

<?php $view->moveToDefaultFragment(); ?>

<div class="jumbotron">

  <div class="design">
  
  <ol class="breadcrumb">
  
    <li class="breadcrumb-item"><a href="index.php?controller=user&amp;action=login"><?= i18n("Home") ?></a></li>
	
    <li class="breadcrumb-item"><a href="index.php?controller=discount&amp;action=show"><?= i18n("List of Discounts") ?></a></li>
	
    <li class="breadcrumb-item active"><?= i18n("Create Discount") ?></li>
	
  </ol>
  
  </div>
  
    <div class="container">
	
      <h1><?= i18n("Create Discount")?></h1>
	  
      <form discount="index.php?controller=discount&amp;action=add" method="POST">
	  
      <div class="form-group">
	  
        <label><?= i18n("Description") ?>:</label>
		
         <input type="text" name="description" class="form-control" minlength="2" maxlength="50" required="required">
		 
      </div>
	  
	  <div class="form-group">
        <label><?= i18n("Quantity") ?>:</label>
         <input type="number" name="quantity" class="form-control" min="0" max="99" required="required">
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

function message(){
  <?php
  $message = i18n("A discount may have a quantity on the total price. Each discount belongs to an Discount Category.");
  echo "alert('$message');";
  ?>
}
</script>