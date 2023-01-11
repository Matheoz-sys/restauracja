<?php
require_once __DIR__ . '/../../Controller/TableOverviewController.php';
?>


<div class="table-status">
    <h2>Stolik nr: <?= $table['table_number'] ?></h2>
    <table>
        <tr>
            <td>Status</td>
            <td><?= $table['is_occupied'] == 1 ? "zajęty" : "wolny" ?></td>
        </tr>
        <tr>
            <td>Miejsc:</td>
            <td><?= $table['places_count'] ?></td>
        </tr>
        <tr>
            <td>Zajęte miejsca:</td>
            <td><?= $table['occupied_places_count'] ?></td>
        </tr>
    </table>
</div>
<a href='/restauracja/Public/management/new_order.php?id=<?= $table['table_number'] ?>' id='<?= $table['table_number'] ?>'>Zamów</a>
</div>

<?php
Controller::insertHtmlEnd();
