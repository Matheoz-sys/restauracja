<?php
require_once __DIR__ . '/../../Controller/NewDishController.php';
?>

<main>
    <div class="new-dish">
        <label>Nowe Danie</label>
        <table class="new-dish-table">
            <form action="new_dish.php" method="POST">
                <tr>
                    <td>Nazwa</td>
                    <td><input type="text" name="DishName"></td>
                </tr>
                <tr>
                    <td>Cena</td>
                    <td><input type="number" name="DishPrice" min='1'></td>
                </tr>
                <tr>
                    <td>Składniki</td>
                    <td><input type="text" name="DishIngredient" min='1'></td>
                </tr>
                <tr>
                    <td><button type="submit">Dodaj</button></td>
                </tr>
            </form>
        </table>
    </div>
</main>