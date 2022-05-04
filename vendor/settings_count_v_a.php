<?php

//Оновлення інформації про кількість позиції вибраного товару в корзині, файл який змінює кількість товару прямо з корзини.

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

/* Создаем переменные со значениями, которые были получены с $_POST */
$id = $_POST['id'];
$count = $_POST['count'];


/* Делаем запрос на изменение строки в таблице orderr, тобто заміни кількості товару */
if($count>0) {
mysqli_query($connect, "UPDATE `electronics` SET `count` = $count-1 WHERE `electronics`.`id` = $id ");
}
/* Переадресация на  страницу "Корзина" */
header('Location:/admin.php');