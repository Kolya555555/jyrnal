<?php

//Обновление информации при її зміні Адміністратором, що дані про вже створенне замовлення, були обновленні, а саме дата і сума замовлення.

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

//Точка входу
session_start();

//Шукаємо користувача в сесії
$username = $_SESSION['username'];
//Створюємо переменну із значенням дати
$date = date("y:m:d  h:i:s");

/* Создаем переменные со значениями, которые были получены с $_POST */
$suma = $_POST['suma'];

/* Делаем запрос на изменение строки в таблице zakaz */
mysqli_query($connect, "UPDATE `zakaz` SET `suma` = '$suma', `data` = '$date' WHERE `zakaz`.`user` = '$username' ");

/* Переадресация на главную страницу Адміністратора */
header('Location:/admin.php');