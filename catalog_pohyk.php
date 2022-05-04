<?php
//Точка входу
session_start();

//Якщо в процесі сесії імя користувача не встановлено, пробуємо його азяти з кук
if(!isset($_SESSION['username']) && isset($_COOKIE['username']))
$_SESSION['username'] = $_COOKIE['username'];

//Ще раз шукаємо користувача в сесії
$username = $_SESSION['username'];

//Неавторизованх користувачів підписувати як Гість
if ($username == Null) {
    $_SESSION['username'] = 'Гість';}

require_once 'config/connect.php';
$array = $_POST['text'];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Каталог</title>
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

/*Клас для контейнеру*/
.container {
    max-width: 990px;
    margin: auto;}

.product-container {
    display: flex; /*Багатоцільова властивість, яка визначає, як елемент повинен бути показаний у документі.*/
    flex-wrap: wrap; /*Властивість Вказує, слід розташовуватися в один рядок або можна зайняти кілька рядків. */
    justify-content: space-around;} /*Властивість  визначає, як браузер розподіляє простір навколо елементів уздовж головної осі контейнера*/

.product {
    max-width: 110px;
    border: 2px solid black; /*дозволяє одночасно встановити товщину, стиль та колір навколо елемента*/
       border-radius: 13em 0.5em/1em 0.5em; /*Встановлює радіус заокруглення куточків рамки*/
    margin: 10px; /*отступа от каждого края элемента*/
    padding: 20px; /*Встановлює значення полів довкола вмісту елемента*/
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;} /*Додає тінь до елемента*/

.product img {
    width: 100%;}

.product-bottom p {
    font-size: 16px; /*Розмір шришта*/
    font-family: 'Arial';  /*Вид шришта*/
    font-weight: 600; /*Встановлює насиченість шрифту*/
    font-variant: all-petite-caps;} /*Визначає, як потрібно представляти букви*/

.product-price { color: red;}

.product-text-title {color: black;}

/*Кнопка №1*/
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

/*Кнопка №2*/
.btn{
    background: black;
    color: white;
    font-size: 12px;
    padding: 10 10px;
    height: 30px;
    outline: none; /*Універсальна властивість, що одночасно встановлює колір, стиль та товщину зовнішньої межі на всіх чотирьох сторонах елемента*/
    border-radius: 7px;
    cursor: pointer; /*Встановлює форму курсора*/}


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
    color:  red;
    border: 5px solid; /*границі вікна*/
    border-radius: 6px;}

    a{
        color : red;
    }

/*Поле лоя введення інформації №1*/
.pole{
    width: 250px;
    background: yellow;
    height: 20px;
    border-radius: 5px;}
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

  #menuVertical ul li:hover ul{display:block;}

#menuVertical{width:100%;height:auto;}
    #menuVertical ul{
        display:block;
         width: avto;
        max-width: 170px;
        height:auto;
        margin:0px;
        padding:0px;
        list-style:none;
        position: static;
        list-style: 150px;
        bottom: 50px;
    }
        #menuVertical ul li{display:block; width:100%; height:auto; position:relative;}
            #menuVertical ul li a{
                position:relative;
                display:block;
                width:100%;
                height:auto;
                box-sizing:border-box;
                font-size:12px;
                text-transform:uppercase;
                font-weight:bold;
                color:white;
                line-height:1.2em;
                padding:10px 15px;
                background:black;
                border-top:1px solid yellow;
                text-decoration:none;
            }
            #menuVertical ul  li:first-child a{border:0px;}
            #menuVertical ul li a:hover, #menuVertical ul li:hover a{
                background:yellow;
                color : black;
            }
            #menuVertical ul li ul{
                position:absolute;
                top:0px;
                left:100%;
                display:none;
                width:auto;
            }
            /*******показываем выпадашку при наведении ********/
            #menuVertical ul li:hover ul{display:block;}
                #menuVertical ul li ul li a{
                    white-space:nowrap;
                    text-transform:none;
                    padding:5px 20px;
                }
                    #menuVertical ul li ul li a:hover{
                        background:black;
                        color:red;
                    }
h1{
   font-size: 22px;
}
h2{
   font-size: 20px;
}
}

