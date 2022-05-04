
<?php
//Точка входу
session_start();

//Якщо в процесі сесії імя користувача не встановлено, пробуємо його азяти з кук
if(!isset($_SESSION['username']) && isset($_COOKIE['username']))
$_SESSION['username'] = $_COOKIE['username'];

//Ще раз шукаємо користувача в сесії
$username = $_SESSION['username'];


/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once 'config/connect.php';
$user_id = $_GET['id'];

$user = mysqli_query($connect, "SELECT * FROM `user` WHERE `user` = '$username'");
$user = mysqli_fetch_all($user);
foreach($user as $user) {}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Кабінет</title>
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


/*клас для тексту*/
.text{
    height: avto;
    width: 1000px;}

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

.ap_textt{
     position: fixed;
    right: 15px;
    bottom: 15px;
    color:  red;
    border: 5px solid; /*границі вікна*/
    border-radius: 6px;}

    a{ color : red;}

h3{
    background: black;
     font-size: 25px;
    border-radius: 6px;
    color: white;
}
h4{
     font-size: 20px;
    border-radius: 6px;
}

.vic{
    background: #FFFE40;
    border-radius: 7em 0.5em/1.5em 2.5em;
    font-family: "cursive";
    width: 70%;
}
.vicc{
    background:  #42E73A;
    border-radius: 7em 0.5em/1.5em 2.5em;
    font-family: "cursive";
    width: 70%;
}
</style>


<body>
    <!-- Виведення шапки сайту -->
     <p class='product_text' align="center" ><img  class = "product_img" src='img/111.png' >Мій Миколай - ваш власний кабінет</p>
        <p class="ap_text" align="center">
                            Телефон: <a href="tel: +380992431028">MTS +38 099-24-31-028</a>
                            Instagram: <a href="https://www.instagram.com/miymukolay/">miymukolay</a>
                            TikTok: <a href="http://tiktok.com/@miymukolay.com.ua">miymukolay.com.ua</a> </p>
    <ul class="menu-main">
        <li><a href="index.php">Головна</a></li>
            <li><a href="catalog.php" >Каталог</a></li>
            <li><a href="pro_nas.php">Про нас</a></li>
            <li><a href="cat.php">Корзина</a></li>
             <li><a href="open.php">Авторизація</a></li>
         </ul>
<h2 align="center" >Кабінет клієнта "<?=$username; ?>"</h2>
<?php
$zakaz = mysqli_query($connect, "SELECT * FROM `zakaz` WHERE `user` = '$username'");
$zakaz = mysqli_fetch_all($zakaz);
$orderr = mysqli_query($connect, "SELECT * FROM `orderr` WHERE `user` = '$username'");
$orderr = mysqli_fetch_all($orderr);
$zakaz_ok = mysqli_query($connect, "SELECT * FROM `zakaz_ok` WHERE `user` = '$username'");
$zakaz_ok = mysqli_fetch_all($zakaz_ok);
foreach ($zakaz as $zakaz) {
?>
    <div class="vic" align="center"><h3>Нові замовлення №<?= $zakaz[0] ?></h3>
             <h4>Логін: "<?= $zakaz[1] ?>"</h4>
              <h4>Телефон: "<?= $zakaz[2] ?>"</h4>
               <h4>Дата: "<?= $zakaz[5] ?>"</h4>
                <h4>Сума: "<?= $zakaz[6] ?> грн"</h4>
                 <h4>Деталі: "<?= $zakaz[7] ?>"</h4>
                <?php    }  ?></div>
                <div class="vicc" align="center">
                    <?php foreach ($zakaz_ok as $zakaz_ok) {?>
                <h3>Обговорені замовлення №<?= $zakaz_ok[0] ?></h3>
               <h4>Дата: "<?= $zakaz_ok[5] ?>"</h4>
                <h4>Сума: "<?= $zakaz_ok[6] ?> грн"</h4>
                 <h4>Перелік товару: "<?= $zakaz_ok[7] ?>"</h4>
                 <h4>Статус: "<?= $zakaz_ok[8] ?>"</h4>
 <?php    }  ?><br></div>


</body>
</html>

<script language="JavaScript"> //мову програмування якою написаний скрипт
var userName = '<?php echo $user_id;?>'
pass = prompt('Введіть номер телефону, який вказували при створення замовлення? Наприклад "380912345678"'); //відображає діалогове вікно з необов'язковим запитом на введення тексту.
if (pass == +userName) // пароль входу на сайт
{ alert('Дані вірні') } else { alert('Дані НЕвірні!'), top.location.href="index.php" } //При неправильному введеню пароля, спрямування користувача на головну сторінку сайту
</script>