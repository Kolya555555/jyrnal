<?php
//Точка входу
session_start();

//Якщо в процесі сесії імя користувача не встановлено, пробуємо його азяти з кук
if(!isset($_SESSION['username']) && isset($_COOKIE['username']))
$_SESSION['username'] = $_COOKIE['username'];

//Ще раз шукаємо користувача в сесії
$username = $_SESSION['username'];

//Неавторизованх користувачів відправляємо на страницу авторизації
if ($username == "Гість")
{   header("Location: open.php");
    exit();}


    /* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
    require_once 'config/connect.php';

    /* Получаем ID продукта из адресной строки - /electronics.php?id=1 */
    $electronics_id = $_GET['id'];

    /* Делаем выборку строки с полученным ID выше */
    $electronics = mysqli_query($connect, "SELECT * FROM `electronics` WHERE `id` = '$electronics_id'");

    /* Преобразовывем полученные данные в нормальный массив
     * Используя функцию mysqli_fetch_assoc массив будет иметь ключи равные названиям столбцов в таблице */
    $electronics = mysqli_fetch_assoc($electronics);

    /* Делаем выборку всех строк комментариев с полученным ID продукта выше */
    $comments = mysqli_query($connect, "SELECT * FROM `comments` WHERE `product_id` = '$electronics_id'");

    /* Преобразовывем полученные данные в нормальный массив */
    $comments = mysqli_fetch_all($comments);
?>

<!doctype html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product</title>
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

/*для "наших даних"*/
.ap_text{
     font-size: 16px;
     color: black;
     background: white;
    border-radius: 6px;
font-family: "cursive";}

    a{
        color : red;
    }

/*Кнопка*/
.btn-buy{
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
/*Поле лоя введення інформації №1*/
.pole{
    width: 35px;
    background: wheat;
    height: 20px;
    border-radius: 10px;}

/*Поле лоя введення інформації №2*/
.pole2{
    width: 100%;
    max-width: 800px;
    background: wheat;
    height: 30px;
    border-radius: 10px;
    font-size: 18px;}

/*Поле лоя введення інформації №3*/
.pole3{
    width: 100%;
    max-width: 800px;
    background: wheat;
    height: 50px;
    border-radius: 10px;
    font-size: 18px;}

/*Текст*/
.text{
    height: avto;
     width: avto;
  max-width: 1200px;}

/*Коментар*/
.comments{
    font-size: 18px;
    margin-left: 20%;
    font-family: 'Arial';
    width: 50%;}
img{
    width: 100%;
    }
.cor{
width: 150px;
height: avto;
}
h1{
   font-size: 17px;
}
h2{
   font-size: 15px;
}
h3{
   font-size: 12px;
}
    /* Модальний (фон) */
.modal {
  display: none; /* Скрито по умолчанию */
  position: fixed; /* Оставаться на месте */
  z-index: 1; /* Сидеть на вершине */
  padding-top: 100px; /* значення поля від верхнього краю вмісту елемента */
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto; /* Включить прокрутку, якщо буде потрібно */
  background-color: rgb(0,0,0); /* Цвет запасной вариант  */
  background-color: rgba(0,0,0,0.4); /*Черний с непрозрачностью */}

/* Модальний вміст */
.modal-content {
  position: relative; /*Положення елемента встановлюється щодо його вихідного місця.*/
  background-color: white; /*фон середини*/
  margin: auto;
  font-family: "cursive";
  font-size: 20px;
  padding: 0;
  border: 4px solid; /*границі вікна*/
  border-color: black #444 #888 #ccc; /*кольори границь*/
  width: avto;
  max-width: 800px;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19); /*Додає тінь до елемента*/
  animation-name: animatetop; /*Анімація*/
  animation-duration: 2s; /*Швидкісь анімації*/}

@keyframes animatetop {
  from {top:-300px; opacity:0} /*з верху*/
  to {top:0; opacity:1}}

/* Кнопка закрытия */
.close {
  color: white; /*Колір*/
  float: right; /*Розміщення*/
  font-size: 30px; /*Розмір шрифта*/
  font-weight: bold; /*насиченість шришта*/}

/* Кнопка закрытия */
.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer; /*Вид курсора*/}

/* Шапка модального вікна*/
.modal-header {
  padding: 2px 16px;
  background-color: #000;
  color: white;}

