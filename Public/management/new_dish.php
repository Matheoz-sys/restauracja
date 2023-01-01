<?php
require_once __DIR__ . '/../../Controller/NewDishController.php';
?>

<main>
    <div class="new-dish">
        <label class="new-dish-label">Nowe Danie</label>
        <table class="new-dish-table">
            <form action="new_dish.php" method="POST">
                <tr>
                    <td>Nazwa</td>
                    <td><input type="text" name="DishName" required/></td>
                </tr>
                <tr>
                    <td>Cena</td>
                    <td><input type="number" name="DishPrice" min='1' step="any" required/></td>
                </tr>
                <tr>
                    <td>Składniki</td>
                    <td><input type="text" name="DishIngredient" maxlength="250" required/></td>
                </tr>
                <tr>
                    <td>Opis</td>
                    <td><textarea rows = "4" cols = "40" name="Description"></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">Dodaj</button></td>
                </tr>
            </form>
        </table>
        <?= process(); ?>
    </div>
</main>