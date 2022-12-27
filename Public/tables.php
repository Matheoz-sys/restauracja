<?php
require_once '../Controller/TablesOverviewController.php';
?>
<main>

    <div class="tables">
        <?= buildTablesOverviewView($tables); ?>
    </div>
</main>