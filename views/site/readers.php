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
    <form class="book_InfoForm" method="post" action="/changeStatus">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <?php if(isset($books) && count($books) > 0): ?>
            <?php foreach ($books as $book): ?>
                <div class="readers_BookInfo">
                    <h3><?=  $book->title ?></h3>
                    <?php foreach ($book->bookInstances as $instance): ?>
                        <?php if($instance->readerBooks): ?>
                            <?php foreach ($instance->readerBooks as $readerBook): ?>
                                <div class="status_dropdown">
                                    <form method="post" action="/changeStatus">
                                        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
                                        <?php echo "<input type='hidden' value='$readerBook->id' name='readerBook_id'>" ?>
                                        <p>ISBN: <?= $instance->ISBN ?></p>
                                        <p>Отдача: <?= $readerBook->get_out ?></p>
                                        <p>Возврат: <?= $readerBook->get_back ?></p>
                                        <label>Статус: </label>
                                        <select class="select_Status" name="status_id_<?= $readerBook->id ?>">
                                            <?php foreach ($status as $item): ?>
                                                <option value="<?= $item->id ?>"><?= $item->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" class="readers_btn">Изменить статус</button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Книг нет</p>
        <?php endif; ?>

    </form>

</div>