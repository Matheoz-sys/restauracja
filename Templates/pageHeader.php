<div class="main-container">
    <header>
        <h1><?= $pageTitle ?? "" ?></h1>
    </header>
    <?= Messager::readNotifications(); ?>