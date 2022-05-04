<?php

//Видалення обраної позиції з корзини

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

/* Получаем ID продукта из адресной строки */
$id = $_GET['id'];

/* Делаем запрос на удаление строки из таблицы orderr */
mysqli_query($connect,"DELETE FROM `orderr` WHERE `orderr`.`id` = '$id'");

/* Переадресация на  страницу "Корзина" */
header('Location: /cat.php');