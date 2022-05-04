<?php
require_once 'config/connect.php';

//Точка входу
session_start();

//Якщо в процесі сесії імя користувача не встановлено, пробуємо його азяти з кук
if(!isset($_SESSION['username']) && isset($_COOKIE['username']))
$_SESSION['username'] = $_COOKIE['username'];

//Ще раз шукаємо користувача в сесії
$username = $_SESSION['username'];
//Неавторизованх користувачів підписуємо як адміністратор
if ($username == Null) {
    $_SESSION['username'] = 'Адміністратор';}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Пошук</title>
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

/*Налаштування таблички*/
    th, td {padding: 3px;
    border-radius: 6px;}

    th {background: black;
        color: #fff;}

    td { background: wheat}

img{
    width: <?=$img?>px;
}

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


.topNubex {
    position: fixed;
    right: 15px;
    bottom: 15px;
    background: yellow ;
    color:  black;
    text-decoration-color: blue;
    font-size: 18pt;
    border: 2px solid; /*границі вікна*/
    border-radius: 5px;
    padding: 0 30px;
    <?php $img+5;?>
   }
.topNubexq {
    position: fixed;
    right: 15px;
    bottom: 50px;
    background: yellow ;
    color:  black;
    text-decoration-color: blue;
    font-size: 18pt;
    border: 2px solid; /*границі вікна*/
    border-radius: 5px;
    padding: 0 30px;
    <?php $img-5;?>
   }
img{
    width: 70px;
}
</style>


<body>
   <!-- Виведення шапки сайту -->
     <p class='product_text' align="center" ><img  class = "product_img" src='img/111.png' >Мій Миколай</p>
      <p class="ap_text">Ви ввійшли як <b>"<?php echo $username; ?>"</b>  <a href="open.php">Вихід</a></p>
<ul class="menu-main">
              <li><a href="admin.php">Головна</a></li>
            <li><a href="search.php">Пошук товару</a></li>
            <li><a href="coment.php"class="current">Пошук коментарів</a></li>
            <li><a href="user.php">Пошук користувачів</a></li>
            <li><a href="cat_admin.php">Робота</a></li>
</ul>
<a href="#" class="topNubexq">Вверх</a>
<a href="#top" class="topNubex">Вниз </a>

<!-- Виведення головного вмісту сторінки -->
      <h1 align="center" >Коментарі системи</h1>

    <!-- Виведення головного вмісту сторінки -->

      <div align="center">
    <table>

        <?php
            $b = $_POST['id'];
            $comments = mysqli_query($connect, "SELECT * FROM `comments` ");
            $comments = mysqli_fetch_all($comments);

        if($comments != null){
            ?>
        <tr>
            <th>Код товару</th>
            <th>Текст</th>
            <th>Користувач</th>
        </tr>
            <?Php
            foreach ($comments as $comments) {
                ?>
                    <tr>
                        <td><?= $comments[1] ?></td>
                        <td><?= $comments[2] ?></td>
                        <td><?= $comments[3] ?></td>
                    </tr>
                <?php
            }}
        else { ?> <h2 class="product_text" align="center">Коментарі в системі відсутні </h2> <?php }
      ?>
    </table></div><a name="top"></a></div>
</body>
</html>