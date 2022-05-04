<?php
//Даний файл виконуэться після того замовлення вже "Обговорено", він додає запис в таблицю zakaz_ok, і видаляє запис з таблиці zakaz, а також видаляє всі дані з таблиці orderr.

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

//Точка входу
session_start();

//Шукаємо користувача в сесії
$username = $_SESSION['username'];
//Створюємо переменну із значенням дати
$date = date("d:m:y  h:i:s");

/* Создаем переменные со значениями, которые были получены с $_POST */
$fio = $_POST['FIO'];
$email = $_POST['E-mail'];
$phone = $_POST['phone'];
$text = $_POST['text'];
$suma = $_POST['suma'];
$statys = "Обговорений";
$detali = $_POST['detali'];

//Делаем выборку строки с полученным username
$orderr = mysqli_query($connect, "SELECT * FROM `orderr` WHERE `user` = '$username'");
// Преобразовывем полученные данные в нормальный массив
$orderr = mysqli_fetch_all($orderr);

/* Записуємо позиції замовлення в переменну zakaz_o */
    foreach ($orderr as $orderr) {
        $zakaz_ok = "Артикул: $orderr[2] - $orderr[4] шт";
        $zakaz_o = "$zakaz_o <br> $zakaz_ok";
    }

/* Додавання нового запису в таблицю zakaz_ok*/
 mysqli_query($connect,"INSERT INTO `zakaz_ok` (`id`, `user`, `FIO`, `E-mail`, `phone`, `data`, `suma`, `zakaz`, `statys`, `detali`) VALUES (NULL, '$username', '$fio', '$email', '$phone', '$date', '$suma', '$zakaz_o', '$statys', '$detali')");

/* Видалення замовлення з таблиці zakaz*/
mysqli_query($connect,"DELETE FROM `zakaz` WHERE `zakaz`.`user` = '$username'");

/* Делаем запрос на удаление все записів из таблицы orderr */
    foreach ($orderr as $orderr) {
    if($orderr[6] = $username)
        mysqli_query($connect,"DELETE FROM `orderr` WHERE `orderr`.`user` = '$username'");
    }

/* Переадресация на стрінку "Обробки заммовлення"*/
header('Location:/cat_admin.php');