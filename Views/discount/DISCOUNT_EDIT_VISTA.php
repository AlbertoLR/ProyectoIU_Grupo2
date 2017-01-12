<?php
require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$view->setVariable("title", "Modify Discount");

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
	  
      <li class="breadcrumb-item active"><?= i18n("Modify Discount") ?></li>
	  
    </ol>
	
  </div>
  
    <div class="container">
	
      <h1><?= i18n("Modify Discount")?></h1>
	  
      <form discount="index.php?controller=discount&amp;action=edit" method="POST">
	  
      <div class="form-group">
	  
        <label><?= i18n("Description") ?>:</label>
         <input type="text" name="description" class="form-control" value="<?= $discount->getDiscountDescription()?>" minlength="2" maxlength="50" required="required">
		 
      </div>

      <div class="form-group">
	  
        <label><?= i18n("Quantity") ?>:</label>
		
         <input type="number" name="quantity" class="form-control" value="<?= $discount->getQuantity()?>" min="0" max="99" required="required">
		 
      </div>
	  
      <div class="form-group" id="limpiar">
	  
        <label><?= i18n("Category") ?>:</label>
		
        <select name="categories" class="form-control" >
		
          <?php foreach($categories as $category) {?>
		  
          <?php if($category["id"] == $discount->getCategoryid()) {?>
		  
            <option value="<?= $category["id"]?>"selected><?= $category["tipo"]?></option>
			
          <?php }else{ ?>
		  
          <option value="<?= $category["id"]?>"><?= $category["tipo"]?></option>
		  
          <?php } }?>
		  
        </select>
		
      </div>
	  
      <button type="submit" name="submit"class="btn btn-default"><?= i18n("Submit") ?></button>
	  
      </form>
	  
    </div>
	
</div>