<?php
require_once __DIR__ . '/../../Controller/NewOrderController.php';
?>


<div id="modal-window" class="confirm-hidden">
   <div class="confirm-message">
      <h3>Potwierdź zamowienie</h3>
      <form id="form" action="" method="post">
         <input id="order-detail" type="hidden" name="order-details" value="">
         <input type="submit" value="Zamawiam">
      </form>
   </div>
   <div class="blurred"></div>
</div>
<div>
   <h2>Stolik nr:<?= $tableId ?> </h2>
</div>
<div>
   <h2>Dodaj zamówienie</h2>
   <div class='dishes-container-nav'>
      <ul>
         <?php foreach ($categories as $item) : ?>
            <li>
               <a href="#<?= $item['category_name'] ?>">
                  <?= $item['category_name'] ?></a>
            </li>
         <?php endforeach ?>
         <li>
            <button class="new-order-button" type="submit" id="order-button">Zamów</button>
         </li>
      </ul>
   </div>
   <div>
      <?php foreach ($categories as $category) : ?>
         <section class="dishes-container-section" id="<?= $category['category_name'] ?>">
            <h3><?= $category['category_name'] ?></h3>
            <ul class="dishes-container-ul">
               <?php
               foreach ($meals as $meal) {
                  if ($meal['category_id'] == $category['id']) { ?>
                     <li class="dishes-container-li">
                        <div class="dishes-container-meal">
                           <h4>Nazwa: <?= $meal['meal_name'] ?></h4>
                           <p>Składniki: <?= $meal['meal_ingredient'] ?></p>
                           <p>Opis: <?= $meal['meal_description'] ?></p>
                           <p>Cena: <?= $meal['meal_price'] ?> zł</p>
                           <p>Kategoria: <?= $category['category_name'] ?></p>
                        </div>
                        <div class="order-options quantity-buttons">
                           <button class="add-to-order-button add-button" id='<?= $meal['id'] ?>'><i class="fa-sharp fa-solid fa-plus"></i></button>
                           <span id='span<?= $meal['id'] ?>'>0</span>
                           <button class="minus-order-button remove-button" id='<?= $meal['id'] ?>'><i class="fa-sharp fa-solid fa-minus"></i></button>
                        </div>
                     </li>
               <?php   }
               } ?>
            </ul>
         </section>
      <?php endforeach ?>
   </div>
</div>

<script src="/restauracja/dev/js/new_order.js"></script>
<?php
Controller::insertHtmlEnd();
