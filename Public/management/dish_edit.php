<?php
require_once __DIR__ . '/../../Controller/DishEditController.php';
?>

<main>
<div class="new-dish">
        <h2>Edytowane danie: <?= $dishData['meal_name']?></h2>
        <table class="new-dish-table">
            <form action="" method="POST">
                <tr>
                    <td>Nowa nazwa:</td>
                    <td><input type="text" name="DishName" value="<?= $dishData['meal_name']?>" required/></td>
                </tr>
                <tr>
                    <td>Nowa cena:</td>
                    <td><input type="number" name="DishPrice" min='1' step="any" value="<?= $dishData['meal_price']?>" required/></td>
                </tr>
                <tr>
                    <td>Nowe składniki:</td>
                    <td><input type="text" name="DishIngredient" maxlength="250" value="<?= $dishData['meal_ingredient']?>"/></td>
                </tr>
                <tr>
                    <td>Nowa kategoria:</td>
                    <td>
                        <select name="DishCategory" required>  
                            <?php foreach(DishCategoryModel::findAll() as $key) {?>
                                <option value="<?=$key['id']?>" <?=$key['id'] == $dishData['category_id'] ? 'selected' : '' ?>> <?= $key['category_name']?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Nowy opis:</td>
                    <td><textarea rows = "4" cols = "40" name="Description"><?=$dishData['meal_description']?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">Zapisz zmiany</button></td>
                </tr>
            </form>
        </table>
        <table class="new-dish-table">
            <form action="" method="POST">
                <tr>
                    <td>Chcę usunąc danie</td>
                    <td><input type="checkbox" name="delete" value="delete_dish"></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">Usuń danie</button></td>
                </tr>
            </form>
        </table>
    </div>
    <?= process(); ?>
</main>

<?php
Controller::insertHtmlEnd();