/* Maximum aspect ratio */
@media (min-width: 992px) {
    html, body {
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
      }
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

/*Клас для контейнеру*/
.container {
    max-width: 1400px;
    margin: auto;}

.product-container {
    display: flex; /*Багатоцільова властивість, яка визначає, як елемент повинен бути показаний у документі.*/
    flex-wrap: wrap; /*Властивість Вказує, слід розташовуватися в один рядок або можна зайняти кілька рядків. */
    justify-content: space-around;} /*Властивість  визначає, як браузер розподіляє простір навколо елементів уздовж головної осі контейнера*/

.product {
    max-width: 350px;
    border: 2px solid black; /*дозволяє одночасно встановити товщину, стиль та колір навколо елемента*/
       border-radius: 13em 0.5em/1em 0.5em; /*Встановлює радіус заокруглення куточків рамки*/
    margin: 10px; /*отступа от каждого края элемента*/
    padding: 20px; /*Встановлює значення полів довкола вмісту елемента*/
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;} /*Додає тінь до елемента*/

.product img {
    width: 100%;}

.product-bottom p {
    font-size: 18px; /*Розмір шришта*/
    font-family: 'Arial';  /*Вид шришта*/
    font-weight: 600; /*Встановлює насиченість шрифту*/
    font-variant: all-petite-caps;} /*Визначає, як потрібно представляти букви*/

.product-price { color: red;}

.product-text-title {color: black;}

/*Кнопка №1*/
.btn-buy{
    background: black;
    color: white;
    font-size: 15px;
    padding: 0 30px;
    height: 40px;
    outline: none; /*Універсальна властивість, що одночасно встановлює колір, стиль та товщину зовнішньої межі на всіх чотирьох сторонах елемента*/
    border-radius: 7px;
    cursor: pointer; /*Встановлює форму курсора*/
    margin-left: 60px;}

/*Кнопка №2*/
.btn{
    background: black;
    color: white;
    font-size: 15px;
    padding: 0 30px;
    height: 30px;
    outline: none; /*Універсальна властивість, що одночасно встановлює колір, стиль та товщину зовнішньої межі на всіх чотирьох сторонах елемента*/
    border-radius: 7px;
    cursor: pointer; /*Встановлює форму курсора*/}


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
     font-size: 22px;
     color: black;
     background: white;
    border-radius: 6px;
font-family: "cursive";}

.ap_textt{
     position: fixed;
    right: 15px;
    bottom: 15px;
    color:  red;
    border: 5px solid; /*границі вікна*/
    border-radius: 6px;}

    a{
        color : red;
    }

/*Поле лоя введення інформації №1*/
.pole{
    width: 250px;
    background: yellow;
    height: 20px;
    border-radius: 5px;}
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

  #menuVertical ul li:hover ul{display:block;}

#menuVertical{width:100%;height:auto;}
    #menuVertical ul{
        display:block;
         width: avto;
        max-width: 200px;
        height:auto;
        margin:0px;
        padding:0px;
        list-style:none;
        position: static;
        list-style: 150px;
        bottom: 50px;
    }
        #menuVertical ul li{display:block; width:100%; height:auto; position:relative;}
            #menuVertical ul li a{
                position:relative;
                display:block;
                width:100%;
                height:auto;
                box-sizing:border-box;
                font-size:13px;
                text-transform:uppercase;
                font-weight:bold;
                color:white;
                line-height:1.2em;
                padding:10px 15px;
                background:black;
                border-top:1px solid yellow;
                text-decoration:none;
            }
            #menuVertical ul  li:first-child a{border:0px;}
            #menuVertical ul li a:hover, #menuVertical ul li:hover a{
                background:yellow;
                color : black;
            }
            #menuVertical ul li ul{
                position:absolute;
                top:0px;
                left:100%;
                display:none;
                width:auto;
            }
            /*******показываем выпадашку при наведении ********/
            #menuVertical ul li:hover ul{display:block;}
                #menuVertical ul li ul li a{
                    white-space:nowrap;
                    text-transform:none;
                    padding:5px 20px;
                }
                    #menuVertical ul li ul li a:hover{
                        background:black;
                        color:red;
                    }
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
    <p class="ap_textt"><button  id="myBtn"><img  class = "product_img" src='img/tell.png' title="Дзвінок менеджеру"  ></button>
    </p>
<ul class="menu-main">
  <li><a href="index.php">Головна</a></li>
            <li><a href="catalog.php" class="current">Каталог</a></li>
            <li><a href="pro_nas.php">Про нас</a></li>
            <li><a href="cat.php">Корзина</a></li>
             <li><a href="open.php">Авторизація</a></li>
</ul>
    <div align="right">  <form action="" method="post">
                        <input class = "pole" type="text" name="text" placeholder="Названія товара">
                        <button class = "btn" type="submit">Пошук на сайті </button>
            </form> </div>
