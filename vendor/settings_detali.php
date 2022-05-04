<?php

//Обновление информации, тобто деталів для вже завчасно створеного замовлення користквачем, при обробці його адміном.

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

/* Создаем переменные со значениями, которые были получены с $_POST */
$id = $_POST['id'];
$detali = $_POST['detali'];

/* Делаем запрос на изменение строки в таблице zakaz */
mysqli_query($connect, "UPDATE `zakaz` SET `detali` = '$detali' WHERE `zakaz`.`id` = $id");

/* Переадресация на стрінку "Обробки заммовлення"*/
header('Location:/cat_admin.php');