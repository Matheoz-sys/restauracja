<div class="new-dish">
    <h1>Nowe Danie</h1>
    <table class="new-dish-table">
        <form action="new_dish" method="POST">
            <tr>
                <td>Nazwa</td>
                <td><input type="text" name="DishName" required /></td>
            </tr>
            <tr>
                <td>Cena</td>
                <td><input type="number" name="DishPrice" min='1' step="any" required /></td>
            </tr>
            <tr>
                <td>Składniki</td>
                <td><input type="text" name="DishIngredient" maxlength="250" required /></td>
            </tr>
            <tr>
                <td>Kategoria</td>
                <td>
                    <select name="DishCategory" required>
                        <option>Wybierz z listy</option>
                        <?php foreach (DishCategoryModel::findAll() as $category) { ?>
                            <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Opis</td>
                <td><textarea rows="4" cols="40" name="Description"></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit">Dodaj</button></td>
            </tr>
        </form>
    </table>
</div>