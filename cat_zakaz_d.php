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
    $_SESSION['username'] = 'Адміністратор';}

/* Подключаем файл для получения соединения к базе данных (PhpMyAdmin, MySQL) */
require_once 'config/connect.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Оброблені</title>
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

    th, td {padding: 5px;
    border-radius: 6px;}

    th {background: black;
        color: #fff;}

    td { background: wheat;
        width: 200px;
    }

</style>


<body>
     <!-- Виведення шапки сайту -->
     <p class='product_text' align="center" ><img  class = "product_img" src='img/111.png' >Мій Миколай</p>
    <p class="ap_text">Ви ввійшли як <b>"<?php echo $username; ?>"</b>  <a href="open.php">Вихід</a></p>
<ul class="menu-main">
             <li><a href="admin.php" >Головна</a></li>
            <li><a href="search.php">Пошук товару</a></li>
            <li><a href="cat_admin.php" >Робота</a></li>
            <li><a href="cat_zakaz.php">Обговорены замовлення</a></li><li><a href="cat_zakaz_d.php"class="current">Заявки на дзвінок</a></li>
</ul>

<h2 align="center">Заявки на дзвінок</h2>
        <?php
            $zakaz_tel = mysqli_query($connect, "SELECT * FROM `zakaz_tel`");
            $zakaz_tel = mysqli_fetch_all($zakaz_tel);
        if($zakaz_tel != null){
            ?>
    <div align="center"><table>
        <tr>
           <th>Імя</th>
            <th>Телефон</th>
            <th>Дата</th>
        </tr>
            <?Php
            foreach ($zakaz_tel as $zakaz_tel) {
                ?>
                    <tr>
                        <td><?= $zakaz_tel[1] ?></td>
                        <td><a href="tel: <?= $zakaz_tel[2] ?>"><?= $zakaz_tel[2] ?></a></td>
                        <td><?= $zakaz_tel[3] ?></td>
                          <td><a style="color: red;" href="vendor/delete_tel.php?id=<?= $zakaz_tel[0] ?>">Видалити</a></td>
                    </tr>
                <?php
            }}
        else { ?> <h2 class="product_text" align="center">Заявки на дзвінок відсутні</h2> <?php }
      ?>
    </table></div>
</body>
</html>
