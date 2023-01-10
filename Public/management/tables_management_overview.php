<?php
require_once __DIR__ . '/../../Controller/TablesManagementOverviewController.php';
?>

<main>
   <div class="buttons__container">
      <a class="button" href="new_table.php">Dodaj stolik</a>
   </div>
   <div class="tables">
      <?php foreach ($tables as $table) : ?>
         <?php extract($table) ?>
         <a href='/restauracja/Public/management/table_edit.php?id=<?= $id ?>' class='table' id='<?= $id ?>'>
            <span><i class="fa-solid fa-person"></i> <?= $places_count ?></span>
            <span class='table__number'><i class="fa-regular fa-hashtag"></i> <?= $table_number ?></span>
            <span style="width:100%; text-align:center">Id: <?= $id ?>
         </a>
      <?php endforeach ?>
   </div>
</main>

<?php
Controller::insertHtmlEnd();
