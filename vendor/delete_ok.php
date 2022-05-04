<?php

//Видалення непотрібного, або устарілого замовлення адміністратором

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

/* Получаем ID продукта из адресной строки */
$id = $_GET['id'];

/* Делаем запрос на удаление строки из таблицы zakaz_ok */
mysqli_query($connect,"DELETE FROM `zakaz_ok` WHERE `zakaz_ok`.`id` = '$id'");

/* Переадресация на главную страницу  */
header('Location: /cat_zakaz.php');