/* Основна частина модального вікна*/
.modal-body {
    padding: 2px 16px;}

/* Низ модального вікна*/
.modal-footer {
  padding: 2px 16px;
  background-color: #000;
  color: white;}
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
     width: 50px;
    width: 50px;}

/*клас для логотипу сайту - текст*/
.product_text{
     font-size: 33px;
    font-family: 'cursive';
     color: black;}

/*для "наших даних"*/
.ap_text{
     font-size: 18px;
     color: black;
     background: white;
    border-radius: 6px;
font-family: "cursive";}

    a{
        color : red;
    }

/*Кнопка*/
.btn-buy{
    background: black;
    color: white;
    font-size: 15px;
    padding: 0 30px;
    height: 25px;
    outline: none; /*Універсальна властивість, що одночасно встановлює колір, стиль та товщину зовнішньої межі на всіх чотирьох сторонах елемента*/
    border-radius: 7px;
    cursor: pointer; /*Встановлює форму курсора*/}
/*Поле лоя введення інформації №1*/
.pole{
    width: 35px;
    background: wheat;
    height: 20px;
    border-radius: 10px;}

/*Поле лоя введення інформації №2*/
.pole2{
    width: 100%;
    max-width: 800px;
    background: wheat;
    height: 30px;
    border-radius: 10px;
    font-size: 18px;}

/*Поле лоя введення інформації №3*/
.pole3{
    width: 100%;
    max-width: 800px;
    background: wheat;
    height: 50px;
    border-radius: 10px;
    font-size: 18px;}

/*Текст*/
.text{
    height: avto;
     width: avto;
  max-width: 1200px;}

/*Коментар*/
.comments{
    font-size: 18px;
    margin-left: 20%;
    font-family: 'Arial';
    width: 50%;}
img{
    width: 100%;
    }
.cor{
width: 400px;
height: avto;
}
/* Модальний (фон) */
.modal {
  display: none; /* Скрито по умолчанию */
  position: fixed; /* Оставаться на месте */
  z-index: 1; /* Сидеть на вершине */
  padding-top: 100px; /* значення поля від верхнього краю вмісту елемента */
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto; /* Включить прокрутку, якщо буде потрібно */
  background-color: rgb(0,0,0); /* Цвет запасной вариант  */
  background-color: rgba(0,0,0,0.4); /*Черний с непрозрачностью */}

/* Модальний вміст */
.modal-content {
  position: relative; /*Положення елемента встановлюється щодо його вихідного місця.*/
  background-color: white; /*фон середини*/
  margin: auto;
  font-family: "cursive";
  font-size: 20px;
  padding: 0;
  border: 4px solid; /*границі вікна*/
  border-color: black #444 #888 #ccc; /*кольори границь*/
  width: avto;
  max-width: 800px;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19); /*Додає тінь до елемента*/
  animation-name: animatetop; /*Анімація*/
  animation-duration: 2s; /*Швидкісь анімації*/}

@keyframes animatetop {
  from {top:-300px; opacity:0} /*з верху*/
  to {top:0; opacity:1}}

/* Кнопка закрытия */
.close {
  color: white; /*Колір*/
  float: right; /*Розміщення*/
  font-size: 30px; /*Розмір шрифта*/
  font-weight: bold; /*насиченість шришта*/}

/* Кнопка закрытия */
.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer; /*Вид курсора*/}

/* Шапка модального вікна*/
.modal-header {
  padding: 2px 16px;
  background-color: #000;
  color: white;}

/* Основна частина модального вікна*/
.modal-body {
    padding: 2px 16px;}

/* Низ модального вікна*/
.modal-footer {
  padding: 2px 16px;
  background-color: #000;
  color: white;}
}
</style>

<body>
     <!-- Виведення шапки сайту -->
     <p class='product_text' align="center" ><img  class = "product_img" src='img/111.png' >Мій Миколай</p>
     <p class="ap_text">Ви ввійшли як <b>"<?php echo $username; ?>"</b>  <a href="open.php">Вихід</a></p>
        <p class="ap_text" align="center">
                            Телефон: <a href="tel: +380992431028">MTS +38 099-24-31-028</a>
                            Instagram: <a href="https://www.instagram.com/miymukolay/">miymukolay</a>
                            TikTok: <a href="http://tiktok.com/@miymukolay.com.ua">miymukolay.com.ua</a> </p>
