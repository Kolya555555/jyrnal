

<?php

//Добавление комментаря до товара

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

/* Создаем переменные со значениями, которые были получены с $_POST */
$id = $_POST['id'];
$body = $_POST['body'];
$name = $_POST['name'];

/* Делаем запрос на добавление новой строки в таблицу comments */
mysqli_query($connect,"INSERT INTO `comments` (`id`, `product_id`, `body`, `name`) VALUES (NULL, '$id', '$body', '$name');");

/* Переадресация на страницу product.php */
header('Location: /product.php?id=' . $id);