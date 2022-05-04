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

    td { background: wheat}

</style>


<body>
     <!-- Виведення шапки сайту -->
     <p class='product_text' align="center" ><img  class = "product_img" src='img/111.png' >Мій Миколай</p>
    <p class="ap_text">Ви ввійшли як <b>"<?php echo $username; ?>"</b>  <a href="open.php">Вихід</a></p>
<ul class="menu-main">
             <li><a href="admin.php" >Головна</a></li>
            <li><a href="search.php">Пошук товару</a></li>
            <li><a href="cat_admin.php" >Робота</a></li>
            <li><a href="cat_zakaz.php"class="current">Обговорены замовлення</a></li><li><a href="cat_zakaz_d.php">Заявки на дзвінок</a></li>
</ul>

<h2 align="center">Обговорені замовлення</h2>
        <?php
            $zakaz_ok = mysqli_query($connect, "SELECT * FROM `zakaz_ok`");
            $zakaz_ok = mysqli_fetch_all($zakaz_ok);
        if($zakaz_ok != null){
            ?>
    <div align="center"><table>
        <tr>
           <th>Логін</th>
            <th>Сума</th>
            <th>Заказ</th>
            <th>Деталі</th>
            <th>Статус</th>
        </tr>
            <?Php
            foreach ($zakaz_ok as $zakaz_ok) {
                ?>
                    <tr>
                        <td><?= $zakaz_ok[1] ?></td>
                        <td><?= $zakaz_ok[6] ?> грн</td>
                        <td><?= $zakaz_ok[7] ?></td>
                        <td><div style="overflow: auto; width:150px ;height:45px;"><?= $zakaz_ok[9] ?></div></td>
                        <td><?= $zakaz_ok[8] ?></td>
                         <td><a style="color: blue;" href="vendor/zakaz_sobran.php?id=<?= $zakaz_ok[0] ?>">Зібраний</a></td>
                         <td><a style="color: yellow;" href="vendor/zakaz_vidpr.php?id=<?= $zakaz_ok[0] ?>">Відпривлений</a></td>
                         <td><a style="color: green" href="vendor/zakaz_doctav.php?id=<?= $zakaz_ok[0] ?>">Доставлений</a></td>
                         <td><a style="color: gold;" href="vendor/zakaz_polyhun.php?id=<?= $zakaz_ok[0] ?>">Отриманий</a></td>
                          <td><a style="color: red;" href="vendor/delete_ok.php?id=<?= $zakaz_ok[0] ?>">Видалити</a></td>
                    </tr>
                <?php
            }}
        else { ?> <h2 class="product_text" align="center">Обговорені замовлення відсутні</h2> <?php }
      ?>
    </table></div>
</body>
</html>
