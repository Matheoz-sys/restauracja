<div class="table-status">
    <h2>Stolik nr: <?= $table['table_number'] ?></h2>
    <table>
        <tr>
            <td>Status</td>
            <td class="table-occupied"><?= $table['is_occupied'] == 1 ? "zajęty" : "wolny" ?></td>
        </tr>
        <tr>
            <td>Miejsc:</td>
            <td><?= $table['places_count'] ?></td>
        </tr>
        <tr>
            <td>Zajęte miejsca:</td>
            <td><button onClick="removePersonFromTable()" class="remove-button button">-</button><span data-id=<?= $table['id'] ?> class="occupiedPlaces" style="margin: 1rem;"><?= $table['occupied_places_count'] ?></span><button onClick="addPersonToTable()" class="add-button button">+</button></td>
        </tr>
    </table>
    <a class="button order-button" href='/restauracja/management/new_order?id=<?= $table['id'] ?>&nr=<?= $table['table_number'] ?>' id='<?= $table['id'] ?>'>Zamów</a>
</div>

<div class="order-list-conteiner">
    <ul class="order-list-ul">
        <?php foreach ($orders as $item) : ?>
            <li class="draggable" draggable="true">
                <div>
                    <h3>Zamówienie nr:<?= $item['id'] ?></h3>
                    <table class="order-list-table">
                        <tr>
                            <td>Dla stolika nr: </td>
                            <td><?= OrderManagementController::getTableNr($item['tables_id']) ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Details:</td>
                        </tr>
                        <?php foreach (OrderManagementController::getOrderItems($item['id']) as $i) : ?>
                            <tr>
                                <td><?= OrderManagementController::getMealName($i['meal_id']) ?></td>
                                <td><?= $i['meal_amount'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                    <div class="order-status">
                        <!-- <p><?= $item['id'] ?></p> -->
                        <p id="status<?= $item['id'] ?>">Status: <?= $item['order_status'] ?></p>
                        <button id="<?= $item['id'] ?>" class="status-button">Zamówienie gotowe</button>
                        <div id="delete<?= $item['id'] ?>" class="confirm-hidden">
                            <form action="" method="post">
                                <input id="order-detail" type="hidden" name="delete-order" value="<?= $item['id'] ?>">
                                <input type="submit" value="Usuń z listy">
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
</div>

<script src="/restauracja/views/js/table_management.js"></script>
<script src="/restauracja/views/js/order_list.js"></script>