<div class="tables">
    <?php foreach ($tables as $table) : ?>
        <?php extract($table) ?>
        <?php $isOccupiedClass = $table['is_occupied'] == 1 ? " is_occupied" : ""; ?>
        <a href='/restauracja/staff/table_overview?id=<?= $id ?>' class='table<?= $isOccupiedClass ?>' id='<?= $id ?>'>
            <span class='table__number'><i class="fa-regular fa-hashtag"></i> <?= $table_number ?></span>
            <span><i class="fa-solid fa-person"></i> <?= $occupied_places_count . "/" . $places_count ?></span>
            <span style="width:100%; text-align:center">Id: <?= $id ?>
        </a>
    <?php endforeach ?>
</div>