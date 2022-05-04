<?php

//Зміна інформації про вже наявну в базі магазину позиції

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

/* Создаем переменные со значениями, которые были получены с $_POST */
$id = $_POST['id'];
$title = $_POST['title'];
$image = $_POST['image'];
$vendor_code = $_POST['vendor_code'];
$short_description = $_POST['short_description'];
$great_description = $_POST['great_description'];
$price = $_POST['price'];
$category = $_POST['category'];
$count = $_POST['count'];

/* Делаем запрос на изменение строки в таблице electronics */
mysqli_query($connect,"UPDATE `electronics` SET `title` = '$title', `image` = '$image', `vendor_code` = '$vendor_code', `short_description` = '$short_description', `great_description` = '$great_description', `price` = '$price', `category` = '$category ', `count` = '$count' WHERE `electronics`.`id` = $id");

/* Переадресация на главную страницу адміністратора*/
header('Location: /admin.php');