<!-- Результати пошуку користувача, або адміністратора -->
      <?Php if($array == '') { ?>
<h1 align="center" >Каталог</h1>
      <?php } else { ?>
        <?php }?>
<nav id="menuVertical">
    <ul>
        <li><h2>Каталог</h2></a>
        <li><a href='/catalog_categ.php?name=Електроніка'>Електроніка</a>
            <ul>
                <li><a href='/catalog_categ_cat.php?name=Смарт Часи'>Смарт Часи</a></li>
                <li><a href='/catalog_categ_cat.php?name=Бездротові навушники'>Бездротові навушники</a></li>
                <li><a href='/catalog_categ_cat.php?name=Наручні Годинники'>Наручні Годинники</a></li>
                <li><a href='/catalog_categ_cat.php?name=Фітнес-браслети'>Фітнес-браслети</a></li>
                <li><a href='/catalog_categ_cat.php?name=Bluetooth-колонки'>Bluetooth-колонки</a></li>
                <li><a href='/catalog_categ_cat.php?name=Інша електроніка'>Інша електроніка</a></li>
            </ul></li>
        <li><a href='/catalog_categ.php?name=Подарункові набори'>Подарункові набори</a>
            <ul>
                <li><a href='/catalog_categ_cat.php?name=Сувеніри'>Сувеніри</a></li>
                <li><a href='/catalog_categ_cat.php?name=Пакетик Кольоровий'>Пакетик Кольоровий</a></li>
                <li><a href='/catalog_categ_cat.php?name=Інші подарунки'>Інші подарунки</a></li>
            </ul>
        </li>
        <li><a href='/catalog_categ.php?name=Дитячі товари'>Дитячі товари</a>
            <ul>
                <li><a href='/catalog_categ_cat.php?name=Брелок'>Брелок</a></li>
                <li><a href='/catalog_categ_cat.php?name=Дитячі приколи'>Дитячі приколи</a></li>
                <li><a href='/catalog_categ_cat.php?name=Різні Іграшки'>Різні Іграшки</a></li>
                <li><a href='/catalog_categ_cat.php?name=Обручі'>Обручі</a></li>
                <li><a href='/catalog_categ_cat.php?name=Браслети'>Браслети</a></li>
                <li><a href='/catalog_categ_cat.php?name=Лизуни'>Лизуни</a></li>
                <li><a href='/catalog_categ_cat.php?name=Мячі'>Мячі</a></li>
                <li><a href='/catalog_categ_cat.php?name=Настільні ігри'>Настільні ігри</a></li>
            </ul>
        </li>
    </ul>
</nav>
<h1 align="center" >Рузультати пошуку "<?php echo $array; ?>"</h1>
<div class="container">
    <div class="product-container">
        <?php
            /*Делаем выборку строк і преобразовывем полученные данные в нормальный массив*/
            $electronics = mysqli_query($connect, "SELECT * FROM `electronics` WHERE `electronics`.`title` LIKE '%$array%' and `electronics`.`count` > 0");
            $electronics = mysqli_fetch_all($electronics);
        if($electronics != null){
            foreach ($electronics as $electronics) {
                echo "
                    <div class='product'>
                        <img src='vendor/tovar/".$electronics[2]."'>
                        <div align='center' class='product-bottom'>
                            <p>".$electronics[1]."</p>
                            <p class='product-price'><span class='product-text-title'>Код: </span>".$electronics[3]."</p>
                            <p class='product-price'><span class='product-text-title'>Ціна: </span>".$electronics[6]." грн<a href='/product.php?id=".$electronics[0]."'><button class='btn-buy'>Детальніше</button></a></p>
                        </div>
                    </div>
                ";
            }}
        else { ?> <h2>Товар в магазині відсунній, або його найменування було введено не правильно</h2> <?php }
        ?>

    </div>
</div>
<!-- Тригер/Відкриття Модального вікна -->

            <!-- Модальне вікно -->
            <div id="myModal" class="modal">

             <!-- Модальное содержание -->
            <div class="modal-content">
            <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Дзвінок менеджеру</h2>
            </div>
            <div class="modal-body" align = "center">

             <form class = "zakaz_text" action="vendor/create_tel_dz.php" method="post">
                <p>Вкажіть ім'я (як до вас можна звертатися)</p>
                <input class="pole" type="text" name="text" required><br>
                 <p>Телефон</p>
                <input class="pole" type="text" name="phone" value="+380" maxlength="13" required><br><br>
                <input type="submit" value="Замовити Дзвінок" class="btn">
             </form><br>
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