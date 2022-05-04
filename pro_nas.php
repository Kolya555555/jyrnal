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

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Про нас</title>
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
     width: 50px;}

/*клас для логотипу сайту - текст*/
.product_text{
     font-size: 20px;
    font-family: 'cursive';
     color: black;}

/*клас для виведення переваг інтернет-магазину - картинки*/
.product_img{
    height: avto;
    width: 50px;}

.product_vik{
    height: avto;
    width: 50%;}

.product_vikk{
    width: avto;
    max-width: 300px;}

/*Виведення текста*/
.text{
    height: avto;
    width: 80%;}

/*Виведення карти*/
.map{
    height: 700px;
    width: 90%;
    margin: avto;
    border-radius: 15px;}

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
    img{
        width:80%;
    }
.per{
    margin-left: 60px;
    width: avto;
    max-width: 500px;

    }
h1{
   font-size: 22px;
}
h2{
   font-size: 20px;
}
h3{
   font-size: 15px;
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
     width: 50px;}

/*клас для логотипу сайту - текст*/
.product_text{
     font-size: 33px;
    font-family: 'cursive';
     color: black;}

/*клас для виведення переваг інтернет-магазину - картинки*/
.product_img{
    height: avto;
    width: 50px;}

.product_vik{
    height: avto;
    width: 50%;}

.product_vikk{
    width: avto;
    max-width: 300px;}

/*Виведення текста*/
.text{
    height: avto;
    width: 80%;}

/*Виведення карти*/
.map{
    height: 700px;
    width: 90%;
    margin: avto;
    border-radius: 15px;}

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
    img{
        width:80%;
    }
.per{
    margin-left: 60px;
    width: avto;
    max-width: 500px;

    }
}

<style>

</style>


<body>
       <!-- Виведення шапки сайту -->
     <p class='product_text' align="center" ><img  class = "product_img" src='img/111.png' >Мій Миколай - Ми Працюємо Для ВАС</p>
     <p class="ap_text">Ви ввійшли як <b>"<?php echo $username; ?>"</b>  <a href="open.php">Вихід</a></p>
        <p class="ap_text" align="center">
                            Телефон: <a href="tel: +380992431028">MTS +38 099-24-31-028</a>
                            Instagram: <a href="https://www.instagram.com/miymukolay/">miymukolay</a>
                            TikTok: <a href="http://tiktok.com/@miymukolay.com.ua">miymukolay.com.ua</a> </p>
<ul class="menu-main">
  <li><a href="index.php">Головна</a></li>
            <li><a href="catalog.php" >Каталог</a></li>
            <li><a href="pro_nas.php"class="current">Про нас</a></li>
            <li><a href="cat.php">Корзина</a></li>
             <li><a href="open.php">Авторизація</a></li>
</ul>
<!-- Виведення головного вмісту сторінки про нас-->
      <h1 align="center" >Про нас</h1>
<table >
              <tr>
                <td><div align="center"><img src='img/logg.png'></div></td>
             </tr>
            <tr>
                <td>
                    <h3 align="center">Інтернет-магазин "Мій Миколай" - кращі товари за низькими цінами!</h3>
                    <div align="center"><h3 class = "text" align="center" >Ми раді запропонувати вам недорогі, але якісні товари з докладними описами, характеристиками і фотографіями. У нас ви можете придбати чудові товари з області дитячих, подарункових і електронних товарів у вашому регіоні за цінами виробників. Продаж великого асортименту різноманітних товарів - основна  спеціалізація нашого інтернет-магазину. Ми доставимо ваше замовлення в будь-який куточок України, здійснимо детальну консультацію по товарах і порадимо з вибором.</h3></div>
                </td>
             </tr>
        </table>
    <h2 align="center" >Нaші переваги</h2>

<table align="center">
            <tr >
                <td >
                    <div class="per"><h2>- Низькі ціни від виробника.<br>
                   - Доставка замовлень Новою поштою по всій Україні.<br>
                   - Гарантія на всі товари!<br>
                   - Бонуси та знижки для постійних покупців. </h2></div>
                </td>
                <td>
                     <div align="center"><img class = "product_vik" src='img/881.jpg'></div>
                </td>
             </tr>
             </table>


<table align="center">
              <tr>
                <td >
                     <div align="center"><img class = "product_vikk" src='img/882.jpg'></div>
                </td>
                <td >
                    <div align="center"><img class = "product_vikk" src='img/883.png'></div>
                </td>
                <td >
                    <div align="center"><img class = "product_vikk" src='img/884.jpg'></div>
                </td>
             </tr>
             <tr align="center">
                <div align="center"><td><h3>Подарунки</h3></td></div>
                <div align="center"><td><h3>Акції на весь асортимент</h3></td></div>
                <div align="center"><td><h3>Швидка доставка</h3></td></div>
             </tr>
        </table>
        <h2 align="center" >Як нас знайти? Дуже просто, ось головне місценаходження ношого офісу і складу</h2>
<div align="center">
    <!-- Виведення розміщення нашого головного офіса -->
<iframe class = "map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2586.641599016552!2d34.515130616079084!3d49.5856491793655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d82f32a4ba3487%3A0xe0c1c386bdec33dd!2sMiy%20Mykolay!5e0!3m2!1sru!2sua!4v1635763767286!5m2!1sru!2sua" width="600" height="450" style="border:5;" allowfullscreen="" loading="lazy"></iframe>
</div>

</body>
</html>
