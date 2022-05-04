<?php
//Виконується коли користувач, або Адмін створив замовлення

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

//Точка входу
session_start();

//Шукаємо користувача в сесії
$username = $_SESSION['username'];

//Створюємо переменну із значенням дати
$date = date("d:m:y  h:i:s");

/* Создаем переменные со значениями, которые были получены с $_POST */
$fio = $_POST['fio'];
$email = $_POST['email'];
$siti = $_POST['siti'];
$phone = $_POST['phone'];
$text = $_POST['text'];
$suma = $_POST['suma'];

//Робимо відправку на емаіл, але вона не працює у звязку з тим що почта відправника повинна буди з закінченням "@.назва домену сайту", потрібно купити даний адрес, а хостинг такою требує облати для реалізації даної функції.
if (mail("kolyaagd@gmail.com", "Заявка с сайта", "ФИО:".$fio.".Місто:".$siti."Телефон:".$phone."Додаткова інформація:".$text."E-mail:".$email ,"From:  info.miymukolay@gmail.com"))
 {     echo "сообщение успешно отправлено";
} else {
    echo "при отправке сообщения возникли ошибки";

//Виконуємо створення запису у табличці zakaz, для подальшої обробки інформації замовлення адміністором
mysqli_query($connect,"INSERT INTO `zakaz` (`id`, `user`, `FIO`, `E-mail`, `phone`, `data`, `suma`, `detali`) VALUES (NULL, '$username', '$fio', '$email', '$phone', '$date', '$suma', '$text')");
mysqli_query($connect,"INSERT INTO `user` (`id`, `user`, `FIO`, `E-mail`, `phone`, `data`) VALUES (NULL, '$username', '$fio', '$email', '$phone', '$date')");
/* Переадресация на  страницу "Корзина" */
header('Location: /cat.php');