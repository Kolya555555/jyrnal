<?php
//Точка входу
session_start();

//Якщо в процесі сесії імя користувача не встановлено, пробуємо його азяти з кук
if(!isset($_SESSION['username']) && isset($_COOKIE['username']))
$_SESSION['username'] = $_COOKIE['username'];

//Ще раз шукаємо користувача в сесії
$username = $_SESSION['username'];

//Додавання товара до корзини

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

/* Создаем переменные со значениями, которые были получены с $_POST */
$id = $_POST['id'];
$title = $_POST['title'];
$vendor_code = $_POST['vendor_code'];
$price = $_POST['price'];
$count = $_POST['count'];
$image = $_POST['image'];
$newcount = $count;

/* Делаем запрос на добавление новой строки в таблицу orderr */

/* Делаем выборку строки с полученным username */
    $orderr = mysqli_query($connect, "SELECT * FROM `orderr` WHERE `user` = '$username'");

/* Преобразовывем полученные данные в нормальный массив */
    $orderr = mysqli_fetch_all($orderr);
    $a = '0';
    $b = '0';

/* Перебираємо масив */
    foreach ($orderr as $orderr) {
    $b = $b + 1 ; //Рахуємо всі записи в корзині користувача "username"

/* Робимо перевірку товар який буде записуватися в корзині вже є в ній, чи буде вперше */
    if ($orderr[2] == $vendor_code)
    {/*Змінюємо кількість товару в корзині*/
        mysqli_query($connect, "UPDATE `orderr` SET `count` = $orderr[4] + $count WHERE `user` = '$username' and `title` = '$title' ");}
    else
    {$a = $a + 1 ;} /*Рахуємо позиції яких немає в корзині*/ }

/* Якщо товар який додає користувач в корзині ще відсутнії додаємо його туди */
if($a == $b)
{/* додаємо нову позицію в корзину*/
    mysqli_query($connect,"INSERT INTO `orderr` (`id`, `title`, `ventor_code`, `price`, `count`, `image`, `user`) VALUES (NULL, '$title', '$vendor_code', '$price', '$count', '$image', '$username')");}

/* Переадресация на страницу product.php */
header('Location: /product.php?id=' . $id);