<ul class="menu-main">
  <li><a href="index.php"class="current">Головна</a></li>
            <li><a href="catalog.php" >Каталог</a></li>
            <li><a href="pro_nas.php">Про нас</a></li>
            <li><a href="cat.php">Корзина</a></li>
             <li><a href="open.php">Авторизація</a></li>
</ul>
<!-- Виведення головного вмісту сторінки -->
<div>
    <div >
        <table align="center">
            <tr >
                <td >
                    <h2><div style="overflow: auto; width:200px;height:avto;"><?= $electronics['title'] ?></div></h2>
                    <h3>Артикул: <?= $electronics['vendor_code'] ?></h3>
                    <h3>Категорія: <?= $electronics['category'] ?></h3>
                    <h3>Ціна: <?= $electronics['price'] ?> грн.</h3>
                            <form action="vendor/create_shop.php" method="post">
                                    <input type="hidden" name="id" value="<?= $electronics['id'] ?>">
                                    <input type="hidden" name="title" value="<?= $electronics['title'] ?>">
                                    <input type="hidden" name="vendor_code" value="<?= $electronics['vendor_code'] ?>">
                                    <input type="hidden" name="price" value="<?= $electronics['price'] ?>">
                                    <input type="hidden" name="image" value="<?= $electronics['image'] ?>">
                                    <input class = "pole" type="number" name="count" min = "1"value="1">
                                    <button class = "btn-buy" type="submit">В корзину</button>
                            </form>
                </td>
                <td >
                    <img id="myBtn" class="cor" src='vendor/tovar/<?= $electronics['image'] ?>' >
                </td>
             </tr>
        </table>
        <div align="center">
            <h3 class="text"> Короткий опис:<br> <?= $electronics['short_description'] ?></h3>
            <h3 class="text"> Детальний опис:<br> <?= $electronics['great_description'] ?></h3>
        </div>
    </div>
</div>
    <hr> <!-- Ліній -->
<!-- Меню додавання коментаря -->
    <h3 align="center">Добавити коментар</h3><div align="center">
        <form action="vendor/create_comment.php" method="post">
            <input  type="hidden" name="id" value="<?= $electronics['id'] ?>">
            <input class ="pole2" type="text" name="name" placeholder="Ім'я:"><br><br>
            <textarea class ="pole3" name="body" placeholder="Коментар:"></textarea><br>
            <button type="submit" class="btn-buy">Добавити</button>
        </div></form>

    <hr> <!-- Ліній -->
<!-- Меню Виведення вже наявних коментарів -->
    <h3 align="center">Коментарі:</h3>
<div class="comments">
    <?php
    if($comments != null){

            foreach ($comments as $comments) {
            ?>
               <td> "<b><?= $comments[3] ?></b>" - <?= $comments[2] ?></td><br><br>
            <?php
            }}
        else { ?> <h3>Коментарі з даної пропозиції відсутні</h3> <?php }
      ?>
</div>


<!-- Тригер/Відкриття Модального вікна -->

            <!-- Модальне вікно -->
            <div id="myModal" class="modal">

             <!-- Модальное содержание -->
            <div class="modal-content">
            <div class="modal-header">
            <span class="close">&times;</span>
            <h2><?= $electronics['title'] ?></h2>
            </div>
            <div class="modal-body" align = "center">

             <img src='vendor/tovar/<?= $electronics['image'] ?>' >
            </div>
            <div class="modal-footer">
                <h3>Miy Mikolay Global Corparation Word</h3>
            </div>
            </div>
            </div>
</body>
</html>

<script>
// Отримати модуль
var modal = document.getElementById("myModal");

// Отримати кнопку, яка відкриває модаль
var btn = document.getElementById("myBtn");

// Отримати елемент <span>, який закриє модуль
var span = document.getElementsByClassName("close")[0];

// Коли користувач натискає кнопку, відкрити модуль
btn.onclick = function() {
  modal.style.display = "block";
}

// Коли користувач клацне <span> (x), закрити модаль
span.onclick = function() {
  modal.style.display = "none";
}

// Коли користувач натисне в будь-яке місце поза модулем, закрить його
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
