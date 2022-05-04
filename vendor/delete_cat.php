<?php

//Очищиння корзини, видалення всих позиції потрібного користувача.

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

//Точка входу
session_start();

//Шукаємо користувача в сесії
$username = $_SESSION['username'];

/* Получаем ID продукта из адресной строки */
$username = $_GET['id'];

/* Делаем выборку строки с полученным username */
$orderr = mysqli_query($connect, "SELECT * FROM `orderr` WHERE `user` = '$username'");

/* Преобразовывем полученные данные в нормальный массив */
$orderr = mysqli_fetch_all($orderr);

/* Делаем запрос на удаление все записів из таблицы orderr */

    foreach ($orderr as $orderr) {
         if($orderr[6] = $username)
         mysqli_query($connect,"DELETE FROM `orderr` WHERE `orderr`.`user` = '$username'");
    }

/* Переадресация на  страницу "Корзина" */
header('Location:/cat.php');