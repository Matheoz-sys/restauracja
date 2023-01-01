<?php
require_once __DIR__ . '/../../Controller/TablesManagementOverviewController.php';
?>

<main>
    <div class="tables">
        <?= buildTablesOverviewView($tables); ?>
    </div>
</main>