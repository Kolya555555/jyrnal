<?php
//Точка входу
session_start();

//Якщо в процесі сесії імя користувача не встановлено, пробуємо його азяти з кук
if(!isset($_SESSION['username']) && isset($_COOKIE['username']))
$_SESSION['username'] = $_COOKIE['username'];

//Ще раз шукаємо користувача в сесії
$username = $_SESSION['username'];

//Не авторизованих користувачів підписувати як гість
if ($username == Null) {
    $_SESSION['username'] = 'Гість';}
?>
<?php //header('refresh: 3'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Корзина</title>
</head>
<style>

/* Minimum aspect ratio */
@media (max-width: 991.8px) {
 html, body {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
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

.btn-buyy{
    background: black;
    color: white;
    font-size: 12px;
    padding: 10 10px;
    height: 30px;
    outline: none; /*Універсальна властивість, що одночасно встановлює колір, стиль та товщину зовнішньої межі на всіх чотирьох сторонах елемента*/
    border-radius: 7px;
    cursor: pointer; /*Встановлює форму курсора*/}

/*клас для тексту*/
.text{
    height: avto;
    width: 990px;}

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

.ap_textt{
     position: fixed;
    right: 10px;
    bottom: 10px;
    color:  black;
    border: 5px solid; /*границі вікна*/
    border-radius: 6px;}


h2{
   font-size: 20px;
}
th{
  font-size: 13px;
}
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
  background-color: yellow; /*фон середини*/
  margin: auto;
  padding: 0;
  border: 4px solid; /*границі вікна*/
  border-color: black #444 #888 #ccc; /*кольори границь*/
  width: 100%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19); /*Додає тінь до елемента*/
  animation-name: animatetop; /*Анімація*/
  animation-duration: 2s; /*Швидкісь анімації*/}

@keyframes animatetop {
  from {top:-300px; opacity:0} /*з верху*/
  to {top:0; opacity:1}}

/* Кнопка закрытия */
.close {
  color: yellow; /*Колір*/
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
  background-color: black;
  color: white;}

/* Основна частина модального вікна*/
.modal-body {
    padding: 2px 16px;}

/* Низ модального вікна*/
.modal-footer {
  padding: 2px 16px;
  background-color: black;
  color: white;}


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

/*Зображення товару*/
.product{
    height: 80px;
    width: 80px;}

/*Поле для введення кількості товару*/
.pole{
    width: 35px;
    background: wheat;
    height: 20px;
    border-radius: 7px;}

/*Поле для введення даних в мадальному вікні, менші вікна*/
.pole2{
    width: 300px;
    background: wheat;
    height: 25px;
    border-radius: 5px;}

/*Поле для введення даних в мадальному вікні, більше вікно*/
.pole3{
    width: 300px;
    background: wheat;
    height: 150px;
    border-radius: 5px;
    font-size: 18px;}

/*Оформлення тексту*/
/*клас для тексту*/
.text{
    height: avto;
    width: 990px;}

/*Оформлення тексту*/
.textt{
    color: #000;
    font-size: 13px;
    width: 250px;}

/*клас для логотипу сайту - зображення*/
.product_img{
     width: 50px;
    width: 50px;}

/*клас для логотипу сайту - текст*/
.product_text{
     font-size: 20px;
    font-family: 'cursive';
     color: black;}

/*Оформлення тексту модального вікна*/
.zakaz_text{
     font-size: 20px;
    font-family: 'Arial';
     color: black;}

/*Кнопка*/
.btn-buy{
    background: black;
    color: white;
    font-size: 12px;
    padding: 0 10px;
    height: 30px;
    outline: none; /*Універсальна властивість, що одночасно встановлює колір, стиль та товщину зовнішньої межі на всіх чотирьох сторонах елемента*/
    border-radius: 7px;
    cursor: pointer; /*Встановлює форму курсора*/}
.btn{
    background: black;
    color: white;
    font-size: 15px;
    outline: none;
    border-radius: 7px;
    cursor: pointer;}
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
  background-color: yellow; /*фон середини*/
  margin: auto;
  padding: 0;
  border: 4px solid; /*границі вікна*/
  border-color: black #444 #888 #ccc; /*кольори границь*/
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19); /*Додає тінь до елемента*/
  animation-name: animatetop; /*Анімація*/
  animation-duration: 2s; /*Швидкісь анімації*/}

@keyframes animatetop {
  from {top:-300px; opacity:0} /*з верху*/
  to {top:0; opacity:1}}

/* Кнопка закрытия */
.close {
  color: yellow; /*Колір*/
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
  background-color: black;
  color: white;}

/* Основна частина модального вікна*/
.modal-body {
    padding: 2px 16px;}

/* Низ модального вікна*/
.modal-footer {
  padding: 2px 16px;
  background-color: black;
  color: white;}

/*для "наших даних"*/
.ap_text{
     font-size: 22px;
     color: black;
     background: white;
    border-radius: 6px;
font-family: "cursive";}

    a{
        color : red;
    }

/*Зображення товару*/
.product{
    height: 150px;
    width: 150px;}

/*Поле для введення кількості товару*/
.pole{
    width: 35px;
    background: wheat;
    height: 20px;
    border-radius: 7px;}

/*Поле для введення даних в мадальному вікні, менші вікна*/
.pole2{
    width: 300px;
    background: wheat;
    height: 25px;
    border-radius: 5px;}

