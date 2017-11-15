Необходимо создать таблицы со связями многие ко многим на примере книг и их авторов.
Сделать запрос в бд который выведет 'Имя автора' и 'количество книг' для авторов у которых более чем *'тут любое число'* книг.

1. Создать БД 'create database yourBdName character set=utf8;'
2. Создать таблицы таблицы:
create table books (id INT AUTO_INCREMENT, name VARCHAR(100) NOT NULL, PRIMARY KEY (id));
create table authors (id INT AUTO_INCREMENT, name VARCHAR(100) NOT NULL, PRIMARY KEY (id));
create table books_authors (id INT AUTO_INCREMENT, book_id INT NOT NULL, author_id INT NOT NULL, PRIMARY KEY (id));
3. Установить связи между таблицами:
alter table books_authors ADD FOREIGN KEY (book_id) REFERENCES books (id);
alter table books_authors ADD FOREIGN KEY (author_id) REFERENCES authors (id);
4. Заполнить таблицу authors: insert into authors (name) values ('автор A'),('автор B'),('автор C'),('автор D'),('автор E');
5. Запустить файл 'for_bd_fill_books.php' - он заполнит таблицу books;
6. Запустить файл 'for_db_fill_books_authors.php' - он заполнит таблицу books_authors; 
7. Запрос в БД : select authors.name as 'Имя автора', count(\*) as 'количество книг' from books_authors join authors on author_id = authors.id group by author_id having count(*)>46;

