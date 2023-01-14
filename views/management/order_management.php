<div class="order-list-conteiner">
    <ul class="order-list-ul">
        <?php foreach ($orders as $item) : ?>
            <li class="draggable" draggable="true">
                <div>
                    <h3>Zamówienie nr:<?= $item['id'] ?></h3>
                    <table class="order-list-table">
                        <tr>
                            <td>Dla stolika nr: </td>
                            <td><?= $item['tables_id'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Details:</td>
                        </tr>
                        <?php foreach (getOrderItems($item['id']) as $i) : ?>
                            <tr>
                                <td><?= getMealName($i['meal_id']) ?></td>
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

<script src="../../dev/js/order_list.js"></script>