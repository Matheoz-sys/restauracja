<?php
require_once __DIR__ . '/../../Controller/DishesManagementController.php';

$categories = getCategories();
$meals = getMeals();
?>


<div class="buttons__container">
   <a class="button" href="new_dish.php">Dodaj danie</a>
</div>
<br>
<!-- <div class="dishes-container"> -->
<div class='dishes-container-nav'>
   <ul>
      <?php foreach ($categories as $category) : ?>
         <li>
            <a href="#<?= $category['category_name'] ?>">
               <?= $category['category_name'] ?></a>
         </li>
      <?php endforeach ?>
   </ul>
</div>
<div>
   <?php foreach ($categories as $category) : ?>
      <section class="dishes-container-section" id="<?= $category['category_name'] ?>">
         <h3><?= $category['category_name'] ?></h3>
         <ul class="dishes-container-ul">
            <?php
            foreach ($meals as $meal) {
               if ($category['id'] == $meal['category_id']) { ?>
                  <li class="dishes-container-li">
                     <div class="dishes-container-meal">
                        <h4>Nazwa: <?= $meal['meal_name'] ?></h4>
                        <p>Składniki: <?= $meal['meal_ingredient'] ?></p>
                        <p>Opis: <?= $meal['meal_description'] ?></p>
                        <p>Cena: <?= $meal['meal_price'] ?> zł</p>
                        <p>Kategoria: <?= $category['category_name'] ?> </p>
                     </div>
                     <div class="order-options">
                        <a class="button dish-edit-button" href='/restauracja/Public/management/dish_edit.php?id=<?= $meal['id'] ?>' id='<?= $meal['id'] ?>'><i class="fa-sharp fa-solid fa-pen-to-square"></i> Edytuj</a>
                     </div>
                  </li>
            <?php   }
            } ?>
         </ul>
      </section>
   <?php endforeach ?>
</div>
<!-- </div> -->


<?php
Controller::insertHtmlEnd();
