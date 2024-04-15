<h2><?= $message ?? ''; ?></h2>

<div class="main_block">
    <h2 class="auth_title">Авторизация</h2>

<!--    <h3>--><?php //= app()->auth->user()->name ?? ''; ?><!--</h3>-->
    <?php
    if (!app()->auth::check()):
        ?>
        <form class="auth_form" method="post">
            <p>Логин</p>
            <label><input class="auth_label " type="text" name="login"></label>
            <p>Пароль</p>
            <label><input class="auth_label label-password" type="password" name="password"></label>
            <button class="auth_btn">Войти</button>
        </form>
    <?php endif ?>

</div>

<?php
//?>
