<?php
    /* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
    require_once 'config/connect.php';

    /* Получаем ID продукта из адресной строки */
    $electronics_id = $_GET['id'];

    /* Делаем выборку строки с полученным ID выше */
    $electronics = mysqli_query($connect, "SELECT * FROM `electronics` WHERE `id` = '$electronics_id'");

    /* Преобразовывем полученные данные в нормальный массив
     Используя функцию mysqli_fetch_assoc массив будет иметь ключи равные названиям столбцов в таблице */
    $electronics = mysqli_fetch_assoc($electronics);

/*Функція для авторизіції*/
function Login($username, $remember)
{//імя користувача не повинно бути пустим
    if ($username == '')
        return false;
//Запоминаємо імя сесії
    $_SESSION['username'] = $username;
//і в куки, якщо користував обрав галочку
    if ($remember)
        setcookie('username', $username, time() + 3600 * 24 * 7);
//Успішна авторизація
    return true;}

//Сброс авторизації
function Logout()
{//Робимо куки устарівшими
    setcookie('username' , '', time() - 1);
//сброс сесії
    unset($_SESSION['username']);}

//Точка входу в сесію
session_start();
$enter_site = false;
//коли попадаємо на страницу open.php авторизація сброшується
Logout();
//якщо масив POST не пустий, то, обробляємо обробку форми
if(count($_POST) > 0)
    $enter_site = Login($_POST['username'], $_POST['remember'] == 'on');

//Коли авторизація пройдена, перекидаєм пользоваткля на головну сторінку сайта
if($enter_site)
    {
    if($_POST['username'] == 'Адміністратор')
    {header("Location: admin.php");
    exit();}

    header("Location: index.php"); //Адрес головної сторінки
    exit();}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Авторизація</title>
</head>
<style>

/* Minimum aspect ratio */
@media (max-width: 991.8px) {
/*Налаштовуємо меню*/
.menu-main {
  list-style: none;
  margin: 2px 0 5px;
  padding: 5px 0 5px;
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
  padding-bottom: 15px;
  margin: 0 34px 0 30px;
  font-size: 12px;
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
@media (max-width: 300px) {
.menu-main {padding-top: 0;}
.menu-main li {display: block;}
.menu-main li:after {content: none;}
.menu-main a {
  padding: 15px 0 20px;
  margin: 0 30px;
}
}
body { background: url(img/fonn.jpg); }

/*клас для логотипу сайту - зображення*/
.product_img{
     width: 50px;
    width: 50px;}

/*клас для логотипу сайту - текст*/
.product_text{
     font-size: 20px;
    font-family: 'cursive';
     color: black;}

 /*Оформлення текста*/
.product_text1{
     font-size: 20px;
     font-family: 'cursive';
     color: black;}

/*Кнопка*/
.btn-buyy{
   background: black;
    color: white;
    font-size: 12px;
    margin-top: 10px;
    padding: 10 10px;
    height: 30px;
    outline: none; /*Універсальна властивість, що одночасно встановлює колір, стиль та товщину зовнішньої межі на всіх чотирьох сторонах елемента*/
    border-radius: 7px;
    cursor: pointer; /*Встановлює форму курсора*/
    margin-left: 10px;}

/*Поле для введення інформації*/
.pole3{
    background: black;
    color: white;
    border-radius: 7px;
    font-size: 20px;
    height: 30px;
}
.cro{
    width: 90%;
    border-radius: 7px;
  border: 4px solid; /*границі вікна*/
}
}

/* Maximum aspect ratio */
@media (min-width: 992px) {
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
    font-family: 'cursive';
     color: black;}

 /*Оформлення текста*/
.product_text1{
     font-size: 20px;
     font-family: 'cursive';
     color: black;}

/*Кнопка*/
.btn-buyy{
    background: black;
    color: white;
    font-size: 15px;
    padding: 0 30px;
    height: 40px;
    outline: none; /*Універсальна властивість, що одночасно встановлює колір, стиль та товщину зовнішньої межі на всіх чотирьох сторонах елемента*/
    border-radius: 7px;
    cursor: pointer; /*Встановлює форму курсора*/}

/*Поле для введення інформації*/
.pole3{
    background: black;
    color: white;
    border-radius: 7px;
    font-size: 20px;
    height: 30px;
}
.cro{
    width: 70%;
    border-radius: 7px;
  border: 4px solid; /*границі вікна*/
}
}
</style>
<body>
    <!-- Виведення логотипу сайту -->
       <div align = "center" ><p class='product_text' align="center" ><img  class = "product_img" src='img/111.png' >Мій Миколай</p>
       <!-- Виведення меню сайту  -->
<ul class="menu-main">
  <li><a href="index.php">Головна</a></li>
            <li><a href="catalog.php" >Каталог</a></li>
            <li><a href="pro_nas.php">Про нас</a></li>
            <li><a href="cat.php">Корзина</a></li>
             <li><a href="open.php" class="current">Авторизація</a></li>
</ul>
<!-- Виведення головного вмісту сторінки -->
    <h2 align="center">Авторизація</h2>
    <div class="cro" align="center">
<div align="center"><h3 align = "center" class = "product_text1" > Авторизуйтесь у системі під будь яким логіном</h3></div>
    <form action="" method="post">
        <div align = "center">
            <p class="product_text1">Введіть Логін</p>
            <input class = "pole3" type="text" name="username" required/><br>
            <p class="product_text1"> <input type="checkbox" name="remember" />Запам'ятати мене(поставте галочку)</p>
            <button class="btn-buyy" type="submit">Ввійти в систему</button>
        </div><br></div>
    </form>
</body>
</html>