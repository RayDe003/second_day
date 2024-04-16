<div class="readers_cards">
    <div class="readers_info">
        <?php if (isset($_GET['reader_id'])): ?>
            <?php $selectedReader = $readers[$_GET['reader_id']]; ?>
        <p class="readers_number"> №<?= str_pad($selectedReader->id, 4, '0', STR_PAD_LEFT) ?></p>
        <p>ФИО: <?= $selectedReader->surname ?> <?= $selectedReader->name ?> <?= $selectedReader->patronymic ?> </p>
        <p>Адрес: <?= $selectedReader->address ?></p>
        <p>Номер телефона: <?= $selectedReader->phone_number ?> </p>
        <?php else: ?>
            <p class="readers_number">№0000</p>
            <p>ФИО:</p>
            <p>Адрес:</p>
            <p>Номер телефона:</p>
        <?php endif; ?>
    </div>


    <div class="readers_search">
        <form>
            <label><input class="readers_search_input" placeholder="Поиск"></label>
            <button class="readers_search_btn">Найти</button>
        </form>
        <div class="lib_readersList">
        <?php foreach ($readers as $key => $reader): ?>
            <div class="readers_info_search">
                <p>Номер книжки: <?= str_pad($reader->id,4 ,'0', STR_PAD_LEFT) ?> </p>
                <p>ФИО: <?= $reader->surname ?> <?= $reader->name ?> <?= $reader->patronymic ?></p>
                <p>Телефон: <?= $reader->phone_number ?> </p>
                <a href="?reader_id=<?= $reader->id-1 ?>" class="more_info_button">Подробнее</a>
            </div>
        <?php endforeach; ?>
        </div>
        <a href="?clear" class="reset_button btn_readers">Сбросить</a>
    </div>
</div>


<div class="readers_books">
    <h2>Книги</h2>
    <div class="readers_line"></div>



</div>