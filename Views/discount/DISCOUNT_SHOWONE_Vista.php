<?php
require_once(__DIR__."/../../core/ViewManager.php");

$view = ViewManager::getInstance();

$view->setVariable("title", "Show Discount");

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

    <li class="breadcrumb-item active"><?= i18n("Discount") ?></li>

  </ol>

  </div>

    <div class="container">

  	  <div class="row">

      <h1><?= i18n("Discount")?></h1>

      </div>


      <div class="row top-buffer">

        <table class="table">

        <tbody>

          <tr class="active">

            <th class="col-sm-2"><?= i18n("Identifier")?></th>

            <td class="col-sm-10"><?= $discount->getID() ?></td>

          </tr>

        </tbody>

        <tbody>

          <tr>

            <th><?= i18n("Description")?></th>

            <td><?= $discount->getDiscountDescription() ?></td>

          </tr>

        </tbody>

        <tbody>

          <tr class="active">

            <th><?= i18n("Category")?></th>

            <?php foreach($categories as $category => $value){ ?>

              <?php if($value["id"] == $discount->getCategoryid()) {?>

              <td><?=$value["tipo"] ?></td>

            <?php } }  ?>

          </tr>

        </tbody>

        </table>

    </div>

    </div>

</div>
