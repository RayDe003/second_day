<div class="admin_add">
    <div class="admin_block">
        <h3 class="h3_admin"> Добавить </h3>
        <form class="add_lobrarian" method="post">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <div class="div_form_admin">
                <label>Фамилия<input class="admin_form" type="text" name="surname"></label>
                <label>Имя <input class="admin_form" type="text" name="name"></label>
                <label>Отчество<input class="admin_form" type="text" name="patronymic"></label>
                <label>Логин<input class="admin_form" type="text" name="login"></label>
                <label>Пароль<input class="admin_form" type="text" name="password"></label>
            </div>
            <button class="submit_btn">Добавить</button>
        </form>

        <h3><?= $message ?? ''; ?></h3>
    </div>

    <div class="admin_block">
        <form method="get" class="search">
            <label><input class="search_input" type="text" name="search" placeholder="Поиск"></label>
            <button type="submit" class="search_button">Найти</button>
        </form>

        <?php if (isset($librarian)): ?>
            <div class="admin_LibList">
                <p>ФИО: <?= $librarian->surname ?> <?= $librarian->name ?> <?= $librarian->patronymic ?></p>
                <p>Логин: <?= $librarian->login ?></p>
            </div>
        <?php else: ?>
            <div class="admin_LibList">
                <?php foreach ($librarians as $librarian): ?>
                <div>
                    <p>ФИО: <?= $librarian->surname ?> <?= $librarian->name ?> <?= $librarian->patronymic ?></p>
                    <p>Логин: <?= $librarian->login ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <a href="?clear" class="reset_button">Сбросить</a>
    </div>




</div>

