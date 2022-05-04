<?php

//Добавление нового товара

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once '../config/connect.php';

/* Создаем переменные со значениями, которые были получены с $_POST */
$title = $_POST['title'];
$vendor_code = $_POST['vendor_code'];
$price = $_POST['price'];
$category = $_POST['category'];
$count = $_POST['count'];
$cod = $vendor_code;

move_uploaded_file($_FILES['file']['tmp_name'], "tovar/" .$_FILES['file']['name']);
$photo = $_FILES['file']['name'];


/* Делаем запрос на добавление новой строки в таблицу electronics */
/* Делаем выборку строки с полученным username */
    $electronics = mysqli_query($connect, "SELECT * FROM `electronics`");
/* Преобразовывем полученные данные в нормальный массив */
    $electronics = mysqli_fetch_all($electronics);
    $a = '0';
    $b = '0';

/* Перебираємо масив */
    foreach ($electronics as $electronics) {
    $b = $b + 1 ; //Рахуємо всі записи

/* Робимо перевірку товар який буде записуватися в корзині вже є в ній, чи буде вперше */
    if ($electronics[3] == $vendor_code)
    { echo "Товар з артикулем: $electronics[3] вже наявний в базі, поверніться назад і виправте дане поле.";
		exit;}
    else
    {$a = $a + 1 ;} /*Рахуємо позиції яких немає в корзині*/
}


/* Якщо товар який додає користувач в корзині ще відсутнії додаємо його туди */
if($a == $b){
    mysqli_query($connect,"INSERT INTO `electronics` (`id`, `title`, `image`, `vendor_code`, `short_description`, `great_description`, `price`, `category`, `count`) VALUES (NULL, '$title', '$photo', '$vendor_code', '$title', '$title', '$price', '$category', '$count');");
    //echo($count);
}

header('Location: /admin.php');