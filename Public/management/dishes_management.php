<?php
require_once __DIR__ . '/../../Controller/DishesManagementController.php';

$categories = getCategories();
$meals = getMeals(); 
?>

<main>
    <div class="buttons__container">
        <a class="button" href="new_dish.php">Dodaj danie</a>
    </div>
    <br>
    <div class="dishes-container">
        <div class='dishes-container-nav'>
            <ul>
                <?php foreach ($categories as $item) : ?>
                    <li>
                        <a href="#<?=$item['category_name']?>">
                            <?=$item['category_name']?></a>
                    </li>
                <?php endforeach ?>
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
                                <a href='/restauracja/Public/management/dish_edit.php?id=<?= $meal['id'] ?>' id='<?= $meal['id'] ?>'>Edytuj danie</a>
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

<?php
Controller::insertHtmlEnd();
