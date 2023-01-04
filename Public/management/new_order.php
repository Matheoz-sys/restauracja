<?php
require_once __DIR__ . '/../../Controller/NewOrderController.php';
?>

<main>
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
        <h2>Stolik nr:<?=$tableId?> </h2>
    </div>
    <div>
        <h2>Dodaj zamówienie</h2>
        <div class='dishes-container-nav'>
            <ul>
                <?php foreach ($categories as $item) : ?>
                    <li>
                        <a href="#<?=$item['category_name']?>">
                            <?=$item['category_name']?></a>
                    </li>
                <?php endforeach ?>
                <li>
                    <button class="new-order-button" type="submit" id="order-button">Zamów</button>
                </li>
            </ul>
        </div>
        <div>
            <?php foreach ($categories as $id) : ?>
            <section class="dishes-container-section" id="<?=$id['category_name']?>">
                <h3><?=$id['category_name']?></h3>
                <ul class="dishes-container-ul">
                <?php 
                    foreach($meals as $meal)
                    {
                        if($id['id'] == $meal['category_id'])
                        {?>
                        <li class="dishes-container-li">
                            <div class="dishes-container-meal">
                                <h4>Nazwa: <?=$meal['meal_name']?></h4>
                                <p>Składniki: <?= $meal['meal_ingredient']?></p>
                                <p class="dishes-container-desc">Opis: <?= $meal['meal_description']?></p>
                                <p>Cena: <?= $meal['meal_price']?> zł</p>
                                <p>Kategoria: <?=$id['category_name']?> </p>
                                <div class="order-details">
                                    <button class="minus-order-button" id='<?= $meal['id']?>'> - </button>
                                    <span id='span<?= $meal['id']?>'>0</span>                    
                                    <button class="add-to-order-button" id='<?= $meal['id']?>'>Dodaj</button>                                       
                                </div>
                            </div>
                        </li>
                <?php   }
                    }?>
                </ul>
            </section>
            <?php endforeach ?>
        </div>
    </div>
</main>
<script src="/restauracja/dev/js/new_order.js"></script>
<?php
Controller::insertHtmlEnd();
