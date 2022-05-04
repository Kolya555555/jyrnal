<?php

//Зміна статуса замовлення

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

/* Получаем ID продукта из адресной строки */
$id = $_GET['id'];
$statys = "Отриманий";

/* Делаем запрос на удаление строки из таблицы zakaz_ok */
mysqli_query($connect, "UPDATE `zakaz_ok` SET `statys` = '$statys' WHERE `zakaz_ok`.`id` = '$id' ");

/* Переадресация на стрінку "Обробки заммовлення"*/
header('Location: /cat_zakaz.php');