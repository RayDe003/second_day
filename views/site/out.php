<div class="outMain">
    <div class="outBlock">
        <p>Кому</p>
        <form method="get" class="search">
            <label><input class="outInput" placeholder="Поиск"></label>
            <button type="submit" class="out_search_btn">Найти</button>
        </form>
        <div class="out_readersList">
            <?php if(isset($reader)): ?>
                <?php foreach ($reader as $selectedReader): ?>
                    <div class="readers_info_search">
                        <p>Номер книжки: <?= str_pad($selectedReader->id, 4, '0', STR_PAD_LEFT) ?> </p>
                        <p>ФИО: <?= $selectedReader->surname ?> <?= $selectedReader->name ?> <?= $selectedReader->patronymic ?></p>
                        <p>Телефон: <?= $selectedReader->phone_number ?> </p>
                        <input type="hidden" name="selected_reader" value="<?= $selectedReader->id ?>">
                        <button class="more_info_button" onclick="selectReader(<?= $selectedReader->id ?>, '<?= $selectedReader->surname ?> <?= $selectedReader->name ?> <?= $selectedReader->patronymic ?>')">Выбрать</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php foreach ($readers as $key => $selectedReader): ?>
                    <div class="readers_info_search">
                        <p>Номер книжки: <?= str_pad($selectedReader->id, 4, '0', STR_PAD_LEFT) ?> </p>
                        <p>ФИО: <?= $selectedReader->surname ?> <?= $selectedReader->name ?> <?= $selectedReader->patronymic ?></p>
                        <p>Телефон: <?= $selectedReader->phone_number ?> </p>
                        <input type="hidden" name="selected_reader" value="<?= $selectedReader->id ?>">
                        <button class="more_info_button" onclick="selectReader(<?= $selectedReader->id ?>, '<?= $selectedReader->surname ?> <?= $selectedReader->name ?> <?= $selectedReader->patronymic ?>')">Выбрать</button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="outBlock">
        <p>Что</p>
        <form method="get" class="search">
            <label><input class="outInput" placeholder="Поиск"></label>
            <button type="submit" class="out_search_btn">Найти</button>
        </form>
        <div class="out_bookList">
            <?php if(isset($book)): ?>
                <?php foreach ($book as $selectedBook): ?>
                    <div class="books_info_search">
                        <p>Название: <?= $selectedBook->title ?></p>
                        <p>Издание: <?= $selectedBook->is_new  == 1 ? 'новое' : 'старое' ?></p>
                        <input type="hidden" name="selected_book" value="<?= $selectedBook->id ?>">
                        <button class="more_info_button" onclick="selectBook(<?= $selectedBook->id ?>, '<?= $selectedBook->title ?>')">Выбрать</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php foreach ($books as $key => $selectedBook): ?>
                    <div class="books_info_search">
                        <p>Название: <?= $selectedBook->title ?></p>
                        <p>Издание: <?= $selectedBook->is_new == 1 ? 'новое' : 'старое' ?></p>
                        <input type="hidden" name="selected_book" value="<?= $selectedBook->id ?>">
                        <button class="more_info_button" onclick="selectBook(<?= $selectedBook->id ?>, '<?= $selectedBook->title ?>')">Выбрать</button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="outBottom">
    <div class="container">
        <div class="outPerson">
            <p>Кому</p>
            <p class="outInput" id="selectedReaderName"><?= isset($_GET['selected_reader']) ? $_GET['selected_reader'] : ''; ?></p>
            <input type="hidden" id="selectedReaderId" name="selected_reader_id" value="<?= isset($_GET['reader_id']) ? $_GET['reader_id'] : ''; ?>">
        </div>

        <div class="outBook">
            <p>Что</p>
            <p class="outInput" id="selectedBookTitle"></p>
            <input type="hidden" id="selectedBookId" name="selected_book_id">
        </div>

        <div class="outDate">
            <p>Дата возврата</p>
            <label><input type="date" class="outInput"></label>
        </div>
        <div class="outNumber">
            <p>Издание</p>
            <label><input class="outInput"></label>
        </div>
    </div>

    <button class="outBtn"> оформить </button>
</div>

<script>
    function selectBook(bookId, bookTitle) {
        document.getElementById('selectedBookId').value = bookId;
        document.getElementById('selectedBookTitle').textContent = bookTitle;
    }
    function selectReader(readerId, readerName) {
        document.getElementById('selectedReaderId').value = readerId;
        document.getElementById('selectedReaderName').textContent = readerName;
    }
</script>