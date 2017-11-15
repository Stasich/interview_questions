<?php
require_once 'config.php';

//подключение к бд
$pdo = new PDO ('mysql:host=localhost;dbname='. $dbname . ';charset=utf8', $username, $password);

// подготавливаю запрос для добавления данных в бд
$query = 'insert into books (name) values (:nameOfBook)';
$prepareQuery = $pdo->prepare($query);

$queryGetBooksName = 'select name from books';

$authors = [ 'A', 'B', 'C', 'D', 'E' ];

for ( $i = 0; $i < 100; $i++ )
{
    // получаю объект с названиями всех существующих в БД книг
    $stmt = $pdo->query($queryGetBooksName);

    $bookName = 'Книга ';

    // записываю в массив названия книг
    $books = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // формирую случайное число авторов для одной книги
    $rand = rand(1,5);

    for ( $j = 0, $arrAddedAuthors=[]; $j < $rand; $j++ )
    {
        // формирую случайное число для выбра одного из пяти авторов.
        $randAuthor = rand(0,4);

        //если случайный автор уже был добавлен к текущей книге, то выбираем заново
        if ( in_array($randAuthor, $arrAddedAuthors) )
        {
            $j--;
            continue;
        }

        // добавляю к названию книги автора, получаю уник имя книги и  в будущем удобный способ проверки
        $bookName = $bookName . $authors[$randAuthor];

        // запоминаем автора добавленного к текущей книге
        $arrAddedAuthors[] =  $randAuthor;
    }

    // если книга с сформированным именем уже есть в БД, то не добавляем её.
    if (in_array($bookName, $books) )
    {
        echo 'пропуск<br>';
        continue;
    }

    // добавляю название книги в бд
    $prepareQuery->bindParam(':nameOfBook', $bookName );
    $prepareQuery->execute();
}