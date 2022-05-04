<?php
    /* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
    //Точка входу
session_start();

//Якщо в процесі сесії імя користувача не встановлено, пробуємо його азяти з кук
if(!isset($_SESSION['username']) && isset($_COOKIE['username']))
$_SESSION['username'] = $_COOKIE['username'];

//Ще раз шукаємо користувача в сесії
$username = $_SESSION['username'];

//Не авторизованих користувачів підписувати як гість
if ($username == Null) {
    $_SESSION['username'] = 'Адміністратор';}


    require_once 'config/connect.php';
    /*Делаем выборку строк і преобразовывем полученные данные в нормальный массив*/
    $electronics = mysqli_query($connect, "SELECT * FROM `electronics`");
    $electronics = mysqli_fetch_all($electronics);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Новий товар</title>
</head>
<style>
/*Налаштовуємо меню*/
.menu-main {
  list-style: none;
  margin: 20px 0 5px;
  padding: 15px 0 5px;
  text-align: center;
  background: black;
  border-radius: 6px;
}
.menu-main li {display: inline-block;}
.menu-main li:after {
  content: "|";
  color: white;
  display: inline-block;
  vertical-align:top;
}
.menu-main li:last-child:after {content: none;}
.menu-main a {
  text-decoration: none;
  font-family: "cursive", serif;
  letter-spacing: 2px;
  position: relative;
  padding-bottom: 20px;
  margin: 0 34px 0 30px;
  font-size: 17px;
  text-transform: uppercase;
  display: inline-block;
  transition: color .2s;
}
.menu-main a, .menu-main a:visited {color: white;}
.menu-main a.current, .menu-main a:hover{color: red;}
.menu-main a:before,
.menu-main a:after {
  content: "";
  position: absolute;
  height: 4px;
  top: auto;
  right: 50%;
  bottom: +8px;
  left: 50%;
  background: red;
  transition: .8s;
}
.menu-main a:hover:before, .menu-main .current:before {left: 0;}
.menu-main a:hover:after, .menu-main .current:after {right: 0;}
@media (max-width: 550px) {
.menu-main {padding-top: 0;}
.menu-main li {display: block;}
.menu-main li:after {content: none;}
.menu-main a {
  padding: 25px 0 20px;
  margin: 0 30px;
}
}
body { background: url(img/fonn.jpg); }

/*клас для логотипу сайту - зображення*/
.product_img{
    height: avto;
    width: 50px;}

/*клас для логотипу сайту - текст*/
.product_text{
     font-size: 33px;
    font-family: 'cursive';}

/*Оформлення тексту*/
.text{
     font-size: 20px;
    font-family: 'cursive';
    color: black;}

/*Вікно для введення інформації №1*/
.vindo{
    background: yellow;
    width: 40%;
    height: 25px;
    border-radius: 5px;
    font-size: 16px;}

/*Вікно для введення інформації №2*/
.vindo_text{
    background: yellow;
    width: 40%;
    height: 100px;
    border-radius: 10px;
    font-size: 16px;}

/*Кнопка*/
.btn-buy{
    background: black;
    color: white;
    font-size: 15px;
    padding: 0 30px;
    height: 25px;
    outline: none;
    border-radius: 10px;
    cursor: pointer;}

</style>


<body>
      <!-- Виведення шапки сайту -->
     <p class='product_text' align="center" ><img  class = "product_img" src='img/111.png' >Мій Миколай</p>
      <p class="ap_text">Ви ввійшли як <b>"<?php echo $username; ?>"</b>  <a href="open.php">Вихід</a></p>
<ul class="menu-main">
             <li><a href="admin.php">Головна</a></li>
            <li><a href="search.php">Пошук товару</a></li>
            <li><a href="cat_admin.php">Робота</a></li>
</ul>
    <div class="text" align= "center">
    <h3>Введення в облік нового товару</h3>
    <form action="vendor/create.php" method="post" enctype="multipart/form-data">
        <p>Назва</p>
        <input type="text" name="title" class="vindo">
        <p>Забраження</p>
        <input type="file" name="file" multiple accept="image/*">
        <p>Артикул</p>
        <input type="text" name="vendor_code" class="vindo">
        <p>Ціна</p>
        <input type="number" name="price" class="vindo">
        <p>Категорія</p>
        <input list="cotegory" class="vindo" name="category">
        <datalist id="cotegory">
            <option>Смарт Часи</option>
            <option>Бездротові навушники</option>
            <option>Наручні Годинники</option>
            <option>Фітнес-браслет</option>
            <option>Bluetooth-колонка</option>
            <option>Інша електроніка</option>
            <option>Сувеніри</option>
            <option>Пакетик Кольоровий</option>
            <option>Інші подарунки</option>
            <option>Брелок</option>
            <option>Дитячі приколи</option>
            <option>Різні Іграшки</option>
            <option>Обручі</option>
            <option>Браслети</option>
            <option>Маски</option>
            <option>Лизуни</option>
            <option>Мячі</option>
            <option>Настільні ігри</option>
        </datalist>
        <p>Кількість</p>
        <input type="number" name="count" class="vindo">
        <br><br>
        <button type="submit" class="btn-buy">Добавити новий товар
    </form>
    </div>
</body>
</html>