<?php

//Очищиння корзини, видалення всих позиції потрібного користувача.

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

/* Получаем ID продукта из адресной строки */
$id = $_GET['id'];

/* Делаем запрос на удаление все записів из таблицы orderr */


    mysqli_query($connect,"DELETE FROM `zakaz_tel` WHERE `zakaz_tel`.`id` = '$id'");
/* Переадресация на  страницу "Корзина" */
header('Location:/cat_zakaz_d.php');