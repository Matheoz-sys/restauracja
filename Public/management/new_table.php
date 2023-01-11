<?php
require_once __DIR__ . '/../../Controller/NewTableController.php';
?>


<div class="new-table">
   <h1>Nowy stolik</h1>
   <table>
      <form method="POST">
         <tr class="<?= addErrorClass($errors['table_number'] ?? []) ?>">
            <td ">Numer stolika</td>
               <td><input type=" text" name="table_number" required />
            </td>
         </tr>
         <tr>
            <td colspan="2"><?= listErrors($errors['table_number'] ?? []) ?></td>
         </tr>
         <tr class="<?= addErrorClass($errors['places_count'] ?? []) ?>">
            <td>Liczba miejsc</td>
            <td><input type="number" name="places_count" step="any" required /></td>
         </tr>
         <tr>
            <td colspan="2"><?= listErrors($errors["places_count"] ?? []) ?></td>
         </tr>
         <tr>
            <td colspan="2"><button type="submit">Dodaj</button></td>
         </tr>
      </form>
   </table>
</div>


<?php
Controller::insertHtmlEnd();
