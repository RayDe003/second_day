<div class="libAdd_a">
    <a href="#bookForm">Книгу/Читателя</a>
    <a href="#authorForm"> Автора</a>
</div>

<div class="libAddMain" >
    <div class="bookForm" id="bookForm">
        <div class="libAdd" >
            <h3>Добавить книгу</h3>

            <form class="libAdd_form">
                <label><input class="libAdd_input" placeholder="Автор"></label>
                <label><input class="libAdd_input" placeholder="Заголовок"></label>
                <label><input class="libAdd_input" placeholder="Год выпуска"></label>
                <label><input class="libAdd_input" placeholder="Цена"></label>
                <div class="libAdd_radio">
                    <p>Новое издание: </p>
                    <label class="libAdd_radio_label" >Да <input  name="answer" id='Yes' class="libAdd_radio_input" type="radio"></label>
                    <label class="libAdd_radio_label" >Нет <input name="answer" id='No' class="libAdd_radio_input" type="radio"></label>
                </div>
                <label><input class="libAdd_input annotation" placeholder="Аннотация"></label>
                <button class="libAdd_btn">Добавить</button>
            </form>

        </div>

        <div class="libAdd">
            <h3>Добавить читателя</h3>

            <form class="libAdd_form">
                <label><input class="libAdd_input" placeholder="Номер книжки"></label>
                <label><input class="libAdd_input" placeholder="Имя"></label>
                <label><input class="libAdd_input" placeholder="Фаимлия"></label>
                <label><input class="libAdd_input" placeholder="Отчество"></label>
                <label><input class="libAdd_input" placeholder="Адрес"></label>
                <label><input class="libAdd_input" placeholder="Телефон"></label>
                <button class="libAdd_btn reader_add" >Добавить</button>
            </form>

        </div>
    </div>

    <div id="authorForm">

        <form class="AuthForm">
            <p>Добавить автора</p>
            <label><input class="AuthInput" placeholder="Фамилия"></label>
            <label><input class="AuthInput" placeholder="Имя"></label>
            <label><input class="AuthInput" placeholder="Отчество"></label>
            <button class="AuthBtn">Добавить</button>
        </form>
    </div>


</div>


