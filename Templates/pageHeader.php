<div class="main-container">
    <div class="user-info"><?= $_COOKIE['loggedInAs'] ?? "" ?></div>
    <header>
        <h1><?= $pageTitle ?? "" ?></h1>
    </header>
    <?= Messager::readNotifications(); ?>