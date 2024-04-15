<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <title>Авторизация</title>
</head>
<body>
<?php
if (app()->auth::check()):
if (app()->auth::user()->role === 2):
?>
<header class="header">
    <nav class="header_nav wrapper">
        <div class="header_nav_links">
            <a class="header_nav_a" href="<?= app()->route->getUrl('/libAdd') ?>">Добавить</a>
            <!--༼ つ ◕_◕ ༽つ¯\_(ツ)_/¯¯\_(ツ)_/¯¯\_(ツ)_/¯.______.-->
            <a class="header_nav_a" href="<?= app()->route->getUrl('/readers') ?>">Читатели</a>
            <a class="header_nav_a" href="<?= app()->route->getUrl('/books') ?>">Книги </a>
            <a class="header_nav_a" href="<?= app()->route->getUrl('/out') ?>">Выдача </a>
        </div>

            <a class="header_nav_a exit" href="<?= app()->route->getUrl('/logout') ?>">Выход(<?= app()->auth::user()->name ?>)</a>

    </nav>
</header>
<?php
elseif (app()->auth::user()->role === 1):
    ?>
    <header class="header">
        <nav class="header_nav wrapper">
            <a class="header_nav_a exit" href="<?= app()->route->getUrl('/logout') ?>">Выход(<?= app()->auth::user()->name ?>)</a>
        </nav>
    </header>
<?php
endif;
endif;
?>


<main class="wrapper">
    <?= $content ?? '' ?>
</main>

</body>
</html>
