<?php

//Видалення товару з бази магазина адміністратором

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL). */
require_once '../config/connect.php';

/* Получаем ID товару из адресной строки */
$id = $_GET['id'];

/* Делаем запрос на удаление строки из таблицы electronics */
mysqli_query($connect,"DELETE FROM `electronics` WHERE `electronics`.`id` = '$id'");

/* Переадресация на главную страницу адміністратора*/
header('Location: /admin.php');