/*Поле для введення даних в мадальному вікні, більше вікно*/
.pole3{
    width: 300px;
    background: wheat;
    height: 150px;
    border-radius: 5px;
    font-size: 18px;}

/*Оформлення тексту*/
.text{
    color: #000;
    font-size: 16px;
    font-family: cursive;
    width: 30px;}

/*Оформлення тексту*/
.textt{
    color: #000;
    font-size: 18px;
    font-family: cursive;
    width: 300px;}

/*клас для логотипу сайту - зображення*/
.product_img{
    height: avto;
    width: 50px;}

/*клас для логотипу сайту - текст*/
.product_text{
     font-size: 33px;
    font-family: 'cursive';
     color: black;}

/*Оформлення тексту модального вікна*/
.zakaz_text{
     font-size: 20px;
    font-family: 'Arial';
     color: black;}

/*Кнопка*/
.btn-buy{
    background: black;
    color: white;
    font-size: 15px;
    padding: 0 30px;
    height: 40px;
    outline: none; /*Універсальна властивість, що одночасно встановлює колір, стиль та товщину зовнішньої межі на всіх чотирьох сторонах елемента*/
    border-radius: 7px;
    cursor: pointer; /*Встановлює форму курсора*/}
.btn{
    background: black;
    color: white;
    font-size: 15px;
    outline: none;
    border-radius: 7px;
    cursor: pointer;}
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
<h2 align="center">Кошик</h2>
    <table align="center" >
<?php
    /* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL)*/
    require_once 'config/connect.php';
    /*Делаем выборку строк і преобразовывем полученные данные в нормальный массив*/
    $orderr = mysqli_query($connect, "SELECT * FROM `orderr` WHERE `user` = '$username'");
    $orderr = mysqli_fetch_all($orderr);
    $a = '0';
        if($orderr != null){ //Перевірка чи корзина не пуста
        ?> <tr>
            <th>Зображення</th>
            <th>Назва</th>
            <th>Ціна</th>
            <th>Шт</th>
          </tr>
                <?php
                foreach ($orderr as $orderr) {
                ?>

                    <tr>
                        <td><img class = "product" src='vendor/tovar/<?= $orderr[5] ?>'></td>
                        <td class = "textt"><?= $orderr[1] ?></td>
                        <td class = "text"><?= $orderr[3]?> грн</td>
                         <td class = "text">
                        <table><tr><td><form action="vendor/settings_count_v.php" method="post">
                                 <input type="hidden" name="id" value="<?= $orderr[0] ?>">
                                 <input type="hidden" name="count" value="<?= $orderr[4] ?>">
                                  <button class="btn" type="submit">-</button>
                             </form></td> <td><?= $orderr[4]?></td>
                            <td><form action="vendor/settings_count_d.php" method="post">
                                 <input type="hidden" name="id" value="<?= $orderr[0] ?>">
                                 <input type="hidden" name="count" value="<?= $orderr[4] ?>">
                                  <button class="btn" type="submit">+</button>
                             </form></td></tr></table></td>
                        <td><button class="btn-buy"><a style="color: red;" href="vendor/delete_shop.php?id=<?= $orderr[0] ?>">Видалити</a></button></td>
                    <tr>
                        <!-- Підрахунок всих товарув -->
                       <?php  $a = $a + ($orderr[3]*$orderr[4]); ?>
                    </tr>
                <?php
            }
        ?>
    </table>



    <table align="center"> <tr>
        <td>
            <form action="vendor/update_zakaz.php" method="post">
                <input type="hidden" name="suma" value="<?php echo $a ?>">
                <button class="btn-buy" type="submit">Обновити Замовлення</button>
            </form> </h3>
        </td>
        <td>
            <!-- Тригер/Відкриття Модального вікна -->
            <button class="btn-buy" id="myBtn">Замовити</button>
            <!-- Модальне вікно -->
            <div id="myModal" class="modal">

             <!-- Модальное содержание -->
            <div class="modal-content">
            <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Оформлення заказу</h2>
            </div>
            <div class="modal-body" align = "center">

             <form class = "zakaz_text" action="vendor/send.php" method="post">
                <input type="hidden" name="suma" value="<?php echo $a ?>" >
                <p>Укажите ПІП</p>
                <input class = "pole2" type="text" name="fio" required><br>
                 <p>Укажите e-mail</p>
                <input class = "pole2" type="text" name="email"  required><br>
                 <p>Місто</p>
                <input class = "pole2" type="text" name="siti" required><br>
                 <p>Телефон</p>
                <input class = "pole2" type="text" name="phone" value="+380" maxlength="13" required><br>
                 <p>Місце для введення додаткової інформації</p>
                <textarea class ="pole3" type="text" name="text"></textarea><br>
                <input type="submit" value="Замовити" class="btn-buy">
             </form>



            </div>
            <div class="modal-footer">
                <h3>Miy Mukolay Global Corparation Word</h3>
            </div>
            </div>
            </div>
        </td>
        <td>
            <a style="color: red;" href="vendor/delete_cat.php?id=<?= $orderr[6] ?>"><button class="btn-buy" type="submit">Очистити корзину</button></a>
        </td></tr>
</table>
    <div align="center"><h2>Всього до сплати: <?= $a?> грн</h2></div>
    <?php }
        else { ?> <h2 class="product_text" align="center">Корзина Поки що ПУСТА </h2> <?php }
      ?>
</body>
</html>

<!-- Скрипт який реалізовує модальне вікно сайту -->
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