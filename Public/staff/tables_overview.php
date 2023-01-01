<?php
require_once __DIR__ . '/../../Controller/TablesOverviewController.php';
?>

<main>
    <div class="tables">
        <?= buildTablesOverviewView($tables); ?>
    </div>
</main>

<?php
Controller::insertHtmlEnd();
