

<?php

//Добавление комментаря до товара

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

/* Создаем переменные со значениями, которые были получены с $_POST */
$id = $_POST['id'];
$text = $_POST['text'];
$phone = $_POST['phone'];
$date = date("d:m:y  h:i:s");

/* Делаем запрос на добавление новой строки в таблицу comments */
mysqli_query($connect,"INSERT INTO `zakaz_tel` (`id`, `name`, `tell`, `date`) VALUES (NULL, '$text', '$phone', '$date')");

/* Переадресация на страницу product.php */
header('Location: /index.php');