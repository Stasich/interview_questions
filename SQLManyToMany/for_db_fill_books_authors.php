<?php
require_once 'config.php';

//подключение к бд
$pdo = new PDO ('mysql:host=localhost;dbname='. $dbname . ';charset=utf8', $username, $password);

$queryGetBooksName = 'select id, name from books';

$queryAdd = 'insert into books_authors (book_id, author_id) values (:bookid, :authorid)';
$stmtAdd = $pdo->prepare($queryAdd);

$stmt = $pdo->query($queryGetBooksName);
$books = $stmt->fetchAll();

$pattern = '/Книга (.{1,5})/usi';
$patternForAuthors = '/([A-E])([A-E])?([A-E])?([A-E])?([A-E])?/usi';

$listOfBooksAuthors = [];
$authorFindOut = [];
$authorId = 0;

foreach ($books as $b) {
    preg_match($pattern, $b['name'], $listOfBooksAuthors);
    if (!empty($listOfBooksAuthors))
        //echo $arr[1] . "<br>";
    preg_match($patternForAuthors, $listOfBooksAuthors[1], $authorFindOut );
    //print_r($authorFindOut);
    for ( $i = 1; $i < 6; $i++ ) {
        if (!empty($authorFindOut))
            if (!empty($authorFindOut[$i])) {
                switch ($authorFindOut[$i]) {
                    case 'A': $authorId = 1; break;
                    case 'B': $authorId = 2; break;
                    case 'C': $authorId = 3; break;
                    case 'D': $authorId = 4; break;
                    case 'E': $authorId = 5; break;
                }
                //echo "id автора: $authorId, имя автора: " . $authorFindOut[$i] . ", id книги = {$b['id']}, имя книги: {$b['name']}<br>";
                $stmtAdd->bindParam(':bookid', $b['id']);
                $stmtAdd->bindParam(':authorid', $authorId);
                $stmtAdd->execute();
            }
    }
    echo "<br> <br>";
}