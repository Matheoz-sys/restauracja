<?php
require_once __DIR__ . '/../../Controller/TableEditController.php';
?>


<div class="new-table">
    <table>
        <form method="POST">
            <tr class="<?= addErrorClass($errors['table_number'] ?? []) ?>">
                <td>Numer stolika</td>
                <td><input type=" text" name="table_number" required value="<?= $tableData['table_number'] ?? "" ?>" /></td>
            </tr>
            <tr>
                <td colspan="2"><?= listErrors($errors['table_number'] ?? []) ?></td>
            </tr>
            <tr class="<?= addErrorClass($errors['places_count'] ?? []) ?>">
                <td>Liczba miejsc</td>
                <td><input type="number" name="places_count" step="any" required value="<?= $tableData['places_count'] ?? 0 ?>" /></td>
            </tr>
            <tr>
                <td colspan="2"><?= listErrors($errors["places_count"] ?? []) ?></td>
            </tr>
            <tr>
                <td colspan="2"><button type="submit">Zaktualizuj</button></td>
            </tr>
        </form>
    </table>
</div>


<?php
Controller::insertHtmlEnd();
