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
        <form method="get" class="search">
            <label><input class="readers_search_input" placeholder="Поиск" name="search"></label>
            <button type="submit" class="readers_search_btn">Найти</button>
        </form>
        <div class="lib_readersList">
            <?php if(isset($reader)): ?>
                <?php foreach ($reader as $selectedReader): ?>
                    <div class="readers_info_search">
                        <p>Номер книжки: <?= str_pad($selectedReader->id, 4, '0', STR_PAD_LEFT) ?> </p>
                        <p>ФИО: <?= $selectedReader->surname ?> <?= $selectedReader->name ?> <?= $selectedReader->patronymic ?></p>
                        <p>Телефон: <?= $selectedReader->phone_number ?> </p>
                        <a href="?reader_id=<?= $selectedReader->id-1 ?>" class="more_info_button">Подробнее</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php foreach ($readers as $key => $reader): ?>
                    <div class="readers_info_search">
                        <p>Номер книжки: <?= str_pad($reader->id,4 ,'0', STR_PAD_LEFT) ?> </p>
                        <p>ФИО: <?= $reader->surname ?> <?= $reader->name ?> <?= $reader->patronymic ?></p>
                        <p>Телефон: <?= $reader->phone_number ?> </p>
                        <a href="?reader_id=<?= $reader->id-1 ?>" class="more_info_button">Подробнее</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <a href="?clear" class="reset_button btn_readers">Сбросить</a>
    </div>
</div>


<div class="readers_books">
    <h2>Книги</h2>
    <?php if(isset($books) && count($books) > 0): ?>
        <?php foreach($books as $book): ?>
            <li><?php echo $book->title; ?></li>
        <?php endforeach; ?>
    <?php else: ?>
    <p>Книг нет</p>
    <?php endif; ?>
</div>