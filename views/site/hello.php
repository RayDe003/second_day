<h2><?= $message ?? ''; ?></h2>


<div class="admin_add">
    <div class="admin_block">
        <h3 class="h3_admin"> Добавить </h3>
        <form class="add_lobrarian" method="post">
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
        <form class="search">
            <label><input class="search_input" type="text" placeholder="Поиск"></label>
            <button class="search_button">Найти</button>
        </form>

    </div>



</div>

