<div class="books_main">
        <div class="book_search">
            <form method="get" class="search">
                <label><input class="books_search" placeholder="Поиск" name="search"></label>
                <button type="submit" class="books_search_btn">Найти</button>
            </form>

            <div class="books_bookList">
                <?php if(isset($book)): ?>
                    <?php foreach ($book as $selectedBook): ?>
                        <div>
                            <p>Навзание: <?= $selectedBook->title ?></p>
                            <p>Издание: <?= $selectedBook->is_new  == 1 ? 'новое' : 'старое' ?></p>
                            <a href="?book_id=<?= $selectedBook->id ?>" class="more_info_button">Подробнее</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                <?php foreach ($books as $key => $selectedBook): ?>
                <div>
                    <p>Навзание: <?= $selectedBook->title ?></p>
                    <p>Издание: <?= $selectedBook->is_new == 1 ? 'новое' : 'старое' ?></p>
                    <a href="?book_id=<?= $selectedBook->id ?>" class="more_info_button">Подробнее</a>
                </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <a href="?clear" class="reset_button btn_books">Сбросить</a>
        </div>

        <div class="book_info_main">
            <div>
                <?php if (isset($_GET['book_id'])): ?>
                    <?php  $selectedBook = $books->find([$_GET['book_id']])->first(); ?>
                <div class="books_price">
                    <p> <?= $selectedBook->price?> </p>
                </div>
                <div class="book_info">
                    <p>Название:<?= $selectedBook->title ?> </p>
                    <p>Год: <?= $selectedBook->year ?> </p>
                    <p>Издание: <?= $selectedBook->is_new == 1 ? 'новое' : 'старое' ?> </p>
                    <p>Аннотация: <?= $selectedBook->annotation ?> </p>
                    <?php if ($selectedBook->image): ?>
                        <div class='image'>
                            <img src='<?= $selectedBook->image ?>' alt='Обложка книги'>
                        </div>
                    <?php endif; ?>
                </div>

                <?php else: ?>
                <div class="books_price"></div>
                <div class="book_info"></div>
                <?php endif; ?>
            </div>


                <div class="libAdd_a" >
                    <a href="#bookList">Читатели</a>
                    <a href="#bookStatic">Статистика</a>
                </div>
            <div class="choise">
                <div class="book_readers" id="bookList">

                    <div class="bookDatas">
                        <p>Читатели</p>
                        <?php if(isset($readers) && count($readers) > 0): ?>
                            <?php foreach($readers as $reader): ?>
                                <p> - <?php echo $reader->name . ' ' . $reader->surname . ' ' . $reader->patronymic; ?></p>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Читателей нет</p>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="book_readers" id="bookStatic">

                    <div class="bookDatas" >
                        <p>Топ книг</p>
                        <p>Число читателей выбранной книги: <?= $selectedBookReadersCount ?></p>
                        <p>Число читателей других книг: <?= $otherBooksReadersCount ?></p>
                    </div>

                </div>
            </div>

        </div>
    </div>






