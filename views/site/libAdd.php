<div class="libAdd_a">
    <a href="#bookForm">Книгу/Читателя</a>
    <a href="#authorForm"> Автора</a>
</div>

<div class="libAddMain" >
    <div class="bookForm" id="bookForm">
        <div class="libAdd" >
            <h3>Добавить книгу</h3>

            <form class="libAdd_form" action="/addBook">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <select class="libAdd_input" name="author_id">
                <?php
                foreach ($authors as $author){
                    $fullname = $author->name . ' ' . $author->surname . ' ' . $author->patronymic;
                    echo "<option label='$fullname'>$author->id</option>";

                }
                ?>

                </select>
                <label><input name="title" class="libAdd_input" placeholder="Заголовок"></label>
                <label><input name="year" class="libAdd_input" placeholder="Год выпуска"></label>
                <label><input name="price" class="libAdd_input" placeholder="Цена"></label>
                <div class="libAdd_radio">
                    <p>Новое издание: </p>
                    <label class="libAdd_radio_label" >Да <input  name="is_new" id='Yes' class="libAdd_radio_input" type="radio"></label>
                    <label class="libAdd_radio_label" >Нет <input name="is_new" id='No' class="libAdd_radio_input" type="radio"></label>
                </div>
                <label><input name="annotation" class="libAdd_input annotation" placeholder="Аннотация"></label>
                <button class="libAdd_btn">Добавить</button>
            </form>

        </div>

        <div class="libAdd">
            <h3>Добавить читателя</h3>

            <form class="libAdd_form" action="/readerAdd">
                <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                <label><input name="name" class="libAdd_input" placeholder="Имя"></label>
                <label><input name="surname" class="libAdd_input" placeholder="Фаимлия"></label>
                <label><input name="patronymic" class="libAdd_input" placeholder="Отчество"></label>
                <label><input name="address" class="libAdd_input" placeholder="Адрес"></label>
                <label><input name="phone_number" class="libAdd_input" placeholder="Телефон"></label>
                <button class="libAdd_btn reader_add" >Добавить</button>
            </form>

        </div>
    </div>

    <div id="authorForm">

        <form class="AuthForm" method="post" action="/libAdd">
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <p>Добавить автора</p>
            <label><input class="AuthInput" name="surname" placeholder="Фамилия"></label>
            <label><input class="AuthInput" name="name" placeholder="Имя"></label>
            <label><input class="AuthInput" name="patronymic" placeholder="Отчество"></label>
            <button class="AuthBtn">Добавить</button>
        </form>
    </div>


</div>

<h2><?= $message ?? ''; ?></h2>


