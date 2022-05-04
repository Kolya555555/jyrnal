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
$img = 70;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Адміністратор</title>
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

img{
    width: <?=$img?>px;
}
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
    padding: 0 5px;
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

</style>


<body>
    <!-- Виведення шапки сайту -->
     <p class='product_text' align="center" ><img  class = "product_img" src='img/111.png' >Мій Миколай</p>
      <p class="ap_text">Ви ввійшли як <b>"<?php echo $username; ?>"</b>  <a href="open.php">Вихід</a></p>
<ul class="menu-main">
             <li><a href="admin.php" class="current">Головна</a></li>
            <li><a href="search.php">Пошук товару</a></li>
            <li><a href="cat_admin.php">Робота</a></li>
</ul>
<a href="#" class="topNubexq">Склад</a>
<a href="#top" class="topNubex">Замовити </a>
<!-- Виведення головного вмісту сторінки -->
      <h1 align="center" >Склад</h1>

    <!-- Виведення головного вмісту сторінки -->
    <div align="center">
    <table>
        <tr>
            <th>Назва</th>
            <th>Зобр.</th>
            <th>Код</th>
            <th>Ціна</th>
            <th>Шт</th>
        </tr>

        <?php
           /*Делаем выборку строк і преобразовывем полученные данные в нормальный массив*/
            $electronics = mysqli_query($connect, "SELECT * FROM `electronics` WHERE `electronics`.`count` > 0");
            $electronics = mysqli_fetch_all($electronics);

            /*Виводимо всі позиції в БД інтернет-магазину*/
            foreach ($electronics as $electronics) {
                ?>
                    <tr>

                        <td><div style="overflow: auto; width:auto;height:50px;"><?= $electronics[1] ?></div></td>
                        <td><img src="vendor/tovar/<?= $electronics[2] ?>"></td>
                        <td><?= $electronics[3] ?></td>
                        <td><?= $electronics[6] ?> грн</td>
                        <td>
                        <table><tr><td><form action="vendor/settings_count_v_a.php" method="post">
                                 <input type="hidden" name="id" value="<?= $electronics[0] ?>">
                                 <input type="hidden" name="count" value="<?= $electronics[8]?>">
                                  <button class="btn" type="submit">-</button>
                             </form></td> <td><?= $electronics[8]?></td>
                            <td><form action="vendor/settings_count_d_a.php" method="post">
                                 <input type="hidden" name="id" value="<?= $electronics[0] ?>">
                                 <input type="hidden" name="count" value="<?= $electronics[8]?>">
                                  <button class="btn" type="submit">+</button>
                             </form></td></tr></table>
                            </td>
                        <td><a href="product.php?id=<?= $electronics[0] ?>">Переглянути</a></td>
                        <td><a href="update.php?id=<?= $electronics[0] ?>">Змінити</a></td>
                    </tr>
                <?php
                $a = $a + ($electronics[6]*$electronics[8]);}
        ?>
    </table></div>
<div align="center">
    <br><a name="top"></a>
    <button class="btn-buy"><a style="color: yellow;" href="new.php">Додати товар на систему</a></button>
    <br></div>

    <div align="center"><h2>Всього в складі товару на: <?= $a?> грн</h2></div>

    <!-- Не має в складі -->
    <div align="center">
        <?php
        $electronics = mysqli_query($connect, "SELECT * FROM `electronics` WHERE `electronics`.`count` < 1");
            $electronics = mysqli_fetch_all($electronics);
            if ($electronics != null) { ?>

    <h1 align="center">На має в наявності</h1>
    <table>
        <tr>
            <th>Назва</th>
            <th>Зобр.</th>
            <th>Код</th>
            <th>Ціна</th>
            <th>Шт</th>
        </tr>

        <?php
            /*Виводимо всі позиції в БД інтернет-магазину*/
            foreach ($electronics as $electronics) {
                ?>
                    <tr>

                        <td><div style="overflow: auto; width:auto;height:50px;"><?= $electronics[1] ?></div></td>
                        <td><img src="vendor/tovar/<?= $electronics[2] ?>"></td>
                        <td><?= $electronics[3] ?></td>
                        <td><?= $electronics[6] ?></td>
                        <td>
                        <table><tr><td><form action="vendor/settings_count_v_a.php" method="post">
                                 <input type="hidden" name="id" value="<?= $electronics[0] ?>">
                                 <input type="hidden" name="count" value="<?= $electronics[8]?>">
                                  <button class="btn" type="submit">-</button>
                             </form></td> <td><?= $electronics[8]?></td>
                            <td><form action="vendor/settings_count_d_a.php" method="post">
                                 <input type="hidden" name="id" value="<?= $electronics[0] ?>">
                                 <input type="hidden" name="count" value="<?= $electronics[8]?>">
                                  <button class="btn" type="submit">+</button>
                             </form></td></tr></table>
                            </td>
                        <td><a href="product.php?id=<?= $electronics[0] ?>">Переглянути</a></td>
                        <td><a href="update.php?id=<?= $electronics[0] ?>">Змінити</a></td>
                        <td><a style="color: red;" href="vendor/delete.php?id=<?= $electronics[0] ?>">Видалити</a></td>
                    </tr>
                <?php
            }
        ?>
    </table>
<?php } else { ?>
    <h1 align="center">Всі позиції в наявності</h1>
<?php }?>
</div>
</body>
</html>
<script language="JavaScript"> //мову програмування якою написаний скрипт
if (top.location.search=="") { //параметри URL адреси
pass = prompt('Введіть пароль'); //відображає діалогове вікно з необов'язковим запитом на введення тексту.
if (pass=='2564') // пароль входу на сайт
{ alert('Пароль принят') } else { alert('Пароль непринят!'), top.location.href="index.php" } //При неправильному введеню пароля, спрямування користувача на головну сторінку сайту
};</script>